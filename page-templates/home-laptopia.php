<?php
/**
 * Template Name: Laptopia - דף הבית
 */

defined( 'ABSPATH' ) || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-laptopia-background="<?php echo esc_attr( laptopia_background_mode() ); ?>">
  <?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/header' );
echo '<main>';
get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/services' );
get_template_part( 'template-parts/prices' );
get_template_part( 'template-parts/board-repair' );
get_template_part( 'template-parts/process' );
get_template_part( 'template-parts/warranty' );
get_template_part( 'template-parts/service-areas-summary' );
$google_reviews_enabled = '' !== laptopia_google_reviews_browser_key();
echo '<div data-google-reviews-shell data-google-reviews-state="' . ( $google_reviews_enabled ? 'loading' : 'fallback' ) . '" aria-busy="' . ( $google_reviews_enabled ? 'true' : 'false' ) . '">';
if ( $google_reviews_enabled ) {
    echo '<div class="laptopia-reviews-loading" role="status"><span>טוענים ביקורות…</span><div class="laptopia-reviews-skeleton" aria-hidden="true"><i></i><i></i><i></i></div></div>';
    echo '<noscript><style>[data-google-reviews-shell] .laptopia-reviews-loading{display:none}[data-google-reviews-shell][data-google-reviews-state="loading"] [data-google-reviews-fallback]{display:block}</style></noscript>';
}
echo '<div data-google-reviews-fallback>';
get_template_part( 'template-parts/reviews-heading' );
echo '<div class="laptopia-reviews-rail">';
echo do_shortcode( '[trustindex no-registration=google]' );
echo '</div>';
get_template_part( 'template-parts/reviews-source-links' );
echo '</div>';
echo '<div data-google-reviews-official hidden>';
get_template_part( 'template-parts/google-reviews' );
echo '</div></div>';

get_template_part( 'template-parts/contact', null, array(
  'show_hours' => true,
  'show_info_labels' => true,
  'show_service_area' => false,
  'notice_first' => true,
  'appointment' => 'הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד',
  'address' => 'רחוב אלמוג 2, רמלה',
  'action_order' => array( 'whatsapp', 'phone', 'google-maps', 'waze' ),
) );
echo '</main>';
get_footer();
