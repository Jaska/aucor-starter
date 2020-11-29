<?php

function theme_fonts(){
  // https://fonts.google.com/specimen/Roboto?query=roboto&sidebar.open=true&selection.family=Roboto:wght@400;900
  ?>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap" rel="stylesheet">
  <?php
}

add_action('wp_head', 'theme_fonts', 10);
add_action('admin_head', 'theme_fonts', 10);
