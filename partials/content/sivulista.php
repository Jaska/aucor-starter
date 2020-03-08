<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Sivulista Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Create id attribute allowing for custom "anchor" value.
$id = 'sivulista-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$template = get_field('sivulista_template');
if ($template == 'default'){
  $bem = 'sivulista';
  $post_template = 'teaser';
} else {
  $bem = $template;
  $post_template = 'card';
}
$class[] = $bem;

if( !empty($block['className']) ) {
    $class[] = $block['className'];
}
if( !empty($block['align']) ) {
  $class[] = 'align' . $block['align'];
}
$class[] = get_field('sivulistan_tausta') ?: 'brand';

/**
 * Tehdään BEM Block nimi sivulista, henkilolista, xlista,
 */

$page_list_format = get_field('page_list_format');
$posts_per_page = get_field('sivulistaus')['amount'] ? get_field('sivulistaus')['amount'] : '12';
$custom_post_type = get_field('sivulistaus')['custom_post_type'] ? get_field('sivulistaus')['custom_post_type'] : 'post';
$category = get_field('sivulistaus')['kategoria'] ? get_field('sivulistaus')['kategoria'] : 0;
$parent_page = get_field('sivulistaus')['parent_page'] ?? false;

$orderby = get_field('sivulistaus')['orderby'] ?? 'date';
$order = get_field('sivulistaus')['order'] ?? 'DESC';

$use_current_category = get_field('sivulistaus')['otetaanko_kategoria_taman_sivun_kategoriasta'] ? get_field('custom_post_type')['otetaanko_kategoria_taman_sivun_kategoriasta'] : 0;

if (get_field('sivulistaus')['otetaanko_kategoria_taman_sivun_kategoriasta']) {
	$output_categories = array();
	$categories=get_the_category();
	foreach($categories as $category) {
		// $output_categories[$category->cat_ID] = $category->name;
		array_push($output_categories, $category->cat_ID);
	}
	// print_r($output_categories);
	$category = $output_categories;
}

// WP_Query arguments
// $custom_post_type = array('page, post');
$args = array(
	'post_type'              => $custom_post_type,
	'posts_per_page'         => $posts_per_page,
	'orderby'                  => $orderby,
	'order'                  => $order,
);

if ($parent_page){
  $parent_page_id = $parent_page->ID;
  // var_dump($parent_page_id);
  $args['post_parent__in'] = array($parent_page_id);
}

if ($page_list_format == 2){
	$erikseen_valitut_sisallot = get_field('erikseen_valitut_sisallot', false, false);
	$args['post__in'] = $erikseen_valitut_sisallot;
	$args['post_type'] = array('any');
	$args['orderby']        	= 'post__in';
	$args['ignore_sticky_posts'] = true;
}

if ($category){
	$args['tax_query'] = array(
		array (
			'taxonomy' => 'category',
			'field' => 'term_id',
			'terms' => $category
			// 'terms' => 'politics',
		)
	);
}

// The Query
$query = new WP_Query( $args );

$post_count_class = count($query->posts) ? 'post_count_'.count($query->posts) : false;
if ($post_count_class){
  $class[] = $post_count_class;
}
?>
<div id="<?php echo esc_attr($id); ?>" class="sivulista <?php echo esc_attr(implode(' ', $class)); ?>">
	<div class="<?php echo $bem;?>__container">
		<?php
		// The Loop
		if ( $query->have_posts() ) {
			echo '<div class="'.$bem.'__posts">';
			while ( $query->have_posts() ) {
        $query->the_post();
        // setup_postdata( $post );
        $post_type = get_post_type() ?? '';
        get_template_part('partials/content/'.$post_template, $post_type);

			}
			echo '</div>';
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
		}
		?>
	</div>
</div>
