<?php
/** Homepage Places UI Kit configuration; no server-side Places requests. */
defined( 'ABSPATH' ) || exit;

function laptopia_google_reviews_browser_key() {
    static $key = null;
    if ( null !== $key ) {
        return $key;
    }
    $key = '';
    $override = getenv( 'LAPTOPIA_PLACES_UI_KIT_BROWSER_KEY_FILE' );
    $path = is_string( $override ) && '' !== $override
        ? $override : '/home/laptlmbb/private/laptopia-google/places-ui-kit-browser-key';
    if ( ! @is_readable( $path ) || ! @is_file( $path ) ) {
        return $key;
    }
    $contents = @file_get_contents( $path, false, null, 0, 256 );
    if ( is_string( $contents ) ) {
        $candidate = trim( $contents );
        if ( preg_match( '/^[A-Za-z0-9_-]{20,200}$/D', $candidate ) ) {
            $key = $candidate;
        }
    }
    return $key;
}

function laptopia_google_reviews_place_id() {
    return 'ChIJpStaxbbLAhURymvH_daEGlo';
}

function laptopia_google_reviews_enqueue() {
    if ( ! is_page_template( 'page-templates/home-laptopia.php' ) ) {
        return;
    }
    $key = laptopia_google_reviews_browser_key();
    if ( '' === $key ) {
        return;
    }
    wp_enqueue_script(
        'laptopia-google-reviews',
        get_stylesheet_directory_uri() . '/assets/js/google-reviews.js',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/js/google-reviews.js' ),
        true
    );
    // Browser key is intentionally public at runtime; never include the file path.
    wp_add_inline_script(
        'laptopia-google-reviews',
        'window.laptopiaPlacesUiConfig = ' . wp_json_encode(
            array( 'key' => $key, 'v' => 'weekly', 'language' => 'he', 'region' => 'IL' ),
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        ) . ';',
        'before'
    );
}
add_action( 'wp_enqueue_scripts', 'laptopia_google_reviews_enqueue' );
