<footer class="laptopia-footer">
  <a class="laptopia-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Laptopia — דף הבית">
    <?php get_template_part( 'template-parts/brand-logo', null, array( 'variant' => 'dark', 'loading' => 'lazy', 'alt' => 'Laptopia — מעבדת מחשבים ניידים' ) ); ?>
  </a>
  <nav class="laptopia-footer-services" aria-label="שירותי המעבדה">
    <?php foreach ( laptopia_get_services() as $service ) : ?>
      <a href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>"<?php if ( is_page( $service['slug'] ) ) : ?> aria-current="page"<?php endif; ?>><?php echo laptopia_bidi_text( $service['short_label'] ); ?></a>
    <?php endforeach; ?>
    <a href="<?php echo esc_url( home_url( '/prices/' ) ); ?>"<?php if ( is_page( 'prices' ) ) : ?> aria-current="page"<?php endif; ?>>מחירון</a>
    <?php if ( laptopia_has_published_repair_case() ) : ?>
      <a href="<?php echo esc_url( home_url( '/repairs/' ) ); ?>"<?php if ( is_page( 'repairs' ) || is_page_template( 'page-templates/repair-case.php' ) ) : ?> aria-current="<?php echo is_page( 'repairs' ) ? 'page' : 'location'; ?>"<?php endif; ?>>תיק עבודות</a>
    <?php endif; ?>
    <a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php if ( is_page( 'service-areas' ) ) : ?> aria-current="page"<?php endif; ?>>אודותינו ואזורי שירות</a>
  </nav>
  <?php
  $legal_links = array();
  foreach ( array( 'privacy-policy' => 'מדיניות פרטיות', 'terms' => 'תנאי שימוש' ) as $slug => $label ) {
      $legal_page = get_page_by_path( $slug, OBJECT, 'page' );
      if ( $legal_page && 'publish' === $legal_page->post_status ) {
          $legal_links[] = array( 'id' => $legal_page->ID, 'label' => $label );
      }
  }
  ?>
  <?php if ( $legal_links ) : ?>
    <nav class="laptopia-footer-legal" aria-label="מידע משפטי">
      <?php foreach ( $legal_links as $link ) : ?>
        <a href="<?php echo esc_url( set_url_scheme( get_permalink( $link['id'] ), 'https' ) ); ?>"<?php if ( is_page( $link['id'] ) ) : ?> aria-current="page"<?php endif; ?>><?php echo esc_html( $link['label'] ); ?></a>
      <?php endforeach; ?>
    </nav>
  <?php endif; ?>
</footer>
