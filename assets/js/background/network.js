export function createNetwork() {
  let width = 0, height = 0, mobile = false, tablet = false, nodes = [];
  let radius = 120, columns = 0, rows = 0, time = 0;
  let heads = new Int32Array(0), next = new Int32Array(0), routes = [], trunks = [];
  let temporary = new Uint8Array(0), temporaryDegree = new Uint8Array(0);
  let backbone = new Uint8Array(0);
  let baseHeads = new Int32Array(0), baseNext = new Int32Array(0), neighbors = [];
  let qualityTarget = 0, quality = 0;
  const stats = { quality: 'high', nodes: 0, localLinks: 0, backboneLinks: 0, temporaryLinks: 0, pulses: 0 };
  let pulses = [], ambientCount = 0, attractionCount = 20, temporaryLimit = 8;
  let pointerRadius = 260, displacement = 36, burstCooldown = 0, pendingBurst = false;
  const distances = new Float64Array(20), nearest = new Int32Array(20);
  const pairs = new Int32Array(16);
  const pointer = { x: -1000, y: -1000, active: false, speed: 0, lastEvent: 0 };

  function buildBuckets() {
    heads.fill(-1);
    for (let i = 0; i < nodes.length; i++) {
      const p = nodes[i];
      const col = Math.max(0, Math.min(columns - 1, Math.floor(p.x / radius)));
      const row = Math.max(0, Math.min(rows - 1, Math.floor(p.y / radius)));
      const bucket = row * columns + col;
      p.bucket = bucket;
      next[i] = heads[bucket];
      heads[bucket] = i;
    }
  }

  function resize(size) {
    ({ width, height, mobile } = size);
    tablet = !mobile && width <= 1100;
    const narrowTablet = tablet && width <= 900;
    const min = mobile ? 45 : narrowTablet ? 100 : tablet ? 140 : 180;
    const max = mobile ? 80 : narrowTablet ? 150 : tablet ? 200 : 260;
    const target = Math.max(min, Math.min(max - 12, Math.round(width * height / (mobile ? 6000 : 5500))));
    let gridColumns = 1, gridRows = min, best = Infinity;
    for (let c = 2; c <= (max - 12) / 2; c++) {
      for (let r = 2; c * r <= max - 12; r++) {
        if (c * r < min) continue;
        const score = Math.abs(Math.log((c / r) / (width / height))) + Math.abs(c * r - target) / target;
        if (score < best) { best = score; gridColumns = c; gridRows = r; }
      }
    }
    radius = mobile ? 85 : narrowTablet ? 110 : 125;
    pointerRadius = tablet ? 240 : 260;
    displacement = tablet ? 28 : 36;
    attractionCount = tablet ? 12 : 20;
    temporaryLimit = tablet ? 6 : 8;
    ambientCount = mobile ? 2 : tablet ? 5 : 8;
    const burstCount = mobile ? 0 : tablet ? 2 : 4;
    columns = Math.max(1, Math.ceil(width / radius));
    rows = Math.max(1, Math.ceil(height / radius));
    heads = new Int32Array(columns * rows);
    neighbors = Array.from({ length: columns * rows }, (_, bucket) => {
      const result = [], row = Math.floor(bucket / columns), col = bucket % columns;
      for (let r = Math.max(0, row - 1); r <= Math.min(rows - 1, row + 1); r++) {
        for (let c = Math.max(0, col - 1); c <= Math.min(columns - 1, col + 1); c++) result.push(r * columns + c);
      }
      return result;
    });
    nodes = [];
    trunks = [];
    time = 0;
    burstCooldown = 0;
    pendingBurst = false;
    pointer.active = false;
    pointer.speed = 0;
    pointer.lastEvent = 0;
    nearest.fill(-1);
    pairs.fill(-1);
    // Broad anisotropic density zones gently warp the even base layer.
    const zoneCount = mobile ? 2 : 4;
    const zones = Array.from({ length: zoneCount }, (_, i) => ({
      x: (i % 2 + .3 + Math.random() * .4) * width / 2,
      y: (Math.floor(i / 2) + .3 + Math.random() * .4) * height / (mobile ? 1 : 2),
      rx: width * .24, ry: height * .28
    }));
    function addNode(bx, by, layer, amplitude) {
      const phase = Math.random() * Math.PI * 2;
      nodes.push({ bx, by, x: bx, y: by, layer, amplitude,
        sinPhase: Math.sin(phase), cosPhase: Math.cos(phase), ax: bx, ay: by,
        ox: 0, oy: 0, activity: 0, target: 0 });
      return nodes.length - 1;
    }
    const cellWidth = width / gridColumns, cellHeight = height / gridRows;
    for (let row = 0; row < gridRows; row++) {
      for (let col = 0; col < gridColumns; col++) {
        let x = (col + .12 + Math.random() * .76) * cellWidth;
        let y = (row + .12 + Math.random() * .76) * cellHeight;
        for (const zone of zones) {
          const dx = zone.x - x, dy = zone.y - y;
          const weight = Math.exp(-((dx / zone.rx) ** 2 + (dy / zone.ry) ** 2)) * .13;
          x += dx * weight;
          y += dy * weight;
        }
        addNode(x, y, (row * gridColumns + col) % 4 === 0 ? 0 : 1, mobile ? 2 : 3);
      }
    }
    // Strategic hubs are existing distributed nodes, not satellite-ring centers.
    const hubCount = mobile ? 4 : narrowTablet ? 8 : tablet ? 10 : 12;
    const hubs = [], hubColumns = mobile ? 2 : 4;
    const hubRows = Math.ceil(hubCount / hubColumns);
    for (let h = 0; h < hubCount; h++) {
      const x = (h % hubColumns + .5) * width / hubColumns;
      const y = (Math.floor(h / hubColumns) + .5) * height / hubRows;
      let selected = -1, distance = Infinity;
      for (let i = 0; i < nodes.length; i++) {
        if (nodes[i].layer === 2) continue;
        const d = Math.hypot(nodes[i].bx - x, nodes[i].by - y);
        if (d < distance) { distance = d; selected = i; }
      }
      nodes[selected].layer = 2;
      nodes[selected].amplitude = .6;
      hubs.push(selected);
    }
    // Only a few regional trunk corridors; short intermediate bridge nodes.
    const candidates = [], hubDegree = new Uint8Array(hubs.length);
    for (let i = 0; i < hubs.length; i++) {
      for (let j = i + 1; j < hubs.length; j++) {
        const a = nodes[hubs[i]], b = nodes[hubs[j]];
        const distance = Math.hypot(a.bx - b.bx, a.by - b.by);
        if (distance > radius * 1.4 && distance <= Math.min(radius * 3.5, Math.max(width, height) * .42)) {
          candidates.push({ i, j, distance });
        }
      }
    }
    candidates.sort((a, b) => a.distance - b.distance);
    const trunkLimit = mobile ? 1 : tablet ? 3 : 4;
    for (const edge of candidates) {
      if (trunks.length >= trunkLimit) break;
      if (hubDegree[edge.i] >= 1 || hubDegree[edge.j] >= 1) continue;
      hubDegree[edge.i]++;
      hubDegree[edge.j]++;
      const from = hubs[edge.i], to = hubs[edge.j], a = nodes[from], b = nodes[to];
      const chain = [from], connectors = Math.min(2, Math.ceil(edge.distance / (radius * 1.6)) - 1);
      for (let k = 1; k <= connectors; k++) {
        const t = k / (connectors + 1);
        chain.push(addNode(a.bx + (b.bx - a.bx) * t, a.by + (b.by - a.by) * t, 3, .3));
      }
      chain.push(to);
      trunks.push(chain);
    }
    next = new Int32Array(nodes.length);
    temporary = new Uint8Array(nodes.length * nodes.length);
    backbone = new Uint8Array(nodes.length * nodes.length);
    temporaryDegree = new Uint8Array(nodes.length);
    routes = nodes.map(() => []);
    buildBuckets();
    baseHeads = heads.slice();
    baseNext = next.slice();
    stats.nodes = nodes.length;
    // Cached base routes are only for pulse walkers, not permanent visual edges.
    for (let i = 0; i < nodes.length; i++) {
      const a = nodes[i], col = Math.floor(a.x / radius), row = Math.floor(a.y / radius);
      for (let r = Math.max(0, row - 1); r <= Math.min(rows - 1, row + 1); r++) {
        for (let c = Math.max(0, col - 1); c <= Math.min(columns - 1, col + 1); c++) {
          for (let j = heads[r * columns + c]; j !== -1; j = next[j]) {
            if (j <= i || Math.hypot(a.x - nodes[j].x, a.y - nodes[j].y) >= radius * .9) continue;
            routes[i].push(j);
            routes[j].push(i);
          }
        }
      }
    }
    for (const chain of trunks) {
      for (let k = 1; k < chain.length; k++) {
        const a = chain[k - 1], b = chain[k];
        backbone[a * nodes.length + b] = backbone[b * nodes.length + a] = 1;
        if (!routes[a].includes(b)) routes[a].unshift(b);
        if (!routes[b].includes(a)) routes[b].unshift(a);
      }
    }
    pulses = Array.from({ length: ambientCount + burstCount }, (_, i) => ({
      from: -1, to: -1, phase: Math.random(), ttl: 0, burst: i >= ambientCount
    }));
  }

  function drawLink(ctx, a, b, limit, base, activity = Math.max(a.activity, b.activity), strength = 1, squared) {
    if (squared === undefined) squared = (a.x - b.x) ** 2 + (a.y - b.y) ** 2;
    if (squared >= limit * limit) return false;
    const distance = Math.sqrt(squared);
    const t = Math.max(0, (distance / limit - .4) / .6);
    const fade = 1 - t * t * (3 - 2 * t);
    ctx.strokeStyle = `rgba(40,49,59,${fade * (base + activity * .16) * strength})`;
    ctx.beginPath();
    ctx.moveTo(a.x, a.y);
    ctx.lineTo(b.x, b.y);
    ctx.stroke();
    return true;
  }

  function render(ctx, dt, reduced) {
    ctx.clearRect(0, 0, width, height);
    if (!reduced) time += dt;
    burstCooldown = Math.max(0, burstCooldown - dt);
    pointer.speed *= Math.exp(-dt * 3);
    const interactive = pointer.active && !mobile && !reduced;
    const ease = 1 - Math.exp(-dt * 5);
    const wakeDecay = Math.exp(-dt / .18);
    quality += (qualityTarget - quality) * (1 - Math.exp(-dt * 2));
    const density = quality <= 1 ? 1 - quality * .08 : .92 - (quality - 1) * .12;
    const activeAmbient = Math.max(mobile ? 1 : 2, Math.round(ambientCount * (1 - quality * .25)));
    const activeTemporary = Math.max(2, Math.round(temporaryLimit * (1 - quality * .25)));
    stats.localLinks = stats.backboneLinks = stats.temporaryLinks = stats.pulses = 0;
    const sinX = Math.sin(time * .16), cosX = Math.cos(time * .16);
    const sinY = Math.sin(time * .13), cosY = Math.cos(time * .13);
    for (const p of nodes) {
      p.target = 0;
      p.ax = p.bx + (reduced ? 0 : (sinX * p.cosPhase + cosX * p.sinPhase) * p.amplitude);
      p.ay = p.by + (reduced ? 0 : (cosY * p.cosPhase - sinY * p.sinPhase) * p.amplitude);
    }
    if (interactive) {
      distances.fill(Infinity);
      nearest.fill(-1);
      // Base-position buckets match the attraction metric and never need rebuilding.
      const reach = pointerRadius;
      const left = Math.max(0, Math.floor((pointer.x - reach) / radius));
      const right = Math.min(columns - 1, Math.floor((pointer.x + reach) / radius));
      const top = Math.max(0, Math.floor((pointer.y - reach) / radius));
      const bottom = Math.min(rows - 1, Math.floor((pointer.y + reach) / radius));
      for (let r = top; r <= bottom; r++) {
        for (let c = left; c <= right; c++) {
          for (let i = baseHeads[r * columns + c]; i !== -1; i = baseNext[i]) {
            const p = nodes[i], distance = (pointer.x - p.bx) ** 2 + (pointer.y - p.by) ** 2;
            if (distance >= pointerRadius * pointerRadius || distance >= distances[attractionCount - 1]) continue;
            let slot = attractionCount - 1;
            while (slot > 0 && distance < distances[slot - 1]) {
              distances[slot] = distances[slot - 1];
              nearest[slot] = nearest[slot - 1];
              slot--;
            }
            distances[slot] = distance;
            nearest[slot] = i;
          }
        }
      }
      for (let k = 0; k < attractionCount; k++) {
        if (nearest[k] >= 0) {
          nodes[nearest[k]].target = Math.min(1, Math.sqrt(1 - Math.sqrt(distances[k]) / pointerRadius) * (1 + pointer.speed * .12));
        }
      }
    }
    for (const p of nodes) {
      p.activity = reduced ? 0 : Math.max(p.target, p.activity * wakeDecay);
      let targetX = 0, targetY = 0;
      if (p.target > 0) {
        const dx = pointer.x - p.bx, dy = pointer.y - p.by, distance = Math.sqrt(dx * dx + dy * dy);
        const pull = Math.min(distance * .35, displacement, displacement * p.target * (.9 + pointer.speed * .1));
        if (distance) { targetX = dx / distance * pull; targetY = dy / distance * pull; }
      }
      p.ox = reduced ? 0 : p.ox + (targetX - p.ox) * ease;
      p.oy = reduced ? 0 : p.oy + (targetY - p.oy) * ease;
      p.x = p.ax + p.ox;
      p.y = p.ay + p.oy;
      const opacity = p.layer === 2 ? .18 : p.layer === 3 ? .17 : p.layer === 0 ? .13 : .14;
      ctx.fillStyle = `rgba(40,49,59,${opacity + p.activity * .20})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.layer === 2 ? 2 : p.layer === 0 ? 1.1 : 1.5, 0, Math.PI * 2);
      ctx.fill();
    }
    buildBuckets();
    for (let k = 0; k < pairs.length; k += 2) {
      const i = pairs[k], j = pairs[k + 1];
      if (i >= 0) temporary[i * nodes.length + j] = temporary[j * nodes.length + i] = 0;
    }
    temporaryDegree.fill(0);
    pairs.fill(-1);
    let pairCount = 0;
    // Bounded node-to-node rewiring; degree cap prevents a cursor star.
    for (; pairCount < activeTemporary && !mobile && !reduced; pairCount++) {
      let from = -1, to = -1, best = (radius * 1.25) ** 2;
      for (let u = 0; u < attractionCount; u++) {
        const i = nearest[u];
        if (i < 0 || nodes[i].activity < .02 || temporaryDegree[i] >= 2) continue;
        for (let v = u + 1; v < attractionCount; v++) {
          const j = nearest[v];
          if (j < 0 || nodes[j].activity < .02 || temporaryDegree[j] >= 2
            || temporary[i * nodes.length + j] || backbone[i * nodes.length + j]) continue;
          const squared = (nodes[i].x - nodes[j].x) ** 2 + (nodes[i].y - nodes[j].y) ** 2;
          if (squared < best) { best = squared; from = i; to = j; }
        }
      }
      if (from < 0) break;
      pairs[pairCount * 2] = from;
      pairs[pairCount * 2 + 1] = to;
      temporary[from * nodes.length + to] = temporary[to * nodes.length + from] = 1;
      temporaryDegree[from]++;
      temporaryDegree[to]++;
    }
    ctx.lineWidth = .8;
    for (let i = 0; i < nodes.length; i++) {
      const a = nodes[i];
      for (const bucket of neighbors[a.bucket]) {
          for (let j = heads[bucket]; j !== -1; j = next[j]) {
            if (j <= i || backbone[i * nodes.length + j]) continue;
            const b = nodes[j], squared = (a.x - b.x) ** 2 + (a.y - b.y) ** 2;
            const limit = (a.layer === 2 || b.layer === 2 ? radius : radius * .96) * density;
            if (squared >= limit * limit) continue;
            // Blend base links into rewired links as activity grows and fades.
            const blend = temporary[i * nodes.length + j] ? Math.min(a.activity, b.activity) : 0;
            if (drawLink(ctx, a, b, limit, a.layer === 0 && b.layer === 0 ? .08 : .09,
              Math.max(a.activity, b.activity), 1 - blend * .35, squared)) stats.localLinks++;
          }
      }
    }
    for (const chain of trunks) {
      for (let k = 1; k < chain.length; k++) {
        if (drawLink(ctx, nodes[chain[k - 1]], nodes[chain[k]], radius * 1.9, .075)) stats.backboneLinks++;
      }
    }
    for (let k = 0; k < pairCount; k++) {
      const a = nodes[pairs[k * 2]], b = nodes[pairs[k * 2 + 1]];
      const activity = Math.min(a.activity, b.activity);
      if (drawLink(ctx, a, b, radius * 1.25, .09, activity, activity * .55)) stats.temporaryLinks++;
    }
    if (reduced) { pendingBurst = false; return; }
    if (pendingBurst && interactive && !burstCooldown) {
      for (let i = ambientCount; i < pulses.length; i++) {
        const from = nearest[(i - ambientCount) * 2];
        if (from < 0 || !routes[from].length) continue;
        const pulse = pulses[i];
        pulse.from = from; pulse.to = routes[from][0]; pulse.phase = 0; pulse.ttl = 1.8;
      }
      burstCooldown = .65;
    }
    pendingBurst = false;
    for (let index = 0; index < pulses.length; index++) {
      const pulse = pulses[index];
      if (!pulse.burst && index >= activeAmbient) continue;
      if (pulse.burst && quality > 1.5 && index >= ambientCount + 2) { pulse.ttl = 0; continue; }
      if (pulse.burst && pulse.ttl <= 0) continue;
      if (pulse.from < 0) {
        pulse.from = pulse === pulses[0] && trunks.length ? trunks[0][0] : Math.floor(Math.random() * nodes.length);
        pulse.to = routes[pulse.from][0] ?? -1;
      }
      if (pulse.to < 0) { pulse.from = -1; continue; }
      let a = nodes[pulse.from], b = nodes[pulse.to];
      const length = Math.sqrt((a.x - b.x) ** 2 + (a.y - b.y) ** 2);
      pulse.phase += dt * (pulse.burst ? 150 : mobile ? 28 : 45) / Math.max(1, length);
      if (pulse.burst) pulse.ttl -= dt;
      if (pulse.phase >= 1) {
        const previous = pulse.from;
        pulse.from = pulse.to;
        const options = routes[pulse.from];
        pulse.to = options.length ? options[Math.floor(Math.random() * options.length)] : -1;
        if (pulse.to === previous && options.length > 1) pulse.to = options[(options.indexOf(previous) + 1) % options.length];
        pulse.phase %= 1;
        if (pulse.to < 0) continue;
        a = nodes[pulse.from]; b = nodes[pulse.to];
      }
      ctx.fillStyle = `rgba(40,49,59,${pulse.burst ? .28 * Math.min(1, Math.max(0, pulse.ttl)) : .18})`;
      if (!backbone[pulse.from * nodes.length + pulse.to] && (a.x - b.x) ** 2 + (a.y - b.y) ** 2 >= radius * radius) continue;
      ctx.beginPath();
      ctx.arc(a.x + (b.x - a.x) * pulse.phase, a.y + (b.y - a.y) * pulse.phase, pulse.burst ? 1.4 : 1.2, 0, Math.PI * 2);
      ctx.fill();
      stats.pulses++;
    }
  }

  return {
    init() {}, resize, render,
    setQuality(level) {
      qualityTarget = level === 'low' ? 2 : level === 'medium' ? 1 : 0;
      stats.quality = level === 'low' ? 'low' : level === 'medium' ? 'medium' : 'high';
    },
    getStats() { return { ...stats }; },
    pointerMove(value) {
      const now = performance.now();
      if (value.active && pointer.active && pointer.lastEvent) {
        const seconds = Math.max(.008, (now - pointer.lastEvent) / 1000);
        const speed = Math.min(1, Math.hypot(value.x - pointer.x, value.y - pointer.y) / seconds / 1200);
        pointer.speed += (speed - pointer.speed) * .45;
        if (speed > .65) pendingBurst = true;
      }
      pointer.x = value.x; pointer.y = value.y; pointer.active = value.active;
      pointer.lastEvent = value.active ? now : 0;
    },
    destroy() {
      nodes = []; routes = []; trunks = []; pulses = [];
      heads = next = new Int32Array(0);
      temporary = temporaryDegree = new Uint8Array(0);
      backbone = new Uint8Array(0);
      baseHeads = baseNext = new Int32Array(0); neighbors = [];
      nearest.fill(-1); pointer.active = false; pendingBurst = false;
    }
  };
}
