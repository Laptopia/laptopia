<?php
/**
 * Factual public repair cases. Add one data entry and one child WordPress Page
 * under /repairs/ using page-templates/repair-case.php for each new case.
 * The listing and related links remain hidden until their Pages are published.
 */
function laptopia_get_repair_cases() {
    $media = 'https://laptopia.co.il/wp-content/uploads/2026/09/';
    $dell_media = 'https://laptopia.co.il/wp-content/uploads/2026/10/';

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
            'diagnosis' => 'לאחר פירוק המחשב התברר שנקודות העיגון של הצירים נעקרו ממקומן ביחידת המקלדת והמארז העליון. הבעיה הייתה בנקודות העיגון שנשברו.',
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
        'dell-vostro-5402-lcd-cover-hinge-repair' => array(
            'slug' => 'dell-vostro-5402-lcd-cover-hinge-repair',
            'model' => 'Dell Vostro 5402',
            'category' => 'צירים ופלסטיקה',
            'service_path' => '/hinges-plastics-repair/',
            'heading' => 'החלפת גב מסך ותיקון צירים במחשב Dell Vostro 5402',
            'intro' => 'המחשב הגיע למעבדה עם גב מסך שבור באזור הצירים. נקודות החיבור של הצירים לגב המסך נשברו, והצירים נעו בקושי והפעילו עומס נוסף על המבנה.',
            'card_problem' => 'נזק בגב המסך ובנקודות החיבור באזור הצירים.',
            'card_title' => 'החלפת גב מסך ותיקון צירים',
            'card_description' => 'החלפת גב המסך, ניקוי וכיוון הצירים ושיקום האזור הפגוע.',
            'problem' => 'בחלק התחתון של גב המסך נגרם נזק משמעותי: נקודות החיבור שמחזיקות את הצירים נשברו, ונפגעו גם כיסויי הצירים במסגרת הקדמית. הצירים עצמם לא היו שבורים, אך נעו בקושי ולעיתים נתקעו, והפעילו עומס נוסף על נקודות החיבור.',
            'diagnosis' => 'מכלול המסך פורק כדי לבדוק את גב המסך, הצירים, המסגרת והחיבורים. באזור הצירים נמצאו אבק וסימני קורוזיה. לא היה צורך להחליף את הצירים או את מסך ה-LCD המקורי; החלקים התקינים נשמרו.',
            'repair' => 'הצירים המקוריים נוקו מאבק ומשאריות קורוזיה וכוונו לתנועה חלקה יותר ולהפחתת העומס על גב המסך. רק גב המסך הפגום הוחלף בחדש. מסך ה-LCD המקורי, הצירים ושאר הרכיבים התקינים הועברו לגב החדש. כיסויי הצירים שנפגעו במסגרת הקדמית שוקמו, ולאחר מכן מכלול המסך והמחשב הורכבו מחדש.',
            'result' => 'לאחר ההרכבה נבדקו פתיחה וסגירה של המכסה, תנועת שני הצירים, יציבות גב המסך ופעולת התצוגה. המחשב חזר לעבודה תקינה עם גב מסך חדש ותנועה תקינה של הצירים.',
            'price' => '700₪',
            'warranty' => '3 חודשים',
            'warranty_exclusion' => 'האחריות אינה כוללת נזק פיזי או נזקי נוזלים שנגרמו לאחר התיקון.',
            'disclaimer' => 'זהו תיעוד של תיקון אמיתי מסוים, והמחיר 700₪ מתייחס למקרה זה בלבד. מחיר, שיטת תיקון ואפשרות התיקון במחשב אחר נקבעים רק לאחר אבחון.',
            'seo_title' => 'החלפת גב מסך ותיקון צירים ב-Dell Vostro 5402 | Laptopia',
            'seo_description' => 'תיקון אמיתי של Dell Vostro 5402 עם גב מסך וחיבורי צירים פגומים: ניקוי וכיוון הצירים והחלפת גב המסך תוך שמירת ה-LCD המקורי. מחיר המקרה בלבד: 700₪.',
            'images' => array(
                'finished' => array( 'src' => $dell_media . 'dell-vostro-5402-repair-final-result.webp', 'alt' => 'מחשב Dell Vostro 5402 מורכב לאחר התיקון עם תמונה על המסך', 'width' => 1920, 'height' => 1440, 'caption' => 'המחשב לאחר ההרכבה ובדיקת התצוגה' ),
                'opened' => array( 'src' => $dell_media . 'dell-vostro-5402-lcd-cover-damage-before.webp', 'alt' => 'Dell Vostro 5402 לפני התיקון עם נזק בגב המסך באזור הצירים', 'width' => 1920, 'height' => 1440, 'caption' => 'לפני התיקון: אזורי הצירים הפגועים' ),
                'damage' => array(
                    array( 'src' => $dell_media . 'dell-vostro-5402-broken-hinge-mounts.webp', 'alt' => 'מכלול המסך המפורק עם נזק באזור הצירים והצירים שהוסרו', 'width' => 1920, 'height' => 1440, 'caption' => 'מכלול המסך לפני התיקון והצירים המקוריים שהוסרו' ),
                    array( 'src' => $dell_media . 'dell-vostro-5402-disassembled-broken-parts.webp', 'alt' => 'גב המסך הישן מבפנים, עם נקודות חיבור פגומות והצירים שהוסרו', 'width' => 1920, 'height' => 1440, 'caption' => 'גב המסך הישן ונקודות החיבור הפגומות' ),
                ),
                'repaired' => array( 'src' => $dell_media . 'dell-vostro-5402-old-new-lcd-cover.webp', 'alt' => 'השוואה בין גב המסך הפגום לגב המסך החדש של Dell Vostro 5402', 'width' => 1440, 'height' => 1920, 'caption' => 'גב המסך הישן למעלה והגב החדש למטה' ),
                'repair_details' => array(
                    array( 'src' => $dell_media . 'dell-vostro-5402-lcd-installed-new-cover.webp', 'alt' => 'מסך Dell Vostro 5402 מותקן בגב המסך החדש במהלך ההרכבה', 'width' => 1920, 'height' => 1440, 'caption' => 'מסך ה-LCD המקורי והצירים המקוריים בגב החדש' ),
                    array( 'src' => $dell_media . 'dell-vostro-5402-display-assembly-after-repair.webp', 'alt' => 'מכלול המסך של Dell Vostro 5402 לאחר החלפת גב המסך ולפני ההרכבה הסופית', 'width' => 1920, 'height' => 1440, 'caption' => 'מכלול המסך לאחר הרכבת המסגרת, לפני החיבור למחשב' ),
                ),
            ),
        ),
    );
}

