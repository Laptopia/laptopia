import { createServiceState, line, dot } from './service-state.js';

export function createScreen() {
  const s = createServiceState();
  let fractures = [], regions = [], step = 30;
  function resize(size) {
    s.resize(size); step = s.mobile ? 44 : 30;
    fractures = []; regions = [];
    const count = s.mobile ? 3 : Math.min(7, Math.max(4, Math.round(s.width / 230)));
    for (let i = 0; i < count; i++) {
      const x = (i + .25 + Math.random() * .5) * s.width / count;
      const y = (.12 + Math.random() * .76) * s.height;
      regions.push({ x, y });
      let px = x, py = y;
      for (let k = 0; k < (s.mobile ? 10 : 18); k++) {
        const nx = px + (Math.random() - .4) * 58, ny = py + (Math.random() - .5) * 64;
        fractures.push({ x: px, y: py, nx, ny, active: 0, branch: k % 3 === 0 });
        if (k % 3 === 0) fractures.push({ x: px, y: py, nx: px - 18 - Math.random() * 30, ny: py + 10 + Math.random() * 24, active: 0, branch: true });
        px = nx; py = ny;
      }
    }
    s.elements = fractures.length;
  }
  function render(ctx, dt, reduced) {
    s.begin(ctx, dt, reduced);
    // LCD scan matrix remains thin and rectilinear, distinct from fractures.
    const stride = step * (s.quality > 1.5 ? 2 : 1);
    for (let x = step / 2; x < s.width; x += stride) line(ctx, x, 0, x, s.height, .028);
    for (let y = step / 2; y < s.height; y += stride) line(ctx, 0, y, s.width, y, .035);
    for (let i = 0; i < fractures.length; i++) {
      const f = fractures[i];
      f.active = s.follow(f.active, s.activity((f.x + f.nx) / 2, (f.y + f.ny) / 2, 220));
      if (f.branch && s.quality > .5 && i % 2) continue;
      const dx = (s.pointer.x - f.x) * f.active * .035, dy = (s.pointer.y - f.y) * f.active * .035;
      line(ctx, f.x + dx, f.y + dy, f.nx + dx * .45, f.ny + dy * .45, .08 + f.active * .12);
    }
    if (reduced) return;
    const p = s.pointer;
    if (p.active && !s.mobile) {
      const tears = s.quality > 1 ? 1 : s.quality > .5 ? 2 : 3;
      const flash = s.gust > .12 ? (s.gust - .12) / .18 : 0;
      for (let i = 0; i < tears; i++) {
        const y = Math.round((p.y + (i - 1) * 18) / 3) * 3;
        const length = 22 + 30 * (1 + Math.sin(s.time * 14 + i)) / 2;
        const offset = Math.sin(s.time * 18 + i) * (1 + flash);
        line(ctx, p.x - length / 2 + offset, y, p.x + length / 2 + offset, y, .11, '86,97,110');
        if (i === 0 && flash > 0) {
          line(ctx, p.x - length / 2 + 1, y - 1, p.x + length / 2 + 1, y - 1, flash * .08, '85,132,149');
          line(ctx, p.x - length / 2 - 1, y + 1, p.x + length / 2 - 1, y + 1, flash * .045, '149,94,109');
        }
      }
      const x = p.x - 45 + (s.time * 140 % 90);
      dot(ctx, x, Math.round(p.y / step) * step + step / 2, .17, 1.3, '85,132,149');
      s.particles++;
    }
    const phase = s.time % 8;
    if (phase < .55) {
      const r = regions[Math.floor(s.time / 8) % regions.length];
      const y = Math.round(r.y / step) * step + step / 2;
      const x = r.x - 50 + phase / .55 * 100;
      line(ctx, x - 12, y, x, y, .12 * Math.sin(phase / .55 * Math.PI));
      s.particles++;
    }
  }
  return { init() {}, resize, render, pointerMove: s.pointerMove, setQuality: s.setQuality, getStats: s.getStats,
    destroy() { fractures = []; regions = []; s.pointer.active = false; } };
}
