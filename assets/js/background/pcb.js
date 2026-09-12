export function createPCB() {
  let width = 0, height = 0, mobile = false, tracks = [];
  let pointer = { x: -1000, y: -1000, active: false };
  function resize(size) {
    ({ width, height, mobile } = size);
    const count = Math.min(mobile ? 14 : 32, Math.max(8, Math.round(width * height / (mobile ? 35000 : 30000))));
    tracks = Array.from({ length: count }, (_, index) => {
      const x = Math.round(Math.random() * width / 24) * 24;
      const y = Math.round(Math.random() * height / 24) * 24;
      const dx = (Math.random() > .5 ? 1 : -1) * (48 + Math.floor(Math.random() * 5) * 24);
      const dy = (Math.random() > .5 ? 1 : -1) * (24 + Math.floor(Math.random() * 4) * 24);
      const diagonal = Math.min(Math.abs(dx), Math.abs(dy), 48);
      const points = [
        { x, y },
        { x: x + dx, y },
        { x: x + dx + Math.sign(dx) * diagonal, y: y + Math.sign(dy) * diagonal },
        { x: x + dx + Math.sign(dx) * diagonal, y: y + dy }
      ];
      const lengths = points.slice(1).map((p, i) => Math.hypot(p.x - points[i].x, p.y - points[i].y));
      return { points, lengths, total: lengths.reduce((a, b) => a + b, 0), phase: Math.random(), active: 0, layer: index % 3 };
    });
  }
  function render(ctx, dt, reduced) {
    ctx.clearRect(0, 0, width, height);
    ctx.lineWidth = 1;
    for (const track of tracks) {
      const nearest = pointer.active && !mobile && !reduced
        ? Math.min(...track.points.map(p => Math.hypot(p.x - pointer.x, p.y - pointer.y))) : 1000;
      const target = Math.max(0, 1 - nearest / 180);
      track.active += (target - track.active) * (1 - Math.exp(-dt * 5));
      ctx.strokeStyle = `rgba(40,49,59,${.061 + track.layer * .0135 + track.active * .17})`;
      ctx.beginPath();
      track.points.forEach((p, i) => i ? ctx.lineTo(p.x, p.y) : ctx.moveTo(p.x, p.y));
      ctx.stroke();
      for (const p of [track.points[0], track.points[3]]) {
        ctx.fillStyle = `rgba(86,97,110,${.095 + track.active * .15})`;
        ctx.beginPath();
        ctx.arc(p.x, p.y, 1.8, 0, Math.PI * 2);
        ctx.fill();
      }
      if (reduced) continue;
      track.phase = (track.phase + dt * (mobile ? 11 : 18) / track.total) % 1;
      if (track.active > .01) {
        let closest = 0, best = Infinity, travelled = 0, destination = 0;
        track.points.forEach((p, i) => {
          if (i) travelled += track.lengths[i - 1];
          const distance = Math.hypot(p.x - pointer.x, p.y - pointer.y);
          if (distance < best) {
            best = distance;
            closest = travelled;
          }
        });
        destination = closest / track.total;
        const delta = ((destination - track.phase + 1.5) % 1) - .5;
        track.phase = (track.phase + delta * track.active * dt * 1.2 + 1) % 1;
      }
      let distance = track.phase * track.total;
      for (let i = 0; i < track.lengths.length; i++) {
        const length = track.lengths[i];
        if (distance <= length) {
          const t = length ? distance / length : 0;
          const a = track.points[i], b = track.points[i + 1];
          ctx.fillStyle = `rgba(40,49,59,${.13 + track.active * .17})`;
          ctx.beginPath();
          ctx.arc(a.x + (b.x - a.x) * t, a.y + (b.y - a.y) * t, 1.4 + track.active * .4, 0, Math.PI * 2);
          ctx.fill();
          break;
        }
        distance -= length;
      }
    }
  }
  return {
    init() {}, resize, render,
    pointerMove(value) { pointer = { ...value }; },
    destroy() { tracks = []; pointer.active = false; }
  };
}
