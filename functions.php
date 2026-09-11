<?php

require_once get_stylesheet_directory() . '/inc/services.php';

add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
} );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'laptopia-child',
        get_stylesheet_directory_uri() . '/assets/css/laptopia.css',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/css/laptopia.css' )
    );
    wp_enqueue_script(
        'laptopia-navigation',
        get_stylesheet_directory_uri() . '/assets/js/navigation.js',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/js/navigation.js' ),
        true
    );
} );
