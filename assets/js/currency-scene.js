/* Decorative prices-only scene. Geometry is measured on resize, never in render. */
(() => {
  'use strict';
  const scene = document.querySelector('.laptopia-page-art--prices');
  if (!scene) return;
  const motion = matchMedia('(prefers-reduced-motion: reduce)');
  const desktop = matchMedia('(min-width: 901px) and (hover: hover) and (pointer: fine)');
  const particles = Array.from(scene.querySelectorAll('.laptopia-currency-particle'), (el, i) => ({
    el, i, x: 0, y: 0, dx: 0, dy: 0, vx: 0, vy: 0, visible: true,
    phase: i * 2.399, period: 15000 + i * 1173,
  }));
  let width = innerWidth, height = innerHeight, frame = 0, last = 0;
  let pointerX = 0, pointerY = 0, pointerActive = false;
  function measure() {
    width = innerWidth; height = scene.offsetHeight;
    for (const p of particles) {
      p.el.style.transform = '';
      const r = p.el.getBoundingClientRect();
      p.x = r.left + r.width / 2; p.y = r.top + r.height / 2;
      p.visible = getComputedStyle(p.el).display !== 'none';
      p.dx = p.dy = p.vx = p.vy = 0;
    }
  }
  function stop() { cancelAnimationFrame(frame); frame = 0; last = 0; }
  function render(now) {
    frame = 0;
    const dt = Math.min((now - (last || now)) / 16.667, 2); last = now;
    for (const p of particles) {
      if (!p.visible) continue;
      const phase = now / p.period * Math.PI * 2 + p.phase;
      const amplitude = desktop.matches ? 13 + p.i % 4 * 3 : 6;
      const ax = Math.sin(phase) * amplitude;
      const ay = Math.cos(phase * .73 + p.phase) * amplitude;
      let fx = 0, fy = 0;
      if (desktop.matches && pointerActive) {
        const rx = p.x + ax + p.dx - pointerX, ry = p.y + ay + p.dy - pointerY;
        const d2 = rx * rx + ry * ry;
        if (d2 < 120 * 120) {
          const d = Math.sqrt(d2);
          const strength = (1 - d / 120) * 1.7;
          fx = (d > 1 ? rx / d : Math.cos(p.phase)) * strength;
          fy = (d > 1 ? ry / d : Math.sin(p.phase)) * strength;
        }
      }
      // Damped spring returns to the independent orbit; soft edge forces prevent escape.
      fx += -p.dx * .012 + Math.max(0, 14 - p.x - ax - p.dx) * .018 - Math.max(0, p.x + ax + p.dx - width + 14) * .018;
      fy += -p.dy * .012 + Math.max(0, 76 - p.y - ay - p.dy) * .018 - Math.max(0, p.y + ay + p.dy - height + 20) * .018;
      p.vx = (p.vx + fx * dt) * Math.pow(.87, dt);
      p.vy = (p.vy + fy * dt) * Math.pow(.87, dt);
      p.dx += p.vx * dt; p.dy += p.vy * dt;
      p.el.style.transform = `translate3d(${(ax + p.dx).toFixed(2)}px,${(ay + p.dy).toFixed(2)}px,0)`;
    }
    frame = requestAnimationFrame(render);
  }
  function sync() {
    stop(); pointerActive = false;
    measure();
    if (!motion.matches && !document.hidden) frame = requestAnimationFrame(render);
  }
  function pointer(event) {
    if (event.pointerType !== 'mouse' || !desktop.matches) return;
    pointerX = event.clientX; pointerY = event.clientY; pointerActive = true;
  }
  function leave() { pointerActive = false; }
  window.addEventListener('pointermove', pointer, { passive: true });
  document.documentElement.addEventListener('pointerleave', leave);
  window.addEventListener('blur', leave);
  window.addEventListener('resize', sync, { passive: true });
  document.addEventListener('visibilitychange', sync);
  motion.addEventListener('change', sync);
  desktop.addEventListener('change', sync);
  window.addEventListener('pagehide', stop);
  window.addEventListener('pageshow', sync);
  const geometry = new ResizeObserver(sync);
  geometry.observe(scene);
  sync();
})();
