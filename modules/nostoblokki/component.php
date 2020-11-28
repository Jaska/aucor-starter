<?php
/**
 * Component: Spacer
 *
 * @example
 * Aucor_Spacer::render();
 *
 * @package aucor_starter
 */
class nostoblokki extends Aucor_Component {
  public static function frontend($data) {
  ?>
    <article <?php parent::render_attributes($data['attr']); ?>>

    <div class="nostoblokki__content">
      <?php if ($data['otsikko']) { ?>
        <div class="nostoblokki__otsikko">
          <?php if ($data['linkki']) { echo '<a href="'.$data['linkki'].'">'; } ?>
          <?= $data['otsikko'] ?>
          <?php if ($data['linkki']) { echo '</a>'; } ?>
        </div>
      <?php } ?>

      <?php if ($data['kuvausteksti']) { ?>
        <div class="nostoblokki__kuvausteksti">
          <?php if ($data['linkki']) { echo '<a href="'.$data['linkki'].'">'; } ?>
          <?= $data['kuvausteksti'] ?>
          <?php if ($data['linkki']) { echo '</a>'; } ?>
        </div>
      <?php } ?>
    </div>
    <?php if ($data['kuva_html']) { ?>
      <div class="nostoblokki__kuva">
      <?php if ($data['linkki']) { echo '<a href="'.$data['linkki'].'">'; } ?>
        <?php echo $data['kuva_html']; ?>
      <?php if ($data['linkki']) { echo '</a>'; } ?>
      </div>
	  <?php } ?>
    </article>
  <?php
  }

  public static function backend($args = [])
  {
    // $placeholders = [

    //   'preview' => false,
    //   'attr'    => [],

    // ];

    // $args = wp_parse_args($args, $placeholders);

    // if (!isset($args['attr']['class'])) {
    //   $args['attr']['class'] = [];
    // }

    // if ($args['preview']) {
    //   $args['attr']['class'][] = 'is-preview';
    // }

    // return $args;

    /**
     * Nostoblokki…
     * Aluksi placeholderit JOS on preview
     * Sitten haetaan sivusta, jos se on laitettu.
     * Sitten haetaan kentät, jos ne on täytetty.
     */
    $word_amount = 13;

    $block = $args['acf_params']['block'];
    $content = $args['acf_params']['content'];
    $is_preview = $args['acf_params']['is_preview'];
    $post_id = $args['acf_params']['post_id'];

    $fields = $args['acf_params']['fields'] ?? get_fields();


    $pohja = $field['template'] ?? 'default';
    $pohja = strtolower($pohja);

    $placeholders = [];
    if ($args['acf_params']['is_preview']){
      $placeholders = [
        'otsikko' => 'Otsikko!',
        'kuvausteksti' => 'Kuvaustekstiä tähän vapaasti.',
        'kuva' => get_post_thumbnail_id(get_option('page_on_front')),
      ];
    } else {
      $placeholders = [
        'otsikko' => null,
        'kuvausteksti' => null,
        'kuva' => null,
      ];
    }

    $inherit_from_page = [];

    $link_id = $fields['link'];
    if (is_object($link_id)) {
      //in case acf settings return object
      $link_id = $link_id->ID;
    }
    if ($link_id){
      $wpquery_args = [
        'post_type' => 'any',
        'p' => $link_id,
      ];
      $query = new WP_Query($wpquery_args);

      if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
          $inherit_from_page['otsikko'] = get_the_title();
          // $fb_kuvausteksti = get_the_excerpt();
          $inherit_from_page['kuvausteksti'] = wp_trim_words( get_the_content(), $word_amount);
          $inherit_from_page['linkki'] = get_the_permalink();
          $inherit_from_page['kuva'] = get_post_thumbnail_id();
          $query->reset_postdata();
        endwhile;
        wp_reset_postdata();
      endif;
    }

    $overrides = [];

    ($i = $fields['otsikko'] ?? false) ? $overrides['otsikko'] = $i : 0;
    ($i = $fields['kuvausteksti'] ?? false) ? $overrides['kuvausteksti'] = $i : 0;
    ($i = $fields['kuva'] ?? false) ? $overrides['kuva'] = $i['id'] : 0;
    ($i = $fields['external_link'] ?? false) ? $overrides['linkki'] = $i['url'] : 0;

    $args = wp_parse_args($args, $overrides);
    $args = wp_parse_args($args, $inherit_from_page);
    $args = wp_parse_args($args, $placeholders);

    $kuva = $args['kuva'] ?? false;
    $args['kuva_html'] = '';

    $slider_pohja = $args['acf_params']['slider_pohja'] ?? false;
    // var_dump($slider_pohja); //$pohja on se nostoblokin pohja… mutta miten saan sliderin pohjan.
    if($kuva){
      switch($pohja){
        case "fixed_1":
          $size = 'hero_xl';
        break;
        case "fixed_2":
          $size = "square_xl";
        break;
        default:
          $size = 'hero_xl';
        break;
      }
      if($slider_pohja == 'landing'){
        $args['kuva_html'] = '';
        //echo wp_get_attachment_image($kuva, $thumbnail_size, false, 'data-heippa');
        $mobile_url = wp_get_attachment_image_src($kuva, 'square_xl');
        $regular_url = wp_get_attachment_image_src($kuva, 'banner_xl');
        // var_dump($mobile_url);

        $args['kuva_html'] .= '<picture>';
        $args['kuva_html'] .=   '<source media="(max-width: 559px)" srcset="'.$mobile_url[0].'">';
        $args['kuva_html'] .=   '<source media="(min-width: 560px)" srcset="'.$regular_url[0].'">';
        $args['kuva_html'] .=   '<img src="'.$regular_url[0].'">';
        $args['kuva_html'] .= '</picture>';
      } else {
        $args['kuva_html'] = wp_get_attachment_image($kuva, $size);
      }
      // var_dump($kuva_html);
      // $x = wp_get_attachment_image_src($kuva, $size); // url, width, height, …
      // $width = $x[1];
      // $height = $x[2];
      // // var_dump($x);
      // // echo $width.' and '.$height;
      // // echo ' mutta: '.$height / $width;
      // $css_ratio = $height / $width * 100 . '%';
      // $css_ratio = 9 / 16 * 100 . '%';
      // $css_ratio = 292 . 'px';
    }

    //FFS!
    $args['linkki'] = $args['linkki'] ?? false;
    $args['kuvausteksti'] = $args['kuvausteksti'] ?? false;

    $args['bem__block'] = 'nostoblokki';
    // $args['otsikko'] = $args['bem__block'];

    $args['attr']['class'][] = $args['bem__block'];
    $args['attr']['class'][] = 'nostoblokki--'.$pohja;
    // $args['attr']['class'][] = $block_id;
    $args['attr']['class'][] = $block['align'] ? 'align' . $block['align'] : '';
    $args['attr']['class'][] = ($fields['text_alignment'] ?? false) ?
      'text-alignment--'.$fields['text_alignment'] : 'text-alignment--default';

    return $args;


  }
}
