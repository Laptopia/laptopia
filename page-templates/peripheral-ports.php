<?php
/**
 * Template Name: Laptopia - תיקון שקעי USB וחיבורים במחשב נייד
 * Template Post Type: page
 */
defined( 'ABSPATH' ) || exit;
get_template_part( 'template-parts/page-shell-start', null, array(
    'body_classes' => array( 'laptopia-service-page' ),
    'background_mode' => 'ports',
) );
?>
<main dir="rtl">
  <section class="laptopia-section laptopia-hero" aria-labelledby="service-title">
    <div class="laptopia-hero-content">
      <h1 id="service-title">תיקון שקעי <?php echo laptopia_bidi_ltr( 'USB' ); ?> וחיבורים במחשב נייד ברמלה</h1>
      <p>התקן לא מזוהה, מסך חיצוני לא מתחבר או שהשקע עובד רק בזווית? בודקים את המחבר, את החיבור ללוח ואת מקור התקלה לפני שמחליטים על תיקון.</p>
      <div class="laptopia-board-price laptopia-service-cta"><span><span class="laptopia-price-card-label">החלפת שקע <?php echo laptopia_bidi_ltr( 'USB' ); ?></span><span class="laptopia-service-price-amount"><?php echo laptopia_price_display( 'usb' ); ?></span></span></div>
      <p>מחיר תיקון חיבורים אחרים נקבע לפי הדגם וממצאי הבדיקה, לפני ביצוע העבודה.</p>
      <?php get_template_part( 'template-parts/service-hero-details' ); ?>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>שלחו הודעה ב-<?php echo laptopia_bidi_ltr( 'WhatsApp' ); ?></span></span></a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
      </div>
      <div class="laptopia-phone-line">קבלת מחשבים במעבדה בתיאום מראש בלבד</div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-repairs', null, array( 'service_path' => '/peripheral-ports/' ) ); ?>
  <section class="laptopia-section laptopia-services">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">איזה חיבור אינו עובד?</h2>
      <p class="laptopia-section-subtitle">סוג החיבור והפעולה שלא עובדת עוזרים לכוון את הבדיקה.</p>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'USB-A' ); ?></h3><p>עכבר, כונן חיצוני או התקן אחר אינם מזוהים, או שהחיבור מתנתק. בודקים גם כבל והתקן תקינים כדי להפריד בין תקלה במחשב לתקלה באביזר.</p></div>
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'USB-C' ); ?> ותחנות עגינה</h3><p>הטעינה עובדת, אבל אין העברת נתונים או שהמסך או תחנת העגינה אינם מזוהים? בודקים את תמיכת השקע בפעולה המבוקשת, את הכבל ואת קווי החיבור.</p></div>
        <div class="laptopia-card"><h3><?php echo laptopia_bidi_ltr( 'HDMI' ); ?> ותצוגה חיצונית</h3><p>המסך החיצוני אינו מזוהה או שהתמונה מתנתקת. בודקים את המחבר ואת החיבור ללוח, לצד הכבל, המסך והגדרות התצוגה.</p></div>
        <div class="laptopia-card"><h3>אוזניות וקוראי כרטיסים</h3><p>שקע אוזניות <?php echo laptopia_bidi_ltr( '3.5mm' ); ?> או קורא <?php echo laptopia_bidi_ltr( 'SD / microSD' ); ?> שאינו מזהה כרטיס נבדקים לפי הדגם. אפשר לפנות גם לגבי חיבורים חיצוניים אחרים ולברר אם ניתן לטפל בהם.</p></div>
      </div>
    </div>
  </section>
  <section class="laptopia-section laptopia-board laptopia-info-panel-section" id="ports">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2>מחבר פגום או תקלה אחרת?</h2>
      <h3>נזק פיזי וחיבור לא יציב</h3>
      <p>שקע רופף, פינים פגומים או חיבור שעובד רק בזווית עשויים להעיד על נזק במחבר או בהלחמות. אם המחבר נעקר ונפגע אזור הלוח, ייתכן שנדרש שיקום של נקודות החיבור. לא ניתן להבטיח שהחלפת המחבר לבדה תפתור את הבעיה.</p>
      <h3>בקר, מעגלים או הגדרות</h3>
      <p>גם שקע שנראה תקין יכול להפסיק לעבוד בגלל מעגל בלוח, בקר או הגדרות ותוכנה. האבחון נועד להבדיל בין המצבים ולברר אם התיקון אפשרי. כאשר נדרש טיפול בלוח, ראו <a class="laptopia-context-link" href="<?php echo esc_url( home_url( '/motherboard-repair/' ) ); ?>">תיקון לוח אם ברמת הרכיב</a>.</p>
      <h3>מה חשוב לדעת על <?php echo laptopia_bidi_ltr( 'USB-C' ); ?>?</h3>
      <p><?php echo laptopia_bidi_text( 'הצורה של USB-C אינה קובעת את כל היכולות שלו. טעינה באמצעות USB Power Delivery, העברת נתונים, תצוגה דרך DisplayPort Alt Mode, תחנות עגינה ו-USB4 / Thunderbolt תלויות בדגם המחשב ובשקע המסוים. לא כל שקע תומך בכל האפשרויות, וגם הכבל והאביזר צריכים להתאים.' ); ?></p>
      <p>אם נתונים עוברים אבל המחשב אינו נטען דרך השקע, או שתהליך הטעינה לא מתחיל, ראו <a class="laptopia-context-link" href="<?php echo esc_url( home_url( '/charging-usb-repair/' ) ); ?>">תיקון שקעי טעינה למחשב נייד</a>. כאן הבדיקה מתמקדת בחיבורי נתונים, תצוגה ואביזרים.</p>
    </div>
  </section>
  <section class="laptopia-section laptopia-prices" id="prices">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">מחיר ובדיקה לפני תיקון</h2>
      <?php get_template_part( 'template-parts/pricing-panel', null, array(
          'price_key' => 'usb',
          'label' => 'החלפת שקע USB',
          'description' => 'המחיר הסופי תלוי בדגם ובמצב המחבר והלוח. לחיבורי תצוגה, אוזניות, קוראי כרטיסים וחיבורים אחרים ניתנת הצעת מחיר לאחר אבחון. העבודה מבוצעת רק לאחר אישור הלקוח.',
      ) ); ?>
      <?php get_template_part( 'template-parts/consumer-price-note' ); ?>
    </div>
  </section>
  <?php get_template_part( 'template-parts/process', null, array(
      'title' => 'איך מתאמים תיקון חיבור?',
      'steps' => array(
          array( 'title' => 'תיאום מראש', 'text' => 'שולחים את דגם המחשב ואת סוג החיבור שאינו עובד.' ),
          array( 'title' => 'בדיקה', 'text' => 'בודקים מחבר, כבל ואביזר ואת החיבור ללוח לפי הצורך.' ),
          array( 'title' => 'הצעת מחיר', 'text' => 'מסבירים מה נמצא ומה ניתן לתקן ומבקשים אישור.' ),
          array( 'title' => 'תיקון ובדיקה', 'text' => 'מבצעים את העבודה המאושרת ובודקים את הפעולה הרלוונטית.' ),
          array( 'title' => 'איסוף', 'text' => 'מתאמים איסוף כשהמחשב מוכן.' ),
      ),
  ) ); ?>
  <section class="laptopia-section laptopia-services laptopia-faq">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title">שאלות על חיבורי מחשב נייד</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>האם צריך להחליף שקע שלא מזהה התקן?</h3><p>לא תמיד. התקלה עשויה להיות בכבל, בהתקן, בהגדרות או במעגל בלוח. בודקים את מקור הבעיה לפני שמחליטים על החלפה.</p></div>
        <div class="laptopia-card"><h3>למה החיבור עובד רק בזווית?</h3><p>ייתכן שהמחבר רופף, שהפינים נפגעו או שיש נזק להלחמות. גם כבל פגום עלול לגרום לכך. אין להפעיל כוח על השקע.</p></div>
        <div class="laptopia-card"><h3>הטעינה עובדת, למה אין תמונה?</h3><p>טעינה אינה מעידה בהכרח על תמיכה בתצוגה. בודקים את מפרט השקע, את הכבל ואת המסך או תחנת העגינה, ולאחר מכן את החיבור במחשב.</p></div>
        <div class="laptopia-card"><h3>האם אפשר לתקן כל מחבר?</h3><p>האפשרות לתיקון תלויה במצב הלוח, במבנה המחשב ובזמינות החלק המתאים. היקף העבודה, תנאי השירות והאחריות נמסרים לפני אישור התיקון.</p></div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/service-contact-section', null, array(
      'heading' => 'לתיאום בדיקת חיבורים במחשב הנייד',
      'description' => 'שלחו את דגם המחשב, את סוג החיבור ואת הפעולה שאינה עובדת. נתאם בדיקה במעבדה ברמלה.',
  ) ); ?>
</main>
<?php get_footer(); ?>
