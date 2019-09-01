<?php
/**
 * Template part: Title
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package starter_19
 */

// title
if (is_singular()) {
	$title = get_the_title();
	} else {
	$title = starter_get_the_archive_title();
}

// description
$description = '';
if (is_singular()) {
  $description = get_post_meta(get_the_ID(), 'lead', true);
} else {
  $description = get_the_archive_description();
}

// meta
$meta = '';
if (is_singular() && get_post_type() === 'post') {
  $meta = starter_get_posted_on();
}
?>

<div class="title__container">
	<h1 class="title__title"><?php echo $title; ?></h1>

	<?php if (!empty($meta)) : ?>
		<div class="title__meta"><?php echo $meta; ?></div>
	<?php endif; ?>

	<?php if (!empty($description)) : ?>
		<p class="title__description"><?php echo $description; ?></p>
	<?php endif; ?>
</div>
