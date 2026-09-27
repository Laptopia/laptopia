<?php
$case = $args['case'] ?? null;
if ( ! is_array( $case ) || empty( $case['slug'] ) ) {
    return;
}
$heading_tag = 2 === ( $args['heading_level'] ?? 3 ) ? 'h2' : 'h3';
?>
<a class="laptopia-repair-card" href="<?php echo esc_url( laptopia_repair_case_url( $case['slug'] ) ); ?>">
  <img src="<?php echo esc_url( $case['images']['finished']['src'] ); ?>"
       alt="<?php echo esc_attr( $case['images']['finished']['alt'] ); ?>"
       width="<?php echo esc_attr( (string) $case['images']['finished']['width'] ); ?>"
       height="<?php echo esc_attr( (string) $case['images']['finished']['height'] ); ?>"
       loading="lazy" decoding="async">
  <div class="laptopia-repair-card-body">
    <span class="laptopia-repair-eyebrow"><?php echo esc_html( $case['category'] ); ?> · <?php echo laptopia_bidi_ltr( $case['model'] ); ?></span>
    <<?php echo $heading_tag; ?> class="laptopia-repair-card-title"><?php echo laptopia_bidi_text( $case['heading'] ); ?></<?php echo $heading_tag; ?>>
    <span><?php echo esc_html( $case['intro'] ); ?></span>
    <span class="laptopia-repair-card-price">מחיר המקרה הזה: <?php echo laptopia_bidi_price( $case['price'] ); ?></span>
    <span class="laptopia-repair-card-read">לקריאת התיקון <?php echo laptopia_ui_icon( 'arrow-left' ); ?></span>
  </div>
</a>
