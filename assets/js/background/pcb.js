import { createServiceState, dot } from './service-state.js';
export function createPCB() {
  const s = createServiceState();
  let tracks = [], anchorFrame = 0, logo;
  const anchor = { x: 0, y: 0, width: 0, source: 'fallback' };
  function updateAnchor() {
    anchorFrame = 0;
    const rect = logo?.getBoundingClientRect();
    anchor.source = rect?.width ? 'logo' : 'fallback';
    anchor.x = rect?.width ? rect.left : s.width * .82;
    anchor.y = rect?.width ? rect.bottom : 48;
    anchor.width = rect?.width || 80;
  }
  function scheduleAnchor() { if (!anchorFrame) anchorFrame = requestAnimationFrame(updateAnchor); }
  function resize(size) {
    s.resize(size); updateAnchor(); tracks = [];
    const count = s.mobile ? 12 : Math.min(32, Math.max(20, Math.round(s.width / 45)));
    for (let i = 0; i < count; i++) {
      const lane = i % 8, side = i % 3 === 0 ? 1 : -1;
      const reach = (s.mobile ? .3 : .55) * s.width * (.35 + Math.random() * .65);
      const y = 30 + lane * 22, diagonal = 24 + (i % 4) * 12;
      const points = new Float64Array([i / count, 0, i / count, y, side * reach, y,
        side * (reach + diagonal), y + diagonal, side * (reach + diagonal), s.height * (.35 + Math.random() * .55)]);
      const lengths = new Float64Array(4);
      let total = 0;
      for (let k = 0; k < 4; k++) {
        lengths[k] = k === 0 ? y : Math.hypot(points[k * 2 + 2] - points[k * 2], points[k * 2 + 3] - points[k * 2 + 1]);
        total += lengths[k];
      }
      tracks.push({ points, lengths, total, phase: Math.random(), active: 0, layer: i % 3 });
    }
    s.elements = tracks.length;
  }
  function render(ctx, dt, reduced) {
    s.begin(ctx, dt, reduced);
    const pulseLimit = s.mobile ? Math.round(4 - s.quality) : Math.round(14 - s.quality * 4);
    for (let i = 0; i < tracks.length; i++) {
      const t = tracks[i], p = t.points, startX = anchor.x + p[0] * anchor.width;
      let target = 0, closest = Infinity, destination = 0, travelled = 0;
      for (let k = 0; k < 4; k++) {
        const x1 = k < 2 ? startX : anchor.x + p[k * 2], y1 = anchor.y + p[k * 2 + 1];
        const x2 = k === 0 ? startX : anchor.x + p[k * 2 + 2], y2 = anchor.y + p[k * 2 + 3];
        const dx = x2 - x1, dy = y2 - y1, squared = dx * dx + dy * dy;
        const u = squared ? Math.max(0, Math.min(1, ((s.pointer.x - x1) * dx + (s.pointer.y - y1) * dy) / squared)) : 0;
        const x = x1 + dx * u, y = y1 + dy * u;
        target = Math.max(target, s.activity(x, y, 250));
        const distance = (x - s.pointer.x) ** 2 + (y - s.pointer.y) ** 2;
        if (distance < closest) { closest = distance; destination = (travelled + t.lengths[k] * u) / t.total; }
        travelled += t.lengths[k];
      }
      t.active = s.follow(t.active, target);
      ctx.strokeStyle = `rgba(40,49,59,${.07 + t.layer * .012 + t.active * .17})`;
      ctx.beginPath(); ctx.moveTo(startX, anchor.y);
      for (let k = 1; k < 5; k++) ctx.lineTo(k === 1 ? startX : anchor.x + p[k * 2], anchor.y + p[k * 2 + 1]);
      ctx.stroke();
      for (let k = 2; k < 5; k++) dot(ctx, anchor.x + p[k * 2], anchor.y + p[k * 2 + 1], .11 + t.active * .15, 1.6);
      if (i % 4 === 0) {
        const x = anchor.x + p[6], y = anchor.y + p[7];
        ctx.beginPath(); ctx.moveTo(x, y); ctx.lineTo(x + 18, y + 18); ctx.lineTo(x + 40, y + 18); ctx.stroke();
        dot(ctx, x + 40, y + 18, .11 + t.active * .12, 1.4);
      }
      if (reduced || i >= pulseLimit) continue;
      t.phase = (t.phase + dt * (s.mobile ? 20 : 35) * (1 + t.active * 2) / t.total) % 1;
      if (t.active > .01) {
        const delta = ((destination - t.phase + 1.5) % 1) - .5;
        t.phase = (t.phase + delta * t.active * dt * (s.gust > 0 ? 2 : 1.2) + 1) % 1;
      }
      let distance = t.phase * t.total;
      for (let k = 0; k < 4; k++) {
        if (distance <= t.lengths[k]) {
          const u = distance / t.lengths[k], x1 = k < 2 ? startX : anchor.x + p[k * 2];
          const x2 = k === 0 ? startX : anchor.x + p[k * 2 + 2];
          dot(ctx, x1 + (x2 - x1) * u, anchor.y + p[k * 2 + 1] + (p[k * 2 + 3] - p[k * 2 + 1]) * u, .17 + t.active * .18, 1.5);
          s.particles++; break;
        }
        distance -= t.lengths[k];
      }
    }
    if (!reduced && s.pointer.active && !s.mobile) {
      ctx.strokeStyle = 'rgba(86,97,110,.045)'; ctx.beginPath();
      ctx.arc(s.pointer.x, s.pointer.y, 20 + (s.time % 1.2) * 45, 0, Math.PI * 2); ctx.stroke();
    }
  }
  return {
    init() { logo = document.querySelector('.laptopia-logo'); window.addEventListener('scroll', scheduleAnchor, { passive: true }); },
    resize, render, pointerMove: s.pointerMove, setQuality: s.setQuality,
    getStats() { return { ...s.getStats(), anchor: { ...anchor } }; },
    destroy() { window.removeEventListener('scroll', scheduleAnchor); cancelAnimationFrame(anchorFrame); tracks = []; logo = null; }
  };
}
