<?php

include_once 'woo.php';
//include_once 'wishlist.php';

function add_menu_link_class($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_link_class', 1, 3);


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


function custom_register_brands_taxonomy() {
    $labels = array(
        'name'              => _x('Brands', 'taxonomy general name', 'watche_block'),
        'singular_name'     => _x('Brand', 'taxonomy singular name', 'watche_block'),
        'search_items'      => __('Search Brands', 'watche_block'),
        'all_items'         => __('All Brands', 'watche_block'),
        'parent_item'       => __('Parent Brand', 'watche_block'),
        'parent_item_colon' => __('Parent Brand:', 'watche_block'),
        'edit_item'         => __('Edit Brand', 'watche_block'),
        'update_item'       => __('Update Brand', 'watche_block'),
        'add_new_item'      => __('Add New Brand', 'watche_block'),
        'new_item_name'     => __('New Brand Name', 'watche_block'),
        'menu_name'         => __('Brands', 'watche_block'),
    );

    $args = array(
        'hierarchical'      => true, // Make it behave like categories.
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'brand'),
    );

    register_taxonomy('brand', array('product'), $args);
}
add_action('init', 'custom_register_brands_taxonomy');


function cptui_register_my_cpts_stolen_watch() {

	/**
	 * Post Type: Stolen Watches.
	 */

	$labels = [
		"name" => esc_html__( "Stolen Watches", "watch_block" ),
		"singular_name" => esc_html__( "Stolen Watch", "watch_block" ),
	];

	$args = [
		"label" => esc_html__( "Stolen Watches", "watch_block" ),
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
		"rewrite" => [ "slug" => "stolen_watch", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "stolen_watch", $args );
}

add_action( 'init', 'cptui_register_my_cpts_stolen_watch' );





add_filter('loop_shop_columns', 'set_custom_columns');
function set_custom_columns($columns) {
    return 3; 
}


// Add excerpt below the product title
add_action('watch_block_product_desc', 'add_product_excerpt', 5);
function add_product_excerpt() {
    global $post;
    if (has_excerpt($post->ID)) {
        $raw_excerpt = get_the_excerpt();
        $trimmed_excerpt = wp_html_excerpt($raw_excerpt, 80, '...');
        echo '<div class="product-excerpt">' . wp_kses_post($trimmed_excerpt) . '</div>';
    }
}


function get_custom_limited_content( $limit = 50 ) {
    $content = get_the_content();
    $content = wp_strip_all_tags( $content ); // Remove HTML tags
    $words   = explode( ' ', $content );

    if ( count( $words ) > $limit ) {
        $content = implode( ' ', array_slice( $words, 0, $limit ) ) . '...';
    }

    return $content;
}
