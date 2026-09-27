<?php
/** Local Lucide UI glyphs. Existing service and approved brand icons remain unchanged. */
function laptopia_ui_icon( $name ) {
    static $cache = array();
    $allowed = array( 'arrow-left', 'wrench', 'map-pin' );
    if ( ! in_array( $name, $allowed, true ) ) {
        return '';
    }

    if ( isset( $cache[ $name ] ) ) {
        return $cache[ $name ];
    }

    $file = get_stylesheet_directory() . '/assets/icons/ui/' . $name . '.svg';
    if ( ! is_readable( $file ) ) {
        return '';
    }

    // Repository-owned, fixed SVG files only; never substitute user input.
    $svg = file_get_contents( $file );
    if ( false === $svg ) {
        return '';
    }
    $cache[ $name ] = (string) preg_replace( '/<svg\b/', '<svg class="laptopia-ui-icon" aria-hidden="true" focusable="false"', $svg, 1 );
    return $cache[ $name ];
}
