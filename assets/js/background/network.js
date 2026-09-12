export function createNetwork() {
  let width = 0, height = 0, mobile = false, particles = [], links = [], proximity = [];
  let time = 0, spacing = 0;
  let pointer = { x: -1000, y: -1000, active: false };
  function resize(size) {
    ({ width, height, mobile } = size);
    const min = mobile ? 15 : 45, max = mobile ? 25 : 70;
    const target = Math.max(min, Math.min(max, Math.round(width * height / 18000)));
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
    // Local cell neighbors form one connected mesh: 2–4 links per node.
    // Jitter removes regular rows; topology is built only on resize.
    for (let row = 0; row < rows; row++) {
      for (let col = 0; col < columns; col++) {
        const index = row * columns + col;
        if (col + 1 < columns) links.push([index, index + 1]);
        if (row + 1 < rows) links.push([index, index + columns]);
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
      // Reuse this small buffer; select the nearest six nodes, not all nodes.
      proximity.sort((a, b) => a - b);
      cutoff = Math.min(proximity[5], spacing * 2);
    }
    for (const p of particles) {
      const dx = pointer.x - p.bx, dy = pointer.y - p.by;
      const distance = Math.hypot(dx, dy);
      const active = interactive && distance <= cutoff
        ? Math.max(.15, 1 - distance / (spacing * 2.5)) : 0;
      p.active += (active - p.active) * ease;
      const pull = Math.min(18, distance * .10) * active;
      p.ox += ((distance ? dx / distance * pull : 0) - p.ox) * ease;
      p.oy += ((distance ? dy / distance * pull : 0) - p.oy) * ease;
      p.x = p.bx + (reduced ? 0 : Math.sin(time * .16 + p.phase) * p.amplitude) + p.ox;
      p.y = p.by + (reduced ? 0 : Math.cos(time * .13 + p.phase) * p.amplitude) + p.oy;
      ctx.fillStyle = `rgba(40,49,59,${.10 + p.active * .16})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, 1.5, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.lineWidth = .7;
    for (const [i, j] of links) {
      const a = particles[i], b = particles[j];
      const activity = Math.max(a.active, b.active);
      ctx.strokeStyle = `rgba(86,97,110,${.055 + activity * .12})`;
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
