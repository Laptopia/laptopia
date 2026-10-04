<?php
/**
 * Template Name: Laptopia - תיקונים מהמעבדה
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;
$cases = laptopia_get_repair_cases();
get_template_part( 'template-parts/page-shell-start', null, array( 'body_classes' => explode( ' ', 'laptopia-service-page laptopia-repairs-page' ), 'background_mode' => 'portfolio' ) );
?>
<main dir="rtl">
  <section class="laptopia-section laptopia-page-foundation laptopia-repairs-intro" aria-labelledby="repairs-title">
    <div class="laptopia-repair-rail">
      <h1 id="repairs-title">תיק עבודות</h1>
      <p class="laptopia-presentation-lead">תיעוד תיקונים אמיתיים במעבדה שלנו. בכל מקרה מתועדים הנזק או תלונת הלקוח, שלבי העבודה והתוצאה הסופית. המחיר שמופיע בתיקונים מותאם לפי סוג המחשב ומורכבות העבודה ועלות החלקים. כל מחשב מקבל מחיר מותאם אישית.</p>
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
<?php get_template_part( 'template-parts/page-shell-end' ); ?>
