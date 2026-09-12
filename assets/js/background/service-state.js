// Small shared lifecycle/math helpers for service effects; no extra canvas or loop.
export function createServiceState() {
  const s = { width: 0, height: 0, mobile: false, time: 0, dt: 0, reduced: false,
    level: 0, quality: 0, qualityName: 'high', gust: 0, elements: 0, particles: 0,
    pointer: { x: -1000, y: -1000, active: false, speed: 0, last: 0 } };
  s.resize = size => {
    Object.assign(s, size);
    s.time = 0; s.gust = 0; s.pointer.active = false; s.pointer.last = 0;
  };
  s.begin = (ctx, dt, reduced) => {
    s.dt = dt; s.reduced = reduced;
    if (!reduced) s.time += dt;
    s.quality += (s.level - s.quality) * (1 - Math.exp(-dt * 2));
    s.gust = Math.max(0, s.gust - dt);
    s.pointer.speed *= Math.exp(-dt * 4);
    s.particles = 0;
    ctx.clearRect(0, 0, s.width, s.height);
    ctx.lineWidth = .8;
  };
  s.activity = (x, y, radius) => {
    if (s.mobile || s.reduced || !s.pointer.active) return 0;
    radius *= 1 - s.quality * .15;
    const dx = x - s.pointer.x, dy = y - s.pointer.y;
    const squared = dx * dx + dy * dy;
    return squared < radius * radius ? 1 - Math.sqrt(squared) / radius : 0;
  };
  s.follow = (current, target, rate = 6) => s.reduced ? 0 : current + (target - current) * (1 - Math.exp(-s.dt * rate));
  s.pointerMove = value => {
    const p = s.pointer, now = performance.now();
    if (value.active && p.active && p.last) {
      const speed = Math.min(1, Math.hypot(value.x - p.x, value.y - p.y) / Math.max(.008, (now - p.last) / 1000) / 1200);
      p.speed += (speed - p.speed) * .45;
      if (speed > .6) s.gust = .3;
    }
    p.x = value.x; p.y = value.y; p.active = value.active; p.last = value.active ? now : 0;
  };
  s.setQuality = name => { s.level = name === 'low' ? 2 : name === 'medium' ? 1 : 0; s.qualityName = name; };
  s.getStats = () => ({ quality: s.qualityName, elements: s.elements, particles: s.particles });
  return s;
}

export function line(ctx, x1, y1, x2, y2, alpha, color = '40,49,59') {
  ctx.strokeStyle = `rgba(${color},${alpha})`;
  ctx.beginPath(); ctx.moveTo(x1, y1); ctx.lineTo(x2, y2); ctx.stroke();
}
export function dot(ctx, x, y, alpha, size = 1.4, color = '40,49,59') {
  ctx.fillStyle = `rgba(${color},${alpha})`;
  ctx.beginPath(); ctx.arc(x, y, size, 0, Math.PI * 2); ctx.fill();
}
export function bezier(out, points, t) {
  const u = 1 - t;
  out.x = u * u * u * points[0] + 3 * u * u * t * points[2] + 3 * u * t * t * points[4] + t * t * t * points[6];
  out.y = u * u * u * points[1] + 3 * u * u * t * points[3] + 3 * u * t * t * points[5] + t * t * t * points[7];
}
