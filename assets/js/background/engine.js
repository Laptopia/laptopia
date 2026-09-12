(() => {
  'use strict';
  const mode = document.body.dataset.laptopiaBackground;
  if (mode !== 'pcb' || window.LaptopiaBackground) return;
  const moduleUrl = new URL('pcb.js', document.currentScript.src);
  // Match the engine cache version when fetching the lazy effect module.
  moduleUrl.search = new URL(document.currentScript.src).search;
  const motion = matchMedia('(prefers-reduced-motion: reduce)');
  const coarse = matchMedia('(pointer: coarse)');
  const canvas = document.createElement('canvas');
  canvas.className = 'laptopia-background-canvas';
  canvas.setAttribute('aria-hidden', 'true');
  const ctx = canvas.getContext('2d', { alpha: true });
  if (!ctx) return;
  document.body.prepend(canvas);
  let effect, frame = 0, resizeFrame = 0, destroyed = false;
  let last = 0, interval = 1000 / 60, slowFrames = 0;
  const pointer = { x: -1000, y: -1000, active: false };
  function stop() {
    cancelAnimationFrame(frame);
    frame = 0;
    last = 0;
  }
  function draw(now) {
    frame = 0;
    if (destroyed || document.hidden || !effect) return;
    if (!last || now - last >= interval - 1) {
      const dt = last ? Math.min((now - last) / 1000, .1) : 0;
      last = now;
      const start = performance.now();
      effect.render(ctx, dt, motion.matches);
      slowFrames = performance.now() - start > 10 ? slowFrames + 1 : Math.max(0, slowFrames - 1);
      if (slowFrames > 20) interval = 1000 / 30;
    }
    if (!motion.matches) frame = requestAnimationFrame(draw);
  }
  function start() {
    if (!destroyed && !document.hidden && effect && !frame) frame = requestAnimationFrame(draw);
  }
  function resize() {
    resizeFrame = 0;
    if (destroyed) return;
    const width = window.innerWidth, height = window.innerHeight;
    const dpr = Math.min(devicePixelRatio || 1, 2);
    canvas.width = Math.round(width * dpr);
    canvas.height = Math.round(height * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    effect?.resize({ width, height, mobile: width <= 600 || coarse.matches });
    last = 0;
    start();
  }
  function scheduleResize() {
    if (!resizeFrame) resizeFrame = requestAnimationFrame(resize);
  }
  function move(event) {
    if (coarse.matches || motion.matches) return;
    pointer.x = event.clientX;
    pointer.y = event.clientY;
    pointer.active = true;
    effect?.pointerMove(pointer);
  }
  function leave() {
    pointer.active = false;
    effect?.pointerMove(pointer);
  }
  function visibility() {
    if (document.hidden) stop();
    else start();
  }
  function preference() {
    stop();
    leave();
    resize();
  }
  function destroy() {
    destroyed = true;
    stop();
    cancelAnimationFrame(resizeFrame);
    window.removeEventListener('resize', scheduleResize);
    window.removeEventListener('pointermove', move);
    document.documentElement.removeEventListener('pointerleave', leave);
    document.removeEventListener('visibilitychange', visibility);
    motion.removeEventListener('change', preference);
    coarse.removeEventListener('change', preference);
    window.removeEventListener('pagehide', pagehide);
    window.removeEventListener('pageshow', pageshow);
    effect?.destroy();
    canvas.remove();
    delete window.LaptopiaBackground;
  }
  function pagehide(event) {
    if (event.persisted) stop();
    else destroy();
  }
  function pageshow(event) {
    if (event.persisted) start();
  }
  window.LaptopiaBackground = { destroy };
  window.addEventListener('resize', scheduleResize, { passive: true });
  window.addEventListener('pointermove', move, { passive: true });
  document.documentElement.addEventListener('pointerleave', leave);
  document.addEventListener('visibilitychange', visibility);
  motion.addEventListener('change', preference);
  coarse.addEventListener('change', preference);
  window.addEventListener('pagehide', pagehide);
  window.addEventListener('pageshow', pageshow);
  import(moduleUrl.href).then(({ createPCB }) => {
    if (destroyed) return;
    effect = createPCB();
    effect.init();
    resize();
  }).catch(destroy);
})();
