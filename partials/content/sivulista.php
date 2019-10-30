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

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sivulista';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
$className .= ' ';
$className .= get_field('sivulistan_tausta') ?: 'brand';

$page_list_format = get_field('page_list_format');
$posts_per_page = get_field('sivulistaus')['amount'] ? get_field('sivulistaus')['amount'] : '12';
$custom_post_type = get_field('sivulistaus')['custom_post_type'] ? get_field('sivulistaus')['custom_post_type'] : 'post';
$category = get_field('sivulistaus')['kategoria'] ? get_field('sivulistaus')['kategoria'] : 0;

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
  $className .= ' '.$post_count_class;
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="sivulista__container">
		<?php
		// The Loop
		if ( $query->have_posts() ) {
			echo '<div class="sivulista__posts">';
			while ( $query->have_posts() ) {
        $query->the_post();
        // setup_postdata( $post );
        $post_type = get_post_type() ?? '';
        get_template_part('partials/content/card', $post_type);

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
