<?php
/**
 * Template Name: Laptopia - תיקון צירים ופלסטיקה למחשב נייד
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
    'service_link' => array( 'href' => '#hinges', 'label' => 'בדיקת צירים ומארז' ),
) ); ?>
<main dir="rtl">
  <section class="laptopia-section laptopia-hero" aria-labelledby="service-title">
    <div class="laptopia-hero-content">
      <h1 id="service-title">תיקון צירים ופלסטיקה למחשב נייד ברמלה והסביבה</h1>
      <p>ציר קשה, מסגרת שנפתחת או מכסה שמתרומם יכולים להעיד על נזק בציר או בנקודות העיגון שלו. במעבדת Laptopia ברמלה בודקים את המכלול לפני שמציעים שיקום חיבורים או החלפת חלקי מארז.</p>
      <div class="laptopia-service-price-grid">
        <div class="laptopia-board-price laptopia-service-cta"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'hinge' ) ); ?><span><span class="laptopia-price-card-label">תיקון צירים</span><span class="laptopia-service-price-amount">החל מ־<bdi dir="ltr">500 ₪</bdi></span></span></div>
        <div class="laptopia-board-price laptopia-service-cta"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'hinge' ) ); ?><span><span class="laptopia-price-card-label">תיקון פלסטיקה / מארז</span><span class="laptopia-service-price-amount">החל מ־<bdi dir="ltr">700 ₪</bdi></span></span></div>
      </div>
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
      <h2 class="laptopia-section-title">מתי כדאי לבדוק צירים ופלסטיקה?</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>ציר קשה או שבור</h3><p>פתיחה קשה, תנועה לא רגילה או ציר שבור מצדיקים בדיקה. אין להמשיך לפתוח בכוח.</p></div>
        <div class="laptopia-card"><h3>הציר יצא מהמקום</h3><p>לפעמים הציר עצמו תקין, אך נקודות העיגון בפלסטיקה סביבו נשברו.</p></div>
        <div class="laptopia-card"><h3>מסגרת או מכסה שנפתחים</h3><p>מסגרת שנפרדת או מכסה מסך שמתרומם בזמן הפתיחה עשויים להעיד על נזק בחיבורים.</p></div>
        <div class="laptopia-card"><h3>שבר במארז</h3><p>סדקים באזור משענת הידיים, המכסה התחתון או מסגרת המסך נבדקים יחד עם מבנה המכלול.</p></div>
      </div>
    </div>
  </section>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section" id="hinges">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>מה בודקים לפני תיקון צירים ופלסטיקה?</h2>
      <h3>הציר ונקודות העיגון</h3>
      <p>בודקים את התנגדות הציר, הברגים ונקודות העיגון במארז. חשוב להבחין בין ציר פגום לבין שבר בחלק שמחזיק אותו.</p>
      <h3>חלקי המארז סביב הציר</h3>
      <p>בודקים את משענת הידיים והמכלול העליון, המכסה התחתון, מכסה המסך והמסגרת בהתאם למבנה הדגם.</p>
      <h3>מסך וחיבורים סמוכים</h3>
      <p>בודקים אם הנזק השפיע גם על המסך או על חיבורים סמוכים. כאשר נדרשת החלפת מסך, ראו <a href="<?php echo esc_url( home_url( '/screen-replacement/' ) ); ?>">החלפת מסך למחשב נייד</a>.</p>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-case', null, array(
    'heading' => 'דוגמה מתיקון אמיתי',
    'description' => 'במקרה זה הציר נעקר ממקומו ופגע באזור החיבור במארז. בוצע שיקום של אזור העיגון, חיזוק הציר והרכבה מחדש של המחשב.',
    'images' => array(
      array(
        'src' => 'https://laptopia.co.il/wp-content/uploads/2026/09/hinge-damage-1.webp',
        'caption' => 'לפני',
        'alt' => 'ציר מחשב נייד שנעקר מהמארז לפני תיקון',
        'width' => 573,
        'height' => 573,
      ),
      array(
        'src' => 'https://laptopia.co.il/wp-content/uploads/2026/09/hinge-damage-2.webp',
        'caption' => 'אזור הנזק',
        'alt' => 'נזק באזור הציר והפלסטיקה של מחשב נייד',
        'width' => 573,
        'height' => 573,
      ),
      array(
        'src' => 'https://laptopia.co.il/wp-content/uploads/2026/09/hinge-repair-after.webp',
        'caption' => 'אחרי',
        'alt' => 'מחשב נייד ASUS לאחר תיקון ציר ופלסטיקה',
        'width' => 573,
        'height' => 573,
      ),
    ),
  ) ); ?>
  <?php get_template_part( 'template-parts/process', null, array(
    'title' => 'איך מתבצע הטיפול בצירים ובמארז?',
    'steps' => array(
      array( 'title' => 'תיאום מראש', 'text' => 'שולחים דגם ותיאור הנזק ומתאמים הגעה.' ),
      array( 'title' => 'בדיקת המכלול', 'text' => 'בודקים צירים, נקודות עיגון וחלקי מארז.' ),
      array( 'title' => 'בחירת טיפול', 'text' => 'מציעים דרך טיפול ומחיר לאישור הלקוח.' ),
      array( 'title' => 'עבודה ובדיקה', 'text' => 'מבצעים את הטיפול המאושר ובודקים פתיחה וסגירה.' ),
      array( 'title' => 'איסוף', 'text' => 'מודיעים כשהמחשב מוכן לאיסוף.' ),
    ),
  ) ); ?>
  <section class="laptopia-section laptopia-prices" id="prices">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">כמה עולה תיקון צירים ופלסטיקה?</h2>
      <div class="laptopia-service-price-grid">
        <div class="laptopia-card laptopia-price-card">
          <div class="laptopia-service-icon" aria-hidden="true"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'hinge' ) ); ?></div>
          <h3>תיקון צירים</h3>
          <p class="laptopia-price-card-value">החל מ־500 ₪</p>
        </div>
        <div class="laptopia-card laptopia-price-card">
          <div class="laptopia-service-icon" aria-hidden="true"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'hinge' ) ); ?></div>
          <h3>תיקון פלסטיקה / מארז</h3>
          <p class="laptopia-price-card-value">החל מ־700 ₪</p>
        </div>
      </div>
      <p class="laptopia-price-note">המחיר תלוי במבנה הדגם, בחלקים שנפגעו ובזמינות החלקים הנדרשים. דרך הטיפול והמחיר נקבעים לאחר בדיקה ואישור הלקוח.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>שיקום עיגונים או החלפת חלק מארז?</h2>
      <h3>שיקום לפי מצב החיבור</h3>
      <p>בחלק מהמקרים ניתן לשקול שיקום נקודות עיגון. האפשרות נבדקת לפי מצב החומר, היקף הנזק והמבנה; אין התחייבות לשיטה לפני הבדיקה.</p>
      <h3>החלפה כאשר היא מתאימה</h3>
      <p>לעיתים החלפת חלק מארז היא האפשרות המתאימה או המשתלמת יותר. בודקים התאמה וזמינות ומציגים את האפשרות לפני העבודה.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-warranty" id="warranty">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">אחריות ותנאי השירות</h2>
      <div class="laptopia-board-content">
        <div class="laptopia-card"><h3>3 חודשי אחריות על התיקון</h3><p>פרטי הטיפול ותנאי האחריות יימסרו לפני אישור העבודה. ההצעה תבהיר אילו חלקים וחיבורים נכללים בטיפול.</p></div>
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
      <h2 class="laptopia-section-title">שאלות נפוצות על צירים ופלסטיקה</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם ציר שיצא מהמקום חייב החלפה?</h3><p>לא בהכרח. לפעמים הנזק הוא בנקודות העיגון בפלסטיקה ולא בציר עצמו. בודקים את שניהם.</p></div>
        <div class="laptopia-card"><h3>האם אפשר לשקם את הפלסטיקה?</h3><p>האפשרות תלויה במצב המארז ובהיקף השבר. לאחר בדיקה מציעים שיקום או החלפה לפי הצורך.</p></div>
        <div class="laptopia-card"><h3>האם תמיד מחליפים את כל המארז?</h3><p>לא. בודקים אילו חלקים נפגעו ומה אפשר להחליף בנפרד בדגם המסוים.</p></div>
        <div class="laptopia-card"><h3>אפשר להמשיך לפתוח ולסגור את המחשב?</h3><p>אם הציר קשה או המסגרת נפרדת, אין להפעיל כוח. מומלץ לתאם בדיקה כדי לא להחמיר את הנזק.</p></div>
        <div class="laptopia-card"><h3>כמה זמן נמשך הטיפול?</h3><p>משך העבודה תלוי בדגם, במצב החיבורים ובזמינות החלקים. לא נקבע זמן קבוע לפני הבדיקה.</p></div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array(
    'heading' => 'לתיאום בדיקת צירים ופלסטיקה',
    'description' => 'שלחו את דגם המחשב ותיאור הנזק במארז או בצירים. נתאם מסירה לבדיקה במעבדה ברמלה.',
  ) ); ?>
</main>
<?php
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );
wp_footer();
?>
</body>
</html>
