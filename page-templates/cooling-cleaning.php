<?php
/**
 * Template Name: Laptopia - ניקוי מערכת קירור למחשב נייד
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
        'href'  => '#cleaning',
        'label' => 'מה כולל השירות',
    ),
) );
?>

<main dir="rtl">
  <nav class="laptopia-section laptopia-inner" aria-label="פירורי לחם">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">דף הבית</a> / <span aria-current="page">ניקוי מערכת קירור למחשב נייד</span></p>
  </nav>

  <section class="laptopia-section laptopia-hero" aria-labelledby="cooling-title">
    <div class="laptopia-hero-content">
      <h1 id="cooling-title">ניקוי מערכת קירור למחשב נייד ברמלה והסביבה</h1>
      <p>המחשב מתחמם, המאוורר רועש או שהביצועים יורדים בזמן עבודה? במעבדת Laptopia ברמלה בודקים את מערכת הקירור ואת הצורך בניקוי. הצטברות אבק יכולה לפגוע בזרימת האוויר, אך לא כל התחממות נפתרת בניקוי בלבד.</p>
      <div class="laptopia-board-price">ניקוי מערכת קירור — החל מ־300 ₪</div>
      <p>המחיר הסופי נקבע לפי דגם המחשב, מצבו והעבודה הנדרשת. הטיפול מתבצע לאחר אישור הלקוח.</p>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener">לתיאום בדיקה בוואטסאפ</a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244">התקשרו למעבדה</a>
      </div>
      <div class="laptopia-phone-line">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</div>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="cooling-symptoms-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="cooling-symptoms-title">מתי כדאי לבדוק את מערכת הקירור?</h2>
      <p class="laptopia-section-subtitle">אבק במאוורר ובמעברי האוויר עלול להקשות על פינוי החום. שינוי בהתנהגות המחשב מצדיק בדיקה של הסיבה, לפני שמחליטים איזה טיפול לבצע.</p>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>חום חריג בזמן עבודה</h3><p>אם המחשב חם מהרגיל באותו סוג שימוש, ייתכן שזרימת האוויר נפגעה. גם עומס תוכנה, משטח שחוסם את הפתחים או תקלה אחרת יכולים להשפיע.</p></div>
        <div class="laptopia-card"><h3>מאוורר רועש לאורך זמן</h3><p>מאוורר שפועל בעוצמה גבוהה עשוי להעיד על מאמץ לפנות חום. רעש מכני יכול לנבוע גם מבלאי במאוורר, ולכן נדרש אבחון.</p></div>
        <div class="laptopia-card"><h3>האטה או כיבוי תחת עומס</h3><p>ירידה בביצועים או כיבוי בזמן עבודה יכולים להיות קשורים להתחממות, אך אינם מוכיחים שהבעיה במערכת הקירור. בודקים את מקור התקלה.</p></div>
      </div>
      <figure class="laptopia-component-figure laptopia-screen-figure">
        <img src="https://laptopia.co.il/wp-content/uploads/2026/09/cooling-before.webp" alt="מערכת קירור של מחשב נייד סתומה באבק לפני ניקוי" width="573" height="573" loading="lazy" decoding="async">
        <figcaption>מערכת קירור סתומה באבק לפני ניקוי</figcaption>
      </figure>
    </div>
  </section>

  <section class="laptopia-section laptopia-board" id="cleaning" aria-labelledby="cleaning-title">
    <div class="laptopia-board-content">
      <h2 id="cleaning-title">מה כולל ניקוי מערכת הקירור?</h2>
      <p>הטיפול מותאם למבנה המחשב ולמצב מערכת הקירור. לאחר בדיקה קובעים את היקף הניקוי והתחזוקה הנדרשים ומוסרים הצעת מחיר לאישור.</p>
      <h3>גישה למערכת וניקוי האבק</h3>
      <p>פותחים את המחשב בהתאם למבנה הדגם ומנקים אבק שהצטבר במערכת הקירור ובמעברי האוויר הנגישים. המטרה היא להסיר חסימות שמפריעות לזרימת האוויר.</p>
      <h3>בדיקת הצורך בתחזוקה נוספת</h3>
      <p>בודקים אם נדרש טיפול נוסף מעבר לניקוי, למשל במאוורר או בחומר התרמי. הצורך בטיפול והכללתו בהצעה נקבעים לאחר בדיקה; החלפת חלקים אינה כלולה אוטומטית במחיר ההתחלתי.</p>
      <h3>הרכבה ובדיקת פעולה</h3>
      <p>לאחר הניקוי מרכיבים את המחשב ובודקים את פעולתו. התוצאה תלויה גם במצב הרכיבים ובמקור ההתחממות, ואין התחייבות לירידה קבועה בטמפרטורה.</p>
    </div>
    <div class="laptopia-component-gallery">
      <figure class="laptopia-component-figure">
        <img src="https://laptopia.co.il/wp-content/uploads/2026/09/cooling-after-open.webp" alt="מערכת קירור של מחשב נייד לאחר ניקוי ותחזוקה" width="573" height="573" loading="lazy" decoding="async">
        <figcaption>מערכת הקירור לאחר ניקוי ותחזוקה</figcaption>
      </figure>
      <figure class="laptopia-component-figure">
        <img src="https://laptopia.co.il/wp-content/uploads/2026/09/cooling-after-complete.webp" alt="מחשב נייד לאחר ניקוי מערכת הקירור והרכבה" width="573" height="573" loading="lazy" decoding="async">
        <figcaption>המחשב לאחר ניקוי מערכת הקירור והרכבה</figcaption>
      </figure>
    </div>
  </section>

  <section class="laptopia-section laptopia-process" aria-labelledby="cooling-process-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="cooling-process-title">איך מתבצע הטיפול במעבדה?</h2>
      <div class="laptopia-process-grid">
        <div class="laptopia-step"><div class="laptopia-step-number">1</div><h3>תיאום מראש</h3><p>שולחים את דגם המחשב ותיאור התופעה ומתאמים מסירה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">2</div><h3>בדיקת המחשב</h3><p>בודקים את מערכת הקירור ואת הגורמים האפשריים להתחממות.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">3</div><h3>הצעת מחיר</h3><p>מגדירים את הטיפול הנדרש ומוסרים מחיר לאישור.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">4</div><h3>ניקוי ותחזוקה</h3><p>מבצעים את העבודה שאושרה, מרכיבים ובודקים את המחשב.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">5</div><h3>איסוף המחשב</h3><p>מודיעים כאשר המחשב מוכן לאיסוף מהמעבדה.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-prices" id="prices" aria-labelledby="cooling-prices-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="cooling-prices-title">כמה עולה ניקוי מערכת קירור למחשב נייד?</h2>
      <div class="laptopia-diagnostic">
        <strong>ניקוי מערכת קירור — החל מ־300 ₪</strong>
        <p>העלות תלויה בדגם, בגישה למערכת ובהיקף העבודה. אם מתגלה צורך בתיקון או בהחלפת רכיב, המחיר יימסר לאישור לפני ביצועו.</p>
        <h3>דמי אבחון</h3>
        <p>במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון, דמי האבחון הם 150 ₪.</p>
        <p>אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-warranty" id="warranty" aria-labelledby="cooling-warranty-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="cooling-warranty-title">אחריות והיקף הטיפול</h2>
      <div class="laptopia-board-content">
        <div class="laptopia-card"><h3>תנאים בהתאם לעבודה שבוצעה</h3><p>תנאי האחריות יובהרו בהתאם לסוג הטיפול והרכיב. ניקוי אינו מבטיח שהמחשב לא יצבור אבק מחדש או שכל תקלה הגורמת להתחממות תיפתר.</p></div>
      </div>
      <p class="laptopia-price-note"><a href="<?php echo esc_url( home_url( '/#warranty' ) ); ?>">למידע על האחריות</a></p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="cooling-geography-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="cooling-geography-title">ניקוי מחשבים ניידים ברמלה והסביבה</h2>
      <p class="laptopia-section-subtitle">מעבדת Laptopia נמצאת ברחוב אלמוג 2, רמלה, ומקבלת מחשבים מלקוחות ברמלה, לוד, באר יעקב, ראשון לציון ורחובות.</p>
      <p class="laptopia-price-note">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="cooling-faq-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="cooling-faq-title">שאלות נפוצות על ניקוי מערכת קירור</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם ניקוי תמיד פותר התחממות?</h3><p>לא. אבק הוא גורם אפשרי, אך גם תקלה במאוורר או בעיה אחרת עשויות להשפיע. הבדיקה מסייעת לקבוע איזה טיפול מתאים.</p></div>
        <div class="laptopia-card"><h3>האם החלפת משחה תרמית כלולה?</h3><p>הצורך בטיפול בחומר התרמי והכללתו במחיר נקבעים לפי הדגם וממצאי הבדיקה. היקף העבודה יפורט בהצעה לפני האישור.</p></div>
        <div class="laptopia-card"><h3>כל כמה זמן כדאי לנקות?</h3><p>התדירות תלויה בסביבת העבודה, בשימוש ובמצב המחשב. אם מופיעים חום חריג, רעש או שינוי בביצועים, כדאי לפנות לבדיקה.</p></div>
        <div class="laptopia-card"><h3>כמה זמן נמשך הטיפול?</h3><p>משך העבודה תלוי בדגם המחשב, במצב מערכת הקירור ובסוג התקלה. אם נדרש חלק נוסף, גם זמינותו יכולה להשפיע.</p></div>
        <div class="laptopia-card"><h3>כמה עולה הניקוי?</h3><p>ניקוי מערכת קירור מתחיל ב־300 ₪. המחיר הסופי נקבע לפי היקף העבודה ונמסר לאישור מראש.</p></div>
        <div class="laptopia-card"><h3>האם צריך לתאם הגעה?</h3><p>כן. פנו בוואטסאפ או בטלפון לתיאום מסירת המחשב למעבדה ברמלה.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-contact" id="contact" aria-labelledby="cooling-contact-title">
    <div class="laptopia-contact-content">
      <h2 id="cooling-contact-title">לתיאום בדיקת מערכת הקירור ב־Laptopia</h2>
      <p class="laptopia-contact-intro">שלחו את דגם המחשב ותארו מתי מופיעים החום, הרעש או ההאטה. נתאם את מסירת המחשב לבדיקה.</p>
      <div class="laptopia-contact-info">
        <div class="laptopia-info-box"><div class="laptopia-info-value">אלמוג 2, רמלה</div></div>
        <div class="laptopia-info-box"><div class="laptopia-info-value"><bdi dir="ltr">053-803-6244</bdi></div></div>
      </div>
      <p class="laptopia-contact-note">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</p>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener">שלחו הודעה בוואטסאפ</a>
        <a class="laptopia-btn laptopia-btn-white" href="tel:+972538036244">התקשרו למעבדה</a>
        <a class="laptopia-btn laptopia-btn-white" href="<?php echo esc_url( home_url( '/#services' ) ); ?>">לכל שירותי המעבדה</a>
      </div>
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