function laptopia_get_repair_case( $slug ) {
    $cases = laptopia_get_repair_cases();
    return $cases[ $slug ] ?? null;
}

/** Published direct children of /repairs/, matched to case data, newest first. */
function laptopia_get_published_repair_cases_for_service( $service_path, $limit = 3 ) {
    $limit = max( 0, (int) $limit );
    if ( ! $limit || ! is_string( $service_path ) || '' === trim( $service_path, '/' ) ) {
        return array();
    }
    $service_path = '/' . trim( $service_path, '/' ) . '/';
    $listing = get_page_by_path( 'repairs', OBJECT, 'page' );
    if ( ! $listing ) {
        return array();
    }

    // One bounded parent query, never one lookup per static case.
    $pages = get_posts( array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_parent' => $listing->ID,
        'posts_per_page' => -1,
        'orderby' => array( 'date' => 'DESC', 'ID' => 'DESC' ),
        'no_found_rows' => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ) );
    $cases = laptopia_get_repair_cases();
    $selected = array();
    foreach ( $pages as $page ) {
        $case = $cases[ $page->post_name ] ?? null;
        if ( ! $case || $service_path !== ( $case['service_path'] ?? '' ) || ! empty( $page->post_password ) ) {
            continue;
        }
        $case['url'] = get_permalink( $page );
        $selected[] = $case;
        if ( count( $selected ) >= $limit ) {
            break;
        }
    }
    return $selected;
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
