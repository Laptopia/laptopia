(() => {
  const dialog = document.querySelector('.laptopia-repair-lightbox');
  const triggers = [...document.querySelectorAll('.laptopia-repair-photo-trigger')];
  if (!dialog || !triggers.length) return;

  const image = dialog.querySelector('.laptopia-repair-lightbox-image');
  const caption = dialog.querySelector('.laptopia-repair-lightbox-caption');
  const counter = dialog.querySelector('.laptopia-repair-lightbox-counter');
  const closeButton = dialog.querySelector('.laptopia-repair-lightbox-close');
  const previousButton = dialog.querySelector('.laptopia-repair-lightbox-previous');
  const nextButton = dialog.querySelector('.laptopia-repair-lightbox-next');
  let current = 0;
  let opener = null;
  let previousOverflow = '';

  const showImage = (index) => {
    current = (index + triggers.length) % triggers.length;
    const trigger = triggers[current];
    image.src = trigger.dataset.repairImage;
    image.alt = trigger.querySelector('img')?.alt || '';
    caption.textContent = trigger.dataset.repairCaption || '';
    counter.textContent = `${current + 1} / ${triggers.length}`;
  };

  triggers.forEach((trigger, index) => {
    trigger.addEventListener('click', () => {
      opener = trigger;
      showImage(index);
      previousOverflow = document.body.style.overflow;
      document.body.style.overflow = 'hidden';
      dialog.showModal();
      closeButton.focus();
    });
  });

  closeButton.addEventListener('click', () => dialog.close());
  previousButton.addEventListener('click', () => showImage(current - 1));
  nextButton.addEventListener('click', () => showImage(current + 1));
  dialog.addEventListener('click', (event) => {
    if (event.target === dialog) dialog.close();
  });
  dialog.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowLeft') {
      event.preventDefault();
      showImage(current + 1);
    } else if (event.key === 'ArrowRight') {
      event.preventDefault();
      showImage(current - 1);
    }
  });
  dialog.addEventListener('close', () => {
    document.body.style.overflow = previousOverflow;
    image.removeAttribute('src');
    opener?.focus({ preventScroll: true });
  });
})();
