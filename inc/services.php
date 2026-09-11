<?php
/** Published service pages shared by header and footer. */
function laptopia_get_services() {
    return array(
        array( 'slug' => 'motherboard-repair', 'label' => 'תיקון לוח אם למחשב נייד' ),
        array( 'slug' => 'screen-replacement', 'label' => 'החלפת מסך למחשב נייד' ),
        array( 'slug' => 'battery-replacement', 'label' => 'החלפת סוללה למחשב נייד' ),
        array( 'slug' => 'cooling-cleaning', 'label' => 'ניקוי מערכת קירור למחשב נייד' ),
        array( 'slug' => 'keyboard-replacement', 'label' => 'החלפת מקלדת למחשב נייד' ),
    );
}
