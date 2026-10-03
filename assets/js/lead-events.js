(() => {
  'use strict';

  document.addEventListener('click', (event) => {
    const link = event.target instanceof Element ? event.target.closest('a[href]') : null;
    if (!link || typeof window.gtag !== 'function') return;

    let url;
    try {
      url = new URL(link.href);
    } catch {
      return;
    }

    let name;
    if (url.protocol === 'tel:') {
      name = 'phone_click';
    } else if (url.protocol === 'https:' && url.hostname === 'wa.me' &&
               /^\/972538036244\/?$/.test(url.pathname)) {
      name = 'whatsapp_click';
    } else {
      return;
    }

    try {
      window.gtag('event', name, {
        link_url: url.protocol === 'tel:' ? `tel:${url.pathname}` : url.origin + url.pathname,
        page_location: window.location.origin + window.location.pathname
      });
    } catch {
      // Analytics must never interrupt the contact action.
    }
  });
})();
