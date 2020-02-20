<?php
/**
 * This is the template that renders the block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$fields = get_fields();
// var_dump($block);
$args = array();
$pohja = $fields['template'] ?? 'default';
$pohja = strtolower($pohja);
$block_id = 'bid--'.wp_generate_uuid4();
$word_amount = 13;
$fb_kuva = '';

$link_id = get_field('link');
if (is_object($link_id)) {
	//in case acf settings return object
	$link_id = $link_id->ID;
}
if ($link_id){
	$args = array(
		'post_type' => 'any',
		'p' => $link_id,
	);
	$query = new WP_Query($args);

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
			$fb_otsikko = get_the_title();
      // $fb_kuvausteksti = get_the_excerpt();
      $fb_kuvausteksti = wp_trim_words( get_the_content(), $word_amount);
			$fb_linkki = get_the_permalink();
			$fb_kuva = get_post_thumbnail_id();
			$query->reset_postdata();
		endwhile;
		// wp_reset_postdata();
	endif;
}

$nayta_uusin_artikkeli = $fields['nayta_uusin_artikkeli'] ?? false;
if ($nayta_uusin_artikkeli) {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
	);

	$query = new WP_Query($args);

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
			$fb_otsikko = get_the_title();
			$page_id = get_the_ID();
			// $fb_kuvausteksti = the_excerpt($page_id);
			$fb_kuvausteksti = wp_trim_words( get_the_content(), $word_amount);
			$fb_linkki = get_the_permalink();
			$fb_kuva = get_post_thumbnail_id();
		endwhile;
		wp_reset_postdata();
	endif;
}

$fb_otsikko = $fb_otsikko ?? ($is_preview ? 'Otsikko!' : false);
$fb_kuvausteksti = $fb_kuvausteksti ?? ($is_preview ? 'Kuvaustekstiä tähän vapaasti.' : false);
$fb_kuva = $fb_kuva ?: (get_post_thumbnail_id(get_option('page_on_front')) ?? false);

$extlink = get_field('external_link') ?: false;

$extlink_url = $extlink['url'] ?? false;

$fb_linkki = $extlink_url ?: ( $fb_linkki ?? false );

$otsikko = $fields['otsikko'] ?? $fb_otsikko;
$kuvausteksti = $fields['kuvausteksti'] ?? $fb_kuvausteksti;
$kuva = $fields['kuva']['id'] ?? $fb_kuva;
$linkki = $acf_link ?? $fb_linkki;

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
  // $size = 'full';
  // $size = 'large';
  // $size = 'hero_xl';
  // $size = 'hero_md';
  // $size = 'square_xl';
  $kuva_html = wp_get_attachment_image($kuva, $size);
  // var_dump($kuva_html);
  $x = wp_get_attachment_image_src($kuva, $size); // url, width, height, …
  $width = $x[1];
  $height = $x[2];
  // var_dump($x);
  // echo $width.' and '.$height;
  // echo ' mutta: '.$height / $width;
  $css_ratio = $height / $width * 100 . '%';
  $css_ratio = 9 / 16 * 100 . '%';
  $css_ratio = 292 . 'px';
}

$class[] = 'nostoblokki--'.$pohja;
$class[] = $block_id;
$class[] = $block['align'] ? 'align' . $block['align'] : '';
?>
<div class="nostoblokki <?php echo esc_attr(implode(' ', $class)); ?>">
<?php
  // echo $is_block_editor;
?>

<div class="nostoblokki__content">
  <?php if ($otsikko) { ?>
		<div class="nostoblokki__otsikko">
			<?php if ($linkki) { echo '<a href="'.$linkki.'">'; } ?>
			<?= $otsikko ?>
			<?php if ($linkki) { echo '</a>'; } ?>
		</div>
  <?php } ?>

  <?php if ($kuvausteksti){ ?>
    <div class="nostoblokki__kuvausteksti">
      <?php if ($linkki) { echo '<a href="'.$linkki.'">'; } ?>
      <?= $kuvausteksti ?>
      <?php if ($linkki) { echo '</a>'; } ?>
    </div>
  <?php } ?>

  </div>

	<?php if ($kuva) { ?>
		<div class="nostoblokki__kuva">
		<?php if ($linkki) { echo '<a href="'.$linkki.'">'; } ?>
			<?php echo $kuva_html; ?>
		<?php if ($linkki) { echo '</a>'; } ?>
		</div>
	<?php } ?>


  <?php if (0 && $kuva) {
  //allows picture specific aspect ratio elements… but let's not use them
  ?>
    <style>
      <?php echo '.'.$block_id ?>:before {
        padding-bottom: <?php echo $css_ratio; ?>;
      }
    </style>
  <?php } ?>


</div>
<?php
