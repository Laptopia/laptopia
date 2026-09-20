<?php
// Use only for display headings/labels; ordinary body copy remains untouched.
$brand_parts = explode( 'Laptopia', (string) ( $args['text'] ?? '' ) );
foreach ( $brand_parts as $brand_index => $brand_part ) {
    $has_wordmark_after = $brand_index < count( $brand_parts ) - 1;
    if ( $has_wordmark_after && preg_match( '/^(.*?)([בומכלש][־-])$/us', $brand_part, $matches ) ) {
        echo laptopia_bidi_text( $matches[1] );
        ?><span class="laptopia-bidi-phrase"><?php echo esc_html( $matches[2] ); ?><?php get_template_part( 'template-parts/brand-wordmark' ); ?></span><?php
    } else {
        echo laptopia_bidi_text( $brand_part );
        if ( $has_wordmark_after ) {
            get_template_part( 'template-parts/brand-wordmark' );
        }
    }
}
