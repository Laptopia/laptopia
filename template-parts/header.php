<?php
$service_header = ! empty( $args['service_link'] );
$service_link = $args['service_link'] ?? array();
$custom_nav = $args['nav_links'] ?? array();
$inner_header = $service_header || ! empty( $custom_nav );
?>
<header class="laptopia-header"<?php if ( $inner_header ) : ?> dir="rtl"<?php endif; ?>>

  <div class="laptopia-header-inner">

    <a class="laptopia-logo<?php if ( ! $service_header ) : ?> laptopia-element-link<?php endif; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Laptopia — דף הבית">
      <?php get_template_part( 'template-parts/brand-logo', null, array( 'variant' => 'light', 'loading' => false, 'fetchpriority' => 'high', 'alt' => 'Laptopia — מעבדת מחשבים ניידים' ) ); ?>
    </a>

    <div class="laptopia-header-navigation">
      <?php get_template_part( 'template-parts/services-navigation' ); ?>
      <a class="laptopia-header-about" href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php if ( is_page( 'service-areas' ) ) : ?> aria-current="page"<?php endif; ?>>אודותינו</a>
      <nav class="laptopia-nav"<?php if ( $inner_header ) : ?> aria-label="ניווט ראשי"<?php endif; ?>>
        <?php if ( ! empty( $custom_nav ) ) : ?>
          <?php foreach ( $custom_nav as $nav_item ) : ?>
            <a href="<?php echo esc_url( $nav_item['href'] ); ?>"<?php if ( ! empty( $nav_item['current'] ) ) : ?> aria-current="page"<?php endif; ?>><?php echo laptopia_bidi_text( $nav_item['label'] ); ?></a>
          <?php endforeach; ?>
        <?php else : ?>
          <?php if ( $service_header ) : ?>
          <a href="<?php echo esc_url( $service_link['href'] ); ?>"><?php echo laptopia_bidi_text( $service_link['label'] ); ?></a>
          <?php else : ?>
          <a href="#board">תיקון לוחות אם</a>
          <?php endif; ?>
          <a href="#prices">מחירים</a>
          <a href="#warranty">אחריות</a>
          <a href="#contact">יצירת קשר</a>
        <?php endif; ?>
      </nav>
    </div>

    <a class="laptopia-header-phone"
       href="tel:+972538036244"
       aria-label="התקשרו למעבדה: 053-803-6244">
      <?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?>
      <bdi class="laptopia-header-phone-number" dir="ltr">053-803-6244</bdi>
    </a>

  </div>

</header>
