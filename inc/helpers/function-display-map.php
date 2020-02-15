<?php

function display_map(){
  $map = '<div class="map__wrapper"><iframe src="" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>';

  return $map;
}

add_shortcode( 'map', 'display_map' );
