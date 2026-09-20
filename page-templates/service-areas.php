<?php
/**
 * Template Name: Laptopia - אזורי שירות
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
<body <?php body_class( 'laptopia-service-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/header', null, array(
  'nav_links' => array(
    array( 'href' => home_url( '/' ), 'label' => 'דף הבית' ),
    array( 'href' => '#about-laptopia-title', 'label' => 'על המעבדה' ),
    array( 'href' => '#primary-areas-title', 'label' => 'אזורי שירות' ),
    array( 'href' => '#contact', 'label' => 'יצירת קשר' ),
  ),
) ); ?>

<main dir="rtl">
  <section class="laptopia-section laptopia-hero" aria-labelledby="service-areas-title">
    <div class="laptopia-hero-content">
      <h1 id="service-areas-title">מעבדת <?php get_template_part( 'template-parts/brand-wordmark' ); ?> לתיקון מחשבים ניידים ברמלה והסביבה</h1>
      <p>מעבדה אחת ברמלה, שירות לתושבי כל האזור. בעל המעבדה הוא מהנדס העוסק בפועל באבחון ובתיקון מחשבים ניידים, ולקוחות פרטיים יכולים לפנות אליו ישירות במעבדה.</p>
      <div class="laptopia-service-hero-details" aria-label="פרטי הגעה">
        <span class="laptopia-service-hero-location">רחוב אלמוג 2, רמלה</span>
        <span>קבלת מחשבים בתיאום מראש בלבד</span>
      </div>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>שלחו הודעה ב-<bdi dir="ltr">WhatsApp</bdi></span></span></a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-board laptopia-info-panel-section" aria-labelledby="about-laptopia-title">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2 class="laptopia-section-title" id="about-laptopia-title">למה פתחתי את <?php get_template_part( 'template-parts/brand-wordmark' ); ?> גם ללקוחות פרטיים?</h2>
      <p>אני מהנדס תיקון מחשבים ניידים. בעבודה היומיומית שלי אני מטפל בכעשרה מחשבים ניידים המגיעים ממעבדות שירות ומחנויות מחשבים שונות.</p>
      <p>העבודה עם המעבדות והחנויות ממשיכה להיות חלק קבוע מהפעילות המקצועית שלי. במקביל פתחתי את <?php get_template_part( 'template-parts/brand-wordmark' ); ?> כדי שגם לקוחות פרטיים תהיה אפשרות לפנות ישירות למהנדס שמבצע את האבחון והתיקון.</p>
      <p>רציתי להנגיש את השירות הזה לשכנים, לחברים ולתושבי רמלה והסביבה, במעבדה שבה אני עובד בפועל ובתיאום מראש.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="specialization-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="specialization-title">התמחות במחשבים ניידים ובלוחות אם</h2>
      <p class="laptopia-section-subtitle">התקלה נבדקת לפני שמחליטים איזה תיקון נדרש. לא כל תסמין מעיד על לוח אם תקול, וההחלטה מתקבלת לפי ממצאי האבחון.</p>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>אבחון מקור התקלה</h3><p>בודקים את המחשב ומזהים אם הבעיה קשורה ללוח האם, לחלק אחר או למערכת ההפעלה.</p></div>
        <div class="laptopia-card"><h3>תיקון ברמת הרכיב</h3><p>במקרים המתאימים בוחנים אפשרות לתקן את המעגל או הרכיב התקול בלוח האם.</p></div>
        <div class="laptopia-card"><h3>קשר ישיר עם המהנדס</h3><p>לקוחות פרטיים יכולים לתאר את התקלה, למסור את המחשב במעבדה ולקבל הסבר על ממצאי הבדיקה והצעת המחיר.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="primary-areas-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="primary-areas-title">מאילו אזורים מגיעים למעבדה?</h2>
      <p class="laptopia-section-subtitle">הכתובת היחידה של המעבדה היא ברמלה. האזורים המפורטים כאן הם אזורי שירות, ואינם כתובות של סניפים נוספים.</p>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>רמלה</h3><p>לתושבי העיר יש כתובת מקומית לאבחון ולתיקון מחשבים ניידים, בתיאום לפני ההגעה.</p></div>
        <div class="laptopia-card"><h3>לוד</h3><p>הקרבה בין הערים מאפשרת לתושבי לוד לתאם מסירה של מחשב נייד לבדיקה.</p></div>
        <div class="laptopia-card"><h3>באר יעקב</h3><p>אפשר לפנות עם דגם המחשב ותיאור התקלה, ולבדוק מראש מהו סוג השירות המתאים.</p></div>
        <div class="laptopia-card"><h3>ראשון לציון</h3><p>השירות מתאים בעיקר לתושבי האזורים הקרובים לרמלה, שמחפשים מעבדה המתמחה במחשבים ניידים.</p></div>
        <div class="laptopia-card"><h3>רחובות</h3><p>לקוחות מהאזורים הקרובים בעיר יכולים לבדוק את התקלה המתוארת ולתאם מסירה.</p></div>
        <div class="laptopia-card"><h3>נס ציונה</h3><p>לפני היציאה מומלץ לשלוח את דגם המחשב ולתאר בקצרה את הבעיה.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-board laptopia-info-panel-section" aria-labelledby="nearby-areas-title">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2 class="laptopia-section-title" id="nearby-areas-title">יישובים נוספים בסביבת רמלה</h2>
      <p>המעבדה משרתת גם לקוחות מאחיסמך, ניר צבי, ישרש, מצליח, גינתון, בן שמן וזיתן, ומיישובים נוספים במעגל הסמוך כמו יד רמב״ם, סתריה, נען, נצר סרני, בית חשמונאי, עזריה, יגל, אחיעזר, כפר חב״ד וכפר דניאל.</p>
      <p>המחשבים נמסרים במעבדה ברמלה, בתיאום מראש.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="regional-services-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="regional-services-title">שירותי המעבדה</h2>
      <p class="laptopia-section-subtitle">בחרו את סוג השירות למידע על סימני התקלה, האבחון, המחיר ותנאי השירות.</p>
      <div class="laptopia-services-grid">
        <?php foreach ( laptopia_get_services() as $service ) : ?>
          <a class="laptopia-card laptopia-element-link" href="<?php echo esc_url( home_url( '/' . $service['slug'] . '/' ) ); ?>">
            <?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => $service['slug'] ) ); ?>
            <h3><?php echo laptopia_bidi_text( $service['label'] ); ?></h3>
            <p>למידע מפורט על השירות, הבדיקה ותנאי התיקון.</p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-process" aria-labelledby="arrival-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="arrival-title">איך מתאמים הגעה?</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-step"><div class="laptopia-step-number">1</div><h3>מתארים את התקלה</h3><p>שולחים בוואטסאפ או מוסרים בטלפון את דגם המחשב ותיאור הבעיה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">2</div><h3>מתאמים מסירה</h3><p>קובעים מראש את הגעת המחשב לכתובת אלמוג 2, רמלה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">3</div><h3>מביאים את המחשב</h3><p>הבדיקה והתיקון מתבצעים במעבדה ברמלה. לא ניתן שירות בכתובת הלקוח.</p></div>
      </div>
    </div>
  </section>

  <?php get_template_part( 'template-parts/service-contact-section', null, array(
    'heading' => 'לתיאום הגעה למעבדת Laptopia',
    'description' => 'שלחו את דגם המחשב ותיאור קצר של התקלה, ונתאם את מסירת המחשב במעבדה ברמלה.',
  ) ); ?>
</main>

<?php
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );
wp_footer();
?>
</body>
</html>
