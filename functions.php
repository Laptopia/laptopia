<?php

require_once get_stylesheet_directory() . '/inc/services.php';

add_action( 'wp_head', function() {
    // WordPress owns favicon output whenever a Site Icon has been configured.
    if ( has_site_icon() ) {
        return;
    }
    $icon_url = get_stylesheet_directory_uri() . '/assets/icons/';
    ?>
    <link rel="icon" href="<?php echo esc_url( $icon_url . 'brand-mark.svg' ); ?>" type="image/svg+xml" sizes="any">
    <link rel="icon" href="<?php echo esc_url( $icon_url . 'favicon-32.png' ); ?>" type="image/png" sizes="32x32">
    <link rel="icon" href="<?php echo esc_url( $icon_url . 'site-icon-192.png' ); ?>" type="image/png" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo esc_url( $icon_url . 'apple-touch-icon-180.png' ); ?>" sizes="180x180">
    <?php
}, 99 );

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
