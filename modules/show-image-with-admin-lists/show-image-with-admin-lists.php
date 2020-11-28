<?php

add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_pages_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);
add_filter('manage_pages_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img_column" => "Image") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img_column' ) {
  echo get_the_post_thumbnail($post_id, 'thumbnail');
 }
 return $column_name;
}

add_action('admin_head', 'manage_img_column_css');

function manage_img_column_css() {
  echo '<style>
    .column-img_column {
      width: 60px;
    }
    .column-img_column img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
  </style>';
}
