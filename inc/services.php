<?php
/** Published service pages shared by header and footer. */
function laptopia_get_services() {
    return array(
        array( 'slug' => 'motherboard-repair', 'label' => 'תיקון לוח אם למחשב נייד', 'short_label' => 'תיקון לוח אם', 'home_order' => 1, 'home_label' => 'תיקון לוח אם', 'home_description' => 'תיקון לוח אם ברמת הרכיב, כולל קצרים, תקלות טעינה ונזקי נוזלים.' ),
        array( 'slug' => 'screen-replacement', 'label' => 'החלפת מסך למחשב נייד', 'short_label' => 'החלפת מסך', 'home_order' => 2, 'home_label' => 'החלפת מסך', 'home_description' => 'החלפת מסכים שבורים, סדוקים או ללא תצוגה.' ),
        array( 'slug' => 'battery-replacement', 'label' => 'החלפת סוללה למחשב נייד', 'short_label' => 'החלפת סוללה', 'home_order' => 6, 'home_label' => 'החלפת סוללה', 'home_description' => 'החלפת סוללות למחשבים ניידים, כולל בדיקת התאמה ואבחון לפי הצורך.' ),
        array( 'slug' => 'cooling-cleaning', 'label' => 'ניקוי מערכת קירור למחשב נייד', 'short_label' => 'ניקוי מערכת קירור', 'home_order' => 7, 'home_label' => 'מערכת קירור', 'home_description' => 'ניקוי מערכת הקירור וטיפול בהתחממות.' ),
        array( 'slug' => 'keyboard-replacement', 'label' => 'החלפת מקלדת למחשב נייד', 'short_label' => 'החלפת מקלדת', 'home_order' => 3, 'home_label' => 'החלפת מקלדת', 'home_description' => 'החלפת מקלדות תקולות לאחר בדיקת התאמה וזמינות.' ),
        array( 'slug' => 'charging-usb-repair', 'label' => 'תיקון שקעי טעינה למחשב נייד', 'short_label' => 'שקעי טעינה', 'home_order' => 4, 'home_label' => 'שקעי טעינה', 'home_description' => 'תיקון שקעי טעינה וחיבורי USB-C לטעינת מחשבים ניידים.' ),
        array( 'slug' => 'peripheral-ports', 'label' => 'תיקון שקעי USB וחיבורים במחשב נייד', 'short_label' => 'USB וחיבורים', 'home_order' => 5, 'home_label' => 'USB וחיבורים', 'home_description' => 'תיקון חיבורי USB, HDMI, אוזניות וקוראי כרטיסים לפי ממצאי הבדיקה.' ),
        array( 'slug' => 'hinges-plastics-repair', 'label' => 'תיקון צירים ופלסטיקה למחשב נייד', 'short_label' => 'צירים ופלסטיקה', 'home_order' => 8, 'home_label' => 'תיקון צירים ופלסטיקה', 'home_description' => 'תיקון נזקי צירים והחלפת חלקי פלסטיקה לפי הצורך.' ),
        array( 'slug' => 'ram-ssd-windows-upgrade', 'label' => 'שדרוג זיכרון ו-SSD והתקנת מערכת הפעלה', 'short_label' => 'זיכרון, SSD ומערכת הפעלה', 'home_order' => 9, 'home_label' => 'שדרוגי חומרה', 'home_description' => 'שדרוגי SSD וזיכרון למחשבים ניידים לשיפור ביצועים ונפח אחסון.' ),
    );
}
