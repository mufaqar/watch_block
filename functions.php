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
        'hierarchical'      => true, // Like product categories
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'watch-type'),
        'show_in_rest'      => true, // Enables REST API support
        'rest_base'         => 'watch_type',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy('watch_type', array('product'), $args);
}
add_action('init', 'register_watch_type_taxonomy');



//

function crypto_payment_button_shortcode() {
    if (WC()->cart->is_empty()) {
        return '';
    }

    $crypto_gateway_url = 'https://thirdpartycrypto.com/pay';

    $cart_items = WC()->cart->get_cart();
    $currency = get_woocommerce_currency();
    $total = WC()->cart->get_total('edit');
    $subtotal = WC()->cart->get_subtotal();
    $return_url = site_url('/checkout/order-received/');
    $cancel_url = wc_get_checkout_url();

    ob_start(); // Start output buffering
    ?>

    <div id="crypto-payment-wrapper" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">
        <h3>Pay with Crypto</h3>
        <p>Use cryptocurrency to complete your payment securely.</p>
        <form id="crypto-payment-form" action="<?php echo esc_url($crypto_gateway_url); ?>" method="POST">
            <input type="hidden" name="currency" value="<?php echo esc_attr($currency); ?>">
            <input type="hidden" name="total" value="<?php echo esc_attr($total); ?>">
            <input type="hidden" name="subtotal" value="<?php echo esc_attr($subtotal); ?>">
            <input type="hidden" name="return_url" value="<?php echo esc_url($return_url); ?>">
            <input type="hidden" name="cancel_url" value="<?php echo esc_url($cancel_url); ?>">

            <?php foreach ($cart_items as $index => $cart_item) : ?>
                <input type="hidden" name="cart_items[<?php echo $index; ?>][product_id]" value="<?php echo esc_attr($cart_item['product_id']); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][name]" value="<?php echo esc_attr($cart_item['data']->get_name()); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][quantity]" value="<?php echo esc_attr($cart_item['quantity']); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][price]" value="<?php echo esc_attr($cart_item['data']->get_price()); ?>">
            <?php endforeach; ?>

            <button type="submit" class="button alt" style="background: #ff9800; color: #fff; padding: 10px 20px; font-size: 16px; border: none; cursor: pointer;">
                Pay with Crypto
            </button>
        </form>
    </div>

    <?php
    return ob_get_clean(); // Return the buffered content
}
add_shortcode('crypto_payment_button', 'crypto_payment_button_shortcode');
