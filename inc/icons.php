<?php
/** Shared SVG source for service icons and page favicons. */
function laptopia_get_icon_svg( $key ) {
    if ( 'brand-mark' === $key ) {
        return file_get_contents( get_stylesheet_directory() . '/assets/icons/brand-mark.svg' );
    }
    $icons = array(
        'charging' => '<rect x="4" y="7" width="16" height="10" rx="3"/><path d="M8 11h8m-8 2h8M8 4v3m8-3v3M8 17v3m8-3v3"/>',
        'hinge' => '<path d="M4 5h7v14H4zM13 5h7v14h-7zM11 8h2m-2 8h2M7 9h.01M7 15h.01M17 9h.01M17 15h.01"/>',
        'software' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 8h18m-10 4-3 2 3 2m3-4 3 2-3 2"/>',
        'diagnostics' => '<circle cx="10" cy="10" r="6"/><path d="m14 14 6 6M7 10h6m-3-3v6"/>',
        'motherboard-repair' => '<rect x="6" y="6" width="12" height="12" rx="2"/><rect x="9" y="9" width="6" height="6" rx="1"/><path d="M9 3v3m6-3v3M9 18v3m6-3v3M3 9h3m-3 6h3m12-6h3m-3 6h3"/>',
        'screen-replacement' => '<rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4"/>',
        'battery-replacement' => '<rect x="2" y="6" width="18" height="12" rx="2"/><path d="M22 10v4M6 12h4m-2-2v4m6-2h3"/>',
        'cooling-cleaning' => '<circle cx="12" cy="12" r="2"/><path d="M10 10C5 5 11 1 14 4c2 2 0 5-1 6m1 0c5-5 9 1 6 4-2 2-5 0-6-1m0 1c5 5-1 9-4 6-2-2 0-5 1-6m-1 0c-5 5-9-1-6-4 2-2 5 0 6 1"/>',
        'keyboard-replacement' => '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M6 12h.01M10 12h.01M14 12h.01M18 12h.01M7 15h10"/>',
    );
    if ( ! isset( $icons[ $key ] ) ) {
        return '';
    }
    return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">' . $icons[ $key ] . '</svg>';
}
