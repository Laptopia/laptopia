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
    const placement = link.dataset.analyticsPlacement ||
      (link.closest('.laptopia-hero') ? 'hero' : 'other');
    const params = {
      placement,
      page_location: window.location.origin + window.location.pathname
    };
    if (url.protocol === 'tel:') {
      name = 'phone_click';
    } else if (url.protocol === 'https:' && url.hostname === 'wa.me' &&
               /^\/972538036244\/?$/.test(url.pathname)) {
      name = 'whatsapp_click';
    } else if (link.dataset.analyticsEvent === 'directions_click' &&
               ['waze', 'google_maps'].includes(link.dataset.analyticsProvider)) {
      name = 'directions_click';
      params.provider = link.dataset.analyticsProvider;
    } else if (link.dataset.analyticsEvent === 'price_list_click') {
      name = 'price_list_click';
    } else if (link.dataset.analyticsEvent === 'service_card_click' && link.dataset.analyticsService) {
      name = 'service_card_click';
      params.service = link.dataset.analyticsService;
    } else if (link.dataset.analyticsEvent === 'repair_case_click' && link.dataset.analyticsCase) {
      name = 'repair_case_click';
      params.case = link.dataset.analyticsCase;
    } else {
      return;
    }

    if (name === 'phone_click' || name === 'whatsapp_click') {
      params.link_url = url.protocol === 'tel:' ? `tel:${url.pathname}` : url.origin + url.pathname;
    }

    try {
      window.gtag('event', name, params);
    } catch {
      // Analytics must never interrupt the contact action.
    }
  });
})();
