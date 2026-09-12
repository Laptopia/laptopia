<?php
// Use only for display headings/labels; ordinary body copy remains untouched.
$brand_parts = explode( 'Laptopia', (string) ( $args['text'] ?? '' ) );
foreach ( $brand_parts as $brand_index => $brand_part ) {
    if ( $brand_index > 0 ) {
        get_template_part( 'template-parts/brand-wordmark' );
    }
    echo esc_html( $brand_part );
}
