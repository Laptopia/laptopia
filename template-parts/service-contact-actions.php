<?php
$services_url = $args['services_url'] ?? home_url( '/#services' );
?>
<div class="laptopia-buttons laptopia-contact-actions laptopia-service-contact-actions">
  <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>שלחו הודעה בוואטסאפ</span></span></a>
  <a class="laptopia-btn laptopia-btn-white" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
  <a class="laptopia-btn laptopia-btn-google-maps" href="https://maps.app.goo.gl/142XHnrHZfT4tYYQA" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'google-maps' ) ); ?><span>ניווט ב-<bdi dir="ltr">Google Maps</bdi></span></span></a>
  <a class="laptopia-btn laptopia-btn-waze" href="https://ul.waze.com/ul?venue_id=22872383.228592761.149507&amp;overview=yes&amp;utm_campaign=default&amp;utm_source=waze_website&amp;utm_medium=lm_share_location" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'waze' ) ); ?><span>ניווט ב-<bdi dir="ltr">Waze</bdi></span></span></a>
  <a class="laptopia-btn laptopia-btn-white" href="<?php echo esc_url( $services_url ); ?>">לכל שירותי המעבדה</a>
</div>
