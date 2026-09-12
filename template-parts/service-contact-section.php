<?php
$template = basename( get_page_template_slug() );
$title_ids = array(
  'motherboard-repair.php' => 'contact-title',
  'screen-replacement.php' => 'screen-contact-title',
  'battery-replacement.php' => 'battery-contact-title',
  'cooling-cleaning.php' => 'cooling-contact-title',
  'keyboard-replacement.php' => 'keyboard-contact-title',
);
$title_id = $title_ids[ $template ] ?? 'service-contact-title';
$actions_args = 'motherboard-repair.php' === $template
  ? array( 'services_url' => 'https://laptopia.co.il/#services' )
  : array();
?>
<section class="laptopia-section laptopia-contact laptopia-service-contact" id="contact" aria-labelledby="<?php echo esc_attr( $title_id ); ?>">
  <div class="laptopia-contact-content">
    <h2 id="<?php echo esc_attr( $title_id ); ?>"><?php echo esc_html( $args['heading'] ?? '' ); ?></h2>
    <p class="laptopia-contact-intro"><?php echo esc_html( $args['description'] ?? '' ); ?></p>
    <div class="laptopia-contact-info">
      <div class="laptopia-info-box"><div class="laptopia-info-value">אלמוג 2, רמלה</div></div>
      <div class="laptopia-info-box"><div class="laptopia-info-value"><bdi dir="ltr">053-803-6244</bdi></div></div>
    </div>
    <p class="laptopia-contact-note">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</p>
    <?php get_template_part( 'template-parts/service-contact-actions', null, $actions_args ); ?>
  </div>
</section>
