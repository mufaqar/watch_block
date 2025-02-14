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


// Add custom color, size, and NFT fields inside the add-to-cart form
//add_action('woocommerce_before_add_to_cart_button', 'add_custom_color_size_nft_fields');
function add_custom_color_size_nft_fields() {
    global $product;

    if ($product->is_type('variable')) { // Ensure it's a variable product
        $colors = $product->get_attribute('watches_colors'); 
        $sizes = $product->get_attribute('watches_size'); 
        $nfts = $product->get_attribute('watches_nft'); 

        $color_options = $colors ? explode(',', $colors) : [];
        $size_options = $sizes ? explode(',', $sizes) : [];
        $nft_options = $nfts ? explode(',', $nfts) : [];

        echo '<div class="watch_options">';

        // Color Selection
        if (!empty($color_options)) {
            echo '<label class="text-xl font-medium">Color Available:</label>';
            echo '<div id="color-buttons" class="py-[14px] mt-0">';
            foreach ($color_options as $color) {
                echo '<button type="button" class="color-button" data-color="' . esc_attr(trim($color)) . '">
                    <figure class="bg-white p-1 rounded-[8px]">
                        <img decoding="async" src="' . esc_url(get_template_directory_uri() . '/public/images/demo-watch.png') . '" 
                            class="w-[50px] object-contain h-[50px]" alt="' . esc_attr($color) . '">
                    </figure>
                    <p class="color_label">' . esc_html(trim($color)) . '</p>
                </button>';
            }
            echo '</div>';
        }
        echo "<div class='options_product'>";

        // Size Selection
        if (!empty($size_options)) {
            echo '<div id="size-wrap">';
            echo '<label class="text-xl font-medium">Choose Size:</label>';
            echo '<div id="size-buttons">';
            foreach ($size_options as $size) {
                echo '<button type="button" class="size-button" data-size="' . esc_attr(trim($size)) . '">' . esc_html(trim($size)) . '</button>';
            }
            echo '</div> </div>';
        }

        // NFT Selection
        if (!empty($nft_options)) {
            echo '<div id="nft-wrap">';
            echo '<label class="text-xl font-medium">Select NFT:</label>';
            echo '<div id="nft-buttons">';
            foreach ($nft_options as $nft) {
                echo '<button type="button" class="nft-button" data-nft="' . esc_attr(trim($nft)) . '">' . esc_html(trim($nft)) . '</button>';
            }
            echo '</div> </div>';
        }

        // Hidden input fields (inside the form)
        echo '<input type="hidden" name="custom_color" id="custom_color" value="" />';
        echo '<input type="hidden" name="custom_size" id="custom_size" value="" />';
        echo '<input type="hidden" name="custom_nft" id="custom_nft" value="" />';
        echo '</div> </div>';
    }
}

// Save custom fields to cart data
add_filter('woocommerce_add_cart_item_data', 'save_custom_attributes_to_cart', 10, 2);
function save_custom_attributes_to_cart($cart_item_data, $product_id) {
    if (!empty($_POST['custom_color'])) {
        $cart_item_data['custom_color'] = sanitize_text_field($_POST['custom_color']);
    }
    if (!empty($_POST['custom_size'])) {
        $cart_item_data['custom_size'] = sanitize_text_field($_POST['custom_size']);
    }
    if (!empty($_POST['custom_nft'])) {
        $cart_item_data['custom_nft'] = sanitize_text_field($_POST['custom_nft']);
    }
    return $cart_item_data;
}

// Display custom fields in the cart page
add_filter('woocommerce_get_item_data', 'display_custom_attributes_in_cart', 10, 2);
function display_custom_attributes_in_cart($item_data, $cart_item) {
    if (!empty($cart_item['custom_color'])) {
        $item_data[] = array(
            'name' => 'Color',
            'value' => ucfirst($cart_item['custom_color']),
        );
    }
    if (!empty($cart_item['custom_size'])) {
        $item_data[] = array(
            'name' => 'Size',
            'value' => ucfirst($cart_item['custom_size']),
        );
    }
    if (!empty($cart_item['custom_nft'])) {
        $item_data[] = array(
            'name' => 'NFT',
            'value' => ucfirst($cart_item['custom_nft']),
        );
    }
    return $item_data;
}

// Save custom fields in order meta
add_action('woocommerce_checkout_create_order_line_item', 'add_custom_attributes_to_order', 10, 4);
function add_custom_attributes_to_order($item, $cart_item_key, $values, $order) {
    if (!empty($values['custom_color'])) {
        $item->add_meta_data('Color', ucfirst($values['custom_color']), true);
    }
    if (!empty($values['custom_size'])) {
        $item->add_meta_data('Size', ucfirst($values['custom_size']), true);
    }
    if (!empty($values['custom_nft'])) {
        $item->add_meta_data('NFT', ucfirst($values['custom_nft']), true);
    }
}


/*shop Page*/



add_action('woocommerce_before_shop_loop', 'add_custom_filter_before_result_count', 15);
function add_custom_filter_before_result_count() {
    
    ?>



<?php
}