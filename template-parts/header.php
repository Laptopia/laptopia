<?php
$service_header = ! empty( $args['service_link'] );
$service_link = $args['service_link'] ?? array();
?>
<header class="laptopia-header"<?php if ( $service_header ) : ?> dir="rtl"<?php endif; ?>>

  <div class="laptopia-header-inner">

    <a class="laptopia-logo<?php if ( ! $service_header ) : ?> laptopia-element-link<?php endif; ?>" href="<?php echo esc_url( $service_header ? home_url( '/' ) : '/' ); ?>">
      <span class="laptopia-logo-wordmark" dir="ltr">Laptop<span class="laptopia-logo-accent">ia</span></span>
      <span class="laptopia-logo-subtitle">מעבדת מחשבים ניידים</span>
    </a>

    <div class="laptopia-header-navigation">
    <?php get_template_part( 'template-parts/services-navigation' ); ?>
    <nav class="laptopia-nav"<?php if ( $service_header ) : ?> aria-label="ניווט ראשי"<?php endif; ?>>
      <?php if ( $service_header ) : ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">דף הבית</a>
      <a href="<?php echo esc_url( $service_link['href'] ); ?>"><?php echo esc_html( $service_link['label'] ); ?></a>
      <?php else : ?>
      <a href="#board">תיקון לוחות אם</a>
      <?php endif; ?>
      <a href="#prices">מחירים</a>
      <a href="#warranty">אחריות</a>
      <a href="#contact">יצירת קשר</a>
    </nav>
    </div>

    <a class="laptopia-header-phone"
       href="tel:+972538036244">
      <?php if ( $service_header ) : ?><bdi dir="ltr">053-803-6244</bdi><?php else : ?>053-803-6244<?php endif; ?>
    </a>

  </div>

</header>