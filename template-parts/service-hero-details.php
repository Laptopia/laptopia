<?php
$warranty = $args['warranty'] ?? '';
?>
<div class="laptopia-service-hero-details" aria-label="פרטי השירות">
  <?php if ( '' !== $warranty ) : ?>
    <span><?php echo laptopia_bidi_text( $warranty ); ?></span>
  <?php endif; ?>
  <span class="laptopia-service-hero-location">רחוב אלמוג 2, רמלה</span>
  <span>שירות גם בלוד, באר יעקב, ראשון לציון ורחובות</span>
</div>
