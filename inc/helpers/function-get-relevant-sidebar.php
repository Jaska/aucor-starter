<?php

function get_relevant_sidebar(){

  $override_sidebar = get_field('aseta_sivupalkki') ? get_field('sivun_sivupalkki', false) : false;
// var_dump($override_sidebar);
  if ($override_sidebar){
    return $override_sidebar[0]->ID;
  }

  $archive = get_archive_post_type() ?? 'page';
  $ctp = $archive ? $archive : get_post_type();

  $args = array(
    'post_type' => 'sivupalkit',
    'posts_per_page' => 1,
    'meta_query' => array(
        array(
          'key' => 'yhdista_sivupalkki_cpt',
          'value' => $ctp,
          'compare' => 'LIKE'
        ),
    ),
  );
  $query = new WP_Query($args);

  $sidebar_id = array();
  // The Loop
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();
      // echo get_the_title();
      $sidebar_id[] = get_the_ID();
      // print_r(get_field('yhdista_sivupalkki_cpt'));
    }
  } else {
    // no posts found
    $sidebar_id = array(aucor_starter_get_hardcoded_id('default_sidebar'));
  }
  // Restore original Post Data
  wp_reset_postdata();

  return $sidebar_id['0'];

  // var_dump($query);
  /**
   * First: get current post type (archive also)
   * See if any sidebar cpt have that post type.
   * Get that ID (or array)
   * if not, use fallback
   *
   */
}
