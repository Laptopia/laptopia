export function createNetwork() {
  let width = 0, height = 0, mobile = false, particles = [];
  let time = 0, radius = 140, bucketColumns = 0, bucketRows = 0;
  let heads = new Int32Array(0), next = new Int32Array(0);
  let clusters = [], bridges = [], localLinks = new Uint8Array(0);
  const nearest = new Float64Array(8);
  const nearestNodes = new Int32Array(8).fill(-1);
  const temporaryPairs = new Int32Array(8);
  const pointerRadius = 200, maxDisplacement = 24;
  let pointer = { x: -1000, y: -1000, active: false };

  function resize(size) {
    ({ width, height, mobile } = size);
    const tablet = !mobile && width <= 1100;
    const count = Math.max(mobile ? 2 : tablet ? 4 : 5,
      Math.min(mobile ? 4 : tablet ? 6 : 8, Math.round(width * height / (mobile ? 140000 : 160000))));
    const target = Math.max(mobile ? 25 : tablet ? 70 : 100,
      Math.min(mobile ? 40 : tablet ? 100 : 140, Math.round(width * height / (mobile ? 10000 : 9000))));
    const satellites = Math.max(6, Math.min(14, Math.floor((target - 2 * (count - 1)) / count) - 1));
    const rows = Math.max(1, Math.min(count, Math.round(Math.sqrt(count * height / width))));
    const cellHeight = height / rows;
    radius = mobile ? 105 : tablet ? 130 : 140;
    bucketColumns = Math.max(1, Math.ceil(width / radius));
    bucketRows = Math.max(1, Math.ceil(height / radius));
    heads = new Int32Array(bucketColumns * bucketRows);
    time = 0;
    particles = [];
    clusters = [];
    bridges = [];
    nearestNodes.fill(-1);
    function addNode(bx, by, cluster, hub = false, bridge = false) {
      const index = particles.length;
      particles.push({ bx, by, x: bx, y: by, cluster, hub, bridge,
        phase: Math.random() * Math.PI * 2, amplitude: bridge ? 0 : hub ? .5 : mobile ? 2 : 3,
        ox: 0, oy: 0, active: 0 });
      return index;
    }
    for (let row = 0; row < rows; row++) {
      const columns = Math.floor(count / rows) + (row < count % rows ? 1 : 0);
      const cellWidth = width / columns;
      for (let col = 0; col < columns; col++) {
        const bx = (col + .42 + Math.random() * .16) * cellWidth;
        const by = (row + .42 + Math.random() * .16) * cellHeight;
        const spread = Math.min(radius * .78, cellWidth * .36, cellHeight * .36);
        const cluster = clusters.length, members = [addNode(bx, by, cluster, true)];
        const rotation = Math.random() * Math.PI * 2;
        const stretch = 1.05 + Math.random() * .12;
        const squash = .82 + Math.random() * .12;
        const bias = (Math.random() - .5) * spread * .24;
        for (let s = 0; s < satellites; s++) {
          const angle = s * 2.39996 + (Math.random() - .5) * .65;
          const distance = spread * (.28 + .72 * Math.sqrt((s + .5) / satellites)) * (.9 + Math.random() * .2);
          const localX = Math.cos(angle) * distance * stretch + bias;
          const localY = Math.sin(angle) * distance * squash + (s % 4 === 0 ? spread * .08 : 0);
          const x = Math.max(8, Math.min(width - 8, bx + localX * Math.cos(rotation) - localY * Math.sin(rotation)));
          const y = Math.max(8, Math.min(height - 8, by + localX * Math.sin(rotation) + localY * Math.cos(rotation)));
          members.push(addNode(x, y, cluster));
        }
        clusters.push({ hub: members[0], members });
      }
    }
    // Sparse local structure within each subsystem, evaluated through buckets below.
    localLinks = new Uint8Array(particles.length * particles.length);
    const originalCount = particles.length;
    const degree = new Uint8Array(originalCount);
    for (const cluster of clusters) {
      const candidates = [];
      const members = cluster.members;
      for (let a = 0; a < members.length; a++) {
        for (let b = a + 1; b < members.length; b++) {
          const i = members[a], j = members[b];
          const distance = Math.hypot(particles[i].bx - particles[j].bx, particles[i].by - particles[j].by);
          if (distance < radius) candidates.push({ i, j, distance });
        }
      }
      candidates.sort((a, b) => a.distance - b.distance);
      function connect(edge) {
        localLinks[edge.i * originalCount + edge.j] = 1;
        localLinks[edge.j * originalCount + edge.i] = 1;
        degree[edge.i]++;
        degree[edge.j]++;
      }
      for (const edge of candidates) {
        if (degree[edge.i] >= (particles[edge.i].hub ? 6 : 4)
          || degree[edge.j] >= (particles[edge.j].hub ? 6 : 4)) continue;
        if (degree[edge.i] < 2 || degree[edge.j] < 2) connect(edge);
      }
      for (const edge of candidates) {
        if (!localLinks[edge.i * originalCount + edge.j]
          && degree[edge.i] < (particles[edge.i].hub ? 6 : 4)
          && degree[edge.j] < (particles[edge.j].hub ? 6 : 4)) connect(edge);
      }
    }
    // A nearest-cluster spanning tree gives one bridge corridor per adjacent pair.
    const candidates = [], parent = clusters.map((_, i) => i);
    function root(i) { while (parent[i] !== i) i = parent[i]; return i; }
    for (let i = 0; i < clusters.length; i++) {
      for (let j = i + 1; j < clusters.length; j++) {
        const a = particles[clusters[i].hub], b = particles[clusters[j].hub];
        candidates.push({ i, j, distance: Math.hypot(a.bx - b.bx, a.by - b.by) });
      }
    }
    candidates.sort((a, b) => a.distance - b.distance);
    function addBridge(edge) {
      let from = -1, to = -1, shortest = Infinity;
      for (const i of clusters[edge.i].members) {
        for (const j of clusters[edge.j].members) {
          const distance = Math.hypot(particles[i].bx - particles[j].bx, particles[i].by - particles[j].by);
          if (distance < shortest) { shortest = distance; from = i; to = j; }
        }
      }
      const a = particles[from], b = particles[to], chain = [from];
      const connectors = Math.min(2, Math.max(0, Math.ceil(shortest / (radius * .8)) - 1));
      for (let k = 1; k <= connectors; k++) {
        const t = k / (connectors + 1);
        chain.push(addNode(a.bx + (b.bx - a.bx) * t, a.by + (b.by - a.by) * t, -1, false, true));
      }
      chain.push(to);
      bridges.push(chain);
    }
    for (const edge of candidates) {
      if (root(edge.i) === root(edge.j)) continue;
      parent[root(edge.i)] = root(edge.j);
      edge.used = true;
      addBridge(edge);
    }
    // One extra nearby corridor softens separate islands without an all-to-all web.
    const extra = candidates.find(edge => !edge.used && edge.distance <= radius * 3.8);
    const nodeLimit = mobile ? 40 : tablet ? 100 : 140;
    if (extra && particles.length + 2 <= nodeLimit) addBridge(extra);
    // Expand the membership lookup once to include shared corridor nodes.
    const expanded = new Uint8Array(particles.length * particles.length);
    for (let i = 0; i < originalCount; i++) {
      for (let j = 0; j < originalCount; j++) expanded[i * particles.length + j] = localLinks[i * originalCount + j];
    }
    for (const chain of bridges) {
      for (let k = 1; k < chain.length; k++) {
        expanded[chain[k - 1] * particles.length + chain[k]] = 2;
        expanded[chain[k] * particles.length + chain[k - 1]] = 2;
      }
    }
    localLinks = expanded;
    next = new Int32Array(particles.length);
  }

  function render(ctx, dt, reduced) {
    ctx.clearRect(0, 0, width, height);
    const interactive = pointer.active && !mobile && !reduced;
    const ease = 1 - Math.exp(-dt * 4);
    if (!reduced) time += dt;
    nearest.fill(Infinity);
    if (interactive) {
      // Keep only eight nearest distances in a reusable buffer: O(8n).
      nearestNodes.fill(-1);
      for (let i = 0; i < particles.length; i++) {
        const p = particles[i];
        const distance = Math.hypot(pointer.x - p.bx, pointer.y - p.by);
        if (distance > pointerRadius || distance >= nearest[7]) continue;
        let slot = 7;
        while (slot > 0 && distance < nearest[slot - 1]) {
          nearest[slot] = nearest[slot - 1];
          nearestNodes[slot] = nearestNodes[slot - 1];
          slot--;
        }
        nearest[slot] = distance;
        nearestNodes[slot] = i;
      }
    }
    heads.fill(-1);
    for (let i = 0; i < particles.length; i++) {
      const p = particles[i];
      const dx = pointer.x - p.bx, dy = pointer.y - p.by;
      const distance = Math.hypot(dx, dy);
      const active = interactive && distance <= pointerRadius && distance <= nearest[7]
        ? Math.sqrt(Math.max(0, 1 - distance / pointerRadius)) : 0;
      p.active += (active - p.active) * ease;
      // Attraction fades by distance; never collapse a node onto the pointer.
      const pull = Math.min(distance * .35, maxDisplacement * active);
      p.ox += ((distance ? dx / distance * pull : 0) - p.ox) * ease;
      p.oy += ((distance ? dy / distance * pull : 0) - p.oy) * ease;
      p.x = p.bx + (reduced ? 0 : Math.sin(time * .16 + p.phase) * p.amplitude) + p.ox;
      p.y = p.by + (reduced ? 0 : Math.cos(time * .13 + p.phase) * p.amplitude) + p.oy;
      const col = Math.max(0, Math.min(bucketColumns - 1, Math.floor(p.x / radius)));
      const row = Math.max(0, Math.min(bucketRows - 1, Math.floor(p.y / radius)));
      const bucket = row * bucketColumns + col;
      next[i] = heads[bucket];
      heads[bucket] = i;
      ctx.fillStyle = `rgba(40,49,59,${(p.hub ? .18 : .14) + p.active * .20})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.hub ? 2.1 : 1.5, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.lineWidth = .8;
    const radiusSquared = radius * radius;
    for (let i = 0; i < particles.length; i++) {
      const a = particles[i];
      const col = Math.max(0, Math.min(bucketColumns - 1, Math.floor(a.x / radius)));
      const row = Math.max(0, Math.min(bucketRows - 1, Math.floor(a.y / radius)));
      for (let r = Math.max(0, row - 1); r <= Math.min(bucketRows - 1, row + 1); r++) {
        for (let c = Math.max(0, col - 1); c <= Math.min(bucketColumns - 1, col + 1); c++) {
          for (let j = heads[r * bucketColumns + c]; j !== -1; j = next[j]) {
            if (j <= i) continue; // Every pair is drawn at most once.
            if (localLinks[i * particles.length + j] !== 1) continue;
            const b = particles[j];
            const dx = a.x - b.x, dy = a.y - b.y;
            const squared = dx * dx + dy * dy;
            if (squared >= radiusSquared) continue;
            drawConnection(ctx, a, b, radius);
          }
        }
      }
    }
    // Stable short segments connect only neighboring subsystems.
    for (const chain of bridges) {
      for (let k = 1; k < chain.length; k++) {
        const a = particles[chain[k - 1]], b = particles[chain[k]];
        const baseLength = Math.hypot(a.bx - b.bx, a.by - b.by);
        drawConnection(ctx, a, b, Math.min(radius * 1.8, Math.max(radius, baseLength * 1.4)));
      }
    }
    // The invisible cursor hub adds at most four short node-to-node links.
    // Retain the last selected nodes after pointerleave so these links fade out.
    temporaryPairs.fill(-1);
    for (let count = 0; count < 4 && !mobile && !reduced; count++) {
      let from = -1, to = -1, shortest = radiusSquared;
      for (let u = 0; u < nearestNodes.length; u++) {
        const i = nearestNodes[u];
        if (i < 0 || particles[i].active < .01) continue;
        for (let v = u + 1; v < nearestNodes.length; v++) {
          const j = nearestNodes[v];
          if (j < 0 || particles[j].active < .01 || localLinks[i * particles.length + j]) continue;
          let used = false;
          for (let k = 0; k < count; k++) {
            if (temporaryPairs[k * 2] === i && temporaryPairs[k * 2 + 1] === j) used = true;
          }
          if (used) continue;
          const a = particles[i], b = particles[j];
          const squared = (a.x - b.x) ** 2 + (a.y - b.y) ** 2;
          if (squared < shortest) { shortest = squared; from = i; to = j; }
        }
      }
      if (from < 0) break;
      temporaryPairs[count * 2] = from;
      temporaryPairs[count * 2 + 1] = to;
      drawConnection(ctx, particles[from], particles[to], radius, true);
    }
  }

  function drawConnection(ctx, a, b, limit, temporary = false) {
    const distance = Math.hypot(a.x - b.x, a.y - b.y);
    if (distance >= limit) return;
    const t = Math.max(0, (distance / limit - .4) / .6);
    const fade = 1 - t * t * (3 - 2 * t);
    const activity = temporary ? Math.min(a.active, b.active) : Math.max(a.active, b.active);
    const opacity = fade * (.09 + activity * .16) * (temporary ? activity : 1);
    ctx.strokeStyle = `rgba(40,49,59,${opacity})`;
    ctx.beginPath();
    ctx.moveTo(a.x, a.y);
    ctx.lineTo(b.x, b.y);
    ctx.stroke();
  }

  return {
    init() {}, resize, render,
    pointerMove(value) { pointer = { ...value }; },
    destroy() {
      particles = [];
      clusters = [];
      bridges = [];
      localLinks = new Uint8Array(0);
      nearestNodes.fill(-1);
      heads = new Int32Array(0);
      next = new Int32Array(0);
      pointer.active = false;
    }
  };
}
