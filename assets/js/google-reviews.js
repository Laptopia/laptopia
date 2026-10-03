/* Maps JavaScript API bootstrap: official sample, Apache-2.0. */
(() => {
  'use strict';
  const shell = document.querySelector('[data-google-reviews-shell]');
  const config = window.laptopiaPlacesUiConfig;
  const official = shell?.querySelector('[data-google-reviews-official]');
  const fallback = shell?.querySelector('[data-google-reviews-fallback]');
  const section = official?.querySelector('.laptopia-google-reviews');
  const carousel = section?.querySelector('[data-google-carousel]');
  const finishLoading = state => {
    shell.dataset.googleReviewsState = state;
    shell.setAttribute('aria-busy', 'false');
  };
  if (!section || !carousel || !fallback || !config?.key || !window.Promise) {
    if (shell && fallback) { fallback.hidden = false; finishLoading('fallback'); }
    return;
  }

  let started = false;
  let failed = false;
  let timer;
  let cards = [];
  let slides = [];
  let physicalIndex = 0;
  let settleTimer;
  let autoplayTimer;
  let resumeTimer;
  let hovered = false;
  let focusInside = false;
  let pointerActive = false;
  let manualPaused = false;
  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const safeUrl = value => {
    try { const url = new URL(value); return url.protocol === 'https:' ? url.href : null; }
    catch (_) { return null; }
  };
  const fail = () => {
    if (failed) return;
    failed = true;
    clearTimeout(timer);
    clearTimeout(autoplayTimer);
    clearTimeout(resumeTimer);
    clearTimeout(settleTimer);
    official.hidden = true;
    fallback.hidden = false;
    finishLoading('fallback');
    shell.style.minHeight = '';
  };
  const link = (label, url, className) => {
    const a = document.createElement('a');
    a.textContent = label;
    a.href = safeUrl(url) || 'https://www.google.com/maps';
    a.target = '_blank';
    a.rel = 'noopener noreferrer';
    if (className) a.className = className;
    return a;
  };
  const cardFor = review => {
    const card = document.createElement('article');
    card.className = 'laptopia-google-review-card';
    const head = document.createElement('div');
    head.className = 'laptopia-google-review-author';
    const author = review.authorAttribution;
    if (safeUrl(author?.photoURI)) {
      const photo = document.createElement('img');
      photo.src = author.photoURI;
      photo.alt = '';
      photo.width = photo.height = 40;
      photo.loading = 'lazy';
      photo.decoding = 'async';
      head.append(photo);
    }
    const identity = document.createElement('div');
    identity.append(link(author?.displayName || 'משתמש Google', author?.uri));
    if (review.relativePublishTimeDescription) {
      const date = document.createElement('small');
      date.textContent = review.relativePublishTimeDescription;
      identity.append(date);
    }
    head.append(identity);
    card.append(head);
    const rating = Math.max(0, Math.min(5, Number(review.rating) || 0));
    const stars = document.createElement('div');
    stars.className = 'laptopia-google-review-stars';
    stars.textContent = '★'.repeat(Math.round(rating)) + '☆'.repeat(5 - Math.round(rating));
    stars.setAttribute('aria-label', `${rating} מתוך 5 כוכבים`);
    card.append(stars);
    const body = document.createElement('p');
    body.className = 'laptopia-google-review-text';
    body.textContent = review.text;
    card.append(body);
    if (review.text.length > 140) {
      body.classList.add('is-collapsed');
      const expand = document.createElement('button');
      expand.type = 'button';
      expand.className = 'laptopia-google-review-expand';
      expand.textContent = 'קראו עוד';
      expand.setAttribute('aria-expanded', 'false');
      expand.addEventListener('click', () => {
        const collapsed = body.classList.toggle('is-collapsed');
        expand.textContent = collapsed ? 'קראו עוד' : 'הציגו פחות';
        expand.setAttribute('aria-expanded', String(!collapsed));
      });
      card.append(expand);
    }
    if (safeUrl(review.googleMapsURI)) card.append(link('צפו בביקורת ב-Google Maps', review.googleMapsURI, 'laptopia-google-review-link'));
    return card;
  };
  const visibleCount = () => window.matchMedia('(min-width: 1024px)').matches ? 3 : window.matchMedia('(min-width: 701px)').matches ? 2 : 1;
  const prev = section.querySelector('[data-google-prev]');
  const next = section.querySelector('[data-google-next]');
  const cloneFor = review => {
    const clone = cardFor(review);
    clone.setAttribute('aria-hidden', 'true');
    clone.querySelectorAll('a, button').forEach(control => { control.tabIndex = -1; });
    return clone;
  };
  const nearestSlide = () => {
    const edge = carousel.getBoundingClientRect().right;
    let best = 0;
    let distance = Infinity;
    slides.forEach((slide, index) => {
      const delta = Math.abs(slide.getBoundingClientRect().right - edge);
      if (delta < distance) { distance = delta; best = index; }
    });
    return best;
  };
  const alignTo = (index, smooth) => {
    const target = slides[index];
    if (!target) return;
    const delta = target.getBoundingClientRect().right - carousel.getBoundingClientRect().right;
    carousel.scrollTo({ left: carousel.scrollLeft + delta, behavior: smooth && !motionQuery.matches ? 'smooth' : 'instant' });
  };
  const settle = () => {
    if (!slides.length || pointerActive) return;
    physicalIndex = nearestSlide();
    if (physicalIndex < cards.length || physicalIndex >= cards.length * 2) {
      physicalIndex = cards.length + ((physicalIndex - cards.length) % cards.length + cards.length) % cards.length;
      alignTo(physicalIndex, false);
    }
  };
  const step = direction => {
    settle();
    physicalIndex += direction;
    alignTo(physicalIndex, true);
  };
  const canAutoplay = () => cards.length > visibleCount() && !failed && !document.hidden &&
    !motionQuery.matches && !hovered && !focusInside && !pointerActive && !manualPaused;
  const scheduleAutoplay = () => {
    clearTimeout(autoplayTimer);
    if (!canAutoplay()) return;
    autoplayTimer = setTimeout(() => {
      if (!canAutoplay()) return;
      step(1);
      scheduleAutoplay();
    }, 5000);
  };
  const pauseForInteraction = () => {
    manualPaused = true;
    clearTimeout(autoplayTimer);
    clearTimeout(resumeTimer);
    resumeTimer = setTimeout(() => {
      manualPaused = false;
      if (canAutoplay()) step(1);
      scheduleAutoplay();
    }, 8000);
  };
  prev.addEventListener('click', () => { pauseForInteraction(); step(-1); });
  next.addEventListener('click', () => { pauseForInteraction(); step(1); });
  carousel.addEventListener('mouseenter', () => {
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
    hovered = true;
    clearTimeout(autoplayTimer);
  });
  carousel.addEventListener('mouseleave', () => { hovered = false; scheduleAutoplay(); });
  section.addEventListener('focusin', event => {
    focusInside = event.target.matches(':focus-visible');
    if (focusInside) clearTimeout(autoplayTimer);
  });
  section.addEventListener('keydown', () => { focusInside = true; clearTimeout(autoplayTimer); });
  section.addEventListener('pointerdown', () => { focusInside = false; });
  section.addEventListener('focusout', () => {
    setTimeout(() => {
      focusInside = section.contains(document.activeElement) && document.activeElement.matches(':focus-visible');
      scheduleAutoplay();
    }, 0);
  });
  carousel.addEventListener('pointerdown', () => { pointerActive = true; pauseForInteraction(); });
  const finishPointer = () => {
    if (!pointerActive) return;
    pointerActive = false;
    clearTimeout(settleTimer);
    settleTimer = setTimeout(settle, 180);
    scheduleAutoplay();
  };
  window.addEventListener('pointerup', finishPointer);
  window.addEventListener('pointercancel', finishPointer);
  carousel.addEventListener('wheel', pauseForInteraction, { passive: true });
  carousel.addEventListener('keydown', pauseForInteraction);
  document.addEventListener('visibilitychange', scheduleAutoplay);
  const onMotionChange = scheduleAutoplay;
  if (motionQuery.addEventListener) motionQuery.addEventListener('change', onMotionChange);
  else motionQuery.addListener(onMotionChange);
  carousel.addEventListener('scroll', () => {
    clearTimeout(settleTimer);
    settleTimer = setTimeout(settle, 180);
  }, { passive: true });
  window.addEventListener('resize', () => { settle(); scheduleAutoplay(); }, { passive: true });

  const start = async () => {
    if (started) return;
    started = true;
    shell.style.minHeight = shell.getBoundingClientRect().height + 'px';
    timer = setTimeout(fail, 15000);
    try {
      if (!window.google?.maps?.importLibrary) {
        // Unmodified official inline bootstrap; guard avoids duplicate load.
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})(config);
      }
      const { Place } = await window.google.maps.importLibrary('places');
      const place = new Place({ id: section.dataset.placeId });
      await place.fetchFields({ fields: ['rating', 'userRatingCount', 'reviews'] });
      if (failed) return;
      const reviews = Array.isArray(place.reviews) ? place.reviews.filter(review => typeof review.text === 'string' && review.text.trim()) : [];
      if (!reviews.length || !Number.isFinite(place.rating) || !Number.isFinite(place.userRatingCount)) { fail(); return; }
      cards = reviews.map(cardFor);
      slides = [
        ...reviews.map(cloneFor),
        ...cards,
        ...reviews.map(cloneFor),
      ];
      carousel.append(...slides);
      physicalIndex = cards.length;
      const summary = section.querySelector('[data-google-rating]');
      const score = document.createElement('strong');
      score.textContent = place.rating.toFixed(1);
      score.dir = 'ltr';
      const stars = document.createElement('span');
      stars.className = 'laptopia-google-rating-stars';
      stars.textContent = '★'.repeat(Math.round(place.rating)) + '☆'.repeat(5 - Math.round(place.rating));
      stars.setAttribute('aria-hidden', 'true');
      const separator = document.createElement('span');
      separator.textContent = '·';
      separator.setAttribute('aria-hidden', 'true');
      const total = document.createElement('span');
      total.textContent = `${place.userRatingCount.toLocaleString('he-IL')} דירוגים ב-Google`;
      summary.append(score, stars, separator, total);
      const attributions = section.querySelector('[data-google-provider-attributions]');
      if (Array.isArray(place.attributions)) place.attributions.forEach(value => {
        if (typeof value === 'string') {
          const span = document.createElement('span');
          span.textContent = value;
          attributions.append(span);
        } else if (value?.provider) {
          attributions.append(safeUrl(value.providerURI)
            ? link(value.provider, value.providerURI)
            : document.createTextNode(value.provider));
        }
      });
      clearTimeout(timer);
      official.hidden = false;
      fallback.hidden = true;
      finishLoading('ready');
      alignTo(physicalIndex, false);
      shell.style.minHeight = '';
      scheduleAutoplay();
    } catch (_) { fail(); }
  };
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
      if (entries.some(entry => entry.isIntersecting)) { observer.disconnect(); void start(); }
    }, { rootMargin: '400px 0px' });
    observer.observe(shell);
  } else { void start(); }
})();
