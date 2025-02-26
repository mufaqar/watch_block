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


//add_filter( 'woocommerce_rest_check_permissions', 'my_woocommerce_rest_check_permissions', 90, 4 );

function my_woocommerce_rest_check_permissions( $permission, $context, $object_id, $post_type  ){
  return true;
}




function filter_woocommerce_shop_query($query) {
    if ( ! is_admin() && ( is_shop() || is_product_category() || is_product_tag() ) ) {

 
        
        // Filtering by Brand
        if (!empty($_GET['brand'])) {
            $query->set('tax_query', [
                [
                    'taxonomy' => 'product_brand',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['brand']),
                ],
            ]);
        }

        // Filtering by Color
        if (!empty($_GET['color'])) {
            $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];
            $tax_query[] = [
                'taxonomy' => 'pa_watches_colors',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['color']),
            ];
            $query->set('tax_query', $tax_query);
        }

        // Filtering by Condition
        if (!empty($_GET['condition'])) {
           
            $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];
            $tax_query[] = [
                'taxonomy' => 'watch_type',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['condition']),
            ];
            $query->set('tax_query', $tax_query);
        }

        // Filtering by Size
        if (!empty($_GET['size'])) {
            $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];
            $tax_query[] = [
                'taxonomy' => 'pa_watches_size',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['size']),
            ];
            $query->set('tax_query', $tax_query);
        }

       // Sorting by Price
        // if (!empty($_GET['orderby'])) {
        //     if ($_GET['orderby'] === 'price-desc') {
        //         $query->set('orderby', 'meta_value_num');
        //         $query->set('meta_key', '_price');
        //         $query->set('order', 'DESC');
        //     } elseif ($_GET['orderby'] === 'price-asc') {
        //         $query->set('orderby', 'meta_value_num');
        //         $query->set('meta_key', '_price');
        //         $query->set('order', 'ASC');
        //     }
        // }
    }
}
add_action('pre_get_posts', 'filter_woocommerce_shop_query');



function custom_woocommerce_orderby_price($args) {
    if (isset($_GET['orderby'])) {
        if ($_GET['orderby'] === 'price-desc') {
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order']    = 'DESC';
        } elseif ($_GET['orderby'] === 'price-asc') {
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order']    = 'ASC';
        }
    }
    return $args;
}
//add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_orderby_price');


function register_watch_type_taxonomy() {
    $args = array(
        'label'             => __('Watch Type', 'textdomain'),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'watch-type'),
        'show_in_rest'      => true, // Enables API support
        'rest_base'         => 'watch_type', // API base URL
    );

    register_taxonomy('watch_type', 'product', $args);
}
add_action('init', 'register_watch_type_taxonomy');



function add_watch_type_to_wc_api() {
    register_rest_field('product', 'watch_type', array(
        'get_callback'    => function ($product) {
            return wp_get_post_terms($product['id'], 'watch_type', array('fields' => 'names'));
        },
        'update_callback' => function ($value, $product) {
            if (!is_array($value)) {
                return;
            }
            wp_set_post_terms($product->ID, $value, 'watch_type');
        },
        'schema'          => null,
    ));
}
add_action('rest_api_init', 'add_watch_type_to_wc_api');


