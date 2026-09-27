<?php

// One scope for JSON-LD and Open Graph; unrelated pages/admin remain untouched.
function laptopia_is_business_page() {
    if ( is_admin() || ! is_page() ) {
        return false;
    }

    $templates = array( 'home-laptopia', 'service-areas', 'repairs', 'repair-case' );
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

function laptopia_repair_seo() {
    if ( is_admin() ) {
        return null;
    }
    if ( is_page_template( 'page-templates/repairs.php' ) ) {
        return array(
            'title' => 'תיקונים אמיתיים מהמעבדה | Laptopia',
            'description' => 'מקרים אמיתיים של תיקון מחשבים ניידים במעבדת Laptopia ברמלה: הבעיה שנמצאה, העבודה שנעשתה והתוצאה. המחיר בכל מקרה מתייחס לאותו מחשב בלבד.',
        );
    }
    if ( is_page_template( 'page-templates/repair-case.php' ) ) {
        $case = laptopia_get_repair_case( get_post_field( 'post_name', get_queried_object_id() ) );
        return $case ? array(
            'title' => $case['seo_title'],
            'description' => $case['seo_description'],
            'image' => $case['images']['finished']['src'],
        ) : null;
    }
    return null;
}

add_filter( 'rank_math/frontend/title', static function( $title ) {
    $repair = laptopia_repair_seo();
    if ( $repair ) {
        return $repair['title'];
    }
    return laptopia_is_service_areas_page()
        ? 'תיקון מחשבים ניידים ברמלה והסביבה | Laptopia'
        : $title;
}, 99 );

add_filter( 'rank_math/frontend/description', static function( $description ) {
    $repair = laptopia_repair_seo();
    if ( $repair ) {
        return $repair['description'];
    }
    return laptopia_is_service_areas_page()
        ? 'מעבדת Laptopia ברמלה מאפשרת ללקוחות פרטיים לפנות ישירות למהנדס לתיקון מחשבים ניידים ולוחות אם ברמת הרכיב. קבלת מחשבים מרמלה והסביבה בתיאום מראש.'
        : $description;
}, 99 );

add_filter( 'rank_math/frontend/canonical', static function( $canonical ) {
    return laptopia_repair_seo() ? set_url_scheme( get_permalink( get_queried_object_id() ), 'https' ) : $canonical;
}, 99 );

foreach ( array( 'facebook', 'twitter' ) as $network ) {
    add_filter( 'rank_math/opengraph/' . $network . '/og_title', static function( $title ) {
        $repair = laptopia_repair_seo();
        return $repair ? $repair['title'] : $title;
    }, 99 );
    add_filter( 'rank_math/opengraph/' . $network . '/og_description', static function( $description ) {
        $repair = laptopia_repair_seo();
        return $repair ? $repair['description'] : $description;
    }, 99 );
    add_filter( 'rank_math/opengraph/' . $network . '/image', static function( $image ) {
        $repair = laptopia_repair_seo();
        return $repair['image'] ?? $image;
    }, 99 );
}
