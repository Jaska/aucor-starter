<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aucor_starter
 */

?>
    <?php
    echo get_relevant_sections();
    ?>
    <?php $map_content = get_lang_content('map', false);
    if ($map_content): ?>
    <section class="map wysiwyg sitesection__wrapper sitesection">
      <?php echo $map_content; ?>
    </section>
    <?php endif; ?>
  </div><!-- #content -->
  <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">

    <div class="site-footer__container wysiwyg">
      <?php
      echo get_lang_content('footer', false);
      ?>
    </div>

  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
