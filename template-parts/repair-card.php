<?php
$case = $args['case'] ?? null;
if ( ! is_array( $case ) || empty( $case['slug'] ) ) {
    return;
}
$url = laptopia_repair_case_url( $case['slug'] );
if ( ! $url ) {
    return;
}
$heading_tag = 2 === ( $args['heading_level'] ?? 3 ) ? 'h2' : 'h3';
$compact = ! empty( $args['compact'] );
?>
<a class="laptopia-repair-card<?php if ( $compact ) : ?> laptopia-repair-card--compact<?php endif; ?>" data-analytics-event="repair_case_click" data-analytics-case="<?php echo esc_attr( $case['slug'] ); ?>" data-analytics-placement="<?php echo esc_attr( is_page( 'repairs' ) ? 'repairs_list' : 'service_related' ); ?>" href="<?php echo esc_url( $url ); ?>">
  <img src="<?php echo esc_url( $case['images']['finished']['src'] ); ?>"
       alt="<?php echo esc_attr( $case['images']['finished']['alt'] ); ?>"
       width="<?php echo esc_attr( (string) $case['images']['finished']['width'] ); ?>"
       height="<?php echo esc_attr( (string) $case['images']['finished']['height'] ); ?>"
       loading="lazy" decoding="async">
  <div class="laptopia-repair-card-body">
    <?php if ( $compact ) : ?>
      <span class="laptopia-repair-eyebrow"><?php echo laptopia_bidi_ltr( $case['model'] ); ?></span>
      <<?php echo $heading_tag; ?> class="laptopia-repair-card-title"><?php echo esc_html( $case['card_title'] ); ?></<?php echo $heading_tag; ?>>
      <span><?php echo esc_html( $case['card_description'] ); ?></span>
      <span class="laptopia-repair-card-price">מחיר התיקון: <?php echo laptopia_bidi_price( $case['price'] ); ?></span>
    <?php else : ?>
      <span class="laptopia-repair-eyebrow"><?php echo esc_html( $case['category'] ); ?></span>
      <<?php echo $heading_tag; ?> class="laptopia-repair-card-title"><?php echo laptopia_bidi_ltr( $case['model'] ); ?></<?php echo $heading_tag; ?>>
      <span><strong>הבעיה:</strong> <?php echo esc_html( $case['card_problem'] ?? $case['problem'] ); ?></span>
      <span><strong>התיקון:</strong> <?php echo esc_html( $case['card_description'] ); ?></span>
      <span class="laptopia-repair-card-price">מחיר התיקון: <?php echo laptopia_bidi_price( $case['price'] ); ?></span>
    <?php endif; ?>
    <span class="laptopia-repair-card-read">לפרטי התיקון <?php echo laptopia_ui_icon( 'arrow-left' ); ?></span>
  </div>
</a>
