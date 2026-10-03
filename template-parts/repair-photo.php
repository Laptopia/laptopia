<?php
$image = $args['image'] ?? array();
if ( empty( $image['src'] ) || empty( $image['alt'] ) ) {
    return;
}
$class = $args['class'] ?? '';
$priority = ! empty( $args['priority'] );
?>
<figure class="laptopia-repair-photo <?php echo esc_attr( $class ); ?>">
  <button class="laptopia-repair-photo-trigger" type="button" aria-label="הגדלת תמונה: <?php echo esc_attr( $image['alt'] ); ?>" data-repair-image="<?php echo esc_url( $image['src'] ); ?>" data-repair-caption="<?php echo esc_attr( $image['caption'] ?? '' ); ?>">
    <img src="<?php echo esc_url( $image['src'] ); ?>"
         alt="<?php echo esc_attr( $image['alt'] ); ?>"
         width="<?php echo esc_attr( (string) (int) $image['width'] ); ?>"
         height="<?php echo esc_attr( (string) (int) $image['height'] ); ?>"
         loading="<?php echo $priority ? 'eager' : 'lazy'; ?>"
         <?php if ( $priority ) : ?>fetchpriority="high"<?php endif; ?> decoding="async">
    <span class="laptopia-photo-zoom" aria-hidden="true"><?php echo laptopia_get_icon_svg( 'diagnostics' ); ?></span>
  </button>
  <?php if ( ! empty( $image['caption'] ) ) : ?><figcaption><?php echo esc_html( $image['caption'] ); ?></figcaption><?php endif; ?>
</figure>
