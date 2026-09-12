import { createServiceState, line, dot } from './service-state.js';

export function createKeyboard() {
  const s = createServiceState();
  let keys = [], columns = 0, rows = 0, pitch = 62, lastKey = -1, lastAmbient = -1;
  function resize(size) {
    s.resize(size); pitch = s.mobile ? 80 : 62;
    columns = Math.ceil(s.width / pitch); rows = Math.ceil(s.height / pitch);
    keys = []; lastKey = lastAmbient = -1;
    for (let row = 0; row < rows; row++) for (let col = 0; col < columns; col++) {
      keys.push({ x: (col + .5) * pitch + (row % 3 - 1) * 5, y: (row + .5) * pitch,
        skip: (row * 7 + col * 3) % 13 === 0, trigger: -100, active: 0 });
    }
    s.elements = keys.filter(k => !k.skip).length;
  }
  function schedule(index) {
    const row = Math.floor(index / columns), col = index % columns;
    const reach = s.quality > .5 ? 1 : 2;
    for (let d = -reach; d <= reach; d++) {
      if (col + d >= 0 && col + d < columns) keys[row * columns + col + d].trigger = s.time + Math.abs(d) * .055;
      if (row + d >= 0 && row + d < rows) keys[(row + d) * columns + col].trigger = s.time + Math.abs(d) * .07;
    }
  }
  function render(ctx, dt, reduced) {
    s.begin(ctx, dt, reduced);
    if (!reduced && s.pointer.active && !s.mobile) {
      const col = Math.floor(s.pointer.x / pitch), row = Math.floor(s.pointer.y / pitch);
      let best = Infinity, index = -1;
      for (let r = Math.max(0, row - 1); r <= Math.min(rows - 1, row + 1); r++) {
        for (let c = Math.max(0, col - 1); c <= Math.min(columns - 1, col + 1); c++) {
          const i = r * columns + c, k = keys[i], distance = (k.x - s.pointer.x) ** 2 + (k.y - s.pointer.y) ** 2;
          if (!k.skip && distance < best) { best = distance; index = i; }
        }
      }
      if (index >= 0 && index !== lastKey) { schedule(index); lastKey = index; }
    } else lastKey = -1;
    if (!reduced && Math.floor(s.time / 9) !== lastAmbient) {
      lastAmbient = Math.floor(s.time / 9); schedule((lastAmbient * 17 + Math.floor(keys.length / 2)) % keys.length);
    }
    for (let row = 0; row < rows; row += 3) line(ctx, 0, (row + .5) * pitch, s.width, (row + .5) * pitch, .035);
    for (let col = 0; col < columns; col += 4) line(ctx, (col + .5) * pitch, 0, (col + .5) * pitch, s.height, .028);
    const pulseLimit = s.mobile ? Math.max(1, Math.round(2 - s.quality)) : Math.round(6 - s.quality * 2);
    for (let i = 0; i < keys.length; i++) {
      const k = keys[i]; if (k.skip) continue;
      const age = s.time - k.trigger;
      const ripple = reduced || age < 0 ? 0 : Math.exp(-age * 7) * (1 - Math.exp(-age * 35));
      k.active = s.follow(k.active, ripple + s.activity(k.x, k.y, pitch * .65) * .25);
      const w = pitch * .54, h = pitch * .38;
      ctx.strokeStyle = `rgba(40,49,59,${.07 + k.active * .20})`;
      ctx.fillStyle = `rgba(40,49,59,${k.active * .035})`;
      ctx.beginPath(); ctx.roundRect(k.x - w / 2, k.y - h / 2, w, h, 4); ctx.stroke();
      if (k.active > .01) ctx.fill();
      if (!reduced && age >= 0 && age < .5 && s.particles < pulseLimit && ripple > .02) {
        const distance = age * 140;
        dot(ctx, k.x + distance, k.y, ripple * .20, 1.3);
        s.particles++;
        if (s.particles < pulseLimit) {
          dot(ctx, k.x, k.y + distance * .8, ripple * .16, 1.2);
          s.particles++;
        }
      }
    }
  }
  return { init() {}, resize, render, pointerMove: s.pointerMove, setQuality: s.setQuality, getStats: s.getStats,
    destroy() { keys = []; s.pointer.active = false; } };
}
