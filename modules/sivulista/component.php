<?php

/**
 * Component: Sivulista
 *
 * @example
 * Sivulista::render();
 *
 * @package aucor_starter
 */
class Renderlista extends Sivulista {
  public static function frontend($data){

    ?>
    <div <?php parent::render_attributes($data['attr']); ?>>

      <div class="renderlista__container">
          <h1><?php echo get_class(); ?> Renderlista</h1>
      </div>


    <?php
  }
}

class Sivulista extends Aucor_Component
{
  public static function frontend($data)
  {
    // print_r($data['wp_query_args']);
    // var_dump($data);
?>
    <div <?php parent::render_attributes($data['attr']); ?>>
      <?php if ($data['preview']) : ?>
        <div class="spacer__indicator"></div>
      <?php endif; ?>

      <?php
      $query = $data['query'];
      if($query->have_posts()){
        while ( $query->have_posts() ) {
          $query->the_post();
          echo get_the_title();
        }
      } else {

      }
      wp_reset_postdata();

      ?>
    </div>
<?php
  }

  public static function backend($args = [])
  {
    $block = $args['block'];

    $placeholders = [

      'preview' => false,
      'attr'    => [],

      'template' => 'default',
      'page_list_format' => '1',
      'background' => 'brand',

      'wp_query_args' => [
        'post_type' => ['any'],
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page'  => '12',
      ],

    ];

    $args = $args + [
      'template' => get_field('sivulista_template'),
      'joku-toinen' => 123,
      'page_list_format' => get_field('page_list_format'),
      'background' => get_field('sivulistan_tausta'),
      'wp_query_args' => [
        // WP_Query arguments
        'posts_per_page'  => ( get_field('sivulistaus')['amount'] ?? false ),
        'post_type'       => ( get_field('sivulistaus')['custom_post_type'] ?? false ),
        'orderby'         => get_field('sivulistaus')['orderby'],
        'order'           => get_field('sivulistaus')['order'],
      ],
    ];

    // falset, nullit ja tyhjät pois,
    $args = array_filter($args);

    $args = wp_parse_args($args, $placeholders);



    $parent_page = get_field('sivulistaus')['parent_page'] ?? false;
    if ($parent_page) {
      $args['wp_query_args']['post_parent__in'] = array($parent_page->ID);
    }

    if ($args['page_list_format'] == 2) {
      $erikseen_valitut_sisallot = get_field('erikseen_valitut_sisallot', false, false);
      $args['wp_query_args']['post__in']            = $erikseen_valitut_sisallot;
      $args['wp_query_args']['post_type']           = array('any');
      $args['wp_query_args']['orderby']             = 'post__in';
      $args['wp_query_args']['ignore_sticky_posts'] = true;
    }

    $category = get_field('sivulistaus')['kategoria'] ? get_field('sivulistaus')['kategoria'] : 0;

    if ( (get_field('sivulistaus')['otetaanko_kategoria_taman_sivun_kategoriasta'] ?? false )) {
      $output_categories = [];
      foreach (get_the_category() as $category) {
        array_push($output_categories, $category->cat_ID);
      }
      $category = $output_categories;
    }

    if ($category) {
      $args['wp_query_args']['tax_query'] = [
        [
          'taxonomy' => 'category',
          'field' => 'term_id',
          'terms' => $category
        ]
      ];
    }

    $args['query'] = new WP_Query( $args['wp_query_args']);
    // wp_reset_postdata();


    // Create id attribute allowing for custom "anchor" value.
    $args['attr']['id'] = $block['anchor'] ?? $args['template'].'-'.$block['id'];


    if (!isset($args['attr']['class'])) {
      $args['attr']['class'] = [];
    }

    if (!empty($block['className'])) {
      $args['attr']['class'][] = $block['className'];
    }
    if (!empty($block['align'])) {
      $args['attr']['class'][] = 'align' . $block['align'];
    }
    $args['attr']['class'][] = $args['background'];

    if ($args['preview']) {
      $args['attr']['class'][] = 'is-preview';
    }

    return $args;
  }
}
