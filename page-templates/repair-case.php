<?php
/**
 * Template Name: Laptopia - תיקון אמיתי מהמעבדה
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;
$case = laptopia_get_repair_case( get_post_field( 'post_name', get_queried_object_id() ) );
if ( ! $case ) {
    status_header( 404 );
    nocache_headers();
    $not_found = get_404_template();
    if ( $not_found ) {
        include $not_found;
    } else {
        wp_die( 'התיקון המבוקש לא נמצא.', '404', array( 'response' => 404 ) );
    }
    return;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'laptopia-service-page laptopia-repair-case-page' ); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/header', null, array( 'nav_links' => array(
    array( 'href' => home_url( '/' ), 'label' => 'דף הבית' ),
    array( 'href' => home_url( '/repairs/' ), 'label' => 'תיקונים מהמעבדה' ),
    array( 'href' => '#contact', 'label' => 'יצירת קשר' ),
) ) ); ?>
<?php get_template_part( 'template-parts/repair-case-content', null, array( 'case' => $case ) ); ?>
<?php get_template_part( 'template-parts/footer' ); ?>
<?php get_template_part( 'template-parts/floating-whatsapp' ); ?>
<?php wp_footer(); ?>
</body>
</html>
