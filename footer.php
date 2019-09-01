<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aucor_starter
 */

?>

  </div><!-- #content -->

  <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">

    <div class="site-footer__container wysiwyg">
      <?php
      echo get_lang_content('footer');
      ?>
    </div>

  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
