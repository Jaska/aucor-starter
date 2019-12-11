<?php
/**
 * Template part: Teaser
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package starter
 */

?>

<article id="card-<?php the_ID(); ?>" <?php post_class('card card--' . get_post_type()); ?>>
  <div class="card__container">
    <?php if (has_post_thumbnail()) : ?>
      <div class="card__thumbnail">
        <a href="<?php the_permalink(); ?>" tabindex="-1">
          <?php // echo starter_get_image(get_post_thumbnail_id(), 'card', false); ?>
          <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'card', false, ''); ?>
        </a>
      </div>
    <?php endif; ?>

    <div class="card__content">
      <!-- <div class="card__flexhelper_1"></div> -->
      <header class="card__header">
        <?php the_title(sprintf('<h2 class="card__header__title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        <?php if (get_post_type() === 'post') : ?>
          <span class="card__header__date"><?php echo starter_get_posted_on(); ?></span>
        <?php endif; ?>
      </header>

      <div class="card__summary">
        <?php the_excerpt(); ?>
      </div>
      <!-- <div class="card__flexhelper_2"></div> -->

    </div>
  </div>
</article>
