<footer class="laptopia-footer">
  <a class="laptopia-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Laptopia — דף הבית">
    <?php get_template_part( 'template-parts/brand-logo', null, array( 'variant' => 'dark', 'loading' => 'lazy', 'alt' => 'Laptopia — מעבדת מחשבים ניידים' ) ); ?>
  </a>
  <nav class="laptopia-footer-services" aria-label="שירותי המעבדה">
    <?php foreach ( laptopia_get_services() as $service ) : ?>
      <a href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>"<?php if ( is_page( $service['slug'] ) ) : ?> aria-current="page"<?php endif; ?>><?php echo laptopia_bidi_text( $service['short_label'] ); ?></a>
    <?php endforeach; ?>
    <a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php if ( is_page( 'service-areas' ) ) : ?> aria-current="page"<?php endif; ?>>אודותינו ואזורי שירות</a>
  </nav>
</footer>
