<?php
/**
 * Sivulista
 *
 * @package aucor_starter
 */


 /**
 * Block templates
 */
add_filter('acf/load_field/name=sivulista_block_template', function ($field) {

  $field['default_value'] = 'default';
  $field['choices'] = [
    'default'   => 'Oletus',
    "renderlista" => "Näytä sivut kokonaan",
    "korttilista" => "Korttityylinen listaus",
    "kevytkorttilista" => "Kevyempi korttilista",
    "henkilokuntalista" => "Henkilökunta listaus"
  ];
  return $field;

});


/**
 * Register block
 */
add_action('acf/init', function () {

  if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
      'name'              => 'Sivulista',
      'title'             => 'Sivulista',
      'render_template'   => 'modules/sivulista/block.php',
      'keywords'          => ['sivulista', 'page list'],
      // 'post_types'        => ['page', 'post'],
      'category'          => 'design',
      'icon'              => array('background' => 'linen', 'src' => 'excerpt-view'),
      'mode'              => 'preview',
      'supports'          => [
        'mode'                => false,
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

  $blocks[] = 'acf/sivulista';
  return $blocks;

}, 11, 2);

/**
 * Load ACF fields
 */
add_filter('acf/settings/load_json', function ($paths) {

  $paths[] = dirname(__FILE__) . '/acf-json/';
  return $paths;

});
