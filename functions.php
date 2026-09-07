<?php

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'hello-elementor-parent',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'laptopia-child',
        get_stylesheet_uri(),
        array( 'hello-elementor-parent' ),
        wp_get_theme()->get( 'Version' )
    );
} );
