<?php

/**
 * Return escaped text with an isolated left-to-right run.
 */
function laptopia_bidi_ltr( $text ) {
    return '<bdi dir="ltr">' . esc_html( (string) $text ) . '</bdi>';
}

/**
 * Keep a numeric amount and its shekel sign in one left-to-right run.
 */
function laptopia_bidi_price( $amount ) {
    return laptopia_bidi_ltr( $amount );
}

/**
 * Escape mixed copy and isolate Latin terms, percentages and shekel amounts.
 */
function laptopia_bidi_text( $text ) {
    $pattern = '/(\d[\d.,]*\s*₪|\d+(?:[.,]\d+)?%|[A-Za-z]+(?:[-\/]?[A-Za-z]+)*(?:[ ]+[A-Za-z]+(?:[-\/]?[A-Za-z]+)*)*)/u';
    $parts = preg_split( $pattern, (string) $text, -1, PREG_SPLIT_DELIM_CAPTURE );

    if ( false === $parts ) {
        return esc_html( (string) $text );
    }

    $html = '';
    foreach ( $parts as $part ) {
        if ( '' !== $part && preg_match( '/^' . substr( $pattern, 1, -2 ) . '$/u', $part ) ) {
            $html .= laptopia_bidi_ltr( $part );
        } else {
            $html .= esc_html( $part );
        }
    }

    return $html;
}
