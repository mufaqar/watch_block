<?php


function cptui_register_my_cpts() {

	
	/**
	 * Post Type: FAQs.
	 */

	 $labels = [
		"name" => esc_html__( "FAQs", "watch_block" ),
		"singular_name" => esc_html__( "FAQ", "watch_block" ),
	];

	$args = [
		"label" => esc_html__( "FAQs", "watch_block" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "faqs", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "faqs", $args );

	/**
	 * Post Type: Team.
	 */

	$labels = [
		"name" => esc_html__( "Team", "watch_block" ),
		"singular_name" => esc_html__( "Team", "watch_block" ),
	];

	$args = [
		"label" => esc_html__( "Team", "watch_block" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "team", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "team", $args );

	/**
	 * Post Type: Reviews.
	 */

	$labels = [
		"name" => esc_html__( "Reviews", "watch_block" ),
		"singular_name" => esc_html__( "Review", "watch_block" ),
	];

	$args = [
		"label" => esc_html__( "Reviews", "watch_block" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "reviews", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "reviews", $args );

	/**
	 * Post Type: Request Watches.
	 */

	$labels = [
		"name" => esc_html__( "Request Watches", "twentytwentyfour" ),
		"singular_name" => esc_html__( "Request Watch", "twentytwentyfour" ),
	];

	$args = [
		"label" => esc_html__( "Request Watches", "twentytwentyfour" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => false,
		"rewrite" => [ "slug" => "request_watch", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "page-attributes" ],
		"show_in_graphql" => false,
	];

	register_post_type( "request_watch", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );




function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Categories.
	 */

	$labels = [
		"name" => esc_html__( "Categories", "watch_block" ),
		"singular_name" => esc_html__( "Category", "watch_block" ),
	];

	
	$args = [
		"label" => esc_html__( "Categories", "watch_block" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'cat_faqs', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "cat_faqs",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "cat_faqs", [ "faqs" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );




