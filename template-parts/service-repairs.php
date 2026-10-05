<?php
/** Reusable related repairs section for a service path. */
$cases = laptopia_get_published_repair_cases_for_service( $args['service_path'] ?? '', 3 );
if ( ! $cases ) {
    return;
}
$listing = laptopia_published_repair_page();
?>
<section class="laptopia-section laptopia-repair-related laptopia-service-repairs" aria-labelledby="service-repairs-title">
  <div class="laptopia-repair-rail">
    <h2 id="service-repairs-title">תיקונים אמיתיים מהמעבדה</h2>
    <div class="laptopia-service-repairs-grid">
      <?php foreach ( $cases as $case ) : ?>
        <?php get_template_part( 'template-parts/repair-card', null, array( 'case' => $case, 'url' => $case['url'], 'compact' => true ) ); ?>
      <?php endforeach; ?>
    </div>
    <?php if ( $listing ) : ?>
      <div class="laptopia-service-repairs-footer">
        <a class="laptopia-repair-text-link" href="<?php echo esc_url( get_permalink( $listing ) ); ?>">לכל התיקונים <?php echo laptopia_ui_icon( 'arrow-left' ); ?></a>
      </div>
    <?php endif; ?>
  </div>
</section>
