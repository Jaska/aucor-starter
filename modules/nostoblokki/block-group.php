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


$fields = get_fields();

if($fields && $fields['nostoblokit']){
  $count = 'count--'.count($fields['nostoblokit']);
  $alignment = $block['align'] ? 'align' . $block['align'] : '';
  ?>

  <section class="nostoblokki__group nostoblokki <?php echo $count.' '.$alignment; ?>">
  <?php
  foreach($fields['nostoblokit'] as $i => $nostoblokki_fields){

    $block['align'] = null;

    // Override /& create template
    $nostoblokki_fields['nostoblokki_block_template'] = 'group_nosto';

    nostoblokki::render([
      'fields' => $nostoblokki_fields,
      'block' => $block,
      'post_id' => $post_id,
      'content' => $content,
      'preview' => $is_preview,
      'attr'    => ['class' => ['wp-block-acf-nostoblokki']],
    ]);

  } ?>
  </section>
  <?php

}

