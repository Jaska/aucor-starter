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
// var_dump($fields);
$args = array();
$pohja = $fields['template'] ?? 'violetti';
$pohja = strtolower($pohja);

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
			$fb_kuvausteksti = wp_trim_words( get_the_content(), 20);
			$fb_linkki = get_the_permalink();
			$fb_kuva = get_post_thumbnail_id();
		endwhile;
		wp_reset_postdata();
	endif;
}

//superfallback
// $post_thumbnail_id = get_post_thumbnail_id(get_option('page_on_front'));

//fb = fallback
$fb_otsikko = $fb_otsikko ?? false;
$fb_kuvausteksti = $fb_kuvausteksti ?? false;
$fb_kuva = $fb_kuva ?: get_post_thumbnail_id(get_option('page_on_front')) ?? false;

$fb_linkki = $fb_linkki ?? false;

$otsikko = $fields['otsikko'] ?? $fb_otsikko;
$kuvausteksti = $fields['kuvausteksti'] ?? $fb_kuvausteksti;
$kuva = $fields['kuva']['id'] ?? $fb_kuva;
$linkki = $acf_link ?? $fb_linkki;

// var_dump($pohja);
?>
<div class="nostoblokki
nostoblokki--<?= $pohja; ?>">

	<?php if ($otsikko) { ?>
		<div class="nostoblokki__otsikko">
			<?php if ($linkki) { echo '<a href="'.$linkki.'">'; } ?>
			<?= $otsikko ?>
			<?php if ($linkki) { echo '</a>'; } ?>
		</div>
	<?php } ?>

	<?php if ($kuva) { ?>
		<div class="nostoblokki__kuva">
		<?php if ($linkki) { echo '<a href="'.$linkki.'">'; } ?>
			<?php echo wp_get_attachment_image($kuva, 'large'); ?>
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
<?php
