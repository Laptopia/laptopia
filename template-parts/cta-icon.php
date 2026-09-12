<?php
$icons = array(
    'phone' => '<path d="m7 3 3 5-2 2c1 3 3 5 6 6l2-2 5 3c0 3-2 4-4 4C9 20 4 15 3 7c0-2 1-4 4-4Z"/>',
    'whatsapp' => '<path d="M20 11.5a8 8 0 0 1-11.8 7L3 20l1.5-5.2A8 8 0 1 1 20 11.5Z"/><path d="m8 7 2 3-1 1c1 2 2 3 4 4l1-1 3 2c-1 2-3 2-5 1-3-1-5-3-6-6-1-2-1-3 2-4Z"/>',
    'navigation' => '<path d="m21 3-7 18-3-8-8-3 18-7Z"/>',
);
?>
<svg class="laptopia-cta-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
  <?php // Fixed SVG markup, never user input.
  echo $icons[ $args['type'] ?? '' ] ?? ''; ?>
</svg>
