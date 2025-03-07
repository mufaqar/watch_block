<?php


function display_all_reviews() {
    global $product;

    $comments = get_comments(array(
        'post_id' => $product->get_id(),
        'status' => 'approve',
    ));

    if ($comments) {
        foreach ($comments as $comment) {
            echo '<section class="bg-[#F2F2F2] py-[28px] rounded-[20px] px-[32px] mb-4">';
            echo '<img src="' . get_template_directory_uri() . '/images/svg/rating-star.svg" alt=""/>';
            echo '<h5 class="flex text-xl items-center gap-1 mt-4">' . esc_html($comment->comment_author) . '.<img src="' . get_template_directory_uri() . '/images/svg/green-checks.svg" alt=""/></h5>';
            echo '<p class="mt-3 text-[#676767]">"' . esc_html($comment->comment_content) . '"</p>';
            echo '<p class="mt-6 text-[#676767]">' . esc_html(get_comment_date('', $comment)) . '</p>';
            echo '</section>';
        }
    } else {
        echo '<p>' . __('No reviews yet. Be the first to review this product!', 'textdomain') . '</p>';
    }
   
    
    // Add 'Write a Review' button with product ID
    $review_page_url = add_query_arg('product_id', $product->get_id(), site_url('/write-a-review'));
    echo '<div class="mt-6">';
    echo '<a href="' . esc_url($review_page_url) . '" class="add_compair_btn single_add_to_cart_button">' . __('Write a Review', 'textdomain') . '</a>';
    echo '</div>';
}
add_action('watch_block_single_reviews', 'display_all_reviews');






add_action('watch_block_related_products', 'custom_output_related_products');

function custom_output_related_products() {
    echo '<div class="max-w-[1280px] px-5 mx-auto">';   
    		woocommerce_output_related_products();
    echo '</div>';
}


add_action( 'wp_ajax_woocommerce_update_cart_quantity', 'update_cart_quantity' );
add_action( 'wp_ajax_nopriv_woocommerce_update_cart_quantity', 'update_cart_quantity' );

function update_cart_quantity() {
    $cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
    $quantity = intval( $_POST['quantity'] );

    if ( $cart_item_key && $quantity >= 1 ) {
        WC()->cart->set_quantity( $cart_item_key, $quantity, true );
        WC()->cart->calculate_totals();

        ob_start();
        woocommerce_mini_cart();
        $mini_cart = ob_get_clean();

        wp_send_json_success([
            'fragments' => [
                'div.widget_shopping_cart_content' => $mini_cart
            ]
        ]);
    } else {
        wp_send_json_error();
    }
}


// Add a custom button after the "Add to Cart" button
add_action('woocommerce_after_add_to_cart_button', 'add_custom_button_after_add_to_cart');
function add_custom_button_after_add_to_cart() {
    global $product;

    // Display the custom button
    echo '<button type="button" id="compare-action" class="add_compair_btn single_add_to_cart_button"  data-product-id="' . get_the_ID() . '">
           COMPARE PRODUCT
          </button>';
}


/* Extra Options */

// Add custom color and size fields (buttons with icons) before the add-to-cart button for simple products
// Add custom color and size fields (buttons with icons) before the add-to-cart button for simple products
add_action('woocommerce_before_add_to_cart_button', 'add_custom_color_and_size_fields', 10);
function add_custom_color_and_size_fields() {
    global $product;

    if ($product->get_type() == 'simple') {
        // Get color options from product attributes (assuming it's a taxonomy or simple options)
        $colors = $product->get_attribute('watches_colors'); // Assuming 'watches_colors' is a product attribute
        $sizes = $product->get_attribute('watches_size'); // Assuming 'watches_size' is a product attribute

        // Check if colors and sizes are set and not empty
        if ($colors) {
            $color_options = explode(',', $colors); // Assuming colors are comma-separated
        }

        if ($sizes) {
            $size_options = explode(',', $sizes); // Assuming sizes are comma-separated
        }

        // Color Selection (Buttons with Icons)
        echo '<div class="watch_options">';
        echo '<label for="custom_color" class="text-xl font-medium">Color Available:</label>';
        echo '<div id="color-buttons" class="py-[14px] mt-0">';
        
        // Loop through color options and generate buttons
        if (isset($color_options)) {
            foreach ($color_options as $color) {
                echo '<button type="button" class="color-button" data-color="' . esc_attr(trim($color)) . '">
        <figure class="bg-white p-1 rounded-[8px]">
          
            <img decoding="async" src="' . esc_url(get_template_directory_uri() . '/images//demo-watch.png') . '" 
                 class="w-[50px] object-contain h-[50px]" alt="' . esc_attr($color) . '">
        </figure>
        <p class="color_lable">' . esc_html(trim($color)) . '</p>
      </button>';

            }
        }

        echo '</div>'; // Close color buttons container

        // Size Selection (Buttons)
        echo '<label for="custom_size" class="text-xl font-medium">Choose Size:</label>';
        echo '<div id="size-buttons">';
        
        // Loop through size options and generate buttons
        if (isset($size_options)) {
            foreach ($size_options as $size) {
                echo '<button type="button" class="size-button" data-size="' . esc_attr(trim($size)) . '">' . esc_html(trim($size)) . '</button>';
            }
        }

        echo '</div>'; // Close size buttons container

        // Hidden input for color and size values
        echo '<input type="hidden" name="custom_color" id="custom_color" value="" />';
        echo '<input type="hidden" name="custom_size" id="custom_size" value="" />';
        echo '</div>';
    }
}



