<?php

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

    if(get_field('aseta_sivun_alaosio')){
      $sivun_alaosiot_ctp = get_field('sivun_alaosiot_postaustyypista', $id, false);
      $sivun_alaosiot_ctp = $sivun_alaosiot_ctp[0] ?? $sivun_alaosiot_ctp;
      $page_type = $sivun_alaosiot_ctp;
    }
    // echo $page_type;

    $archive_id = $page_type.'_options';
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

    foreach($alaosat as $page_id){
      $page_id = $page_id + 0; //has to be integer.
      // var_dump($page_id);
      $obj = get_lang_object($page_id);
      $slug = $obj->post_name;
      // var_dump($obj);
      $echo .= '<section class="'.$slug.' sitesection__wrapper">';
      $echo .= '<div class="wysiwyg">';
      $echo .= $obj->post_content;
      $echo .= '</div>';

      $edit_link = get_edit_post_link($page_id);
      if ($edit_link){
        $echo .= '<a style="margin-top:.5rem; display: inline-block;" href="'.$edit_link.'">Muokkaa / Edit</a>';
      }

      $echo .= '</section>';
    }

    return $echo;
}
