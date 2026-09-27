<?php
$service_header = ! empty( $args['service_link'] );
$repairs_current = is_page( 'repairs' ) || is_page_template( 'page-templates/repair-case.php' );
?>
<header class="laptopia-header" dir="rtl">

  <div class="laptopia-header-inner">

    <a class="laptopia-logo<?php if ( ! $service_header ) : ?> laptopia-element-link<?php endif; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Laptopia — דף הבית">
      <?php get_template_part( 'template-parts/brand-logo', null, array( 'variant' => 'light', 'loading' => false, 'fetchpriority' => 'high', 'alt' => 'Laptopia — מעבדת מחשבים ניידים' ) ); ?>
    </a>

    <nav class="laptopia-header-navigation" aria-label="ניווט ראשי">
      <a class="laptopia-header-home" href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php if ( is_front_page() ) : ?> aria-current="page"<?php endif; ?>>דף הבית</a>
      <?php get_template_part( 'template-parts/services-navigation' ); ?>
      <a class="laptopia-header-repairs" href="<?php echo esc_url( home_url( '/repairs/' ) ); ?>"<?php if ( $repairs_current ) : ?> aria-current="<?php echo is_page( 'repairs' ) ? 'page' : 'location'; ?>"<?php endif; ?>>תיקונים מהמעבדה</a>
      <a class="laptopia-header-about" href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php if ( is_page( 'service-areas' ) ) : ?> aria-current="page"<?php endif; ?>>אודותינו</a>
      <a class="laptopia-header-contact" href="#contact">יצירת קשר</a>
      <details class="laptopia-mobile-navigation" dir="rtl">
        <summary aria-controls="laptopia-mobile-navigation-panel" aria-expanded="false">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          תפריט
        </summary>
        <div class="laptopia-mobile-navigation-panel" id="laptopia-mobile-navigation-panel">
          <p class="laptopia-mobile-navigation-heading">שירותים</p>
          <?php foreach ( laptopia_get_services() as $service ) : ?>
            <a href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>"<?php if ( is_page( $service['slug'] ) ) : ?> aria-current="page"<?php endif; ?>><?php echo laptopia_bidi_text( $service['short_label'] ); ?></a>
          <?php endforeach; ?>
          <a class="laptopia-mobile-navigation-section" href="<?php echo esc_url( home_url( '/repairs/' ) ); ?>"<?php if ( $repairs_current ) : ?> aria-current="<?php echo is_page( 'repairs' ) ? 'page' : 'location'; ?>"<?php endif; ?>>תיקונים מהמעבדה</a>
          <a class="laptopia-mobile-navigation-section" href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php if ( is_page( 'service-areas' ) ) : ?> aria-current="page"<?php endif; ?>>אודותינו</a>
          <a class="laptopia-mobile-navigation-section" href="#contact">יצירת קשר</a>
        </div>
      </details>
    </nav>

    <a class="laptopia-header-phone"
       href="tel:+972538036244"
       aria-label="התקשרו למעבדה: 053-803-6244">
      <?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?>
      <bdi class="laptopia-header-phone-number" dir="ltr">053-803-6244</bdi>
    </a>

  </div>

</header>