// Save custom color and size attributes when adding product to cart
add_filter('woocommerce_add_cart_item_data', 'save_custom_attributes_to_cart', 10, 2);
function save_custom_attributes_to_cart($cart_item_data, $product_id) {
    if (isset($_POST['custom_color']) && isset($_POST['custom_size'])) {
        // Save the custom color and size to cart item data
        $cart_item_data['custom_color'] = sanitize_text_field($_POST['custom_color']);
        $cart_item_data['custom_size'] = sanitize_text_field($_POST['custom_size']);
    }
    return $cart_item_data;
}


// Display custom color and size attributes in the cart page
// Display custom color and size attributes in the cart page
add_filter('woocommerce_get_item_data', 'display_custom_attributes_in_cart', 10, 2);
function display_custom_attributes_in_cart($item_data, $cart_item) {
    if (isset($cart_item['custom_color'])) {
        $item_data[] = array(
            'name' => 'Color',
            'value' => ucfirst($cart_item['custom_color']),
        );
    }
    if (isset($cart_item['custom_size'])) {
        $item_data[] = array(
            'name' => 'Size',
            'value' => ucfirst($cart_item['custom_size']),
        );
    }
    return $item_data;
}

// Display custom color and size attributes in the order details
add_action('woocommerce_checkout_create_order_line_item', 'add_custom_attributes_to_order', 10, 4);
function add_custom_attributes_to_order($item, $cart_item_key, $values, $order) {
    if (isset($values['custom_color'])) {
        $item->add_meta_data('Color', ucfirst($values['custom_color']), true);
    }
    if (isset($values['custom_size'])) {
        $item->add_meta_data('Size', ucfirst($values['custom_size']), true);
    }
}


function add_custom_menu_items($items) {
    // Define new menu items
    $new_items = [        
        'sell-my-watch' => __('Sell My Watch', 'your-textdomain'),
        'stolen-watch' => __('Report lost/stolen Watch', 'your-textdomain'),
       
        
    ];

    // Move Logout to the end
    if (isset($items['customer-logout'])) {
        $logout_item = ['customer-logout' => $items['customer-logout']];
        unset($items['customer-logout']);

        // Merge items: Add new items before logout
        $items = array_merge($items, $new_items, $logout_item);
    } else {
        $items = array_merge($items, $new_items);
    }

    return $items;
}
add_filter('woocommerce_account_menu_items', 'add_custom_menu_items');




function add_custom_account_endpoints() {
    add_rewrite_endpoint('stolen-watch', EP_PAGES);
    add_rewrite_endpoint('sell-my-watch', EP_PAGES);
    add_rewrite_endpoint('add-my-watch', EP_PAGES);
}
add_action('init', 'add_custom_account_endpoints');



function stolen_watch_content() {

    report_stolen_watch();

    get_Stolen_Watches();
}
add_action('woocommerce_account_stolen-watch_endpoint', 'stolen_watch_content');


function sell_my_watch_content() {

    get_all_watches();
   
 }
 add_action('woocommerce_account_sell-my-watch_endpoint', 'sell_my_watch_content');

 // Content for "Add My Watch" endpoint (If needed)
function add_my_watch_content() {
    add_my_watch();
}
add_action('woocommerce_account_add-my-watch_endpoint', 'add_my_watch_content');


 function custom_rename_dashboard_tab( $menu_links ) {
    // Rename the "Dashboard" label
    if ( isset( $menu_links['dashboard'] ) ) {
        $menu_links['dashboard'] = __( 'Statistics', 'your-textdomain' ); // Change label
    }
    return $menu_links;
}
add_filter( 'woocommerce_account_menu_items', 'custom_rename_dashboard_tab', 10, 1 );



// Badge System


function assign_user_badge($user_id) {
    $order_count = wc_get_customer_order_count($user_id);

    // Get the count of approved product reviews by the user
    $review_count = get_review_count_by_user($user_id);

    // Calculate total score (orders + reviews)
    $total_count = $order_count + $review_count;

    if ($total_count >= 50) {
        update_user_meta($user_id, 'user_badge', 'Diamond');
    } elseif ($total_count >= 30) {
        update_user_meta($user_id, 'user_badge', 'Platinum');
    } elseif ($total_count >= 10) {
        update_user_meta($user_id, 'user_badge', 'Gold');
    } elseif ($total_count >= 5) {
        update_user_meta($user_id, 'user_badge', 'Silver');
    } elseif ($total_count >= 1) {
        update_user_meta($user_id, 'user_badge', 'Bronze');
    } else {
        delete_user_meta($user_id, 'user_badge'); // Remove badge if no activity
    }
}

function get_review_count_by_user($user_id) {
    $args = array(
        'user_id' => $user_id,
        'count'   => true,
        'type'    => 'review',
        'status'  => 'approve'
    );

    return get_comments($args);
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
        echo '<p><strong>Your Badge: <span style="color: #B6E22E;">' . esc_html($badge) . '</span></strong> </p>';
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

