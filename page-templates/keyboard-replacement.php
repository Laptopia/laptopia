<?php
/**
 * Template Name: Laptopia - החלפת מקלדת למחשב נייד
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
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/header', null, array(
    'service_link' => array(
        'href'  => '#keyboards',
        'label' => 'התאמת מקלדת',
    ),
) );
?>

<main dir="rtl">
  <nav class="laptopia-section laptopia-inner" aria-label="פירורי לחם">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">דף הבית</a> / <span aria-current="page">החלפת מקלדת למחשב נייד</span></p>
  </nav>

  <section class="laptopia-section laptopia-hero" aria-labelledby="keyboard-title">
    <div class="laptopia-hero-content">
      <h1 id="keyboard-title">החלפת מקלדת למחשב נייד ברמלה והסביבה</h1>
      <p>מקשים לא מגיבים, חסרים או מקלידים תווים באופן לא צפוי? במעבדת Laptopia ברמלה בודקים את מקור התקלה. כאשר נדרשת החלפת מקלדת, מתאימים את החלק לדגם המחשב ובודקים את זמינותו לפני אישור העבודה.</p>
      <div class="laptopia-board-price">החלפת מקלדת — החל מ־550 ₪</div>
      <p>המחיר הסופי תלוי בדגם, במקלדת הנדרשת ובמורכבות הפירוק וההרכבה.</p>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>לתיאום בדיקה בוואטסאפ</span></span></a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
      </div>
      <div class="laptopia-phone-line">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</div>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="keyboard-symptoms-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboard-symptoms-title">סימנים לתקלה במקלדת המחשב הנייד</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>מקשים שאינם מגיבים</h3><p>מקש בודד או קבוצת מקשים יכולים להפסיק להגיב. בודקים אם התקלה במקלדת, בחיבור שלה או במקום אחר.</p></div>
        <div class="laptopia-card"><h3>מקשים חסרים או שבורים</h3><p>נזק למקש או למנגנון שמתחתיו עלול להפריע להקלדה. האפשרות לטפל במקש בנפרד או הצורך בהחלפת המקלדת נבדקים לפי מצבה והדגם.</p></div>
        <div class="laptopia-card"><h3>הקלדה כפולה או לא צפויה</h3><p>תווים שחוזרים על עצמם או הקלדה ללא לחיצה מצדיקים בדיקה. התופעה לבדה אינה קובעת איזה חלק צריך להחליף.</p></div>
      </div>
      <figure class="laptopia-component-figure laptopia-screen-figure">
        <img src="https://laptopia.co.il/wp-content/uploads/2026/09/keyboard-damaged-hp.webp" alt="מקלדת מחשב נייד עם מקשים חסרים לפני החלפה" width="1254" height="1254" loading="lazy" decoding="async">
        <figcaption>מקלדת מחשב נייד עם מקשים חסרים לפני החלפה</figcaption>
      </figure>
    </div>
  </section>

  <section class="laptopia-section laptopia-board" aria-labelledby="keyboard-diagnosis-title">
    <div class="laptopia-board-content">
      <h2 id="keyboard-diagnosis-title">מתי נדרשת החלפה ומתי הסיבה אינה במקלדת?</h2>
      <p>החלפה מתאימה כאשר הבדיקה מצביעה על תקלה במקלדת או על נזק שאינו מאפשר שימוש תקין. לפני הזמנת חלק בודקים את התסמינים ואת מקורם.</p>
      <h3>הגדרות וחיבור המקלדת</h3>
      <p>פריסת שפה שגויה, הגדרות תוכנה או בעיה בחיבור יכולים להשפיע על ההקלדה. במקרים כאלה החלפת מקלדת אינה בהכרח הטיפול הנדרש.</p>
      <h3>נזקי נוזלים או תקלה בלוח האם</h3>
      <p>לאחר חדירת נוזלים ייתכן נזק מעבר למקלדת עצמה. אם מתגלה תקלה בלוח האם או ברכיב אחר, היקף הטיפול והמחיר יימסרו לאישור בנפרד.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" id="keyboards" aria-labelledby="keyboards-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboards-title">אילו מקלדות ניתן להחליף?</h2>
      <p class="laptopia-section-subtitle">בודקים אפשרויות החלפה לפי הדגם המדויק, מבנה המחשב ומפרט המקלדת. זמינות החלק נבדקת לכל מחשב בנפרד.</p>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>מקלדת נפרדת או מכלול עליון</h3><p>אופן ההחלפה תלוי במבנה הדגם. בחלק מהמחשבים המקלדת נפרדת ובאחרים העבודה עשויה לכלול את המכלול העליון.</p></div>
        <div class="laptopia-card"><h3>שפה ופריסת המקשים</h3><p>בודקים את פריסת המקשים והשפות של החלק המוצע ומבהירים את הפרטים לפני הזמנתו.</p></div>
        <div class="laptopia-card"><h3>תאורה וכפתור הפעלה</h3><p>במקלדות עם תאורה או כפתור הפעלה משולב בודקים גם את התאמת התכונות והחיבורים לדגם.</p></div>
      </div>
      <figure class="laptopia-component-figure laptopia-screen-figure">
        <img src="https://laptopia.co.il/wp-content/uploads/2026/09/asus-keyboard-replacement-original-clean-e1789160656975.webp" alt="החלפת מקלדת RGB במחשב נייד ASUS עקב תקלה בכפתור ההפעלה" width="792" height="1104" loading="lazy" decoding="async">
        <figcaption>החלפת מקלדת RGB במחשב נייד ASUS בעקבות תקלה בכפתור ההפעלה</figcaption>
      </figure>
    </div>
  </section>

  <section class="laptopia-section laptopia-process" aria-labelledby="keyboard-process-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboard-process-title">איך מתבצעת החלפת המקלדת?</h2>
      <div class="laptopia-process-grid">
        <div class="laptopia-step"><div class="laptopia-step-number">1</div><h3>תיאום מסירה</h3><p>שולחים את דגם המחשב ותיאור התקלה ומתאמים הגעה למעבדה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">2</div><h3>אבחון</h3><p>בודקים את המקשים ואת מקור הבעיה לפני החלטה על החלפה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">3</div><h3>התאמה והצעת מחיר</h3><p>בודקים התאמה וזמינות של מקלדת ומוסרים הצעת מחיר לאישור.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">4</div><h3>החלפה ובדיקה</h3><p>לאחר אישור הלקוח מחליפים את החלק ובודקים את פעולת המקלדת.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">5</div><h3>איסוף</h3><p>מודיעים כאשר המחשב מוכן לאיסוף מהמעבדה.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-prices" id="prices" aria-labelledby="keyboard-prices-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboard-prices-title">כמה עולה החלפת מקלדת למחשב נייד?</h2>
      <div class="laptopia-diagnostic">
        <strong>החלפת מקלדת — החל מ־550 ₪</strong>
        <p>המחיר תלוי בדגם, בסוג המקלדת ובאופן התקנתה. הצעת המחיר נמסרת לפני העבודה, וההחלפה מתבצעת לאחר אישור הלקוח.</p>
        <h3>דמי אבחון</h3>
        <p>במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון, דמי האבחון הם 150 ₪.</p>
        <p>אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-warranty" id="warranty" aria-labelledby="keyboard-warranty-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboard-warranty-title">אחריות ותנאי ההחלפה</h2>
      <div class="laptopia-board-content">
        <div class="laptopia-card"><h3>פרטי החלק והאחריות לפני אישור</h3><p>סוג המקלדת המוצעת, תנאי האחריות והיקף העבודה יימסרו לפני אישור ההחלפה. אם נדרש טיפול נוסף מעבר למקלדת, הוא יפורט בהצעה.</p></div>
      </div>
      <p class="laptopia-price-note"><a href="<?php echo esc_url( home_url( '/#warranty' ) ); ?>">למידע על האחריות</a></p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="keyboard-geography-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboard-geography-title">החלפת מקלדת ברמלה והסביבה</h2>
      <p class="laptopia-section-subtitle">מעבדת Laptopia נמצאת ברחוב אלמוג 2, רמלה. אנו מקבלים מחשבים מלקוחות ברמלה, לוד, באר יעקב, ראשון לציון ורחובות.</p>
      <p class="laptopia-price-note">מסירת המחשב מתבצעת במעבדה ברמלה, בתיאום מראש בלבד.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="keyboard-faq-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="keyboard-faq-title">שאלות נפוצות על החלפת מקלדת</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם אפשר להחליף רק מקש אחד?</h3><p>האפשרות תלויה במצב המקש והמנגנון, בדגם ובזמינות החלק המתאים. בודקים אם טיפול נקודתי אפשרי או שנדרשת החלפת המקלדת.</p></div>
        <div class="laptopia-card"><h3>האם מקשים שלא מגיבים מחייבים החלפה?</h3><p>לא בהכרח. בודקים גם הגדרות, חיבורים ותקלות אפשריות ברכיבים אחרים לפני שקובעים מה צריך לתקן.</p></div>
        <div class="laptopia-card"><h3>האם יש מקלדת מתאימה לדגם שלי?</h3><p>שלחו את הדגם המדויק. נבדוק התאמה, פריסה וזמינות של חלק מתאים; אין התחייבות למלאי לכל דגם.</p></div>
        <div class="laptopia-card"><h3>כמה זמן נמשכת ההחלפה?</h3><p>משך העבודה תלוי בדגם המחשב, בזמינות המקלדת ובסוג התקלה.</p></div>
        <div class="laptopia-card"><h3>מה המחיר ואילו תנאים נמסרים מראש?</h3><p>המחיר מתחיל ב־550 ₪. המחיר הסופי, פרטי המקלדת ותנאי האחריות נמסרים לאישור לפני ההחלפה.</p></div>
        <div class="laptopia-card"><h3>צריך לתאם לפני ההגעה?</h3><p>כן. פנו בוואטסאפ או בטלפון לתיאום מסירת המחשב למעבדה ברמלה.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-contact" id="contact" aria-labelledby="keyboard-contact-title">
    <div class="laptopia-contact-content">
      <h2 id="keyboard-contact-title">לתיאום בדיקת מקלדת ב־Laptopia</h2>
      <p class="laptopia-contact-intro">שלחו את דגם המחשב ותיאור הבעיה במקשים. נתאם את מסירת המחשב לבדיקה במעבדה.</p>
      <div class="laptopia-contact-info">
        <div class="laptopia-info-box"><div class="laptopia-info-value">אלמוג 2, רמלה</div></div>
        <div class="laptopia-info-box"><div class="laptopia-info-value"><bdi dir="ltr">053-803-6244</bdi></div></div>
      </div>
      <p class="laptopia-contact-note">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</p>
      <?php get_template_part( 'template-parts/service-contact-actions' ); ?>
    </div>
  </section>
</main>

<?php
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );
wp_footer();
?>
</body>
</html>
