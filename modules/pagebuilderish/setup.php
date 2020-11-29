<?php

/**
 * pagebuilderish
 *
 * @package aucor_starter
 */

register_post_type('osat', array(
  'label' => 'Sivuston osat',
  'description' => 'Footer, yleiset sektiot',
  'hierarchical' => false,
  'supports' => array(
    0 => 'title',
    1 => 'editor',
    2 => 'revisions',
  ),
  'taxonomies' => array(),
  'public' => false,
  'exclude_from_search' => true,
  'publicly_queryable' => false,
  'can_export' => true,
  'delete_with_user' => false,
  'labels' => array(),
  'menu_position' => 20,
  'menu_icon' => 'dashicons-text',
  'show_ui' => true,
  'show_in_menu' => true,
  'show_in_nav_menus' => false,
  'show_in_admin_bar' => true,
  'rewrite' => true,
  'has_archive' => false,
  'show_in_rest' => true,
  'rest_base' => '',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
  'acfe_archive_template' => '',
  'acfe_archive_ppp' => 10,
  'acfe_archive_orderby' => 'date',
  'acfe_archive_order' => 'DESC',
  'acfe_single_template' => '',
  'acfe_admin_ppp' => 10,
  'acfe_admin_orderby' => 'date',
  'acfe_admin_order' => 'DESC',
  'capability_type' => 'page',
  'capabilities' => array(),
  'map_meta_cap' => NULL,
));



add_filter('pll_get_post_types', 'add_cpt_to_pll', 10, 2);

function add_cpt_to_pll($post_types, $is_settings)
{
  if ($is_settings) {
    // hides 'my_cpt' from the list of custom post types in Polylang settings
    unset($post_types['my_cpt']);
  } else {
    // enables language and translation management for 'my_cpt'
    $post_types['sivupalkit'] = 'sivupalkit';
    $post_types['osat'] = 'osat';
  }
  return $post_types;
}


/**
 * Load ACF fields
 */
add_filter('acf/settings/load_json', function ($paths) {

  $paths[] = dirname(__FILE__) . '/acf-json/';
  return $paths;
});



function get_archive_post_type(){
  return is_archive() ? get_queried_object()->name : false;
}


/**
 * Get page content with id or hardcoded id string. Also applies polylang
 *
 * @package starter
 */
function get_lang_object($id, $return_object = true){
  return get_lang_content($id, $return_object);
}

function get_lang_content($id, $return_object = false){
  if (!is_int($id)) {
    if (is_string($id)) {
      $id = aucor_starter_get_hardcoded_id($id);
      if ($id == '0') {
        return;
      }
    } else {
      return false;
    }
  }
  if (function_exists('pll_get_post')) {
    $id = pll_get_post($id) ?: $id;
  }
  $post_object = get_post($id);
  // var_dump($post_object);
  if ($post_object === NULL) {
    return false;
  }
  $content = $post_object->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]>', $content);
  $post_object->post_content = $content;

  if ($return_object) {
    return $post_object;
  }

  return $content;
}


// function get_archive_post_type() {
//   return is_archive() ? get_queried_object()->name : false;
// }
function get_relevant_sections(){
  /**
   * Eli tarkoitus returnata oikeat sivujen content wrapattuna.
   * Eli aluksi etsitään ID array ja sitten looppi jossa printataan.
   * Pitää tietää onko kyseiselle sivulle yliajo
   * Pitää saada selville post type tarkasti.
   *
   * Joku check että löytyykö sivua ylipäätään. Vissiin joku ongelma polylangin kanssa.
   *
   */
  $archive = get_archive_post_type();
  $page_type = $archive ? $archive : get_post_type();
  $id = get_the_ID();
  $echo = '';

  // var_dump($page_type).'<br>';

  //checks if overriden
  // $page_type = get_field('aseta_sivun_alaosio') ? get_field('sivun_alaosiot_postaustyypista', $ıd, false) : $page_type;

  if (get_field('aseta_sivun_alaosio')) {
    $sivun_alaosiot_ctp = get_field('sivun_alaosiot_postaustyypista', $id, false);
    $sivun_alaosiot_ctp = $sivun_alaosiot_ctp[0] ?? $sivun_alaosiot_ctp;
    $page_type = $sivun_alaosiot_ctp;
  }
  // echo $page_type;

  $archive_id = $page_type . '_options';
  // var_dump( get_field('sivun_alaosiot', $archive_id, false) );

  $alaosat = get_field('sivun_alaosiot', $archive_id, false) ?? get_field('sivun_alaosiot', 'osat_options', false) ?? array();

  if (
    get_field('aseta_sivun_alaosio') && get_field('sivun_alaosiot', $id, false)
  ) {
    $alaosat = get_field('sivun_alaosiot', $id, false) ?? array();
  }

  $pois_nama_id = array(74, 145); //to avoid having duplicates
  $alaosat = array_diff($alaosat, $pois_nama_id);

  // echo pll_get_post(151).' --';
  // var_dump($alaosat);

  foreach ($alaosat as $page_id) {
    $page_id = $page_id + 0; //has to be integer.
    // var_dump($page_id);
    $obj = get_lang_object($page_id);
    $slug = $obj->post_name;
    // var_dump($obj);
    $echo .= '<section class="' . $slug . ' sitesection__wrapper">';
    $echo .= '<div class="wysiwyg">';
    $echo .= $obj->post_content;
    $echo .= '</div>';

    $edit_link = get_edit_post_link($page_id);
    if ($edit_link) {
      $echo .= '<a style="margin-top:.5rem; display: inline-block;" href="' . $edit_link . '">Muokkaa / Edit</a>';
    }

    $echo .= '</section>';
  }

  return $echo;
}



function get_relevant_sidebar(){

  $override_sidebar = get_field('aseta_sivupalkki') ? get_field('sivun_sivupalkki', false) : false;
  // var_dump($override_sidebar);
  if ($override_sidebar) {
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
  if ($query->have_posts()) {
    while ($query->have_posts()) {
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


/**
 * Adds relevant section above footer. (footer is priority 100)
 * Remove Aucor_Footer from it's module
 */
add_action('theme_footer', function() {

  echo get_relevant_sections();

  Favor_Footer::render();

}, 90, 0);

remove_action('theme_footer', ['Aucor_Footer', 'render'], 100, 0);


class Favor_Footer extends Aucor_Footer {
  public static function frontend($data) {
    ?>
    <footer <?php parent::render_attributes($data['attr']); ?>>

      <div class="site-footer__container wysiwyg">
        <?php echo get_lang_content(84, false); ?>
      </div>

    </footer>
    <?php
  }

}


/**
 * Hero stuff
 */
function remove_hero_with_acf(){
  $banner_template = get_field('banner_pohja');
  if($banner_template == 'remove'){
    remove_action('theme_hero', ['Aucor_Hero', 'render'], 100, 1);
  }
}

add_action('template_redirect', 'remove_hero_with_acf', 10);
