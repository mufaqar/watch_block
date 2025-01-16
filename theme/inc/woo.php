<?php


function display_all_reviews() {


    global $product;

    $comments = get_comments(array(
        'post_id' => $product->get_id(),
        'status' => 'approve',
    ));

    if ($comments) {
        foreach ($comments as $comment) {
            echo '<section class="bg-[#F2F2F2] py-[28px] rounded-[20px] px-[32px]">';
			echo '<img src="' . get_template_directory_uri() . '/public/svg/rating-star.svg" alt=""/>';
			echo '<h5 class="flex text-xl items-center gap-1 mt-4">' . esc_html($comment->comment_author) . '.<img src="' . get_template_directory_uri() . '/public/svg/green-checks.svg" alt=""/></h5>';
			echo '<p class="mt-3 text-[#676767]">"' . esc_html($comment->comment_content) . '</p>';
			echo '<p class="mt-6 text-[#676767]">' . esc_html(get_comment_date('', $comment)) . '</p>';
            echo '</section>';
        }
    } else {
        echo '<p>' . __('No reviews yet. Be the first to review this product!', 'textdomain') . '</p>';
    }
}
add_action('watch_block_single_reviews', 'display_all_reviews');




add_action('watch_block_related_products', 'custom_output_related_products');

function custom_output_related_products() {
    echo '<div class="max-w-[1280px] px-3 mx-auto">';   
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
    echo '<button type="button" class="add_cart_btn" onclick="customButtonAction()">
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
          
            <img decoding="async" src="' . esc_url(get_template_directory_uri() . '/public/images/demo-watch.png') . '" 
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


/*shop Page*/



add_action('woocommerce_before_shop_loop', 'add_custom_filter_before_result_count', 15);
function add_custom_filter_before_result_count() {
    // Your custom filter HTML
    echo '<div class="custom-filter-container">';
    echo '<label for="custom-filter" class="mr-2">Filter by:</label>';
    echo '<select id="custom-filter" class="custom-filter">
            <option value="">Select an option</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
          </select>';
    echo '</div>';
}

