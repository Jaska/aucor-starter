<?php

function social_menu_shortcode($atts){
  $echo = '';
  $echo .= '<nav id="social-navigation" class="social-navigation" aria-label="'.ask__('Menu: Social Menu').'" itemscope itemtype="http://schema.org/SiteNavigationElement">';

  // if (!is_admin()){
  //   get_template_part('partials/navigation/menu-social');
  // }
  $echo .= wp_nav_menu(array(
    'theme_location' => 'social',
    'container'      => '',
    'menu_id'        => 'social-navigation__items',
    'menu_class'     => 'social-navigation__items',
    'depth'          => 1,
    'link_before'    => '',
    'link_after'     => '',
    'fallback_cb'    => '',
    'echo'           => false,
  ));

  $echo .= '</nav>';

  return $echo;
}

add_shortcode( 'social_menu', 'social_menu_shortcode' );
