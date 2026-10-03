<?php
$template = basename( get_page_template_slug() );
$title_ids = array(
  'motherboard-repair.php' => 'contact-title',
  'screen-replacement.php' => 'screen-contact-title',
  'battery-replacement.php' => 'battery-contact-title',
  'cooling-cleaning.php' => 'cooling-contact-title',
  'keyboard-replacement.php' => 'keyboard-contact-title',
);
$title_id = $title_ids[ $template ] ?? 'service-contact-title';
$options = $args ?? array();
$options['title_id'] = $title_id;
$options['show_service_area'] = ! is_page_template( 'page-templates/service-areas.php' );
get_template_part( 'template-parts/contact', null, $options );
