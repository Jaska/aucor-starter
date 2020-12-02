<?php
/**
 * nostoblokki
 *
 * @package aucor_starter
 */


  /**
 * Block templates
 */
add_filter('acf/load_field/name=nostoblokki_block_template', function ($field) {

  $field['default_value'] = 'default';
  $field['choices'] = [
    "default" => "Tavallinen",
    // "fixed_1" => "Paneeli",
    // "fixed_2" => "Korkea paneeli"
  ];
  /**
   * Hides field if just one template
   */
  if(count($field['choices']) < 2){
    // $field['class'] = 'hidden';
    $field['wrapper']['class'] = 'hidden';
  }
  return $field;

});


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
        'mode'                => true,
        'align'               => true,
        'multiple'            => true,
        'customClassName'     => false,
      ],
    ]);

    acf_register_block_type([
      'name'              => 'nostogroup',
      'title'             => 'Nostoblokki Ryhmä',
      'render_template'   => 'modules/nostoblokki/block-group.php',
      'keywords'          => ['nostoblokki', 'page list'],
      // 'post_types'        => ['page', 'post'],
      'category'          => 'design',
      'icon'              => array('background' => 'linen', 'src' => 'excerpt-view'),
      'mode'              => 'edit',
      'supports'          => [
        'mode'                => true,
        'align'               => true,
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
  $blocks[] = 'acf/nostogroup';
  return $blocks;

}, 11, 2);

/**
 * Load ACF fields
 */
add_filter('acf/settings/load_json', function ($paths) {

  $paths[] = dirname(__FILE__) . '/acf-json/';
  return $paths;

});
