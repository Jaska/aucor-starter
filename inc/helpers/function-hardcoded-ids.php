<?php
/**
 * Hardcoded IDs
 *
 * @package aucor_starter
 */

/**
 * Get hardcoded ID by key
 *
 * @param string $key a name of hardcoded id
 *
 * @return int harcoded id
 */
function starter_get_hardcoded_id($key = '') {

  switch ($key) {

    // case 'example':
    //   return 123;
    case 'footer':
      return 74;

    default:
      return 0;

  }

}
