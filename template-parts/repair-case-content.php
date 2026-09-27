<?php
$case = $args['case'] ?? null;
if ( ! is_array( $case ) ) {
    return;
}
?>
<main dir="rtl" class="laptopia-repair-page">
  <nav class="laptopia-repair-breadcrumb" aria-label="מיקום באתר">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">דף הבית</a><span aria-hidden="true">/</span>
    <a href="<?php echo esc_url( home_url( '/repairs/' ) ); ?>">תיקונים מהמעבדה</a><span aria-hidden="true">/</span>
    <span aria-current="page">תיקון צירים</span>
  </nav>
  <section class="laptopia-section laptopia-repair-hero" aria-labelledby="repair-title">
    <div class="laptopia-repair-hero-inner">
      <div>
        <p class="laptopia-repair-eyebrow">תיקון אמיתי מהמעבדה · <?php echo esc_html( $case['category'] ); ?></p>
        <h1 id="repair-title"><?php echo laptopia_bidi_text( $case['heading'] ); ?></h1>
        <p><?php echo esc_html( $case['intro'] ); ?></p>
        <dl class="laptopia-repair-facts">
          <div><dt>המחשב</dt><dd><?php echo laptopia_bidi_ltr( $case['model'] ); ?></dd></div>
          <div><dt>מחיר המקרה הזה</dt><dd><?php echo laptopia_bidi_price( $case['price'] ); ?></dd></div>
          <div><dt>אחריות לתיקון הזה</dt><dd><?php echo esc_html( $case['warranty'] ); ?></dd></div>
        </dl>
        <a class="laptopia-repair-text-link" href="<?php echo esc_url( home_url( $case['service_path'] ) ); ?>">למידע על תיקון צירים ופלסטיקה <?php echo laptopia_ui_icon( 'arrow-left' ); ?></a>
      </div>
      <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $case['images']['finished'], 'priority' => true ) ); ?>
    </div>
  </section>
  <section class="laptopia-section laptopia-repair-story" aria-labelledby="repair-problem">
    <div class="laptopia-repair-story-grid">
      <div><p class="laptopia-repair-eyebrow">01 · הבעיה</p><h2 id="repair-problem">המארז נפתח באזור הצירים</h2><p><?php echo esc_html( $case['problem'] ); ?></p></div>
      <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $case['images']['opened'] ) ); ?>
    </div>
  </section>
  <section class="laptopia-section laptopia-repair-story laptopia-repair-story-light" aria-labelledby="repair-diagnosis">
    <div class="laptopia-repair-rail">
      <div class="laptopia-repair-story-copy"><p class="laptopia-repair-eyebrow">02 · מה מצאנו</p><h2 id="repair-diagnosis">נקודות העיגון נעקרו ממקומן</h2><p><?php echo esc_html( $case['diagnosis'] ); ?></p></div>
      <div class="laptopia-repair-details">
        <?php foreach ( $case['images']['damage'] as $image ) : ?><?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $image ) ); ?><?php endforeach; ?>
      </div>
    </div>
  </section>
  <section class="laptopia-section laptopia-repair-story" aria-labelledby="repair-work">
    <div class="laptopia-repair-rail">
      <div class="laptopia-repair-story-copy"><p class="laptopia-repair-eyebrow">03 · מה תיקנו</p><h2 id="repair-work">שחזור נקודות החיבור</h2><p><?php echo esc_html( $case['repair'] ); ?></p></div>
      <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $case['images']['repaired'], 'class' => 'laptopia-repair-photo-wide' ) ); ?>
      <div class="laptopia-repair-details laptopia-repair-details-two">
        <?php foreach ( $case['images']['repair_details'] as $image ) : ?><?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $image ) ); ?><?php endforeach; ?>
      </div>
    </div>
  </section>
  <section class="laptopia-section laptopia-repair-result" aria-labelledby="repair-result">
    <div class="laptopia-repair-rail">
      <p class="laptopia-repair-eyebrow">04 · התוצאה</p><h2 id="repair-result">המחשב הורכב ונבדקה תנועת המסך</h2><p><?php echo esc_html( $case['result'] ); ?></p>
      <div class="laptopia-repair-result-facts"><span>מחיר המקרה הזה: <?php echo laptopia_bidi_price( $case['price'] ); ?></span><span>אחריות לתיקון הזה: <?php echo esc_html( $case['warranty'] ); ?></span></div>
      <p class="laptopia-repair-note"><?php echo esc_html( $case['warranty_exclusion'] ); ?></p>
      <p class="laptopia-repair-note"><?php echo esc_html( $case['disclaimer'] ); ?></p>
      <div class="laptopia-buttons"><a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>שלחו הודעה ב-<?php echo laptopia_bidi_ltr( 'WhatsApp' ); ?></span></span></a><a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a></div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array( 'heading' => 'לתיאום בדיקת צירים ופלסטיקה', 'description' => 'שלחו את דגם המחשב ותיאור התקלה, ונתאם הגעה למעבדה ברמלה.' ) ); ?>
</main>
