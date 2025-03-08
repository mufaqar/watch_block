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
        'primary' => __( 'Primary Menu', 'watch_block' ),
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



function redirect_guest_users_from_checkout() {
    if (is_checkout() && !is_user_logged_in()) {
        wp_redirect(home_url('/my-account/edit-account/?redirect_to=' . urlencode(wc_get_checkout_url())));
        exit;
    }
}
add_action('template_redirect', 'redirect_guest_users_from_checkout');

// Add custom profile picture field to WooCommerce edit account form

add_action('woocommerce_save_account_details', 'save_custom_profile_picture');
function save_custom_profile_picture($user_id) {
    if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $uploaded = wp_handle_upload($_FILES['profile_picture'], array('test_form' => false));
        if (isset($uploaded['file'])) {
            update_user_meta($user_id, 'profile_picture', $uploaded['url']);
        } else {
            wc_add_notice(__('Error uploading profile picture.', 'your-textdomain'), 'error');
        }
    }
}

// Login and Register

add_shortcode('woocommerce_my_account', 'custom_woocommerce_my_account_shortcode');
function custom_woocommerce_my_account_shortcode($atts) {
    $atts = shortcode_atts(array(
        'login_only' => false,
        'register_only' => false,
    ), $atts, 'woocommerce_my_account');

    ob_start();

    if ($atts['login_only']) {
        wc_get_template('myaccount/form-login-only.php');
    } elseif ($atts['register_only']) {
        wc_get_template('myaccount/form-register-only.php');
    } else {
        wc_get_template('myaccount/my-account.php');
    }

    return ob_get_clean();
}