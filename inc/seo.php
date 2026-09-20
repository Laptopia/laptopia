<?php

// One scope for JSON-LD and Open Graph; unrelated pages/admin remain untouched.
function laptopia_is_business_page() {
    if ( is_admin() || ! is_page() ) {
        return false;
    }

    $templates = array( 'home-laptopia', 'service-areas' );
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
    return $matches;
}

// Filter Rank Math's own graph; never emit a second JSON-LD block.
function laptopia_filter_page_schema( $data ) {
    if ( ! laptopia_is_business_page() ) {
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

    $served_cities = array( 'רמלה', 'לוד', 'באר יעקב', 'ראשון לציון', 'רחובות', 'נס ציונה' );
    foreach ( $data as $key => $entity ) {
        $types = (array) ( $entity['@type'] ?? array() );
        if ( in_array( 'ComputerStore', $types, true ) || in_array( 'LocalBusiness', $types, true ) ) {
            $data[ $key ]['areaServed'] = array_map( static function( $city ) {
                return array(
                    '@type' => 'City',
                    'name'  => $city,
                );
            }, $served_cities );
        }
    }
    return $data;
}

add_filter( 'rank_math/json_ld', 'laptopia_filter_page_schema', 99 );

add_filter( 'rank_math/opengraph/type', static function( $type ) {
    return laptopia_is_business_page() ? 'website' : $type;
}, 99 );

function laptopia_filter_article_date_meta( $value ) {
    return laptopia_is_business_page() ? false : $value;
}

add_filter( 'rank_math/opengraph/facebook/article_published_time', 'laptopia_filter_article_date_meta', 99 );
add_filter( 'rank_math/opengraph/facebook/article_modified_time', 'laptopia_filter_article_date_meta', 99 );
add_filter( 'rank_math/opengraph/facebook/og_updated_time', 'laptopia_filter_article_date_meta', 99 );

function laptopia_is_service_areas_page() {
    return ! is_admin() && is_page_template( 'page-templates/service-areas.php' );
}

add_filter( 'rank_math/frontend/title', static function( $title ) {
    return laptopia_is_service_areas_page()
        ? 'תיקון מחשבים ניידים ברמלה והסביבה | Laptopia'
        : $title;
}, 99 );

add_filter( 'rank_math/frontend/description', static function( $description ) {
    return laptopia_is_service_areas_page()
        ? 'מעבדת Laptopia ברמלה מאפשרת ללקוחות פרטיים לפנות ישירות למהנדס לתיקון מחשבים ניידים ולוחות אם ברמת הרכיב. קבלת מחשבים מרמלה והסביבה בתיאום מראש.'
        : $description;
}, 99 );
