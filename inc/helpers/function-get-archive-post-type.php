<?php
function get_archive_post_type() {
  return is_archive() ? get_queried_object()->name : false;
}
