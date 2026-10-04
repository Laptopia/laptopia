<?php
/** Homepage cards consume the same published service registry as navigation. */
$services = laptopia_get_services();
usort( $services, static function( $a, $b ) { return $a['home_order'] <=> $b['home_order']; } );
?>
<section class="laptopia-section laptopia-services" id="services">
  <div class="laptopia-inner">
    <h2 class="laptopia-section-title">שירותי המעבדה</h2>
    <div class="laptopia-section-subtitle">תיקון מחשבים ניידים מיצרנים שונים, בהתאם לדגם ולתקלה</div>
    <div class="laptopia-services-grid">
      <?php foreach ( $services as $service ) : ?>
        <a class="laptopia-card laptopia-element-link" href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>">
          <div class="laptopia-service-icon" aria-hidden="true"><?php echo str_replace( '<svg ', '<svg width="22" height="22" focusable="false" ', laptopia_get_icon_svg( $service['slug'] ) ); ?></div>
          <h3><?php echo laptopia_bidi_text( $service['home_label'] ); ?></h3>
          <p><?php echo laptopia_bidi_text( $service['home_description'] ); ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
