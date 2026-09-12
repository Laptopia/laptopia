export function createNetwork() {
  let width = 0, height = 0, mobile = false, particles = [], links = [], proximity = [];
  let time = 0, spacing = 0;
  let pointer = { x: -1000, y: -1000, active: false };
  function resize(size) {
    ({ width, height, mobile } = size);
    const min = mobile ? 20 : 65, max = mobile ? 30 : 90;
    const target = Math.max(min, Math.min(max, Math.round(width * height / 13000)));
    let columns = 1, rows = min, best = Infinity;
    for (let c = 2; c <= max / 2; c++) {
      for (let r = 2; c * r <= max; r++) {
        if (c * r < min) continue;
        const score = Math.abs(Math.log((c / r) / (width / height))) + Math.abs(c * r - target) / target;
        if (score < best) { best = score; columns = c; rows = r; }
      }
    }
    const cellWidth = width / columns, cellHeight = height / rows;
    spacing = Math.max(cellWidth, cellHeight);
    time = 0;
    particles = [];
    links = [];
    for (let row = 0; row < rows; row++) {
      for (let col = 0; col < columns; col++) {
        const bx = (col + .2 + Math.random() * .6) * cellWidth;
        const by = (row + .2 + Math.random() * .6) * cellHeight;
        particles.push({ bx, by, x: bx, y: by, phase: Math.random() * Math.PI * 2,
          amplitude: Math.min(cellWidth, cellHeight) * (mobile ? .025 : .045),
          ox: 0, oy: 0, active: 0 });
      }
    }
    // Shortest local edges first; no topology work in the animation loop.
    const candidates = [], degree = new Uint8Array(particles.length);
    const parent = particles.map((_, i) => i);
    const edgeLimit = spacing * 1.55;
    function root(index) {
      while (parent[index] !== index) index = parent[index];
      return index;
    }
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const distance = Math.hypot(particles[i].bx - particles[j].bx, particles[i].by - particles[j].by);
        if (distance <= edgeLimit) candidates.push({ i, j, distance, used: false });
      }
    }
    candidates.sort((a, b) => a.distance - b.distance);
    function connect(edge) {
      const { i, j } = edge;
      links.push([i, j]);
      degree[i]++;
      degree[j]++;
      parent[root(i)] = root(j);
      edge.used = true;
    }
    // Build a connected backbone before filling the nearest available neighbors.
    for (const edge of candidates) {
      if (degree[edge.i] < 3 && degree[edge.j] < 3 && root(edge.i) !== root(edge.j)) connect(edge);
    }
    for (const edge of candidates) {
      if (!edge.used && degree[edge.i] < 3 && degree[edge.j] < 3) connect(edge);
    }
    // Insert sparse boundary nodes into a nearby edge without disconnecting it.
    // This adds a short local triangle while keeping the three-neighbor cap.
    for (let i = 0; i < particles.length; i++) {
      if (degree[i] >= 2) continue;
      for (let index = 0; index < links.length; index++) {
        const [a, b] = links[index];
        if (a === i || b === i) continue;
        if (Math.hypot(particles[i].bx - particles[a].bx, particles[i].by - particles[a].by) > edgeLimit
          || Math.hypot(particles[i].bx - particles[b].bx, particles[i].by - particles[b].by) > edgeLimit) continue;
        if (links.some(([u, v]) => (u === i && (v === a || v === b)) || (v === i && (u === a || u === b)))) continue;
        links.splice(index, 1, [i, a], [i, b]);
        degree[i] += 2;
        break;
      }
    }
    proximity = new Array(particles.length).fill(Infinity);
  }
  function render(ctx, dt, reduced) {
    ctx.clearRect(0, 0, width, height);
    const interactive = pointer.active && !mobile && !reduced;
    const ease = 1 - Math.exp(-dt * 3);
    if (!reduced) time += dt;
    let cutoff = 0;
    if (interactive) {
      for (let i = 0; i < particles.length; i++) {
        const p = particles[i];
        proximity[i] = Math.hypot(pointer.x - p.bx, pointer.y - p.by);
      }
      // Reuse this small buffer; select at most eight local nodes.
      proximity.sort((a, b) => a - b);
      cutoff = Math.min(proximity[7], spacing * 1.8);
    }
    for (const p of particles) {
      const dx = pointer.x - p.bx, dy = pointer.y - p.by;
      const distance = Math.hypot(dx, dy);
      const active = interactive && distance <= cutoff
        ? Math.max(.20, 1 - distance / (spacing * 2.2)) : 0;
      p.active += (active - p.active) * ease;
      const pull = Math.min(22, distance * .14) * active;
      p.ox += ((distance ? dx / distance * pull : 0) - p.ox) * ease;
      p.oy += ((distance ? dy / distance * pull : 0) - p.oy) * ease;
      p.x = p.bx + (reduced ? 0 : Math.sin(time * .16 + p.phase) * p.amplitude) + p.ox;
      p.y = p.by + (reduced ? 0 : Math.cos(time * .13 + p.phase) * p.amplitude) + p.oy;
      ctx.fillStyle = `rgba(40,49,59,${.12 + p.active * .18})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, 1.5, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.lineWidth = .8;
    for (const [i, j] of links) {
      const a = particles[i], b = particles[j];
      const activity = Math.max(a.active, b.active);
      ctx.strokeStyle = `rgba(40,49,59,${.075 + activity * .14})`;
      ctx.beginPath();
      ctx.moveTo(a.x, a.y);
      ctx.lineTo(b.x, b.y);
      ctx.stroke();
    }
  }
  return {
    init() {}, resize, render,
    pointerMove(value) { pointer = { ...value }; },
    destroy() { particles = []; links = []; proximity = []; pointer.active = false; }
  };
}
