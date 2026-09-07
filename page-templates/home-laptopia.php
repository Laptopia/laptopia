<?php
/**
 * Template Name: Laptopia - דף הבית
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/services' );
get_template_part( 'template-parts/board-repair' );
get_template_part( 'template-parts/process' );
get_template_part( 'template-parts/prices' );
get_template_part( 'template-parts/warranty' );
get_template_part( 'template-parts/reviews-heading' );

echo do_shortcode( '[trustindex no-registration=google]' );

get_template_part( 'template-parts/contact' );
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );

get_footer();
