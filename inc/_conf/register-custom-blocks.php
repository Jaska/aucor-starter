<?php
/**
 * REMEMBER TO ALSO ADD CUSTOM BLOCKS TO register-blocks.php
 * etc: acf/nostoblokki
 *
 * Täältä ikonit
 * https://developer.wordpress.org/resource/dashicons/#excerpt-view
 *
 * Pastellivärit jees, esim:
 * azure
* lavender
* Cornsilk > Ivory
* Honeydew
* Linen > Seashell
 */
// add_action('acf/init', 'register_custom_blocks', 11, 2);

// function register_custom_blocks() {

//     if( function_exists('acf_register_block') ) {

//         acf_register_block_type(array(
//             'name'              => 'nostoblokki',
//             'title'             => __('Nostoblokki'),
//             // 'description'       => __('A custom testimonial block.'),
//             'render_template'   => 'partials/content/nosto.php',
//             'category'          => 'formatting',
//             'icon'              => array('background' => 'lavender', 'src' => 'nametag'),
//         ));

//         acf_register_block_type(array(
//             'name'              => 'review',
//             'title'             => __('Arvostelu'),
//             // 'description'       => __('A custom testimonial block.'),
//             'render_template'   => 'partials/content/review.php',
//             'category'          => 'widgets',
//             'icon'              => array('background' => 'azure', 'src' => 'star-filled'),
//         ));

//         acf_register_block(array(
//           'name'              => 'sivulista',
//           'title'             => __('Sivulista'),
//           'description'       => __('Luo 3 uusinta uutista, listaa kategorian mukaan sisältöjä…'),
//           'render_template'   => 'partials/content/sivulista.php',
//           'category'          => 'formatting',
//           // 'icon'              => 'admin-comments',
//           'mode'              => 'edit',
//           'icon'              => array('background' => 'linen', 'src' => 'excerpt-view'),
//           //'keywords'          => array( 'testimonial', 'quote' ),
//   ));

//     }
// }
