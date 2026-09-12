import { createServiceState, line, dot } from './service-state.js';

export function createScreen() {
  const s = createServiceState();
  let panel, textures = [], cracks = [], pixels = [], defects = [], centers = [], pressure = 0;
  function tone(x, y) {
    const center = Math.max(0, 1 - Math.abs(x / s.width - .5) / .3) * Math.max(0, 1 - Math.abs(y / s.height - .5) / .6);
    return 1 - center * .82;
  }
  function resize(size) {
    s.resize(size); textures = []; cracks = []; pixels = []; defects = []; centers = []; pressure = 0;
    panel = s.mobile ? { x: s.width * .07, y: s.height * .24, w: s.width * .86, h: s.height * .38 }
      : { x: s.width * .055, y: s.height * .17, w: s.width * .89, h: s.height * .66 };
    // One continuous LCD surface. Central subpixels are a separate quiet layer.
    for (let section = 0; section < 3; section++) {
      const channels = [new Path2D(), new Path2D(), new Path2D()];
      const x1 = panel.x + panel.w * section / 3, x2 = panel.x + panel.w * (section + 1) / 3;
      for (let x = x1 + 5; x < x2 - 3; x += s.mobile ? 15 : 12) {
        for (let channel = 0; channel < 3; channel++) {
          channels[channel].moveTo(x + channel * 2, panel.y + 9);
          channels[channel].lineTo(x + channel * 2, panel.y + panel.h - 9);
        }
      }
      textures.push({ channels, weight: section === 1 ? .23 : .8 });
    }
    const locations = s.mobile ? [[.12, .32]] : [[.16, .33], [.94, .68], [.52, .70]];
    for (let region = 0; region < locations.length; region++) {
      const l = locations[region], x = panel.x + l[0] * panel.w, y = panel.y + l[1] * panel.h;
      centers.push({ x, y, weight: tone(x, y) });
      const rays = s.mobile ? 5 : region === 1 ? 3 : 6;
      for (let ray = 0; ray < rays; ray++) {
        const angle = region === 1 ? Math.PI * .7 + ray * .42 : ray * Math.PI * 2 / rays + .13;
        let px = x, py = y;
        for (let k = 0; k < 4; k++) {
          const a = angle + (Math.random() - .5) * .25, length = (s.mobile ? 12 : 20) + Math.random() * 14;
          const nx = Math.max(panel.x + 3, Math.min(panel.x + panel.w - 3, px + Math.cos(a) * length));
          const ny = Math.max(panel.y + 3, Math.min(panel.y + panel.h - 3, py + Math.sin(a) * length));
          cracks.push({ x: px, y: py, nx, ny, weight: tone((px + nx) / 2, (py + ny) / 2), active: 0, primary: true });
          if (k === 2) cracks.push({ x: px, y: py, nx: px + Math.cos(a + .7) * length * .6, ny: py + Math.sin(a + .7) * length * .6, weight: tone(px, py), active: 0, primary: false });
          px = nx; py = ny;
        }
      }
      for (let i = 0; i < 5; i++) pixels.push({ x: x + (i % 3) * 5, y: y + Math.floor(i / 3) * 6, weight: tone(x, y) });
    }
    defects = [
      { x: panel.x + panel.w * .18, y: panel.y + 10, nx: panel.x + panel.w * .18, ny: panel.y + panel.h * .68, active: 0 },
      { x: panel.x + panel.w * .85, y: panel.y + panel.h * .20, nx: panel.x + panel.w * .85, ny: panel.y + panel.h - 12, active: 0 },
      { x: panel.x + 10, y: panel.y + panel.h * .74, nx: panel.x + panel.w * .39, ny: panel.y + panel.h * .74, active: 0 }
    ];
    s.elements = cracks.length + pixels.length + defects.length + 1;
  }
  function render(ctx, dt, reduced) {
    s.begin(ctx, dt, reduced);
    ctx.lineWidth = .8; ctx.strokeStyle = 'rgba(40,49,59,.085)';
    ctx.strokeRect(panel.x, panel.y, panel.w, panel.h);
    for (const t of textures) {
      ctx.lineWidth = .6;
      ctx.strokeStyle = `rgba(147,101,111,${.03 * t.weight})`; ctx.stroke(t.channels[0]);
      ctx.strokeStyle = `rgba(86,133,113,${.03 * t.weight})`; ctx.stroke(t.channels[1]);
      ctx.strokeStyle = `rgba(79,119,151,${.03 * t.weight})`; ctx.stroke(t.channels[2]);
    }
    for (const d of defects) {
      d.active = s.follow(d.active, s.activity((d.x + d.nx) / 2, (d.y + d.ny) / 2, 190));
      ctx.lineWidth = 1.1; line(ctx, d.x, d.y, d.nx, d.ny, .13 + d.active * .10);
    }
    for (let i = 0; i < cracks.length; i++) {
      const f = cracks[i]; if (!f.primary && s.quality > .5 && i % 2) continue;
      f.active = s.follow(f.active, s.activity(f.x, f.y, 200) * f.weight);
      const dx = (s.pointer.x - f.x) * f.active * .008, dy = (s.pointer.y - f.y) * f.active * .008;
      ctx.lineWidth = f.primary ? 1.05 : .6;
      line(ctx, f.x + dx, f.y + dy, f.nx + dx * .4, f.ny + dy * .4, .15 * f.weight + f.active * .12);
    }
    for (const c of centers) dot(ctx, c.x, c.y, .18 * c.weight, 2.2);
    for (const p of pixels) { ctx.fillStyle = `rgba(40,49,59,${.16 * p.weight})`; ctx.fillRect(p.x, p.y, 2.5, 2.5); }
    const p = s.pointer, inside = p.active && p.x >= panel.x && p.x <= panel.x + panel.w && p.y >= panel.y && p.y <= panel.y + panel.h;
    pressure = s.follow(pressure, !s.mobile && inside ? tone(p.x, p.y) : 0, 12);
    if (reduced) return;
    if (pressure > .01) {
      const flash = Math.max(0, (s.gust - .15) / .15), scan = s.time * 180 % 80 - 40, shift = Math.sin(s.time * 15) * 1.5;
      ctx.lineWidth = .9; line(ctx, p.x - 40, p.y + scan * .25, p.x + 40, p.y + scan * .25, .18 * pressure);
      // A few displaced subpixels make the surface disturbance explicit.
      ctx.fillStyle = `rgba(86,97,110,${.12 * pressure})`;
      for (let i = 0; i < 4; i++) ctx.fillRect(p.x - 14 + i * 8 + shift, p.y + i % 2 * 5, 2, 3);
      if (flash > .01) {
        line(ctx, p.x - 32 + shift, p.y - 1, p.x + 32 + shift, p.y - 1, flash * pressure * .13, '67,130,153');
        line(ctx, p.x - 32 - shift, p.y + 1, p.x + 32 - shift, p.y + 1, flash * pressure * .08, '147,90,111');
      }
      s.particles++;
    }
    const cycle = 11 + s.quality * 4, phase = s.time % cycle;
    if (phase < .5) { const c = centers[Math.floor(s.time / cycle) % centers.length]; dot(ctx, c.x - 25 + phase * 100, c.y, .16 * c.weight * Math.sin(phase / .5 * Math.PI), 1.4); s.particles++; }
  }
  return { init() {}, resize, render, pointerMove: s.pointerMove, setQuality: s.setQuality,
    getStats() { return { ...s.getStats(), panels: 1, epicenters: centers.length, cracks: cracks.length }; },
    destroy() { textures = []; cracks = []; pixels = []; defects = []; centers = []; panel = null; } };
}
