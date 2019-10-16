<?php

function display_map(){
  $map = '<div class="map__wrapper"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d843246.3570092141!2d26.252035168461664!3d65.61937082178433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x442a32c3beffaab1%3A0x2c453b0edbcc3b95!2sHotelli%20Iso-Sy%C3%B6te!5e0!3m2!1sfi!2sfi!4v1567587292242!5m2!1sfi!2sfi" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>';

  return $map;
}

add_shortcode( 'map', 'display_map' );
