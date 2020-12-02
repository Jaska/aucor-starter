<?php

/**
 * Component: Spacer
 *
 * @example
 * nostoblokki::render();
 *
 * @package aucor_starter
 */
class nostoblokki extends Aucor_Component
{
  public static function frontend($data)
  {
?>
    <article <?php parent::render_attributes($data['attr']); ?>>

      <div class="nostoblokki__content">
        <?php if ($data['otsikko']) { ?>
          <h3 class="nostoblokki__otsikko">
            <?php if ($data['linkki']) {
              echo '<a href="' . $data['linkki'] . '">';
            } ?>
            <?= $data['otsikko'] ?>
            <?php if ($data['linkki']) {
              echo '</a>';
            } ?>
          </h3>
        <?php } ?>

        <?php if ($data['kuvausteksti']) { ?>
          <div class="nostoblokki__kuvausteksti">
            <?php if ($data['linkki']) {
              echo '<a href="' . $data['linkki'] . '">';
            } ?>
            <?= $data['kuvausteksti'] ?>
            <?php if ($data['linkki']) {
              echo '</a>';
            } ?>
          </div>
        <?php } ?>
      </div>
      <?php if ($data['kuva_html']) { ?>
        <div class="nostoblokki__kuva">
          <?php if ($data['linkki']) {
            echo '<a href="' . $data['linkki'] . '">';
          } ?>
          <?php echo $data['kuva_html']; ?>
          <?php if ($data['linkki']) {
            echo '</a>';
          } ?>
        </div>
      <?php } ?>
    </article>
<?php
  }

  public static function backend($args = [])
  {
    /**
     * Nostoblokki…
     * Aluksi placeholderit JOS on preview
     * Sitten haetaan sivusta, jos se on laitettu.
     * Sitten haetaan kentät, jos ne on täytetty.
     */
    $word_amount = 13;

    $block = $args['block'];

    $fields = $args['fields'] ?? get_fields() ?? false;

    $pohja = $fields['nostoblokki_block_template'] ?? 'default';
    $pohja = strtolower($pohja);

    $placeholders = [
      'preview' => false,
      'attr'    => [],
    ];
    if (isset($args['is_preview'])) {
      $placeholders = [
        'otsikko' => 'Otsikko',
        'kuvausteksti' => 'Kuvaustekstiä lorem ipsum.',
        'kuva' => get_post_thumbnail_id(get_option('page_on_front')),
      ];
    }
    $placeholders = array_filter($placeholders);


    $inherit_from_page = [];

    $link_id = $fields['link'];
    if (is_object($link_id)) {
      //in case acf settings return object
      $link_id = $link_id->ID;
    }
    if ($link_id) {
      $nosto_post = get_post($link_id);

      $nosto_post_content = $nosto_post->post_content;
      $nosto_post_content = apply_filters('the_content', $nosto_post_content);
      $nosto_post_content = str_replace(']]>', ']]>', $nosto_post_content);
      $nosto_post_excerpt = wp_trim_words($nosto_post_content, $word_amount);

      $inherit_from_page = [
        'otsikko'         => $nosto_post->post_title,
        'kuvausteksti'    => $nosto_post_excerpt,
        'linkki'          => get_the_permalink($nosto_post),
        'kuva'            => get_post_thumbnail_id($nosto_post),
      ];
      $inherit_from_page = array_filter($inherit_from_page);
    }

    $overrides = [
      'otsikko'       => $fields['otsikko'],
      'kuvausteksti'  => $fields['kuvausteksti'],
      'kuva'          => ($fields['kuva'] ? $fields['kuva']['id'] : null),
      'linkki'        => (is_array($fields['external_link']) ? $fields['external_link']['url'] : null),
    ];
    $overrides = array_filter($overrides);

    /**
     * Combine all args
     */
    $args = wp_parse_args($args, $overrides);
    $args = wp_parse_args($args, $inherit_from_page);
    $args = wp_parse_args($args, $placeholders);

    //FFS!
    $args['linkki'] = $args['linkki'] ?? false;
    $args['kuvausteksti'] = $args['kuvausteksti'] ?? false;

    $args['bem__block'] = 'nostoblokki';

    $kuva = $args['kuva'] ?? false;
    $args['kuva_html'] = '';

    // var_dump($kuva);

    if ($kuva) {
      switch ($pohja) {

        /**
         * Remember to create suitable css templates
         */
        case "solo_nosto":
          $args['kuva_html'] = Favor_image::get($kuva, [
            ['background_m', 'max-width: 559px'],
            ['background_l', 'min-width: 560px'],
            ['hero_l', 'min-width: 1120px'],
          ]);
          break;

        case "group_nosto":
          $args['kuva_html'] = Favor_image::get($kuva, [
            ['background_m', 'max-width: 559px'],
            ['background_s', 'min-width: 560px']
          ]);
          break;

          default:
            $kuva_obj = wp_get_attachment_image($kuva, 'background_m');
            $args['kuva_html'] = $kuva_obj ? $kuva_obj : false;
          break;
      }
    }

    //Classes
    if (!isset($args['attr']['class'])) {
      $args['attr']['class'] = [];
    }

    if ($args['preview']) {
      $args['attr']['class'][] = 'is-preview';
    }

    $args['attr']['class'][] = $args['bem__block'];
    $args['attr']['class'][] = 'nostoblokki--' . $pohja;
    // $args['attr']['class'][] = $block_id;
    $args['attr']['class'][] = $block['align'] ? 'align' . $block['align'] : '';
    $args['attr']['class'][] = ($fields['text_alignment'] ?? false) ?
      'text-alignment--' . $fields['text_alignment'] : 'text-alignment--default';

    return $args;
  }
}




/**
 * Favor_image - useful picture element helper
 *
 *  // $testimage = Favor_image::get($kuva, [
 *  //   ['image_size_1', 'max-width: 559px'],
 *  //   ['image_size_2', 'min-width: 560px']
 *  // ]);
 */
class Favor_image
{
  public static function get($id, $sources)
  {

    if (!$id || !$sources || !count($sources)) {
      return false;
    }

    $size_i = 0;
    $mq_i = 1;

    $echo = '<picture>';

    foreach ($sources as $i => $source) {
      $image_url = wp_get_attachment_image_src($id, $source[$size_i]);
      $echo .=   '<source media="' . $source[$mq_i] . '" srcset="' . $image_url[0] . '">';

      if ($i == 0) {
        $fallback_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        $fallback_img = '<img src="' . $image_url[0] . '" alt="' . $fallback_alt . '">';
      }
    }
    $echo .= $fallback_img;
    $echo .= '</picture>';

    return $echo;
  }
}



/**
 * Favor classi? Nääh. Kasvais liikaa.
 */
