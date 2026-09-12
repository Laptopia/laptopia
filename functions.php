<?php

require_once get_stylesheet_directory() . '/inc/services.php';
require_once get_stylesheet_directory() . '/inc/icons.php';

function laptopia_background_mode() {
    if ( is_page_template( 'page-templates/home-laptopia.php' ) ) {
        return 'network';
    }
    return is_page_template( 'page-templates/motherboard-repair.php' ) ? 'pcb' : '';
}

add_action( 'wp_head', function() {
    $key = 'brand-mark';
    if ( ! is_front_page() ) {
        foreach ( laptopia_get_services() as $service ) {
            if ( is_page( $service['slug'] ) ) {
                $key = $service['slug'];
                break;
            }
        }
    }
    $icon_url = get_stylesheet_directory_uri() . '/assets/icons/';
    // Data URIs use esc_attr(): esc_url() would remove the data scheme.
    $favicon = 'brand-mark' === $key
        ? $icon_url . 'brand-mark.svg'
        : 'data:image/svg+xml;base64,' . base64_encode( str_replace( 'currentColor', '#28313b', laptopia_get_icon_svg( $key ) ) );
    ?>
    <link rel="icon" href="<?php echo esc_attr( $favicon ); ?>" type="image/svg+xml" sizes="any">
    <?php if ( 'brand-mark' === $key ) : ?>
    <link rel="icon" href="<?php echo esc_url( $icon_url . 'favicon-32.png' ); ?>" type="image/png" sizes="32x32">
    <link rel="icon" href="<?php echo esc_url( $icon_url . 'site-icon-192.png' ); ?>" type="image/png" sizes="192x192">
    <?php endif; ?>
    <link rel="apple-touch-icon" href="<?php echo esc_url( $icon_url . 'apple-touch-icon-180.png' ); ?>" sizes="180x180">
    <?php
}, 99 );

add_action( 'after_setup_theme', function() {
    // Only replace public-page Site Icon links; admin/login hooks stay intact.
    remove_action( 'wp_head', 'wp_site_icon', 99 );
    add_theme_support( 'title-tag' );
} );

add_action( 'wp_enqueue_scripts', function() {
    if ( '' !== laptopia_background_mode() ) {
        wp_enqueue_script(
            'laptopia-background',
            get_stylesheet_directory_uri() . '/assets/js/background/engine.js',
            array(),
            filemtime( get_stylesheet_directory() . '/assets/js/background/engine.js' ),
            true
        );
    }
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
