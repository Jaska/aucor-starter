<?php
/**
 * ACF Block: sivulista
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aucor_starter
 */

$main_template = 'sivulista';
$template = get_field('sivulista_block_template') ?? $main_template;
if(!is_string($template)){
  return;
}
$template = strtolower($template);
$template = class_exists($template) ? $template : $main_template;

$template::render([
  'preview' => $is_preview,
  'attr'    => ['class' => [$template]],
  'block' => $block,
  'template' => $template,
]);



