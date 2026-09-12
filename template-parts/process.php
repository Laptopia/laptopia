<?php
/** Shared process section. Defaults preserve the homepage process. */
$process_title = $args['title'] ?? 'איך מתבצע התיקון?';
$process_subtitle = $args['subtitle'] ?? 'תהליך פשוט וברור';
$process_steps = $args['steps'] ?? array(
    array( 'title' => 'תיאום מראש', 'text' => 'מתאמים את מסירת המחשב למעבדה.' ),
    array( 'title' => 'אבחון התקלה', 'text' => 'מבצעים בדיקה ומאתרים את מקור התקלה.' ),
    array( 'title' => 'הצעת מחיר', 'text' => 'מקבלים מחיר לפני ביצוע התיקון.' ),
    array( 'title' => 'ביצוע התיקון', 'text' => 'התיקון מבוצע לאחר קבלת אישור.' ),
    array( 'title' => 'המחשב מוכן', 'text' => 'נשלחת הודעה כאשר המחשב מוכן לאיסוף.' ),
);
?>
<section class="laptopia-section laptopia-process">
  <div class="laptopia-inner">
    <h2 class="laptopia-section-title"><?php echo esc_html( $process_title ); ?></h2>
    <div class="laptopia-section-subtitle"><?php echo esc_html( $process_subtitle ); ?></div>
    <div class="laptopia-process-grid">
      <?php foreach ( $process_steps as $index => $step ) : ?>
        <div class="laptopia-step">
          <div class="laptopia-step-number"><?php echo esc_html( (string) ( $index + 1 ) ); ?></div>
          <h3><?php echo esc_html( $step['title'] ); ?></h3>
          <p><?php echo esc_html( $step['text'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
