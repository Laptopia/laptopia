<?php
/**
 * Template Name: Laptopia - תיקון לוחות אם
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
<body <?php body_class(); ?> data-laptopia-background="<?php echo esc_attr( laptopia_background_mode() ); ?>">
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/header', null, array(
    'service_link' => array(
        'href'  => '#board',
        'label' => 'תיקון ברמת הרכיב',
    ),
) );
?>

<main dir="rtl">
  <section class="laptopia-section laptopia-hero" aria-labelledby="repair-title">
    <div class="laptopia-hero-content">
      <h1 id="repair-title">תיקון לוחות אם למחשבים ניידים ברמלה והסביבה</h1>
      <p>המחשב הנייד לא נדלק, לא נטען או סובל מתקלה בלוח האם? ב־Laptopia ברמלה מבצעים אבחון ותיקון תקלות אלקטרוניות ברמת הרכיב, כולל תקלות הדלקה, טעינה, קצרים ונזקי נוזלים. אפשרות התיקון והמחיר נקבעים לאחר בדיקה.</p>
      <div class="laptopia-board-price laptopia-service-cta"><?php get_template_part( 'template-parts/service-icon', null, array( 'slug' => 'motherboard-repair' ) ); ?><span>תיקון לוח אם — החל מ־700 ₪</span></div>
      <p>המחיר הסופי נקבע לאחר אבחון, בהתאם לדגם, לתקלה ולחלקים הנדרשים. התיקון מתבצע רק לאחר אישור הלקוח.</p>
      <div class="laptopia-buttons">
        <a class="laptopia-btn laptopia-btn-whatsapp" href="https://wa.me/972538036244" target="_blank" rel="noopener"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'whatsapp' ) ); ?><span>לתיאום אבחון בוואטסאפ</span></span></a>
        <a class="laptopia-btn laptopia-btn-dark" href="tel:+972538036244"><span class="laptopia-cta-content"><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'phone' ) ); ?><span>התקשרו למעבדה</span></span></a>
      </div>
      <div class="laptopia-phone-line">הגעה למעבדה ומסירת מחשב בתיאום מראש בלבד.</div>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="symptoms-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="symptoms-title">מתי כדאי לבדוק את לוח האם?</h2>
      <p class="laptopia-section-subtitle">תקלות הדלקה וטעינה עשויות להיות קשורות ללוח האם, אך התסמין לבדו אינו מספיק כדי לקבוע מה מקור התקלה. האבחון נועד לזהות את הבעיה לפני שמחליטים על תיקון.</p>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card">
          <h3>המחשב הנייד לא נדלק</h3>
          <p>המחשב אינו מגיב ללחיצה על כפתור ההפעלה? בבדיקה מאתרים את מקור התקלה ובוחנים אם היא קשורה ללוח האם או לרכיב אחר.</p>
        </div>
        <div class="laptopia-card">
          <h3>המחשב אינו נטען</h3>
          <p>תקלה בטעינה אינה מעידה בהכרח על לוח אם תקול. נדרש אבחון כדי לזהות את מקור הבעיה ולקבוע מה צריך לתקן.</p>
        </div>
        <div class="laptopia-card">
          <h3>קצרים ונזקי נוזלים</h3>
          <p>קצר או נזק מנוזלים עלולים לפגוע ברכיבים ובמעגלים בלוח האם. אפשרות התיקון תלויה במצב הלוח ובהיקף הנזק ונבחנת לאחר בדיקה.</p>
        </div>
      </div>
      <figure class="laptopia-liquid-damage-figure">
        <img
          class="laptopia-liquid-damage-image"
          src="https://laptopia.co.il/wp-content/uploads/2026/09/water-optimized.webp"
          width="1215"
          height="911"
          alt="תיקון לוח אם למחשב נייד לאחר נזקי נוזלים במעבדת Laptopia ברמלה"
          loading="lazy"
          decoding="async"
        >
        <figcaption>דוגמה לנזקי נוזלים וקורוזיה בלוח אם של מחשב נייד</figcaption>
      </figure>
    </div>
  </section>

  <section class="laptopia-section laptopia-board laptopia-info-panel-section" id="board" aria-labelledby="board-title">
    <div class="laptopia-board-content laptopia-info-panel">
      <h2 id="board-title">מה כולל תיקון לוח אם למחשב נייד?</h2>
      <p>תיקון לוח אם למחשב נייד הוא אחד מתחומי ההתמחות המרכזיים של Laptopia ברמלה. התהליך מתחיל באבחון מקור התקלה ובבדיקת אפשרות התיקון.</p>
      <h3>אבחון מקור התקלה</h3>
      <p>בודקים את המחשב כדי לאתר את מקור התקלה ולהבין איזה טיפול נדרש. ממצאי האבחון משמשים לקביעת אפשרות התיקון והצעת המחיר.</p>
      <h3>תיקון ברמת הרכיב</h3>
      <p>כאשר מצב הלוח מאפשר זאת, התיקון מתמקד ברכיבים ובמעגלים התקולים בלוח האם, במקום בהחלפת הלוח כולו.</p>
      <h3>החלטה בהתאם לממצאי הבדיקה</h3>
      <p>לא בכל מקרה ניתן לתקן את לוח האם. האפשרות להמשיך בתיקון נבחנת בהתאם לסוג התקלה ולמצב הלוח, והעבודה מתבצעת רק לאחר אישור הלקוח.</p>
    </div>
    <div class="laptopia-component-gallery">
      <figure class="laptopia-component-figure">
        <img
          src="https://laptopia.co.il/wp-content/uploads/2026/09/component-repair.webp"
          width="573"
          height="573"
          alt="תיקון ברמת הרכיב בלוח אם של מחשב נייד במעבדת Laptopia ברמלה"
          loading="lazy"
          decoding="async"
        >
        <figcaption>דוגמה לתיקון ברמת הרכיב בלוח אם של מחשב נייד</figcaption>
      </figure>
      <figure class="laptopia-component-figure">
        <img
          src="https://laptopia.co.il/wp-content/uploads/2026/09/micro-component-coin-e1788901294840.webp"
          width="573"
          height="573"
          alt="רכיב אלקטרוני זעיר במסגרת תיקון לוח אם למחשב נייד"
          loading="lazy"
          decoding="async"
        >
        <figcaption>דוגמה לרכיב זעיר המולחם במסגרת תיקון ברמת הרכיב</figcaption>
      </figure>
    </div>
  </section>

  <section class="laptopia-section laptopia-process" aria-labelledby="process-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="process-title"><?php get_template_part( 'template-parts/brand-text', null, array( 'text' => 'איך מתבצע התיקון ב־Laptopia?' ) ); ?></h2>
      <div class="laptopia-process-grid">
        <div class="laptopia-step"><div class="laptopia-step-number">1</div><h3>תיאום מראש</h3><p>מתאמים את מסירת המחשב למעבדה ברמלה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">2</div><h3>אבחון התקלה</h3><p>בודקים את המחשב ומאתרים את מקור התקלה.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">3</div><h3>הצעת מחיר</h3><p>מקבלים הצעת מחיר לפני ביצוע התיקון.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">4</div><h3>אישור וביצוע התיקון</h3><p>התיקון מתבצע לאחר קבלת אישור הלקוח.</p></div>
        <div class="laptopia-step"><div class="laptopia-step-number">5</div><h3>איסוף המחשב</h3><p>נשלחת הודעה כאשר המחשב מוכן לאיסוף.</p></div>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-prices" id="prices" aria-labelledby="prices-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="prices-title">כמה עולה תיקון לוח אם?</h2>
      <div class="laptopia-diagnostic">
        <strong>תיקון לוח אם — החל מ־700 ₪</strong>
        <p>המחיר הסופי נקבע בהתאם לדגם המחשב, לסוג התקלה, לחלקים הנדרשים ולמורכבות העבודה. התיקון מתבצע רק לאחר אישור הלקוח.</p>
        <h3>דמי אבחון</h3>
        <p>במקרה שבו הלקוח בוחר שלא לבצע תיקון לאחר האבחון, דמי האבחון הם 150 ₪.</p>
        <p>אם לאחר הבדיקה נקבע כי המחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p>
      </div>
    </div>
  </section>

  <section class="laptopia-section laptopia-warranty" id="warranty" aria-labelledby="warranty-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="warranty-title">תיקון לוחות אם ברמלה — אבחון, אישור ואחריות</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>אבחון לפני תיקון</h3><p>איתור מקור התקלה והצעת מחיר לפני תחילת העבודה.</p></div>
        <div class="laptopia-card"><h3>תיקון ברמת הרכיב</h3><p>טיפול בתקלות אלקטרוניות בלוח האם בהתאם לממצאי האבחון ולאפשרות התיקון.</p></div>
        <div class="laptopia-card"><h3>אחריות על התיקון</h3><p>3 חודשי אחריות על תיקון שבוצע במעבדה, בהתאם לסוג התיקון והרכיב.</p></div>
      </div>
      <p class="laptopia-price-note"><a href="<?php echo esc_url( home_url( '/#warranty' ) ); ?>">למידע על האחריות</a></p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services" aria-labelledby="geography-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="geography-title">תיקון לוחות אם ברמלה והסביבה</h2>
      <p class="laptopia-section-subtitle">Laptopia היא מעבדת מחשבים ניידים ברמלה, ברחוב אלמוג 2. המעבדה נותנת שירות ללקוחות מרמלה ומהערים הסמוכות: לוד, באר יעקב, ראשון לציון ורחובות.</p>
      <p class="laptopia-price-note">מסירת המחשב מתבצעת במעבדה ברמלה, בתיאום מראש.</p>
    </div>
  </section>

  <section class="laptopia-section laptopia-services laptopia-faq" aria-labelledby="faq-title">
    <div class="laptopia-inner">
      <h2 class="laptopia-section-title" id="faq-title">שאלות נפוצות על תיקון לוחות אם</h2>
      <div class="laptopia-warranty-grid">
        <div class="laptopia-card"><h3>המחשב לא נדלק — האם לוח האם תקול?</h3><p>לא בהכרח. תקלת הדלקה יכולה להיות קשורה גם למקור המתח או לרכיב אחר. נדרש אבחון כדי לזהות את מקור התקלה.</p></div>
        <div class="laptopia-card"><h3>האם אפשר לתקן את הלוח במקום להחליף אותו?</h3><p>בחלק מהמקרים ניתן לבצע תיקון ברמת הרכיב. האפשרות תלויה בסוג התקלה ובמצב הלוח ונקבעת לאחר אבחון.</p></div>
        <div class="laptopia-card"><h3>כמה עולה תיקון לוח אם למחשב נייד?</h3><p>המחיר מתחיל ב־700 ₪. המחיר הסופי נקבע לאחר אבחון ובהתאם לדגם, לתקלה ולחלקים הנדרשים. התיקון מתבצע רק לאחר אישור הלקוח.</p></div>
        <div class="laptopia-card"><h3>האם משלמים על האבחון אם לא מתקנים?</h3><p>אם בוחרים שלא לבצע את התיקון לאחר האבחון, דמי האבחון הם 150 ₪. אם נמצא שהמחשב אינו ניתן לתיקון מבחינה טכנית, לא ייגבו דמי אבחון.</p></div>
        <div class="laptopia-card"><h3>האם יש אחריות על התיקון?</h3><p>על תיקון שבוצע במעבדה ניתנים 3 חודשי אחריות, בהתאם לסוג התיקון והרכיב.</p></div>
        <div class="laptopia-card"><h3>כמה זמן לוקח לתקן לוח אם?</h3><p>משך הטיפול תלוי בסוג התקלה ובחלקים הנדרשים. לקבלת הערכת זמן למקרה שלכם, פנו למעבדה עם דגם המחשב ותיאור התקלה.</p></div>
      </div>
    </div>
  </section>

  <?php get_template_part( 'template-parts/service-contact-section', null, array(
    'heading' => 'לתיאום אבחון במעבדת Laptopia',
    'description' => 'שלחו לנו בוואטסאפ את דגם המחשב ותיאור התקלה. אפשר לצרף תמונה כדי לעזור לנו להבין את הבעיה.',
  ) ); ?>
</main>

<?php
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );
wp_footer();
?>
</body>
</html>
