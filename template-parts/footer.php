<footer class="laptopia-footer">
  <?php get_template_part( 'template-parts/brand-wordmark' ); ?> – מעבדת מחשבים ניידים ברמלה
  <nav class="laptopia-footer-services" aria-label="שירותי המעבדה">
    <?php foreach ( laptopia_get_services() as $service ) : ?>
      <a href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>"<?php if ( is_page( $service['slug'] ) ) : ?> aria-current="page"<?php endif; ?>><?php echo laptopia_bidi_text( $service['short_label'] ); ?></a>
    <?php endforeach; ?>
    <a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php if ( is_page( 'service-areas' ) ) : ?> aria-current="page"<?php endif; ?>>אזורי שירות</a>
  </nav>
</footer>
