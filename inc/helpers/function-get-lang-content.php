<?php
/**
 * Get page content with id or hardcoded id string. Also applies polylang
 *
 * @package starter
 */
function get_lang_object($id, $return_object = true){
  return get_lang_content($id, $return_object);
}
function get_lang_content($id, $return_object = false){
  if (!is_int($id)){
    if (is_string($id)){
      $id = aucor_starter_get_hardcoded_id($id);
      if ($id == '0'){
        return;
      }
    } else {
      return false;
    }
  }
  if(function_exists('pll_get_post')){
    $id = pll_get_post($id) ?: $id;
  }
  $post_object = get_post($id);
  // var_dump($post_object);
  if ($post_object === NULL){
    return false;
  }
  $content = $post_object->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]>', $content);
  $post_object->post_content = $content;

  if ($return_object){
    return $post_object;
  }

  return $content;
}
