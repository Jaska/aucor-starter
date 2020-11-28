<?php
/**
 * ACF Block: blankblock
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aucor_starter
 */


blankblock::render([
  // 'size'    => get_field('spacer_size') ? get_field('spacer_size') : 'm',
  'preview' => $is_preview,
  'attr'    => ['class' => ['wp-block-acf-blankblock']]
]);

