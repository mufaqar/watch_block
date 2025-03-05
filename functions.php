<?php
/**
 * CBL_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CBL_Theme
 */

 

function my_theme_enqueue_styles() {
    wp_enqueue_style('custom_css', get_template_directory_uri() . '/custom.css', array(), null);
    wp_enqueue_style('woo_css', get_template_directory_uri() . '/woo-style.css', array(), null);
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/dist/style.css', array(), '1.0', 'all');
   
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');



add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );


//add_filter( 'woocommerce_rest_check_permissions', 'my_woocommerce_rest_check_permissions', 90, 4 );

// function my_woocommerce_rest_check_permissions( $permission, $context, $object_id, $post_type  ){
//    // return true;
//   }
  

// This theme uses wp_nav_menu() in two locations.
register_nav_menus(
    array(
        'main' => __( 'Main Menu', 'watch_block' ),
        'footer' => __( 'Footer Menu', 'watch_block' ),
    )
);



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/menu-function.php';


function enqueue_custom_scripts() {
    wp_enqueue_script('custom-menu-toggle', get_template_directory_uri() . '/js/script.js', array(), '1.0', true);	
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function enqueue_custom_minicart_script() {
    // Enqueue WooCommerce cart fragments for dynamic updates
    wp_enqueue_script('wc-cart-fragments');

    // Enqueue custom script
    wp_enqueue_script(
        'custom-minicart-script', 
        get_stylesheet_directory_uri() . '/js/woo.js', 
        ['jquery', 'wc-cart-fragments'], 
        null, 
        true
    );

    // Localize script with WooCommerce AJAX URL
    wp_localize_script('custom-minicart-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('stolen_watch_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_minicart_script');


function custom_enqueue_scripts() {
    if (is_product()) {
		wp_dequeue_script('wc-add-to-cart-variation'); // Remove WooCommerce default variation script
        wp_enqueue_script('custom-variation-js', get_stylesheet_directory_uri() . '/js/custom-variation.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');




function add_custom_query_vars($vars) {
    $vars[] = 'condition';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');

add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        $condition = get_query_var('condition', '');

        if (!empty($condition)) {
            $query->set('posts_per_page', -1);
            $query->set('post_status', 'publish');
            $query->is_404 = false; // Prevent 404
        }
    }
}, 20);


function add_custom_rewrite_rules() {
    add_rewrite_rule('^shop/condition/([^/]*)/?', 'index.php?post_type=product&condition=$matches[1]', 'top');
}
add_action('init', 'add_custom_rewrite_rules');



function filter_woocommerce_shop_query($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {

        $meta_query = $query->get('meta_query') ? $query->get('meta_query') : [];
        $tax_query  = $query->get('tax_query') ? $query->get('tax_query') : [];

        $condition = get_query_var('condition', '');
        if (!empty($condition)) {
            $meta_query[] = [
                'key'     => 'watch_type',
                'value'   => sanitize_text_field($condition),
                'compare' => '='
            ];
        }

        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        // Debug
        error_log(print_r($query->query_vars, true));
    }
}
add_action('pre_get_posts', 'filter_woocommerce_shop_query', 20);
