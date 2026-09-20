<?php
$variant = 'dark' === ( $args['variant'] ?? 'light' ) ? 'dark' : 'light';
$loading = $args['loading'] ?? 'lazy';
$filename = 'laptopia-logo-' . $variant . '.webp';
$logo_url = get_theme_file_uri( '/assets/images/' . $filename );
$alt = $args['alt'] ?? 'Laptopia — מעבדת מחשבים ניידים';
?>
<img
  class="laptopia-brand-logo laptopia-brand-logo-<?php echo esc_attr( $variant ); ?>"
  src="<?php echo esc_url( $logo_url ); ?>"
  width="600"
  height="205"
  alt="<?php echo esc_attr( $alt ); ?>"
  decoding="async"
  <?php if ( $loading ) : ?>loading="<?php echo esc_attr( $loading ); ?>"<?php endif; ?>
  <?php if ( ! empty( $args['fetchpriority'] ) ) : ?>fetchpriority="<?php echo esc_attr( $args['fetchpriority'] ); ?>"<?php endif; ?>
>
