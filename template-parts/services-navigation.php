<details class="laptopia-services-dropdown" dir="rtl">
  <summary class="laptopia-services-toggle" aria-controls="laptopia-services-panel" aria-expanded="false">
    <svg class="laptopia-services-menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    שירותים
    <svg class="laptopia-services-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6"/></svg>
  </summary>
  <nav class="laptopia-services-panel" id="laptopia-services-panel" aria-label="שירותי המעבדה">
    <?php foreach ( laptopia_get_services() as $service ) : ?>
      <a href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>"<?php if ( is_page( $service['slug'] ) ) : ?> aria-current="page"<?php endif; ?>>
        <?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => $service['slug'] ) ); ?>
        <span><?php echo esc_html( $service['short_label'] ); ?></span>
      </a>
    <?php endforeach; ?>
    <a class="laptopia-services-all" href="<?php echo esc_url( home_url( '/#services' ) ); ?>">כל שירותי המעבדה</a>
  </nav>
</details>
