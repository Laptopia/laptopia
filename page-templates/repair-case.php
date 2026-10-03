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
get_template_part( 'template-parts/page-shell-start', null, array( 'body_classes' => explode( ' ', 'laptopia-service-page laptopia-repair-case-page' ), 'background_mode' => 'repair-case' ) );
?>
<?php get_template_part( 'template-parts/repair-case-content', null, array( 'case' => $case ) ); ?>
<?php get_template_part( 'template-parts/page-shell-end' ); ?>
