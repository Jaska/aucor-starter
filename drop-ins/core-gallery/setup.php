<?php
/**
 * Setup: core/gallery block
 *
 * @package aucor_starter
 */

/**
 * Allow block
 */
add_filter('allowed_block_types', function($blocks, $post) {

  $blocks[] = 'core/gallery';
  return $blocks;

}, 11, 2);
