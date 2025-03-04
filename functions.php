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
            $meta_query = $query->get('meta_query') ? $query->get('meta_query') : [];
            $meta_query[] = [
                'key'     => 'watch_type',
                'value'   => sanitize_text_field($_GET['condition']),
                'compare' => '='
            ];
            $query->set('meta_query', $meta_query);
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



//






function assign_user_badge($user_id) {
    $order_count = wc_get_customer_order_count($user_id);
    
    if ($order_count >= 10) {
        update_user_meta($user_id, 'user_badge', 'Gold');
    } elseif ($order_count >= 5) {
        update_user_meta($user_id, 'user_badge', 'Silver');
    } elseif ($order_count > 1) { // Ensures users with 0 orders don't get a badge
        update_user_meta($user_id, 'user_badge', 'Bronze');
    }
}

// Update badge on order completion
add_action('woocommerce_order_status_completed', function ($order_id) {
    $order = wc_get_order($order_id);
    $user_id = $order->get_user_id();
    if ($user_id) {
        assign_user_badge($user_id);
    }
});


function display_user_badge() {
    $user_id = get_current_user_id();
    $badge = get_user_meta($user_id, 'user_badge', true);    
    if (!empty($badge)) {
        echo '<p><strong>Your Badge: </strong> <span style="color: gold;">' . esc_html($badge) . '</span></p>';
    }
}






// Add profile picture upload field to WooCommerce "Edit Account" page
add_action('woocommerce_edit_account_form', 'custom_profile_picture_upload_field');
function custom_profile_picture_upload_field() {
    $user_id = get_current_user_id();
    $profile_image = get_user_meta($user_id, 'profile_picture', true);
    ?>
<p>
    <label for="profile_picture"><?php esc_html_e('Profile Picture', 'woocommerce'); ?></label>
    <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
    <?php if ($profile_image): ?>
    <br><img src="<?php echo esc_url($profile_image); ?>" width="100" height="100" style="border-radius:50px;">
    <?php endif; ?>
</p>
<?php
}

// Save the uploaded profile picture
add_action('woocommerce_save_account_details', 'save_custom_profile_picture', 10, 1);
function save_custom_profile_picture($user_id) {
    if (!empty($_FILES['profile_picture']['name'])) {
        $upload = wp_handle_upload($_FILES['profile_picture'], ['test_form' => false]);
        if (isset($upload['url'])) {
            update_user_meta($user_id, 'profile_picture', esc_url($upload['url']));
        }
    }
}

