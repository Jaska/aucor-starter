<?php
/**
 * REMEMBER TO ALSO ADD CUSTOM BLOCKS TO register-blocks.php
 * etc: acf/nostoblokki
 * https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
add_action('acf/init', 'register_custom_blocks', 11, 2);

function register_custom_blocks() {

    if( function_exists('acf_register_block') ) {

        //  The core provided categories are [ common | formatting | layout | widgets | embed ]
        // https://developer.wordpress.org/resource/dashicons/#layout
        // example colors: azure, lavender, Ivory, Honeydew, Seashell

        // acf_register_block_type(array(
        //   'name'              => 'exampleblock',
        //   'title'             => __('Name of the block'),
        //   'description'       => __('A custom testimonial block.'),
        //   'render_template'   => 'partials/content/nosto.php',
        //   'category'          => 'formatting',
        //   'icon'              => array('background' => 'lavender', 'src' => 'nametag'),
        // ));

        acf_register_block_type(array(
          'name'              => 'nostoblokki',
          'title'             => __('Nostoblokki'),
          // 'description'       => __('A custom testimonial block.'),
          'render_template'   => 'partials/content/nosto.php',
          'category'          => 'formatting',
          'mode'              => 'preview',
          'icon'              => array('background' => 'lavender', 'src' => 'nametag'),
      ));
        acf_register_block(array(
          'name'              => 'sivulista',
          'title'             => __('Sivulista'),
          'description'       => __('Luo 3 uusinta uutista, listaa kategorian mukaan sisältöjä…'),
          'render_template'   => 'partials/content/sivulista.php',
          'category'          => 'formatting',
          // 'icon'              => 'admin-comments',
          'mode'              => 'edit',
          'icon'              => array('background' => 'linen', 'src' => 'excerpt-view'),
          //'keywords'          => array( 'testimonial', 'quote' ),
        ));

    }
}
