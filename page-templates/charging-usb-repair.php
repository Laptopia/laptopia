<?php
/**
 * Template Name: Laptopia - תיקון שקעי טעינה ו־USB למחשב נייד
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'laptopia-service-page' ); ?> data-laptopia-background="<?php echo esc_attr( laptopia_background_mode() ); ?>">
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/header', null, array(
    'service_link' => array( 'href' => '#ports', 'label' => 'בדיקת שקעי טעינה' ),
) ); ?>
<main dir="rtl">
  <section class="laptopia-section laptopia-hero" aria-labelledby="service-title">
    <div class="laptopia-hero-content">
      <h1 id="service-title">תיקון שקעי טעינה ו־<?php echo laptopia_bidi_ltr( 'USB' ); ?> למחשב נייד ברמלה והסביבה</h1>
      <p>טעינה שמתנתקת, שקע רופף או <?php echo laptopia_bidi_ltr( 'USB' ); ?> שאינו מזוהה? בודקים אם הבעיה במחבר, בהלחמות, בבקר או במעגלי הלוח.</p>
      <div class="laptopia-service-price-grid">
        <div class="laptopia-board-price laptopia-service-cta"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'charging' ) ); ?><span><span class="laptopia-price-card-label">שקע טעינה</span><span class="laptopia-service-price-amount">החל מ־<bdi dir="ltr">250 ₪</bdi></span></span></div>
        <div class="laptopia-board-price laptopia-service-cta"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'charging' ) ); ?><span><span class="laptopia-price-card-label"><bdi dir="ltr">USB / USB-C</bdi></span><span class="laptopia-service-price-amount">החל מ־<bdi dir="ltr">300 ₪</bdi></span></span></div>
      </div>
      <p>המחיר והיקף העבודה נקבעים לאחר בדיקה ואישור הלקוח.</p>
      <?php get_template_part( 'template-parts/service-hero-details', null, array( 'warranty' => '3 חודשי אחריות על התיקון' ) ); ?>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>שלחו הודעה ב-<?php echo laptopia_bidi_ltr( 'WhatsApp' ); ?></span></span></a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
      </div>
      <div class="laptopia-phone-line">קבלת מחשבים במעבדה בתיאום מראש בלבד</div>
    </div>
  </section>
  <section class="laptopia-section laptopia-services">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">מתי צריך לבדוק שקע טעינה או <?php echo laptopia_bidi_ltr( 'USB' ); ?>?</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>המטען לא יושב היטב</h3><p>המטען לא נכנס היטב, צריך להחזיק אותו בזווית או שהטעינה מתנתקת. בודקים גם את המטען ואת התאמתו למחשב.</p></div>
        <div class="laptopia-card"><h3>שקע רופף, שבור או חם</h3><p>מחבר שנפגע פיזית או מתחמם מצדיק בדיקה. אין להפעיל עליו כוח כדי לנסות לייצב את החיבור.</p></div>
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'USB' ); ?> לא מזהה התקנים</h3><p>בודקים את השקע, את החיבור ואת אפשרות התקלה בקו הנתונים או במערכת ההפעלה.</p></div>
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'USB-C' ); ?> לא טוען</h3><p>הסיבה עשויה להיות במחבר, במטען, בבקר או במעגלי ההזנה. החלפת שקע לבדה אינה בהכרח הפתרון.</p></div>
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'USB-C' ); ?> לא מעביר נתונים או תמונה</h3><p>בודקים אם דגם המחשב והשקע תומכים בפעולה המבוקשת, וכן את הכבל ואת מעגלי החיבור.</p></div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-case', null, array(
    'heading' => 'דוגמה מתיקון אמיתי',
    'description' => 'במקרה זה המחבר נפגע יחד עם חלק מאזור הלוח. התיקון כלל שיקום של אזור החיבור בלוח והתקנת המחבר מחדש.',
    'images' => array(
      array(
        'src' => 'https://laptopia.co.il/wp-content/uploads/2026/09/usb-port-board-damage.webp',
        'alt' => 'שקע USB-C פגום עם נזק ללוח האם',
        'title' => 'נזק לשקע USB-C וללוח האם',
        'width' => 1200,
        'height' => 1600,
      ),
    ),
  ) ); ?>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section" id="ports">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>מה בודקים בתיקון שקע טעינה ו־<?php echo laptopia_bidi_ltr( 'USB' ); ?>?</h2>
      <h3>בדיקת המחבר והחיבור ללוח</h3>
      <p>בודקים נזק פיזי, חופש במחבר ומצב ההלחמות. לפי הממצאים ניתן לשקול תיקון הלחמה או החלפת מחבר מתאים.</p>
      <h3>הזנה, בקר וקווי נתונים</h3>
      <p>בתקלות <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> / <?php echo laptopia_bidi_ltr( 'Type-C' ); ?> בודקים גם את ההזנה, הבקר, רכיבי המעגל סביב המחבר וקווי הנתונים. לא כל תקלה נפתרת בהחלפת השקע.</p>
      <h3>טיפול ברמת הרכיב לפי האבחון</h3>
      <p>אם התקלה עמוקה יותר, היקף העבודה נקבע לאחר בדיקה ונמסר לאישור. מידע נוסף נמצא בעמוד <a href="<?php echo esc_url( home_url( '/motherboard-repair/' ) ); ?>">תיקון לוח אם למחשב נייד</a>.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-prices" id="prices">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">כמה עולה תיקון שקע טעינה או <?php echo laptopia_bidi_ltr( 'USB' ); ?>?</h2>
      <div class="laptopia-service-price-grid">
        <div class="laptopia-card laptopia-price-card">
          <div class="laptopia-service-icon" aria-hidden="true"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'charging' ) ); ?></div>
          <h3>שקע טעינה</h3>
          <p class="laptopia-price-card-value">החל מ־<?php echo laptopia_bidi_price( '250 ₪' ); ?></p>
        </div>
        <div class="laptopia-card laptopia-price-card">
          <div class="laptopia-service-icon" aria-hidden="true"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'charging' ) ); ?></div>
          <h3><?php echo laptopia_bidi_ltr( 'USB' ); ?> / <?php echo laptopia_bidi_ltr( 'USB-C' ); ?></h3>
          <p class="laptopia-price-card-value">החל מ־<?php echo laptopia_bidi_price( '300 ₪' ); ?></p>
        </div>
      </div>
      <p class="laptopia-price-note">המחיר הסופי תלוי בדגם, במצב המחבר ובממצאי הבדיקה. תיקון בקר, הזנה או מעגלים נוספים מתומחר לפי היקף העבודה, לאחר אבחון ואישור הלקוח.</p>
      <?php get_template_part( 'template-parts/consumer-price-note' ); ?>
    </div>
  </section>
  <?php get_template_part( 'template-parts/process', null, array(
    'title' => 'איך מתבצע תיקון שקעי הטעינה וה־USB?',
    'steps' => array(
      array( 'title' => 'תיאום מראש', 'text' => 'שולחים דגם ותיאור התקלה ומתאמים מסירה.' ),
      array( 'title' => 'אבחון החיבור', 'text' => 'בודקים מחבר, הזנה וקווי נתונים לפי התקלה.' ),
      array( 'title' => 'הצעת מחיר', 'text' => 'מפרטים את הטיפול הנדרש ומבקשים אישור.' ),
      array( 'title' => 'תיקון ובדיקה', 'text' => 'מבצעים את העבודה המאושרת ובודקים את החיבור.' ),
      array( 'title' => 'איסוף', 'text' => 'מודיעים כשהמחשב מוכן לאיסוף.' ),
    ),
  ) ); ?>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>מה משפיע על היקף התיקון?</h2>
      <h3>מבנה השקע והלוח</h3>
      <p>שקע שמחובר ללוח נפרד אינו זהה לשקע שמולחם ללוח האם. מצב נקודות החיבור והנזק סביב המחבר משפיעים על דרך הטיפול.</p>
      <h3>התאמה וזמינות</h3>
      <p>סוג המחבר, תכונות <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> והחלק המתאים נבדקים לפי הדגם. אין התחייבות לזמינות מחבר לכל מחשב.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-warranty" id="warranty">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">אחריות ותנאי השירות</h2>
      <div class="laptopia-board-content">
        <div class="laptopia-card"><h3>3 חודשי אחריות על התיקון</h3><p>היקף העבודה ותנאי האחריות יימסרו לפני אישור התיקון. אם נדרש טיפול ברכיבים נוספים, הוא יפורט בהצעה.</p></div>
      </div>
    <?php get_template_part( 'template-parts/warranty-exclusion' ); ?>
    </div>
  </section>
  <section class="laptopia-section laptopia-services laptopia-faq">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">שאלות נפוצות על שקעי טעינה ו־<?php echo laptopia_bidi_ltr( 'USB' ); ?></h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם תמיד צריך להחליף שקע שלא טוען?</h3><p>לא. ייתכן שהסיבה במטען, בחיבור או במעגלי ההזנה. מאבחנים לפני שקובעים מה לתקן.</p></div>
        <div class="laptopia-card"><h3>האם <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> תקול נפתר בהחלפת המחבר?</h3><p>לא בהכרח. בקר, רכיבי הזנה וקווי נתונים עלולים להיות מקור התקלה. הטיפול נקבע לפי הבדיקה.</p></div>
        <div class="laptopia-card"><h3>למה השקע עובד רק בזווית מסוימת?</h3><p>מחבר רופף, נזק להלחמות או בעיה בכבל יכולים לגרום לכך. לא ניתן לקבוע את הסיבה ללא בדיקה.</p></div>
        <div class="laptopia-card"><h3>האם כל <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> יכול להעביר תמונה?</h3><p>לא. האפשרויות תלויות בדגם ובמפרט השקע. בודקים תמיכה לפני שמייחסים את התופעה לתקלה.</p></div>
        <div class="laptopia-card"><h3>כמה זמן נמשך התיקון?</h3><p>משך העבודה תלוי בדגם, בסוג התקלה ובזמינות החלק הנדרש. פרטים נמסרים לאחר בדיקה.</p></div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array(
    'heading' => 'לתיאום בדיקת שקע טעינה או USB',
    'description' => 'שלחו את דגם המחשב ותארו מה קורה בחיבור המטען או ההתקן. נתאם מסירה לבדיקה במעבדה ברמלה.',
  ) ); ?>
</main>
<?php
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );
wp_footer();
?>
</body>
</html>
