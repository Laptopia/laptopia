<?php
/**
 * Template Name: Laptopia - תיקון שקעי טעינה למחשב נייד
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
      <h1 id="service-title">תיקון שקעי טעינה למחשב נייד ברמלה והסביבה</h1>
      <p>המחשב לא נטען, השקע רופף או שהטעינה מתנתקת? בודקים את המטען, את חיבור הטעינה ואת מעגלי ההזנה לפני שקובעים מה לתקן.</p>
      <div class="laptopia-board-price laptopia-service-cta"><span><span class="laptopia-price-card-label">שקע טעינה</span><span class="laptopia-service-price-amount"><?php echo laptopia_price_display( 'charging' ); ?></span></span></div>
      <p>המחיר והיקף העבודה נקבעים לאחר בדיקה ואישור הלקוח. תיקון טעינה ב-<?php echo laptopia_bidi_ltr( 'USB-C' ); ?> מתומחר לפי הדגם וממצאי הבדיקה.</p>
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
      <h2 class="laptopia-section-title">מתי צריך לבדוק את חיבור הטעינה?</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>המטען לא יושב היטב</h3><p>המטען לא נכנס היטב, צריך להחזיק אותו בזווית או שהטעינה מתנתקת. בודקים גם את המטען ואת התאמתו למחשב.</p></div>
        <div class="laptopia-card"><h3>שקע רופף, שבור או חם</h3><p>מחבר שנפגע פיזית או מתחמם מצדיק בדיקה. אין להפעיל עליו כוח כדי לנסות לייצב את החיבור.</p></div>
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'USB-C' ); ?> לא טוען</h3><p>הסיבה עשויה להיות במחבר, במטען, בבקר או במעגלי ההזנה. החלפת שקע לבדה אינה בהכרח הפתרון.</p></div>
        <div class="laptopia-card"><h3>המחשב פועל אך לא נטען</h3><p>גם כשהמחשב נדלק, ייתכן שיש בעיה בזיהוי המטען או במעגלי הטעינה. בודקים את מקור התקלה ולא מניחים שנדרשת החלפת שקע.</p></div>
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
      <h2>שלושה סוגים של חיבורי טעינה</h2>
      <h3>שקע טעינה עם כבל / מחבר פנימי</h3>
      <p>בחלק מהדגמים שקע הטעינה מחובר לכבל או למכלול פנימי, ולא מולחם ישירות ללוח האם. בודקים את השקע, את הכבל ואת המחבר הפנימי ומתאימים את הטיפול למבנה המחשב.</p>
      <h3>שקע טעינה מולחם ללוח</h3>
      <p>בשקע שמולחם ישירות ללוח בודקים גם את ההלחמות, את נקודות העיגון ואת אזור הלוח סביב המחבר. נזק באזור הזה עשוי לדרוש שיקום נוסף ולא רק החלפת שקע.</p>
      <h3>תיקון שקע <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> לטעינה</h3>
      <p>בחיבור <?php echo laptopia_bidi_ltr( 'USB-C / Type-C' ); ?> בודקים את המחבר והפינים, את החיבור ללוח ואת מעגלי הכניסה והטעינה. בדגמים התומכים בכך נבדק גם תהליך תיאום הטעינה בין המחשב למטען באמצעות <?php echo laptopia_bidi_ltr( 'USB Power Delivery' ); ?>. נתונים שעוברים בשקע אינם מוכיחים שמערכת הטעינה תקינה.</p>
      <p>לא כל שקע <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> מיועד לטעינת המחשב. התמיכה תלויה בדגם ובשקע המסוים, וגם המטען והכבל צריכים להתאים.</p>
      <p>אם הטעינה עובדת אך התקן, מסך או תחנת עגינה אינם מזוהים, ראו <a class="laptopia-context-link" href="<?php echo esc_url( home_url( '/peripheral-ports/' ) ); ?>">תיקון שקעי <?php echo laptopia_bidi_ltr( 'USB' ); ?> וחיבורים למחשב נייד</a>.</p>
      <h3>טיפול ברמת הרכיב לפי האבחון</h3>
      <p>אם התקלה עמוקה יותר, היקף העבודה נקבע לאחר בדיקה ונמסר לאישור. מידע נוסף נמצא בעמוד <a class="laptopia-context-link" href="<?php echo esc_url( home_url( '/motherboard-repair/' ) ); ?>">תיקון לוח אם למחשב נייד</a>.</p>
      <p>כאשר חוסר הטעינה עשוי להיות קשור לסוללה, אפשר לקרוא גם על <a class="laptopia-context-link" href="<?php echo esc_url( home_url( '/battery-replacement/' ) ); ?>">החלפת סוללה למחשב נייד</a>.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-prices" id="prices">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">כמה עולה תיקון חיבור הטעינה?</h2>
      <?php get_template_part( 'template-parts/pricing-panel', null, array(
          'price_key' => 'charging',
          'label' => 'החלפת שקע טעינה',
          'description' => 'המחיר הסופי תלוי בדגם, במצב המחבר ובממצאי הבדיקה. תיקון טעינה ב-USB-C, בקר או מעגלים נוספים מתומחר לפי היקף העבודה, לאחר אבחון ואישור הלקוח.',
      ) ); ?>
      <?php get_template_part( 'template-parts/consumer-price-note' ); ?>
    </div>
  </section>
  <?php get_template_part( 'template-parts/process', null, array(
    'title' => 'איך מתבצע תיקון חיבור הטעינה?',
    'steps' => array(
      array( 'title' => 'תיאום מראש', 'text' => 'שולחים דגם ותיאור התקלה ומתאמים מסירה.' ),
      array( 'title' => 'אבחון החיבור', 'text' => 'בודקים מטען, מחבר ומעגלי טעינה לפי התקלה.' ),
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
        <div class="laptopia-card laptopia-compact-notice"><h3>3 חודשי אחריות על התיקון</h3><p>היקף העבודה ותנאי האחריות יימסרו לפני אישור התיקון. אם נדרש טיפול ברכיבים נוספים, הוא יפורט בהצעה.</p></div>
      </div>
    <?php get_template_part( 'template-parts/warranty-exclusion' ); ?>
    </div>
  </section>
  <section class="laptopia-section laptopia-services laptopia-faq">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">שאלות נפוצות על חיבורי טעינה</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם תמיד צריך להחליף שקע שלא טוען?</h3><p>לא. ייתכן שהסיבה במטען, בחיבור או במעגלי ההזנה. מאבחנים לפני שקובעים מה לתקן.</p></div>
        <div class="laptopia-card"><h3>האם <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> תקול נפתר בהחלפת המחבר?</h3><p>לא בהכרח. מטען, בקר ורכיבי הזנה עלולים להיות מקור התקלה. הטיפול נקבע לפי הבדיקה.</p></div>
        <div class="laptopia-card"><h3>למה השקע עובד רק בזווית מסוימת?</h3><p>מחבר רופף, נזק להלחמות או בעיה בכבל יכולים לגרום לכך. לא ניתן לקבוע את הסיבה ללא בדיקה.</p></div>
        <div class="laptopia-card"><h3>האם כל <?php echo laptopia_bidi_ltr( 'USB-C' ); ?> יכול לטעון את המחשב?</h3><p>לא. האפשרויות תלויות בדגם ובמפרט השקע. בודקים תמיכה לפני שמייחסים את התופעה לתקלה.</p></div>
        <div class="laptopia-card"><h3>כמה זמן נמשך התיקון?</h3><p>משך העבודה תלוי בדגם, בסוג התקלה ובזמינות החלק הנדרש. פרטים נמסרים לאחר בדיקה.</p></div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array(
    'heading' => 'לתיאום בדיקת חיבור הטעינה',
    'description' => 'שלחו את דגם המחשב ותארו מה קורה בחיבור המטען. נתאם מסירה לבדיקה במעבדה ברמלה.',
  ) ); ?>
</main>
<?php
get_footer();
