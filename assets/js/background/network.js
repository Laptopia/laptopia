export function createNetwork() {
  let width = 0, height = 0, mobile = false, particles = [];
  let pointer = { x: -1000, y: -1000, active: false };
  function resize(size) {
    ({ width, height, mobile } = size);
    const count = mobile
      ? Math.min(20, Math.max(12, Math.round(width * height / 22000)))
      : Math.min(60, Math.max(30, Math.round(width * height / 20000)));
    particles = Array.from({ length: count }, () => {
      const angle = Math.random() * Math.PI * 2;
      const speed = mobile ? 3 : 6;
      return { x: Math.random() * width, y: Math.random() * height,
        vx: Math.cos(angle) * speed, vy: Math.sin(angle) * speed,
        ox: 0, oy: 0, active: 0 };
    });
  }
  function render(ctx, dt, reduced) {
    ctx.clearRect(0, 0, width, height);
    const interactive = pointer.active && !mobile && !reduced;
    const ease = 1 - Math.exp(-dt * 3);
    for (const p of particles) {
      if (!reduced) {
        p.x += p.vx * dt;
        p.y += p.vy * dt;
        if (p.x < 0 || p.x > width) { p.vx *= -1; p.x = Math.max(0, Math.min(width, p.x)); }
        if (p.y < 0 || p.y > height) { p.vy *= -1; p.y = Math.max(0, Math.min(height, p.y)); }
      }
      const dx = pointer.x - p.x, dy = pointer.y - p.y;
      const active = interactive ? Math.max(0, 1 - Math.hypot(dx, dy) / 180) : 0;
      p.active += (active - p.active) * ease;
      p.ox += (dx * active * .12 - p.ox) * ease;
      p.oy += (dy * active * .12 - p.oy) * ease;
      ctx.fillStyle = `rgba(40,49,59,${.15 + p.active * .12})`;
      ctx.beginPath();
      ctx.arc(p.x + p.ox, p.y + p.oy, 1.6, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.lineWidth = .8;
    for (let i = 0; i < particles.length; i++) {
      const a = particles[i];
      for (let j = i + 1; j < particles.length; j++) {
        const b = particles[j];
        const activity = Math.max(a.active, b.active);
        const limit = (mobile ? 145 : 180) + activity * 35;
        const distance = Math.hypot(a.x + a.ox - b.x - b.ox, a.y + a.oy - b.y - b.oy);
        if (distance >= limit) continue;
        ctx.strokeStyle = `rgba(40,49,59,${(1 - distance / limit) * (.10 + activity * .10)})`;
        ctx.beginPath();
        ctx.moveTo(a.x + a.ox, a.y + a.oy);
        ctx.lineTo(b.x + b.ox, b.y + b.oy);
        ctx.stroke();
      }
    }
  }
  return {
    init() {}, resize, render,
    pointerMove(value) { pointer = { ...value }; },
    destroy() { particles = []; pointer.active = false; }
  };
}
