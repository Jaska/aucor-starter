<?php
/**
 * ACF Block: nostoblokki
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aucor_starter
 */


// nostoblokki::render([
//   // 'size'    => get_field('spacer_size') ? get_field('spacer_size') : 'm',
//   'preview' => $is_preview,
//   'attr'    => ['class' => ['wp-block-acf-nostoblokki']]
// ]);

nostoblokki::render([
  'acf_params' => [
    'block' => $block,
    'content' => $content,
    'is_preview' => $is_preview,
    'post_id' => $post_id,
  ],
  'preview' => $is_preview,
  'attr'    => ['class' => ['wp-block-acf-nostoblokki']],
]);

