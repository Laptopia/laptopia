<?php
/** Published service pages shared by header and footer. */
function laptopia_get_services() {
    return array(
        array( 'slug' => 'motherboard-repair', 'label' => 'תיקון לוח אם למחשב נייד', 'short_label' => 'תיקון לוח אם' ),
        array( 'slug' => 'screen-replacement', 'label' => 'החלפת מסך למחשב נייד', 'short_label' => 'החלפת מסך' ),
        array( 'slug' => 'battery-replacement', 'label' => 'החלפת סוללה למחשב נייד', 'short_label' => 'החלפת סוללה' ),
        array( 'slug' => 'cooling-cleaning', 'label' => 'ניקוי מערכת קירור למחשב נייד', 'short_label' => 'ניקוי מערכת קירור' ),
        array( 'slug' => 'keyboard-replacement', 'label' => 'החלפת מקלדת למחשב נייד', 'short_label' => 'החלפת מקלדת' ),
    );
}
