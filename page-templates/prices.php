<?php
/**
 * Template Name: Laptopia - מחירון
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;

get_template_part( 'template-parts/page-shell-start', null, array( 'body_classes' => array( 'laptopia-price-page' ), 'background_mode' => 'prices' ) );

$rows = laptopia_price_rows();
?>
<main class="laptopia-price-page-main" dir="rtl">
  <section class="laptopia-section laptopia-page-foundation laptopia-price-page-intro">
    <div class="laptopia-page-container laptopia-page-surface">
      <h1 class="laptopia-section-title">מחירון תיקון מחשבים ניידים</h1>
      <p class="laptopia-presentation-lead">כאן אפשר למצוא את מחירי השירותים הנפוצים במעבדת Laptopia. מחיר שמוצג כ״החל מ-״ הוא מחיר התחלתי; המחיר הסופי תלוי בדגם המחשב, בתקלה ובחלקים הנדרשים ונמסר לאישור לפני ביצוע התיקון.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-price-page-list" aria-label="מחירי שירותים">
    <div class="laptopia-page-container laptopia-price-list-container">
      <h2 class="laptopia-price-list-heading">שירותים ומחירים</h2>
      <div class="laptopia-price-list">
        <?php foreach ( $rows as $key => $row ) : ?>
          <?php if ( ! empty( $row['slug'] ) ) : ?>
            <a class="laptopia-price-row laptopia-price-row-link" href="<?php echo esc_url( home_url( '/' . $row['slug'] . '/' ) ); ?>">
          <?php else : ?>
            <div class="laptopia-price-row laptopia-price-row-static">
          <?php endif; ?>
            <div class="laptopia-price-name laptopia-price-service">
              <?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => $row['icon'] ) ); ?>
              <span><?php echo laptopia_bidi_text( $row['label'] ); ?></span>
            </div>
            <span class="laptopia-price-value"><?php echo laptopia_price_display( $key ); ?></span>
            <?php if ( ! empty( $row['slug'] ) ) : ?>
              <span class="laptopia-price-detail-link" aria-hidden="true"><?php echo laptopia_ui_icon( 'arrow-left' ); ?></span>
            <?php endif; ?>
          <?php if ( ! empty( $row['slug'] ) ) : ?></a><?php else : ?></div><?php endif; ?>
        <?php endforeach; ?>
      </div>
      <p class="laptopia-pricing-explanation">מחירי <bdi dir="ltr">RAM</bdi> ו-<bdi dir="ltr">SSD</bdi> נקבעים לפי הרכיב המתאים והיקף העבודה. הצעת המחיר נמסרת לפני הביצוע; אין מחיר קבוע לשדרוג ללא בדיקת התאמה. <a href="<?php echo esc_url( home_url( '/ram-ssd-windows-upgrade/' ) ); ?>">לפרטי שדרוגים</a></p>
      <p class="laptopia-pricing-explanation">התקנת <bdi dir="ltr">Windows</bdi> מתבצעת באמצעות רישיון קיים של הלקוח. המחיר אינו כולל רכישת רישיון חדש. גיבוי והעברת מידע אינם כלולים במחיר התקנת מערכת ההפעלה ומתומחרים בנפרד, בהתאם להיקף העבודה ולמצב הכונן.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-price-page-conditions">
    <div class="laptopia-page-container laptopia-page-surface laptopia-reading-content">
      <h2 class="laptopia-section-title">אבחון ותנאי המחיר</h2>
      <h3 class="laptopia-concept-heading">דמי אבחון</h3>
      <p>במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון, דמי האבחון הם <?php echo laptopia_price_amount( 'diagnostics' ); ?>. אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p>
      <h3 class="laptopia-concept-heading">אישור המחיר לפני התיקון</h3>
      <p>התיקון מתבצע רק לאחר אישור הלקוח. המחיר הסופי עשוי להשתנות בהתאם לדגם המחשב, לסוג החלק ולמורכבות העבודה.</p>
      <?php get_template_part( 'template-parts/consumer-price-note' ); ?>
      <p class="laptopia-standalone-navigation"><a href="<?php echo esc_url( home_url( '/#warranty' ) ); ?>">למידע על האחריות</a></p>
    </div>
  </section>

  <?php get_template_part( 'template-parts/contact', null, array(
    'heading' => 'רוצים לברר מחיר למחשב שלכם?',
    'description' => 'שלחו את דגם המחשב ותיאור התקלה או התקשרו לתיאום מסירת המחשב במעבדה.',
    'tone' => 'light',
    'show_info' => false,
    'show_service_area' => false,
    'appointment' => '',
    'action_order' => array( 'whatsapp', 'phone' ),
  ) ); ?>
</main>
<?php get_template_part( 'template-parts/page-shell-end' ); ?>
