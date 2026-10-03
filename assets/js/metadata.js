/* Decorative separators follow visual rows without changing text or wrapping. */
(() => {
  'use strict';
  const rows = document.querySelectorAll('.laptopia-trust, .laptopia-service-hero-details');
  const update = row => {
    const items = Array.from(row.children);
    const positions = items.map(item => item.getBoundingClientRect());
    items.forEach((item, index) => {
      const position = positions[index];
      const startsRow = !positions.some(other =>
        Math.abs(other.top - position.top) < 2 && other.right > position.right + 2);
      item.classList.toggle('laptopia-metadata-row-start', startsRow);
    });
    row.classList.add('laptopia-metadata-ready');
  };
  rows.forEach(row => {
    update(row);
    if ('ResizeObserver' in window) new ResizeObserver(() => update(row)).observe(row);
  });
  if (!('ResizeObserver' in window)) window.addEventListener('resize', () => rows.forEach(update), { passive: true });
  document.fonts?.ready.then(() => rows.forEach(update));
})();
