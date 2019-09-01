<?php
/**
 * Get page content with id or hardcoded id string. Also applies polylang
 *
 * @package starter
 */

function get_lang_content($id){
  if (!is_int($id)){
    if (is_string($id)){
      $id = starter_get_hardcoded_id($id);
    } else {
      return false;
    }
  }
  if(function_exists('pll_get_post')){
    $id = pll_get_post($id);
  }
  $post_object = get_post($id);
  $content = $post_object->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]>', $content);

  return $content;
}
