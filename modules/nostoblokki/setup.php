<?php
/**
 * nostoblokki
 *
 * @package aucor_starter
 */


/**
 * Register block
 */
add_action('acf/init', function () {

  if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
      'name'              => 'nostoblokki',
      'title'             => 'Nostoblokki',
      'render_template'   => 'modules/nostoblokki/block.php',
      'keywords'          => ['nostoblokki', 'page list'],
      // 'post_types'        => ['page', 'post'],
      'category'          => 'design',
      'icon'              => array('background' => 'linen', 'src' => 'excerpt-view'),
      'mode'              => 'preview',
      'supports'          => [
        'mode'                => false,
        'align'               => false,
        'multiple'            => true,
        'customClassName'     => false,
      ],
    ]);
  }

});

/**
 * Allow block
 */
add_filter('allowed_block_types', function($blocks, $post) {

  $blocks[] = 'acf/nostoblokki';
  return $blocks;

}, 11, 2);

/**
 * Load ACF fields
 */
add_filter('acf/settings/load_json', function ($paths) {

  $paths[] = dirname(__FILE__) . '/acf-json/';
  return $paths;

});
