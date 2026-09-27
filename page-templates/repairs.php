<?php
/**
 * Template Name: Laptopia - תיקונים מהמעבדה
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;
$cases = laptopia_get_repair_cases();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'laptopia-service-page laptopia-repairs-page' ); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/header', null, array( 'nav_links' => array(
    array( 'href' => home_url( '/' ), 'label' => 'דף הבית' ),
    array( 'href' => home_url( '/service-areas/' ), 'label' => 'על המעבדה' ),
    array( 'href' => '#contact', 'label' => 'יצירת קשר' ),
) ) ); ?>
<main dir="rtl">
  <section class="laptopia-section laptopia-repairs-intro" aria-labelledby="repairs-title">
    <div class="laptopia-repair-rail">
      <p class="laptopia-repair-eyebrow">מהעבודה במעבדה</p>
      <h1 id="repairs-title">תיקונים מהמעבדה</h1>
      <p>מקרים אמיתיים של תיקון מחשבים ניידים במעבדת Laptopia ברמלה. בכל מקרה מוצגים הנזק שנמצא, העבודה שנעשתה והתוצאה. המחיר המתואר שייך למחשב המסוים; מחיר של מחשב אחר נקבע לאחר בדיקה.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-repairs-list" aria-label="מקרי תיקון">
    <div class="laptopia-repair-list-grid">
      <?php foreach ( $cases as $case ) : ?>
        <?php if ( laptopia_published_repair_page( $case['slug'] ) ) : ?>
          <?php get_template_part( 'template-parts/repair-card', null, array( 'case' => $case, 'heading_level' => 2 ) ); ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array( 'heading' => 'רוצים לתאם בדיקה?', 'description' => 'שלחו את דגם המחשב ותיאור התקלה, ונתאם מסירה במעבדה ברמלה.' ) ); ?>
</main>
<?php get_template_part( 'template-parts/footer' ); ?>
<?php get_template_part( 'template-parts/floating-whatsapp' ); ?>
<?php wp_footer(); ?>
</body>
</html>
