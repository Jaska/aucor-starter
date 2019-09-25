<?php
/**
 * Register: Assets
 *
 * Enqueue scripts and stylesheets for theme.
 * Append content into <head> or footer.
 * Include favicons.
 *
 * @package aucor_starter
 */

/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', function() {

  // main css
  wp_enqueue_style(
    'aucor_starter-style',
    get_template_directory_uri() . '/dist/styles/main.css',
    [],
    aucor_starter_last_edited('css')
  );

  // critical js
  wp_enqueue_script(
    'aucor_starter-critical-js',
    get_template_directory_uri() . '/dist/scripts/critical.js',
    [],
    aucor_starter_last_edited('js'),
    false
  );

  wp_enqueue_script("jquery");

  // main js
  wp_enqueue_script(
    'aucor_starter-js',
    get_template_directory_uri() . '/dist/scripts/main.js',
    [],
    aucor_starter_last_edited('js'),
    true
  );

  // remove gutenberg default stylesheets
  wp_deregister_style('wp-block-library-theme');
  wp_deregister_style('wp-block-library');

  add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
  function wps_deregister_styles() {
      wp_dequeue_style( 'wp-block-library' );
  }

  // comments
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

});

/**
 * Enqueue styles for Gutenberg Editor
 */
add_action('enqueue_block_editor_assets', function() {

  // editor styles
  wp_enqueue_style(
    'aucor_starter-editor-gutenberg-style',
    get_stylesheet_directory_uri() . '/dist/styles/editor-gutenberg.css',
    [],
    aucor_starter_last_edited('css')
  );

  // editor scripts
  wp_enqueue_script(
    'aucor_starter-editor-gutenberg-scripts',
    get_stylesheet_directory_uri() . '/dist/scripts/editor-gutenberg.js',
    ['wp-i18n', 'wp-blocks', 'wp-dom-ready'],
    aucor_starter_last_edited('js'),
    true
  );

  // overwrite Core block styles with empty styles
  wp_deregister_style('wp-block-library' );
  wp_register_style('wp-block-library', '' );

  // overwrite Core theme styles with empty styles
  wp_deregister_style('wp-block-library-theme');
  wp_register_style('wp-block-library-theme', '');

}, 10);

/**
 * Enqueue scripts and styles for admin
 */
add_action('admin_enqueue_scripts', function() {

  // admin.css
  wp_enqueue_style(
    'aucor_starter-admin-css',
    get_template_directory_uri() . '/dist/styles/admin.css',
    [],
    aucor_starter_last_edited('css')
  );

});

/**
 * Assets for login screen
 */
add_action('login_enqueue_scripts', function() {

  // wp-login.css
  wp_enqueue_style(
    'aucor_starter-login-styles',
    get_stylesheet_directory_uri() . '/dist/styles/wp-login.css',
    [],
    aucor_starter_last_edited('css')
  );

});

/**
 * Enqueue styles for Classic Editor
 */
add_action('admin_init', function() {

  add_editor_style('dist/styles/editor-classic.css');

});

/**
 * Append to <head>
 */
add_action('wp_head', function() {

  // replace class no-js with js in html tag
  echo "<script>(function(d){d.className = d.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

});

/**
 * Append to footer
 */
add_action('wp_footer', function() {

});

/**
 * Favicons
 *
 * Add favicons' <link> and <meta> tags here
 */
function starter_favicons() {
  // Use https://realfavicongenerator.net and insert all files in dist/favicon
  $x = get_template_directory_uri().'/dist/favicon';
  ?>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $x; ?>/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $x; ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $x; ?>/favicon-16x16.png">
  <link rel="mask-icon" href="<?php echo $x; ?>/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <?php
}
add_action('wp_head',    'starter_favicons');
add_action('admin_head', 'starter_favicons');
add_action('login_head', 'starter_favicons');
