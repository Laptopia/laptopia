(() => {
  document.querySelectorAll('.laptopia-services-dropdown').forEach((dropdown) => {
    const toggle = dropdown.querySelector('summary');
    const header = dropdown.closest('.laptopia-header');
    const overlay = document.createElement('div');
    overlay.className = 'laptopia-services-overlay';
    overlay.setAttribute('aria-hidden', 'true');
    overlay.hidden = true;
    document.body.append(overlay);
    const sync = () => {
      toggle.setAttribute('aria-expanded', String(dropdown.open));
      overlay.hidden = !dropdown.open;
      header?.classList.toggle('laptopia-services-open', dropdown.open);
    };
    const close = (restoreFocus = false) => {
      dropdown.open = false;
      sync();
      if (restoreFocus) toggle.focus();
    };
    dropdown.addEventListener('toggle', sync);
    overlay.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      close(true);
    });
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

  const floatingWhatsapp = document.querySelector('.laptopia-floating-whatsapp');

  const button = document.createElement('button');
  button.type = 'button';
  button.className = 'laptopia-floating-control laptopia-back-to-top';
  button.setAttribute('aria-label', 'חזרה לראש העמוד');
  // Arrow Up from Lucide Icons: https://lucide.dev/icons/arrow-up.
  button.innerHTML = '<svg class="laptopia-floating-icon laptopia-floating-icon-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>';
  button.hidden = true;
  document.body.append(button);

  let collisionFrame = 0;
  let collisionElements = [];
  let collisionTextRanges = [];

  const refreshCollisionTargets = () => {
    collisionElements = [...document.querySelectorAll('main img, main .laptopia-btn, footer a')];
    collisionTextRanges = [];
    document.querySelectorAll('main, footer').forEach((root) => {
      const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, {
        acceptNode(node) {
          if (!node.textContent.trim() || node.parentElement?.closest('.laptopia-floating-control, script, style, noscript')) {
            return NodeFilter.FILTER_REJECT;
          }
          return NodeFilter.FILTER_ACCEPT;
        },
      });
      let node;
      while ((node = walker.nextNode())) {
        const range = document.createRange();
        range.selectNodeContents(node);
        collisionTextRanges.push(range);
      }
    });
  };
  refreshCollisionTargets();

  const overlaps = (first, second) => (
    first.left < second.right && first.right > second.left
    && first.top < second.bottom && first.bottom > second.top
  );

  const updateCollision = () => {
    collisionFrame = 0;
    const occupied = [];
    for (let rangeIndex = 0; rangeIndex < collisionTextRanges.length; rangeIndex++) {
      const rects = collisionTextRanges[rangeIndex].getClientRects();
      for (let rectIndex = 0; rectIndex < rects.length; rectIndex++) {
        const rect = rects[rectIndex];
        if (rect.bottom > 0 && rect.top < window.innerHeight) occupied.push(rect);
      }
    }

    for (let index = 0; index < collisionElements.length; index++) {
      const element = collisionElements[index];
      if (element.hidden) continue;
      const rect = element.getBoundingClientRect();
      if (rect.bottom <= 0 || rect.top >= window.innerHeight || rect.width === 0 || rect.height === 0) continue;
      occupied.push(rect);
    }

    const controls = [floatingWhatsapp, button.hidden ? null : button];
    const obscured = controls.map((control) => {
      if (!control || document.activeElement === control) return false;
      const rect = control.getBoundingClientRect();
      return occupied.some((occupiedRect) => overlaps(rect, occupiedRect));
    });
    document.body.classList.toggle('laptopia-floating-whatsapp-obscured', obscured[0]);
    document.body.classList.toggle('laptopia-back-to-top-obscured', obscured[1]);
  };

  const scheduleCollisionUpdate = () => {
    if (!collisionFrame) collisionFrame = requestAnimationFrame(updateCollision);
  };

  const collisionObserver = new MutationObserver(() => {
    refreshCollisionTargets();
    scheduleCollisionUpdate();
  });
  document.querySelectorAll('main, footer').forEach((root) => {
    collisionObserver.observe(root, { childList: true, subtree: true });
  });

  const updateVisibility = () => {
    const hide = window.scrollY < 600;
    if (hide && document.activeElement === button) logo.focus({ preventScroll: true });
    button.hidden = hide;
    scheduleCollisionUpdate();
  };

  window.addEventListener('scroll', updateVisibility, { passive: true });
  window.addEventListener('resize', scheduleCollisionUpdate, { passive: true });
  window.addEventListener('pageshow', updateVisibility);
  floatingWhatsapp?.addEventListener('focus', scheduleCollisionUpdate);
  floatingWhatsapp?.addEventListener('blur', scheduleCollisionUpdate);
  button.addEventListener('focus', scheduleCollisionUpdate);
  button.addEventListener('blur', scheduleCollisionUpdate);
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
  scheduleCollisionUpdate();
})();
