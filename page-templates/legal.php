<?php
/**
 * Template Name: Laptopia - מסמך משפטי
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;
$background_mode = is_page( 'privacy-policy' ) ? 'privacy' : ( is_page( 'terms' ) ? 'terms' : 'workbench' );
get_template_part( 'template-parts/page-shell-start', null, array( 'body_classes' => array( 'laptopia-legal-page' ), 'background_mode' => $background_mode ) );
get_template_part( 'template-parts/page-content' );
get_template_part( 'template-parts/page-shell-end' );
