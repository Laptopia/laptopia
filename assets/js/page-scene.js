/* Match the fixed viewport geometry used by the service background canvas. */
(() => {
  'use strict';
  const art = document.querySelector('.laptopia-page-art--full');
  const main = document.querySelector('main');
  if (!art || !main) return;
  let pending = 0;
  const measure = () => {
    pending = 0;
    art.style.height = `${innerHeight}px`;
  };
  const schedule = () => {
    if (!pending) pending = requestAnimationFrame(measure);
  };
  window.addEventListener('resize', schedule, { passive: true });
  window.addEventListener('load', schedule, { once: true });
  window.addEventListener('pagehide', () => cancelAnimationFrame(pending));
  window.addEventListener('pageshow', schedule);
  measure();
})();
