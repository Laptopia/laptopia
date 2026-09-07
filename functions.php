<?php

add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
} );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'hello-elementor-parent',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'laptopia-child',
        get_stylesheet_directory_uri() . '/assets/css/laptopia.css',
        array( 'hello-elementor-parent' ),
        wp_get_theme()->get( 'Version' )
    );
} );
