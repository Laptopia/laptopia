import { createServiceState, bezier, dot } from './service-state.js';

export function createCooling() {
  const s = createServiceState();
  let flows = [];
  const point = { x: 0, y: 0 }, modified = new Float64Array(8);
  function resize(size) {
    s.resize(size); flows = [];
    const count = s.mobile ? 25 : Math.min(100, Math.max(55, Math.round(s.width * s.height / 14000)));
    for (let i = 0; i < count; i++) {
      const band = i % 5, x = Math.random() * s.width - s.width * .15;
      const y = (band + Math.random()) * s.height / 5;
      const length = (s.mobile ? 140 : 230) + Math.random() * (s.mobile ? 170 : 420);
      const bend = Math.sin(band * 1.4) * 85 + (Math.random() - .5) * 40;
      const points = new Float64Array([x,y,x + length * .3,y + bend,x + length * .7,y - bend*.6,x+length,y+bend*.25]);
      const path = new Path2D(); path.moveTo(points[0], points[1]); path.bezierCurveTo(...points.slice(2));
      flows.push({ points, path, phase: Math.random(), active: 0, layer: i % 3 });
    }
    s.elements = flows.length;
  }
  function render(ctx, dt, reduced) {
    s.begin(ctx, dt, reduced);
    const particles = s.mobile ? Math.round(3 - s.quality) : Math.round(12 - s.quality * 4);
    for (let i = 0; i < flows.length; i++) {
      const f = flows[i], p = f.points;
      // Precomputed paths stay untouched except within the local vortex.
      f.active = s.follow(f.active, Math.max(s.activity(p[2],p[3],260),s.activity(p[4],p[5],260)));
      if (i % 3 === 2 && s.quality > 1.5) continue;
      modified.set(p);
      if (f.active > .002) {
        for (let k = 2; k <= 4; k += 2) {
          const dx = p[k] - s.pointer.x, dy = p[k+1] - s.pointer.y;
          const scale = f.active * (.055 + (s.gust > 0 ? .025 : 0));
          modified[k] += -dy * scale; modified[k+1] += dx * scale;
        }
      }
      ctx.strokeStyle = `rgba(40,49,59,${.055 + f.layer * .012 + f.active * .13})`;
      if (f.active < .002) ctx.stroke(f.path);
      else { ctx.beginPath(); ctx.moveTo(modified[0],modified[1]); ctx.bezierCurveTo(modified[2],modified[3],modified[4],modified[5],modified[6],modified[7]); ctx.stroke(); }
      if (!reduced && i < particles) {
        f.phase = (f.phase + dt * (s.mobile ? .035 : .05) * (1 + f.active * 2 + (s.gust > 0 ? f.active * 2 : 0))) % 1;
        bezier(point, modified, f.phase);
        const color = f.active > .4 ? (f.phase < .5 ? '131,103,101' : '87,127,126') : '40,49,59';
        dot(ctx, point.x, point.y, .17 + f.active * .08, 1.3, color); s.particles++;
      }
    }
  }
  return { init() {}, resize, render, pointerMove: s.pointerMove, setQuality: s.setQuality, getStats: s.getStats,
    destroy() { flows = []; s.pointer.active = false; } };
}
