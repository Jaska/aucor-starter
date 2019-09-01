<?php
add_filter('admin_body_class', function($classes){
  //get current page
  global $pagenow;

  //check if the current page is post.php and if post params set
  if ($pagenow == 'post.php' && isset($_GET['post'])){
    //get post type from url via id
    $post_type = get_post_type( $_GET['post']);
    // append the new class
    $classes .= 'single-' . $post_type;
  }
  //next check if this is a new post
  else if ( $pagenow === 'nost-new.php'){
    // check if post_type param is set
    if (isset($_GET['post_type'])){
      // in this case get post ype directly from url
      $classes .= 'single-' . urldecode($_GET['post_type']);
    } else {
      // if not set, 'post' is being created
      $classes .= 'single-post';
    }
  }

  return $classes;

});
