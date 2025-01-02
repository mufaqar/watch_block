<?php
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



add_filter('loop_shop_columns', 'set_custom_columns');
function set_custom_columns($columns) {
    return 3; // Set the number of columns to 4
}


// Add excerpt below the product title
add_action('watch_block_product_desc', 'add_product_excerpt', 5);

function add_product_excerpt() {
    global $post;

    // Check if the excerpt exists
    if (has_excerpt($post->ID)) {
        echo '<div class="product-excerpt">' . wp_kses_post(get_the_excerpt()) . '</div>';
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
