<?php defined( 'ABSPATH' ) || exit; ?>
<section class="laptopia-section laptopia-prices laptopia-price-teaser" id="prices">
  <div class="laptopia-inner laptopia-content-rail">
    <h2 class="laptopia-section-title">מחירון</h2>
    <p class="laptopia-section-subtitle">המחיר הסופי נקבע בהתאם לדגם המחשב, לתקלה ולחלקים הנדרשים. התיקון מתבצע רק לאחר אישור הלקוח.</p>
    <div class="laptopia-diagnostic laptopia-pricing-panel">
      <h3 class="laptopia-panel-heading">דמי אבחון אם בוחרים שלא לתקן</h3>
      <p class="laptopia-principal-value"><?php echo laptopia_price_display( 'diagnostics' ); ?></p>
      <p class="laptopia-pricing-explanation">במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון, דמי האבחון הם <?php echo laptopia_price_amount( 'diagnostics' ); ?>. אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p>
    </div>
    <?php get_template_part( 'template-parts/consumer-price-note' ); ?>
    <div class="laptopia-buttons">
      <a class="laptopia-btn laptopia-btn-navigation" data-analytics-event="price_list_click" data-analytics-placement="home_price_teaser" href="<?php echo esc_url( home_url( '/prices/' ) ); ?>">למחירון המלא</a>
    </div>
  </div>
</section>
