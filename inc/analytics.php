<?php

add_action( 'wp_head', static function() {
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PPF91TL92V"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-PPF91TL92V', {
        page_location: window.location.origin + window.location.pathname
    });
    </script>
    <?php
}, 1 );

add_action( 'wp_enqueue_scripts', static function() {
    wp_enqueue_script(
        'laptopia-lead-events',
        get_stylesheet_directory_uri() . '/assets/js/lead-events.js',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/js/lead-events.js' ),
        true
    );
} );
