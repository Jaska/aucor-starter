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

$nostoblokki_fields = $args['fields'] ?? get_fields() ?? false;

// Override /& create template
$nostoblokki_fields['nostoblokki_block_template'] = 'solo_nosto';

nostoblokki::render([
  'block'     => $block,
  'post_id'   => $post_id,
  'content'   => $content,
  'preview'   => $is_preview,
  'attr'      => ['class' => ['wp-block-acf-nostoblokki']],
  'fields'    => $nostoblokki_fields,
]);

