<?php
/**
 * Factual public repair cases. Add one data entry and one child WordPress Page
 * under /repairs/ using page-templates/repair-case.php for each new case.
 * The listing and related links remain hidden until their Pages are published.
 */
function laptopia_get_repair_cases() {
    $media = 'https://laptopia.co.il/wp-content/uploads/2026/09/';

    return array(
        'asus-tuf-f15-hinge-repair' => array(
            'slug' => 'asus-tuf-f15-hinge-repair',
            'model' => 'ASUS TUF Gaming F15',
            'category' => 'צירים ופלסטיקה',
            'service_path' => '/hinges-plastics-repair/',
            'heading' => 'תיקון צירים במחשב ASUS TUF Gaming F15',
            'intro' => 'שחזור נקודות העיגון של הצירים לאחר שהמארז נפתח באזור החיבור בעת פתיחת המסך.',
            'card_problem' => 'נקודות העיגון של הצירים נעקרו ממקומן.',
            'card_title' => 'תיקון צירים',
            'card_description' => 'שחזור נקודות עיגון שנעקרו מהמארז באזור הצירים.',
            'problem' => 'המחשב הגיע למעבדה לאחר שקיבוע הצירים נפגע. בעת פתיחת המסך המארז היה נפתח באזור הצירים.',
            'diagnosis' => 'לאחר פירוק המחשב התברר שנקודות העיגון של הצירים נעקרו ממקומן ביחידת המקלדת והמארז העליון. הבעיה הייתה במושבי החיבור שנשברו.',
            'repair' => 'נקודות העיגון שוחזרו באמצעות תושבות הברגה חדשות וארוכות יותר מפליז, ברגים ארוכים מתאימים וחיזוק באפוקסי. לאחר מכן המחשב הורכב מחדש.',
            'result' => 'לאחר ההרכבה נבדקה פתיחה וסגירה תקינה של המסך.',
            'price' => '550₪',
            'warranty' => '3 חודשים',
            'warranty_exclusion' => 'האחריות אינה כוללת נזק פיזי או נזקי נוזלים שנגרמו לאחר התיקון.',
            'disclaimer' => 'זהו תיעוד של תיקון מסוים. מחיר, שיטת תיקון ואפשרות התיקון במחשב אחר נקבעים רק לאחר אבחון.',
            'seo_title' => 'תיקון צירים ב-ASUS TUF Gaming F15 | תיקון אמיתי מהמעבדה | Laptopia',
            'seo_description' => 'תיקון אמיתי של ASUS TUF Gaming F15 במעבדת Laptopia ברמלה: שחזור נקודות עיגון הצירים שנעקרו, הרכבה ובדיקת פתיחה וסגירה. מחיר המקרה 550₪.',
            'images' => array(
                'finished' => array( 'src' => $media . 'clean_full_open.jpg', 'alt' => 'מחשב ASUS TUF Gaming F15 לאחר תיקון הצירים', 'width' => 1215, 'height' => 911, 'caption' => 'המחשב לאחר ההרכבה' ),
                'opened' => array( 'src' => $media . 'hinge_damage_full-rotated.jpg', 'alt' => 'ASUS TUF Gaming F15 פתוח לפני תיקון נקודות העיגון של הצירים', 'width' => 911, 'height' => 683, 'caption' => 'המחשב לאחר פתיחה, לפני שחזור נקודות העיגון' ),
                'damage' => array(
                    array( 'src' => $media . 'hinge_damage_left-rotated.jpg', 'alt' => 'אזור עיגון ציר שבור במחשב ASUS TUF Gaming F15', 'width' => 911, 'height' => 683, 'caption' => 'אזור עיגון פגוע' ),
                    array( 'src' => $media . 'hinge_damage_right-rotated.jpg', 'alt' => 'אזור העיגון הפגוע בציר השני במחשב ASUS TUF Gaming F15', 'width' => 911, 'height' => 683, 'caption' => 'אזור העיגון בציר השני' ),
                    array( 'src' => $media . 'hinge_damage_screw-rotated.jpg', 'alt' => 'תושבות ההברגה שנעקרו ממארז המחשב באזור הצירים', 'width' => 911, 'height' => 683, 'caption' => 'תושבות ההברגה שנעקרו' ),
                ),
                'repaired' => array( 'src' => $media . 'hinge_repair_full-rotated.jpg', 'alt' => 'ASUS TUF Gaming F15 לאחר שחזור נקודות העיגון של הצירים', 'width' => 911, 'height' => 683, 'caption' => 'שני אזורי הצירים לאחר שחזור נקודות העיגון' ),
                'repair_details' => array(
                    array( 'src' => $media . 'hinge_repair_left-rotated.jpg', 'alt' => 'אזור ציר לאחר שחזור נקודות העיגון וחיזוק באפוקסי', 'width' => 911, 'height' => 683, 'caption' => 'פרט מאזור התיקון' ),
                    array( 'src' => $media . 'hinge_repair_right-rotated.jpg', 'alt' => 'הציר השני לאחר שחזור נקודות העיגון וחיזוק באפוקסי', 'width' => 911, 'height' => 683, 'caption' => 'פרט מהציר השני' ),
                ),
            ),
        ),
    );
}

function laptopia_get_repair_case( $slug ) {
    $cases = laptopia_get_repair_cases();
    return $cases[ $slug ] ?? null;
}

function laptopia_repair_case_url( $slug ) {
    $page = laptopia_published_repair_page( $slug );
    return $page ? get_permalink( $page ) : '';
}

function laptopia_published_repair_page( $slug = '' ) {
    $listing = get_page_by_path( 'repairs', OBJECT, 'page' );
    if ( ! $listing || 'publish' !== get_post_status( $listing ) ) {
        return null;
    }
    if ( '' === $slug ) {
        return $listing;
    }
    $page = get_page_by_path( 'repairs/' . sanitize_title( $slug ), OBJECT, 'page' );
    return $page && 'publish' === get_post_status( $page ) ? $page : null;
}

function laptopia_has_published_repair_case() {
    foreach ( laptopia_get_repair_cases() as $case ) {
        if ( laptopia_published_repair_page( $case['slug'] ) ) {
            return true;
        }
    }
    return false;
}