// Override WordPress avatar with the uploaded profile picture
add_filter('get_avatar', 'custom_user_profile_avatar', 10, 5);
function custom_user_profile_avatar($avatar, $id_or_email, $size, $default, $alt) {
    $user_id = 0;

    if (is_numeric($id_or_email)) {
        $user_id = (int) $id_or_email;
    } elseif (is_object($id_or_email) && !empty($id_or_email->user_id)) {
        $user_id = (int) $id_or_email->user_id;
    } elseif (is_email($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
        if ($user) {
            $user_id = $user->ID;
        }
    }

    if ($user_id) {
        $profile_image = get_user_meta($user_id, 'profile_picture', true);
        if (!empty($profile_image)) {
            return '<img src="' . esc_url($profile_image) . '" width="' . $size . '" height="' . $size . '" style="border-radius:50%;" alt="' . esc_attr($alt) . '">';
        }
    }

    // Default avatar if no custom image is uploaded
    return '<img src="' . esc_url(get_template_directory_uri() . '/images/default-avatar.png') . '" width="' . $size . '" height="' . $size . '" style="border-radius:50%;" alt="' . esc_attr($alt) . '">';
}

// Add profile picture to WooCommerce account menu
add_filter('woocommerce_account_menu_items', 'add_profile_picture_to_menu', 10, 1);
function add_profile_picture_to_menu($items) {
    $user_id = get_current_user_id();
    $profile_image = get_user_meta($user_id, 'profile_picture', true);

    if ($profile_image) {
        $items = ['profile_picture' => '<img src="' . esc_url($profile_image) . '" width="30" height="30" style="border-radius:15px;">'] + $items;
    }

    return $items;
}

function crypto_payment_button_shortcode() {
    if (WC()->cart->is_empty()) {
        return '';
    }

    $randomHex = bin2hex(random_bytes(8));
    $api_url = get_theme_mod('mytheme_api_url', '');
    $success_url = 'https://nft-watch-dashboard.vercel.app/crypto-wallet?checkout_id=' . $randomHex;

    $cart_items = WC()->cart->get_cart();
    $currency = get_woocommerce_currency();
    $total = WC()->cart->get_total('edit');
    $subtotal = WC()->cart->get_subtotal();
    $return_url = site_url('/checkout/order-received/');
    $cancel_url = wc_get_checkout_url();

    ob_start(); // Start output buffering
    ?>

<div id="crypto-payment-wrapper"
    style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">
    <h3>Pay with Crypto</h3>

    <form id="crypto-payment-form">
        <input type="hidden" name="currency" value="<?php echo esc_attr($currency); ?>">
        <input type="hidden" name="total" value="<?php echo esc_attr($total); ?>">
        <input type="hidden" name="subtotal" value="<?php echo esc_attr($subtotal); ?>">
        <input type="hidden" name="checkout_id" value="<?php echo esc_attr($randomHex); ?>">
        <input type="hidden" name="return_url" value="<?php echo esc_url($api_url); ?>">
        <input type="hidden" name="sucess_url" value="<?php echo esc_url($success_url); ?>">

        <?php foreach ($cart_items as $index => $cart_item) : ?>
        <input type="hidden" name="cart_items[<?php echo $index; ?>][product_id]"
            value="<?php echo esc_attr($cart_item['product_id']); ?>">
        <input type="hidden" name="cart_items[<?php echo $index; ?>][name]"
            value="<?php echo esc_attr($cart_item['data']->get_name()); ?>">
        <input type="hidden" name="cart_items[<?php echo $index; ?>][quantity]"
            value="<?php echo esc_attr($cart_item['quantity']); ?>">
        <input type="hidden" name="cart_items[<?php echo $index; ?>][price]"
            value="<?php echo esc_attr($cart_item['data']->get_price()); ?>">
        <?php endforeach; ?>

        <button type="submit" class="button alt" id="crypto-pay-button"
            style="background: #ff9800; color: #fff; padding: 10px 20px; font-size: 16px; border: none; cursor: pointer;">
            Pay with Crypto
        </button>
    </form>
</div>

<script>
document.getElementById('crypto-payment-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Gather form data
    const formData = new FormData(this);
    const data = {
        currency: formData.get('currency'),
        total: formData.get('total'),
        subtotal: formData.get('subtotal'),
        return_url: formData.get('return_url'),
        cancel_url: formData.get('cancel_url'),
        checkout_id: formData.get('checkout_id'),
        cart_items: []
    };

    // Extract cart items
    for (let pair of formData.entries()) {
        const key = pair[0];
        const value = pair[1];

        // Match cart item keys like cart_items[unique_id][product_id]
        const match = key.match(/^cart_items\[(.*?)\]\[(.*?)\]$/);
        if (match) {
            const itemKey = match[1]; // Unique identifier for each cart item
            const fieldName = match[2]; // Field name (product_id, name, quantity, price)

            // Find or create the cart item object
            let item = data.cart_items.find(i => i.id === itemKey);
            if (!item) {
                item = { id: itemKey };
                data.cart_items.push(item);
            }

            // Assign the extracted value
            item[fieldName] = value;
        }
    }

    // Remove the temporary id field
    data.cart_items = data.cart_items.map(({ id, ...rest }) => rest);

    console.log("Processed Data:", data);

    // Send the data as JSON via AJAX
    fetch("<?php echo esc_url($api_url); ?>", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
            window.location.href = "<?php echo esc_url($success_url); ?>"; // Redirect on success
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error
        });
});
</script>

<?php
    return ob_get_clean(); // Return the buffered content
}
add_shortcode('crypto_payment_button', 'crypto_payment_button_shortcode');
