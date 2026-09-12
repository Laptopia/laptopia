(() => {
  document.querySelectorAll('.laptopia-services-dropdown').forEach((dropdown) => {
    const toggle = dropdown.querySelector('summary');
    const sync = () => toggle.setAttribute('aria-expanded', String(dropdown.open));
    const close = (restoreFocus = false) => {
      dropdown.open = false;
      sync();
      if (restoreFocus) toggle.focus();
    };
    dropdown.addEventListener('toggle', sync);
    dropdown.addEventListener('click', (event) => {
      if (event.target.closest('a')) close(true);
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && dropdown.open) {
        event.preventDefault();
        close(true);
      }
    });
    document.addEventListener('click', (event) => {
      if (dropdown.open && !dropdown.contains(event.target)) close();
    });
    dropdown.addEventListener('focusout', (event) => {
      if (event.relatedTarget && !dropdown.contains(event.relatedTarget)) close();
    });
    sync();
  });
})();

(() => {
  const logo = document.querySelector('.laptopia-header .laptopia-logo');
  if (!logo) return;

  const button = document.createElement('button');
  button.type = 'button';
  button.className = 'laptopia-back-to-top';
  button.setAttribute('aria-label', 'חזרה לראש העמוד');
  button.textContent = '↑';
  button.hidden = true;
  document.body.append(button);

  const updateVisibility = () => {
    const hide = window.scrollY < 600;
    if (hide && document.activeElement === button) logo.focus({ preventScroll: true });
    button.hidden = hide;
  };

  window.addEventListener('scroll', updateVisibility, { passive: true });
  window.addEventListener('pageshow', updateVisibility);
  button.addEventListener('click', () => {
    if (window.location.hash) {
      history.replaceState(history.state, '', window.location.pathname + window.location.search);
    }
    logo.focus({ preventScroll: true });
    window.scrollTo({
      top: 0,
      behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
    });
  });
  updateVisibility();
})();
