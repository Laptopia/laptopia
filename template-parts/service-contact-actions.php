<?php
/** One action source for the shared contact component. */
defined( 'ABSPATH' ) || exit;
$actions = array(
  'phone' => array( 'url' => 'tel:+972538036244', 'class' => ! empty( $args['light'] ) ? 'laptopia-btn-dark' : 'laptopia-btn-white', 'label' => 'התקשרו למעבדה', 'external' => false ),
  'whatsapp' => array( 'url' => 'https://wa.me/972538036244', 'class' => 'laptopia-btn-whatsapp', 'label' => 'שלחו הודעה ב-WhatsApp', 'external' => true ),
  'waze' => array( 'url' => 'https://ul.waze.com/ul?venue_id=22872383.228592761.149507&overview=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location', 'class' => 'laptopia-btn-waze', 'label' => 'ניווט ב-Waze', 'external' => true ),
  'google-maps' => array( 'url' => 'https://maps.app.goo.gl/142XHnrHZfT4tYYQA', 'class' => 'laptopia-btn-google-maps', 'label' => 'ניווט ב-Google Maps', 'external' => true ),
);
$order = $args['order'] ?? array( 'phone', 'whatsapp', 'waze', 'google-maps' );
?>
<div class="laptopia-buttons laptopia-contact-actions laptopia-service-contact-actions">
  <?php foreach ( $order as $type ) : ?>
    <?php if ( ! isset( $actions[ $type ] ) ) { continue; } $action = $actions[ $type ]; ?>
    <a class="laptopia-btn <?php echo esc_attr( $action['class'] ); ?>" data-analytics-placement="contact"<?php if ( in_array( $type, array( 'waze', 'google-maps' ), true ) ) : ?> data-analytics-event="directions_click" data-analytics-provider="<?php echo esc_attr( 'waze' === $type ? 'waze' : 'google_maps' ); ?>"<?php endif; ?> href="<?php echo esc_url( $action['url'] ); ?>"<?php if ( $action['external'] ) : ?> target="_blank" rel="noopener"<?php endif; ?>>
      <span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => $type ) ); ?><span><?php echo laptopia_bidi_text( $action['label'] ); ?></span></span>
    </a>
  <?php endforeach; ?>
</div>
