(() => {
  'use strict';
  const mode = document.body.dataset.laptopiaBackground;
  const modes = { pcb: ['pcb.js', 'createPCB'], network: ['network.js', 'createNetwork'] };
  if (!Object.hasOwn(modes, mode) || window.LaptopiaBackground) return;
  const [moduleFile, factory] = modes[mode];
  const moduleUrl = new URL(moduleFile, document.currentScript.src);
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
  let last = 0, nextDraw = 0, lastTick = 0, cadence = 1000 / 60;
  let stage = 0, renderCost = 0, overloaded = 0, recovered = 0;
  const policies = [0, 1000 / 60, 1000 / 45, 1000 / 30];
  function resetTiming() {
    last = nextDraw = lastTick = 0;
    overloaded = recovered = 0;
  }
  function adapt(cost, dt) {
    renderCost += (cost - renderCost) * .08;
    const targetInterval = stage ? policies[stage] : Math.min(1000 / 60, cadence);
    const budget = Math.max(3, targetInterval * .65);
    overloaded = renderCost > budget ? overloaded + dt : Math.max(0, overloaded - dt * 2);
    recovered = renderCost < budget * .55 ? recovered + dt : 0;
    if (overloaded > 1.5 && stage < 3) {
      stage++;
      overloaded = recovered = 0;
      nextDraw = 0;
      effect.setQuality?.(stage === 1 ? 'medium' : 'low');
    } else if (recovered > 5 && stage > 0) {
      stage--;
      overloaded = recovered = 0;
      nextDraw = 0;
      effect.setQuality?.(stage === 0 ? 'high' : stage === 1 ? 'medium' : 'low');
    }
  }
  const pointer = { x: -1000, y: -1000, active: false };
  function stop() {
    cancelAnimationFrame(frame);
    frame = 0;
    resetTiming();
  }
  function draw(now) {
    frame = 0;
    if (destroyed || document.hidden || !effect) return;
    if (lastTick) {
      const gap = now - lastTick;
      if (gap > 2 && gap < 100) cadence += (gap - cadence) * .05;
    }
    lastTick = now;
    const interval = policies[stage];
    if (!last || !interval || now >= nextDraw - .5) {
      const dt = last ? Math.min((now - last) / 1000, .1) : 0;
      last = now;
      const start = performance.now();
      effect.render(ctx, dt, motion.matches);
      if (!motion.matches) adapt(performance.now() - start, dt);
      // Accumulate deadlines: capped 45/60 FPS must not halve a faster rAF clock.
      if (stage && !nextDraw) nextDraw = now + policies[stage];
      else if (stage) {
        nextDraw += policies[stage];
        if (now - nextDraw > policies[stage]) nextDraw = now + policies[stage];
      }
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
    resetTiming();
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
  window.LaptopiaBackground = {
    destroy,
    getStats() {
      return { mode, framePolicy: stage ? [0, 60, 45, 30][stage] : 'native', renderMs: renderCost,
        effect: effect?.getStats?.() };
    }
  };
  window.addEventListener('resize', scheduleResize, { passive: true });
  window.addEventListener('pointermove', move, { passive: true });
  document.documentElement.addEventListener('pointerleave', leave);
  document.addEventListener('visibilitychange', visibility);
  motion.addEventListener('change', preference);
  coarse.addEventListener('change', preference);
  window.addEventListener('pagehide', pagehide);
  window.addEventListener('pageshow', pageshow);
  import(moduleUrl.href).then(module => {
    if (destroyed) return;
    effect = module[factory]();
    effect.init();
    resize();
  }).catch(destroy);
})();
