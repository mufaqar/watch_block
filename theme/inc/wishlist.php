<?php

function watch_block_wishlist_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'watch_block_wishlist';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) NOT NULL,
            product_id BIGINT(20) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
add_action('after_setup_theme', 'watch_block_wishlist_table');

function add_wishlist_button() {
    global $product;
    echo '<button class="add-to-wishlist" data-product-id="' . $product->get_id() . '">Add to Wishlist</button>';
}
add_action('woocommerce_before_add_to_cart_button', 'add_wishlist_button');

function handle_add_to_wishlist() {
    global $wpdb;

    $product_id = intval($_POST['product_id']);
    $user_id = get_current_user_id();

    if (!$user_id) {
        wp_send_json_error('User not logged in.');
    }

    $table_name = $wpdb->prefix . 'watch_block_wishlist';
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table_name WHERE user_id = %d AND product_id = %d",
        $user_id,
        $product_id
    ));

    if (!$exists) {
        $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);
        wp_send_json_success('Added to wishlist.');
    } else {
        wp_send_json_error('Product already in wishlist.');
    }
}
add_action('wp_ajax_add_to_wishlist', 'handle_add_to_wishlist');
add_action('wp_ajax_nopriv_add_to_wishlist', 'handle_add_to_wishlist');



function enqueue_wishlist_scripts() {
    wp_enqueue_script('wishlist-script', get_template_directory_uri() . '/wishlist.js', ['jquery'], null, true);
    wp_localize_script('wishlist-script', 'wishlist_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_wishlist_scripts');


function display_wishlist() {
    global $wpdb;
    $user_id = get_current_user_id();

    if (!$user_id) {
        return 'You need to log in to view your wishlist.';
    }

    $table_name = $wpdb->prefix . 'custom_wishlist';
    $results = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name WHERE user_id = %d",
        $user_id
    ));

    if (!$results) {
        return 'Your wishlist is empty.';
    }

    ob_start();
    echo '<ul class="wishlist">';
    foreach ($results as $item) {
        $product = wc_get_product($item->product_id);
        echo '<li><a href="' . get_permalink($product->get_id()) . '">' . $product->get_name() . '</a></li>';
    }
    echo '</ul>';
    return ob_get_clean();
}
add_shortcode('wishlist', 'display_wishlist');


