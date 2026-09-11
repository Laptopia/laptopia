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
