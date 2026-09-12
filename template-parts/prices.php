<section class="laptopia-section laptopia-prices" id="prices">

  <div class="laptopia-inner">

    <h2 class="laptopia-section-title">
      מחירון שירותים נפוצים
    </h2>

    <div class="laptopia-section-subtitle">
      המחיר הסופי נקבע בהתאם לדגם, לתקלה ולחלקים הנדרשים
    </div>

    <?php
    // Reusable icon keys match the shared service-icon component.
    $price_rows = array(
      array( 'label' => 'אבחון במקרה של אי ביצוע תיקון', 'price' => '150 ₪', 'icon' => 'diagnostics' ),
      array( 'label' => 'ניקוי מערכת קירור', 'price' => 'החל מ־300 ₪', 'icon' => 'cooling-cleaning', 'url' => '/cooling-cleaning/' ),
      array( 'label' => 'החלפת מסך', 'price' => 'החל מ־550 ₪', 'icon' => 'screen-replacement', 'url' => 'https://laptopia.co.il/screen-replacement/' ),
      array( 'label' => 'החלפת מקלדת', 'price' => 'החל מ־550 ₪', 'icon' => 'keyboard-replacement', 'url' => 'https://laptopia.co.il/keyboard-replacement/' ),
      array( 'label' => 'החלפת שקע טעינה', 'price' => 'החל מ־250 ₪', 'icon' => 'charging', 'url' => '/charging-usb-repair/' ),
      array( 'label' => 'החלפת שקע USB', 'price' => 'החל מ־300 ₪', 'icon' => 'charging', 'url' => '/charging-usb-repair/' ),
      array( 'label' => 'החלפת סוללה', 'price' => 'החל מ־400 ₪', 'icon' => 'battery-replacement', 'url' => 'https://laptopia.co.il/battery-replacement/' ),
      array( 'label' => 'תיקון צירים', 'price' => 'החל מ־500 ₪', 'icon' => 'hinge', 'url' => '/hinges-plastics-repair/' ),
      array( 'label' => 'החלפת חלקי פלסטיקה', 'price' => 'החל מ־700 ₪', 'icon' => 'hinge', 'url' => '/hinges-plastics-repair/' ),
      array( 'label' => 'התקנת מערכת הפעלה', 'price' => '300 ₪', 'icon' => 'software', 'url' => '/ram-ssd-windows-upgrade/' ),
      array( 'label' => 'תיקון לוח אם', 'price' => 'החל מ־700 ₪', 'icon' => 'motherboard-repair', 'url' => '/motherboard-repair/' ),
    );
    ?>
    <div class="laptopia-price-list">
      <?php foreach ( $price_rows as $row ) : ?>
        <?php if ( isset( $row['url'] ) ) : ?>
          <a class="laptopia-price-row laptopia-element-link" href="<?php echo esc_url( $row['url'] ); ?>">
        <?php else : ?>
          <div class="laptopia-price-row">
        <?php endif; ?>
            <div class="laptopia-price-name laptopia-price-service">
              <?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => $row['icon'] ) ); ?>
              <span><?php echo esc_html( $row['label'] ); ?></span>
            </div>
            <div class="laptopia-price-value"><?php echo esc_html( $row['price'] ); ?></div>
        <?php if ( isset( $row['url'] ) ) : ?>
          </a>
        <?php else : ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <div class="laptopia-diagnostic">
      במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון,
      דמי האבחון הם 150 ₪.
      <br>
      אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית,
      לא ייגבו דמי אבחון.
    </div>

    <div class="laptopia-price-note">
      התיקון מתבצע רק לאחר אישור הלקוח.
      המחיר הסופי עשוי להשתנות בהתאם לדגם המחשב,
      לסוג החלק ולמורכבות העבודה.
    </div>

  </div>

</section>
