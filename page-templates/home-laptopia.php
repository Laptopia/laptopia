<?php
/**
 * Template Name: Laptopia - דף הבית
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

<?php
get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/services' );
get_template_part( 'template-parts/board-repair' );
get_template_part( 'template-parts/process' );
get_template_part( 'template-parts/prices' );
get_template_part( 'template-parts/warranty' );
get_template_part( 'template-parts/reviews-heading' );

echo do_shortcode( '[trustindex no-registration=google]' );

get_template_part( 'template-parts/contact' );
get_template_part( 'template-parts/footer' );
get_template_part( 'template-parts/floating-whatsapp' );

?>
  <?php wp_footer(); ?>
</body>
</html>
