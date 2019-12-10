<?php

register_post_type('osat', array(
	'label' => 'Sivuston osat',
	'description' => 'Footer, yleiset sektiot',
	'hierarchical' => false,
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'revisions',
	),
	'taxonomies' => array(
	),
	'public' => false,
	'exclude_from_search' => true,
	'publicly_queryable' => false,
	'can_export' => true,
	'delete_with_user' => false,
	'labels' => array(
	),
	'menu_position' => 20,
	'menu_icon' => 'dashicons-text',
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => false,
	'show_in_admin_bar' => true,
	'rewrite' => true,
	'has_archive' => false,
	'show_in_rest' => true,
	'rest_base' => '',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
	'acfe_archive_template' => '',
	'acfe_archive_ppp' => 10,
	'acfe_archive_orderby' => 'date',
	'acfe_archive_order' => 'DESC',
	'acfe_single_template' => '',
	'acfe_admin_ppp' => 10,
	'acfe_admin_orderby' => 'date',
	'acfe_admin_order' => 'DESC',
	'capability_type' => 'page',
	'capabilities' => array(
	),
	'map_meta_cap' => NULL,
));

