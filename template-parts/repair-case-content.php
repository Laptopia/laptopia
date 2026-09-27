<?php
$case = $args['case'] ?? null;
if ( ! is_array( $case ) ) {
    return;
}
?>
<main dir="rtl" class="laptopia-repair-page">
  <nav class="laptopia-repair-breadcrumb" aria-label="מיקום באתר">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">דף הבית</a><span aria-hidden="true">/</span>
    <?php if ( laptopia_published_repair_page( $case['slug'] ) ) : ?>
      <a href="<?php echo esc_url( home_url( '/repairs/' ) ); ?>">תיקונים מהמעבדה</a><span aria-hidden="true">/</span>
    <?php endif; ?>
    <span aria-current="page">תיקון צירים</span>
  </nav>

  <section class="laptopia-section laptopia-repair-intro" aria-labelledby="repair-title">
    <div class="laptopia-repair-rail">
      <p class="laptopia-repair-eyebrow">תיקון אמיתי מהמעבדה</p>
      <h1 id="repair-title"><?php echo laptopia_bidi_text( $case['heading'] ); ?></h1>
      <p><?php echo esc_html( $case['intro'] ); ?></p>
      <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $case['images']['finished'], 'priority' => true, 'class' => 'laptopia-repair-photo-main' ) ); ?>
    </div>
  </section>

  <section class="laptopia-section laptopia-repair-stage" aria-labelledby="repair-problem">
    <div class="laptopia-repair-rail">
      <h2 id="repair-problem">הבעיה</h2>
      <p><?php echo esc_html( $case['problem'] ); ?></p>
      <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $case['images']['opened'], 'class' => 'laptopia-repair-photo-main' ) ); ?>
    </div>
  </section>

  <section class="laptopia-section laptopia-repair-stage laptopia-repair-stage-muted" aria-labelledby="repair-diagnosis">
    <div class="laptopia-repair-rail">
      <h2 id="repair-diagnosis">מה מצאנו</h2>
      <p><?php echo esc_html( $case['diagnosis'] ); ?></p>
      <div class="laptopia-repair-details">
        <?php foreach ( $case['images']['damage'] as $image ) : ?>
          <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $image ) ); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-repair-stage" aria-labelledby="repair-work">
    <div class="laptopia-repair-rail">
      <h2 id="repair-work">מה תיקנו</h2>
      <p><?php echo esc_html( $case['repair'] ); ?></p>
      <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $case['images']['repaired'], 'class' => 'laptopia-repair-photo-main' ) ); ?>
      <div class="laptopia-repair-details laptopia-repair-details-two">
        <?php foreach ( $case['images']['repair_details'] as $image ) : ?>
          <?php get_template_part( 'template-parts/repair-photo', null, array( 'image' => $image ) ); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-repair-stage laptopia-repair-result" aria-labelledby="repair-result">
    <div class="laptopia-repair-rail">
      <h2 id="repair-result">התוצאה</h2>
      <p><?php echo esc_html( $case['result'] ); ?></p>
      <div class="laptopia-info-panel laptopia-repair-outcome">
        <p><strong>מחיר המקרה הזה:</strong> <?php echo laptopia_bidi_price( $case['price'] ); ?></p>
        <p><strong>אחריות לתיקון הזה:</strong> <?php echo esc_html( $case['warranty'] ); ?></p>
        <p><?php echo esc_html( $case['warranty_exclusion'] ); ?></p>
        <p><?php echo esc_html( $case['disclaimer'] ); ?></p>
      </div>
      <a class="laptopia-repair-text-link" href="<?php echo esc_url( home_url( $case['service_path'] ) ); ?>">למידע על תיקון צירים ופלסטיקה <?php echo laptopia_ui_icon( 'arrow-left' ); ?></a>
    </div>
  </section>

  <?php get_template_part( 'template-parts/service-contact-section', null, array( 'heading' => 'לתיאום בדיקת צירים ופלסטיקה', 'description' => 'שלחו את דגם המחשב ותיאור התקלה, ונתאם הגעה למעבדה ברמלה.' ) ); ?>
</main>

<dialog class="laptopia-repair-lightbox" aria-label="תמונות התיקון">
  <div class="laptopia-repair-lightbox-content">
    <button class="laptopia-repair-lightbox-close" type="button" aria-label="סגירת תמונה">×</button>
    <img class="laptopia-repair-lightbox-image" alt="תמונה מוגדלת של התיקון">
    <p class="laptopia-repair-lightbox-caption"></p>
    <div class="laptopia-repair-lightbox-navigation">
      <button class="laptopia-repair-lightbox-previous" type="button" aria-label="תמונה קודמת">הקודמת</button>
      <span class="laptopia-repair-lightbox-counter" aria-live="polite"></span>
      <button class="laptopia-repair-lightbox-next" type="button" aria-label="תמונה הבאה">הבאה</button>
    </div>
  </div>
</dialog>
