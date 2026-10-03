<?php
/** Editable standard-page content, also used by the legal-page template. */
defined( 'ABSPATH' ) || exit;
?>
<main class="laptopia-section laptopia-standard-content" dir="rtl">
    <?php while ( have_posts() ) : the_post(); ?>
  <section class="laptopia-page-foundation" aria-labelledby="page-title">
    <div class="laptopia-page-container laptopia-page-surface laptopia-page-prose laptopia-page-prose-heading">
      <h1 class="laptopia-section-title" id="page-title"><?php the_title(); ?></h1>
    </div>
  </section>
  <div class="laptopia-page-container laptopia-page-surface laptopia-page-prose laptopia-page-prose-body">
      <article aria-labelledby="page-title">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
      </article>
  </div>
    <?php endwhile; ?>
</main>
