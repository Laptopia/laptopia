<?php

// Filter Rank Math's own graph; never emit a second JSON-LD block.
function laptopia_filter_page_schema( $data ) {
    if ( is_admin() || ! is_page() ) {
        return $data;
    }

    $templates = array( 'home-laptopia' );
    foreach ( laptopia_get_services() as $service ) {
        $templates[] = $service['slug'];
    }
    $matches = false;
    foreach ( $templates as $template ) {
        if ( is_page_template( 'page-templates/' . $template . '.php' ) ) {
            $matches = true;
            break;
        }
    }
    if ( ! $matches ) {
        return $data;
    }

    $author_ids = array();
    foreach ( $data as $key => $entity ) {
        $types = (array) ( $entity['@type'] ?? array() );
        if ( array_intersect( $types, array( 'Article', 'BlogPosting', 'NewsArticle' ) ) ) {
            if ( ! empty( $entity['author']['@id'] ) ) {
                $author_ids[] = $entity['author']['@id'];
            }
            unset( $data[ $key ] );
        }
    }

    // Remove only orphan authors of the removed articles. Preserve business people.
    foreach ( $data as $key => $entity ) {
        if ( ! in_array( 'Person', (array) ( $entity['@type'] ?? array() ), true )
            || ! in_array( $entity['@id'] ?? '', $author_ids, true ) ) {
            continue;
        }
        $remaining = $data;
        unset( $remaining[ $key ] );
        $referenced = false;
        array_walk_recursive( $remaining, static function( $value, $property ) use ( &$referenced, $entity ) {
            if ( '@id' === $property && $value === $entity['@id'] ) {
                $referenced = true;
            }
        } );
        if ( ! $referenced ) {
            unset( $data[ $key ] );
        }
    }
    return $data;
}

add_filter( 'rank_math/json_ld', 'laptopia_filter_page_schema', 99 );
