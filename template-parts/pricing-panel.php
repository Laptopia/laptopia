<?php
/** Shared service pricing hierarchy; values remain in the published price source. */
defined( 'ABSPATH' ) || exit;

$price_key = $args['price_key'] ?? '';
$label = $args['label'] ?? '';
$description = $args['description'] ?? '';
?>
<div class="laptopia-diagnostic laptopia-pricing-panel">
  <h3 class="laptopia-panel-heading">תמחור ואבחון</h3>
  <p class="laptopia-principal-value"><span><?php echo laptopia_bidi_text( $label ); ?></span> — <?php echo laptopia_price_display( $price_key ); ?></p>
  <p class="laptopia-pricing-explanation"><?php echo laptopia_bidi_text( $description ); ?></p>
  <div class="laptopia-diagnostic-subsection">
    <h3 class="laptopia-concept-heading">דמי אבחון</h3>
    <p>במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון, דמי האבחון הם <?php echo laptopia_price_amount( 'diagnostics' ); ?>.</p>
    <p>אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p>
  </div>
</div>
