<?php defined( 'ABSPATH' ) || exit; ?>
<section class="laptopia-section laptopia-google-reviews" aria-labelledby="google-reviews-title" data-place-id="<?php echo esc_attr( laptopia_google_reviews_place_id() ); ?>">
  <div class="laptopia-reviews-rail">
    <header class="laptopia-google-reviews-heading">
      <h2 class="laptopia-section-title" id="google-reviews-title">ביקורות מ-<?php echo laptopia_bidi_ltr( 'Google' ); ?></h2>
      <div class="laptopia-google-rating" data-google-rating aria-label="דירוג Google"></div>
      <p class="laptopia-google-reviews-disclosure">הביקורות המוצגות נבחרות ומסודרות לפי רלוונטיות על ידי <?php echo laptopia_bidi_ltr( 'Google' ); ?>.</p>
    </header>
    <div class="laptopia-google-carousel-frame">
      <div class="laptopia-google-carousel" data-google-carousel tabindex="0" aria-label="ביקורות Google"></div>
      <button class="laptopia-google-carousel-arrow laptopia-google-carousel-prev" type="button" data-google-prev aria-label="ביקורות קודמות">›</button>
      <button class="laptopia-google-carousel-arrow laptopia-google-carousel-next" type="button" data-google-next aria-label="ביקורות הבאות">‹</button>
    </div>
    <div class="laptopia-google-attribution">
      <a href="https://www.google.com/maps" target="_blank" rel="noopener noreferrer" aria-label="Google Maps"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/google-maps-logo.svg' ); ?>" alt="Google Maps" width="100" height="20" loading="lazy" decoding="async"></a>
      <span data-google-provider-attributions></span>
    </div>
    <nav class="laptopia-google-reviews-actions" aria-label="מקורות ביקורות וכרטיסי העסק">
      <a class="laptopia-google-review-action laptopia-google-review-action-google" href="https://g.page/r/Ccprx_3WhBpaEAE/review" target="_blank" rel="noopener noreferrer"><span class="laptopia-cta-content"><span>כתבו ביקורת בגוגל</span><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'google' ) ); ?></span></a>
      <a class="laptopia-google-review-action laptopia-google-review-action-easy" href="https://easy.co.il/page/27436684" target="_blank" rel="noopener noreferrer"><span class="laptopia-cta-content"><span>צפו בכרטיס העסק ב-<?php echo laptopia_bidi_ltr( 'Easy' ); ?></span><img class="laptopia-easy-icon" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/easy-icon.png' ); ?>" alt="" width="19" height="19" loading="lazy" decoding="async"></span></a>
      <a class="laptopia-google-review-action laptopia-google-review-action-google" href="https://maps.google.com/?cid=6492647871723563978" target="_blank" rel="noopener noreferrer"><span class="laptopia-cta-content"><span>לכל הביקורות ב-<?php echo laptopia_bidi_ltr( 'Google' ); ?></span><?php get_template_part( 'template-parts/cta-icon', null, array( 'type' => 'google' ) ); ?></span></a>
    </nav>
  </div>
</section>
