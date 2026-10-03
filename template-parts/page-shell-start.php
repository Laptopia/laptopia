<?php
/** Shared document frame for standard pages; custom templates opt in explicitly. */
defined( 'ABSPATH' ) || exit;
$shell_classes = isset( $args['body_classes'] ) ? (array) $args['body_classes'] : array();
$background_mode = isset( $args['background_mode'] ) ? sanitize_key( $args['background_mode'] ) : 'workbench';
$shell_classes[] = 'laptopia-standard-page';
$shell_classes[] = 'laptopia-bg--' . $background_mode;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( $shell_classes ); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/header' ); ?>
<?php get_template_part( 'template-parts/page-background', null, array( 'mode' => $background_mode ) ); ?>
