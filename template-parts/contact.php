<?php
/** Canonical contact/pre-footer. Options change content, never page-specific geometry. */
defined( 'ABSPATH' ) || exit;
$options = wp_parse_args( $args ?? array(), array(
  'heading' => 'יצירת קשר',
  'description' => 'שלחו לנו הודעה בוואטסאפ עם דגם המחשב ותיאור התקלה. ניתן לצרף תמונה כדי שנוכל להבין טוב יותר במה מדובר.',
  'title_id' => 'service-contact-title',
  'show_info' => true,
  'show_info_labels' => false,
  'show_hours' => false,
  'show_service_area' => true,
  'appointment' => 'הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.',
  'notice_first' => false,
  'address' => 'אלמוג 2, רמלה',
  'action_order' => array( 'phone', 'whatsapp', 'waze', 'google-maps' ),
  'tone' => 'dark',
) );
$is_light = 'light' === $options['tone'];
?>
<section class="laptopia-section laptopia-contact<?php echo $is_light ? ' laptopia-contact-inquiry' : ' laptopia-service-contact'; ?>" id="contact" aria-labelledby="<?php echo esc_attr( $options['title_id'] ); ?>">
  <div class="laptopia-contact-content">
    <h2 id="<?php echo esc_attr( $options['title_id'] ); ?>"><?php get_template_part( 'template-parts/brand-text', null, array( 'text' => $options['heading'] ) ); ?></h2>
    <p class="laptopia-contact-intro"><?php echo laptopia_bidi_text( $options['description'] ); ?></p>
    <?php if ( $options['notice_first'] && $options['appointment'] ) : ?>
      <div class="laptopia-contact-note"><?php echo esc_html( $options['appointment'] ); ?></div>
    <?php endif; ?>
    <?php if ( $options['show_info'] ) : ?>
      <div class="laptopia-contact-info">
        <div class="laptopia-info-box">
          <?php if ( $options['show_info_labels'] ) : ?><div class="laptopia-info-title">כתובת</div><?php endif; ?>
          <div class="laptopia-info-value"><?php echo esc_html( $options['address'] ); ?></div>
        </div>
        <div class="laptopia-info-box">
          <?php if ( $options['show_info_labels'] ) : ?><div class="laptopia-info-title">טלפון</div><?php endif; ?>
          <div class="laptopia-info-value"><bdi dir="ltr">053-803-6244</bdi></div>
        </div>
      </div>
    <?php endif; ?>
    <?php if ( ! $options['notice_first'] && $options['appointment'] ) : ?>
      <p class="laptopia-contact-note"><?php echo esc_html( $options['appointment'] ); ?></p>
    <?php endif; ?>
    <?php if ( $options['show_service_area'] ) : ?>
      <p class="laptopia-contact-navigation"><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">אזורי שירות והגעה למעבדה</a></p>
    <?php endif; ?>
    <?php if ( $options['show_hours'] ) : ?>
    <div class="laptopia-hours">

      <div class="laptopia-hours-row">
        <span>ראשון</span>
        <strong><bdi dir="ltr">07:00–09:00</bdi><br><bdi dir="ltr">18:00–23:00</bdi></strong>
      </div>

      <div class="laptopia-hours-row">
        <span>שני</span>
        <strong><bdi dir="ltr">07:00–09:00</bdi><br><bdi dir="ltr">18:00–23:00</bdi></strong>
      </div>

      <div class="laptopia-hours-row">
        <span>שלישי</span>
        <strong><bdi dir="ltr">07:00–09:00</bdi><br><bdi dir="ltr">18:00–23:00</bdi></strong>
      </div>

      <div class="laptopia-hours-row">
        <span>רביעי</span>
        <strong><bdi dir="ltr">07:00–09:00</bdi><br><bdi dir="ltr">18:00–23:00</bdi></strong>
      </div>

      <div class="laptopia-hours-row">
        <span>חמישי</span>
        <strong><bdi dir="ltr">07:00–09:00</bdi><br><bdi dir="ltr">18:00–23:00</bdi></strong>
      </div>

      <div class="laptopia-hours-row">
        <span>שישי</span>
        <strong><bdi dir="ltr">09:00–15:00</bdi></strong>
      </div>

      <div class="laptopia-hours-row">
        <span>שבת</span>
        <strong><bdi dir="ltr">19:30–23:00</bdi></strong>
      </div>

    </div>

    <p class="laptopia-contact-hours-note">
      בשבתות ובחגים שעות הפעילות עשויות להשתנות
    </p>

    <p class="laptopia-contact-hours-note">שעות הפעילות המעודכנות החל מ־06.10.2026. קבלת מחשבים בתיאום מראש בלבד.</p>
    <p class="laptopia-contact-hours-note">במקרים דחופים ניתן לשלוח הודעה ב-<bdi dir="ltr">WhatsApp</bdi>; נחזור אליכם כשנתפנה.</p>

    <?php endif; ?>
    <?php get_template_part( 'template-parts/service-contact-actions', null, array( 'order' => $options['action_order'], 'light' => $is_light ) ); ?>
  </div>
</section>
