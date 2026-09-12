<?php
/** Reusable real-repair example; images are supplied by the service template. */
$case_images = $args['images'] ?? array();
if ( empty( $case_images ) ) {
    return;
}
$case_gallery_class = count( $case_images ) === 1 ? ' laptopia-case-gallery-single' : '';
?>
<section class="laptopia-section laptopia-services laptopia-service-case">
  <div class="laptopia-board-content">
    <h2 class="laptopia-section-title"><?php echo esc_html( $args['heading'] ?? '' ); ?></h2>
    <div class="laptopia-component-gallery<?php echo esc_attr( $case_gallery_class ); ?>">
      <?php foreach ( $case_images as $image ) : ?>
        <figure class="laptopia-component-figure">
          <img src="<?php echo esc_url( $image['src'] ); ?>"
               alt="<?php echo esc_attr( $image['alt'] ); ?>"
               <?php if ( ! empty( $image['title'] ) ) : ?>title="<?php echo esc_attr( $image['title'] ); ?>"<?php endif; ?>
               <?php if ( ! empty( $image['width'] ) && ! empty( $image['height'] ) ) : ?>width="<?php echo esc_attr( (string) (int) $image['width'] ); ?>" height="<?php echo esc_attr( (string) (int) $image['height'] ); ?>"<?php endif; ?>
               loading="lazy" decoding="async">
          <?php if ( ! empty( $image['caption'] ) ) : ?>
            <figcaption><?php echo esc_html( $image['caption'] ); ?></figcaption>
          <?php endif; ?>
        </figure>
      <?php endforeach; ?>
    </div>
    <p class="laptopia-price-note"><?php echo esc_html( $args['description'] ?? '' ); ?></p>
  </div>
</section>
