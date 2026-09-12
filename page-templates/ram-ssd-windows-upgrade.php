<?php
/**
 * Template Name: Laptopia - שדרוג זיכרון ו־SSD והתקנת מערכת הפעלה
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
<?php get_template_part( 'template-parts/header', null, array(
    'service_link' => array( 'href' => '#upgrades', 'label' => 'התאמת זיכרון ו־SSD' ),
) ); ?>
<main dir="rtl">
  <section class="laptopia-section laptopia-hero" aria-labelledby="service-title">
    <div class="laptopia-hero-content">
      <h1 id="service-title">שדרוג זיכרון ו־SSD והתקנת מערכת הפעלה למחשב נייד ברמלה והסביבה</h1>
      <p>מחשב איטי או צורך בנפח נוסף אינם מצביעים תמיד על אותו פתרון. ב־Laptopia ברמלה בודקים התאמת זיכרון RAM, כונן SSD והתקנת מערכת הפעלה לפי הדגם, מצב המחשב והצרכים שלכם.</p>
      <div class="laptopia-board-price laptopia-service-cta"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'upgrade' ) ); ?><span>התקנת מערכת הפעלה — 300 ₪</span></div>
      <p>המחיר והיקף העבודה נקבעים לאחר בדיקה ואישור הלקוח.</p>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>שלחו הודעה ב-WhatsApp</span></span></a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
      </div>
      <div class="laptopia-phone-line">קבלת מחשבים במעבדה בתיאום מראש בלבד</div>
    </div>
  </section>
  <section class="laptopia-section laptopia-services">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">מתי כדאי לבדוק שדרוג או התקנת מערכת?</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>איטיות בריבוי משימות</h3><p>מחסור בזיכרון עשוי להשפיע על עבודה עם כמה תוכנות. בודקים את השימוש ואת האפשרות לשדרוג לפני רכישת רכיב.</p></div>
        <div class="laptopia-card"><h3>נפח אחסון שאינו מספיק</h3><p>כונן מלא או צורך בנפח נוסף מצדיקים בדיקת אפשרויות SSD המתאימות למחשב.</p></div>
        <div class="laptopia-card"><h3>כונן ישן או חשוד בתקלה</h3><p>ניתן לבדוק החלפת HDD ב־SSD או החלפת SSD תקול. מצב הכונן הקיים משפיע על אפשרות העברת המידע.</p></div>
        <div class="laptopia-card"><h3>מערכת שאינה פועלת כרגיל</h3><p>שגיאות או קושי בהפעלה עשויים להיות קשורים לתוכנה או לחומרה. לפני התקנה מחדש מאבחנים את מקור הבעיה.</p></div>
      </div>
    </div>
  </section>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section" id="upgrades">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>זיכרון, SSD ומערכת הפעלה — שלושה טיפולים שונים</h2>
      <h3>התאמת זיכרון RAM</h3>
      <p>בודקים סוג זיכרון, נפח נתמך ומספר חריצים. בחלק מהמחשבים הזיכרון מולחם ואינו ניתן לשדרוג רגיל; בדגמים אחרים יש חריץ אחד או שניים. ההתאמה תלויה בדגם ובפלטפורמה.</p>
      <h3>התאמת SSD והעברת מידע</h3>
      <p>בודקים חיבור SATA או NVMe, מבנה הכונן והנפח הרצוי לפי הדגם. לא כל מחשב תומך בכל NVMe. העברת מערכת או מידע אפשרית רק בהתאם למצב הכונן ולתנאים הטכניים.</p>
      <h3>התקנת מערכת הפעלה</h3>
      <p>העבודה כוללת התקנת Windows, מנהלי התקנים, עדכוני Windows ובדיקת מערכת בסיסית. התקנה אינה מבטיחה פתרון של תקלה חומרתית.</p>
    </div>
  </section>
  <?php get_template_part( 'template-parts/process', null, array(
    'title' => 'איך מתבצע השדרוג או התקנת המערכת?',
    'steps' => array(
      array( 'title' => 'תיאום מראש', 'text' => 'שולחים דגם, צרכים ותיאור הבעיה.' ),
      array( 'title' => 'בדיקת התאמה', 'text' => 'בודקים זיכרון, כונן ומצב מערכת לפי הצורך.' ),
      array( 'title' => 'הצעת מחיר', 'text' => 'מפרטים רכיבים, עבודה וטיפול במידע לאישור.' ),
      array( 'title' => 'ביצוע ובדיקה', 'text' => 'מבצעים את העבודה המאושרת ובודקים את המערכת.' ),
      array( 'title' => 'איסוף', 'text' => 'מודיעים כשהמחשב מוכן לאיסוף.' ),
    ),
  ) ); ?>
  <section class="laptopia-section laptopia-prices" id="prices">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">מחירי שדרוג והתקנת מערכת הפעלה</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>שדרוג זיכרון RAM</h3><p>מחיר בהתאם לדגם ולנפח</p></div>
        <div class="laptopia-card"><h3>שדרוג או החלפת SSD</h3><p>מחיר בהתאם לדגם, לסוג ולנפח</p></div>
        <div class="laptopia-card"><h3>התקנת מערכת הפעלה</h3><p>300 ₪</p></div>
      </div>
      <p class="laptopia-price-note">מחירי RAM ו־SSD נקבעים לפי הרכיב המתאים והיקף העבודה. הצעת המחיר נמסרת לפני הביצוע; אין מחיר קבוע לשדרוג ללא בדיקת התאמה.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>התאמה, מצב הכונן ושמירת מידע</h2>
      <h3>אבחון לפני בחירת פתרון</h3>
      <p>איטיות או שגיאה בהפעלה יכולות לנבוע מזיכרון, כונן, תוכנה או רכיב אחר. מידע על בדיקה ותמחור נמצא ב<a href="<?php echo esc_url( home_url( '/#prices' ) ); ?>">מחירון המעבדה ותנאי האבחון</a>.</p>
      <h3>גיבוי והעברת מידע</h3>
      <p>גיבוי או העברת מידע מתבצעים בנפרד ובהתאם למצב הכונן ולבקשת הלקוח. לא מניחים שהתקנה מחדש תשמור את המידע הקיים; מסכמים את הטיפול במידע מראש.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-warranty" id="warranty">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">אחריות ותנאי השירות</h2>
      <div class="laptopia-board-content">
        <div class="laptopia-card"><h3>תנאי השירות והאחריות לפני אישור</h3><p>פרטי הרכיבים המוצעים, תנאי האחריות והיקף התקנת המערכת יימסרו לפני אישור העבודה. טיפול במידע נבדק ומתואם בנפרד.</p></div>
      </div>
    </div>
  </section>
  <section class="laptopia-section laptopia-services">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">שירות במעבדת Laptopia ברמלה והסביבה</h2>
      <p class="laptopia-section-subtitle">המעבדה נמצאת ברחוב אלמוג 2, רמלה. אנו מקבלים מחשבים מלקוחות ברמלה, לוד, באר יעקב, ראשון לציון ורחובות.</p>
      <p class="laptopia-price-note">קבלת מחשבים במעבדה בתיאום מראש בלבד</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-services laptopia-faq">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">שאלות נפוצות על זיכרון, SSD ו־Windows</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם אפשר להוסיף זיכרון לכל מחשב נייד?</h3><p>לא. זיכרון מולחם, מספר חריצים ומגבלות הנפח משתנים לפי הדגם. בודקים את האפשרויות לפני הצעה.</p></div>
        <div class="laptopia-card"><h3>האם כל מחשב תומך בכונן NVMe?</h3><p>לא. סוג החיבור, מבנה הכונן ותמיכת המחשב נבדקים לפי הדגם. בחלק מהדגמים נדרש SSD מסוג SATA.</p></div>
        <div class="laptopia-card"><h3>האם אפשר להעביר את המידע מהכונן הישן?</h3><p>האפשרות תלויה במצב הכונן ובגישה למידע. גיבוי או העברה מתואמים בנפרד; אין התחייבות לשמירת נתונים ללא בדיקה.</p></div>
        <div class="laptopia-card"><h3>מה כוללת התקנת מערכת הפעלה ב־300 ₪?</h3><p>התקנת Windows, מנהלי התקנים, עדכוני Windows ובדיקת מערכת בסיסית. טיפול במידע מתבצע בנפרד לפי הבקשה והמצב.</p></div>
        <div class="laptopia-card"><h3>האם שדרוג יפתור כל איטיות?</h3><p>לא בהכרח. מאבחנים את מקור האיטיות ומתאימים את ההצעה לממצאים ולדגם.</p></div>
        <div class="laptopia-card"><h3>כמה זמן נמשכת העבודה?</h3><p>משך העבודה תלוי בדגם, בזמינות הרכיבים, במצב הכונן ובהיקף העבודה שאושר.</p></div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array(
    'heading' => 'לתיאום בדיקת שדרוג או התקנת מערכת',
    'description' => 'שלחו את דגם המחשב ותארו את הצורך בזיכרון, אחסון או התקנת מערכת. נתאם בדיקה והצעה במעבדה ברמלה.',
  ) ); ?>
</main>
<?php
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );
wp_footer();
?>
</body>
</html>
