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

    // Pass WooCommerce AJAX URL to the script
    wp_localize_script('custom-minicart-script', 'wc_cart_fragments_params', [
        'wc_ajax_url' => WC_AJAX::get_endpoint('%%endpoint%%'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_minicart_script');



add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        // Get URL parameters
        $meta_query = [];
        $tax_query = [];

        if (!empty($_GET['brand'])) {
            $tax_query[] = [
                'taxonomy' => 'pa_brand', // Replace with the correct taxonomy slug for brands
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['brand']),
            ];
        }

        if (!empty($_GET['color'])) {
            $tax_query[] = [
                'taxonomy' => 'pa_color', // Replace with the correct taxonomy slug for colors
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['color']),
            ];
        }

        if (!empty($_GET['condition'])) {
            $tax_query[] = [
                'taxonomy' => 'pa_condition', // Replace with the correct taxonomy slug for condition
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['condition']),
            ];
        }

        if (!empty($_GET['material'])) {
            $tax_query[] = [
                'taxonomy' => 'pa_material', // Replace with the correct taxonomy slug for material
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['material']),
            ];
        }

        if (!empty($_GET['orderby'])) {
            if ($_GET['orderby'] === 'price-desc') {
                $query->set('orderby', 'meta_value_num');
                $query->set('meta_key', '_price');
                $query->set('order', 'DESC');
            } elseif ($_GET['orderby'] === 'price-asc') {
                $query->set('orderby', 'meta_value_num');
                $query->set('meta_key', '_price');
                $query->set('order', 'ASC');
            }
        }

        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }
    }
});



function custom_enqueue_scripts() {
    if (is_product()) {
		wp_dequeue_script('wc-add-to-cart-variation'); // Remove WooCommerce default variation script
        wp_enqueue_script('custom-variation-js', get_stylesheet_directory_uri() . '/js/custom-variation.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');


//add_filter( 'woocommerce_rest_check_permissions', 'my_woocommerce_rest_check_permissions', 90, 4 );

function my_woocommerce_rest_check_permissions( $permission, $context, $object_id, $post_type  ){
  return true;
}


