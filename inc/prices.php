<?php
/** Published price values shared by the price list and service templates. */
defined( 'ABSPATH' ) || exit;

function laptopia_price_rows() {
    return array(
        'diagnostics' => array( 'label' => 'דמי אבחון אם בוחרים שלא לתקן', 'amount' => '150₪', 'type' => 'fixed', 'icon' => 'diagnostics' ),
        'cooling' => array( 'label' => 'ניקוי מערכת קירור', 'amount' => '300₪', 'type' => 'from', 'icon' => 'cooling-cleaning', 'slug' => 'cooling-cleaning' ),
        'screen' => array( 'label' => 'החלפת מסך', 'amount' => '550₪', 'type' => 'from', 'icon' => 'screen-replacement', 'slug' => 'screen-replacement' ),
        'keyboard' => array( 'label' => 'החלפת מקלדת', 'amount' => '550₪', 'type' => 'from', 'icon' => 'keyboard-replacement', 'slug' => 'keyboard-replacement' ),
        'charging' => array( 'label' => 'החלפת שקע טעינה', 'amount' => '250₪', 'type' => 'from', 'icon' => 'charging', 'slug' => 'charging-usb-repair' ),
        'usb' => array( 'label' => 'החלפת שקע USB', 'amount' => '300₪', 'type' => 'from', 'icon' => 'charging', 'slug' => 'peripheral-ports' ),
        'battery' => array( 'label' => 'החלפת סוללה', 'amount' => '400₪', 'type' => 'from', 'icon' => 'battery-replacement', 'slug' => 'battery-replacement' ),
        'hinges' => array( 'label' => 'תיקון צירים', 'amount' => '500₪', 'type' => 'from', 'icon' => 'hinge', 'slug' => 'hinges-plastics-repair' ),
        'plastics' => array( 'label' => 'תיקון פלסטיקה / מארז', 'amount' => '700₪', 'type' => 'from', 'icon' => 'hinge', 'slug' => 'hinges-plastics-repair' ),
        'windows' => array( 'label' => 'התקנת מערכת הפעלה', 'amount' => '300₪', 'type' => 'fixed', 'icon' => 'software', 'slug' => 'ram-ssd-windows-upgrade' ),
        'motherboard' => array( 'label' => 'תיקון לוח אם', 'amount' => '700₪', 'type' => 'from', 'icon' => 'motherboard-repair', 'slug' => 'motherboard-repair' ),
    );
}

function laptopia_price_amount( $key ) {
    $rows = laptopia_price_rows();
    return isset( $rows[ $key ] ) ? laptopia_bidi_price( $rows[ $key ]['amount'] ) : '';
}

function laptopia_price_display( $key ) {
    $rows = laptopia_price_rows();
    if ( ! isset( $rows[ $key ] ) ) {
        return '';
    }
    $amount = laptopia_price_amount( $key );
    return 'from' === $rows[ $key ]['type']
        ? '<span class="laptopia-bidi-phrase">החל מ- ' . $amount . '</span>'
        : $amount;
}
