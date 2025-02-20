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



// Add custom color, size, and NFT options to variable products
function add_custom_color_size_nft_fields() {
    global $product;

    if ($product->is_type('variable')) { 
        // Get product attributes
        $colors = $product->get_attribute('watches_colors'); 
        $sizes = $product->get_attribute('watches_size'); 
        $nfts = $product->get_attribute('nft_watches'); 

        $color_options = $colors ? explode(',', $colors) : [];
        $size_options = $sizes ? explode(',', $sizes) : [];
        $nft_options = $nfts ? explode(',', $nfts) : [];

        $variations = $product->get_available_variations();
        
        echo '<div class="watch_options" data-product-id="' . esc_attr($product->get_id()) . '">';
        
        // Color Selection
        if (!empty($color_options)) {
            echo '<label class="text-xl font-medium">Color Available:</label>';
            echo '<div id="color-buttons" class="py-[14px] mt-0">';
            foreach ($color_options as $color) {
                echo '<button type="button" class="color-button" data-attribute="watches_colors" data-value="' . esc_attr(trim($color)) . '">
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
                echo '<button type="button" class="size-button" data-attribute="watches_size" data-value="' . esc_attr(trim($size)) . '">' . esc_html(trim($size)) . '</button>';
            }
            echo '</div></div>';
        }

        // NFT Selection
        if (!empty($nft_options)) {
            echo '<div id="nft-wrap">';
            echo '<label class="text-xl font-medium">select an item:</label>';
            echo '<div id="nft-buttons">';
            foreach ($nft_options as $nft) {
                $size_slug = str_replace(' ', '-', strtolower(trim($nft)));
                echo '<button type="button" class="nft-button" data-attribute="nft_watches" data-value="' . esc_attr($size_slug) . '">' . esc_html(($nft)) . '</button>';
            }
            echo '</div></div>';
        }

        // Price Display
        echo '<div class="price_display text-xl font-bold mt-4"><span id="selected-price">' . wc_price($product->get_price()) . '</span></div>';

        // Hidden input fields
        echo '<input type="hidden" name="custom_color" id="custom_color" value="" />';
        echo '<input type="hidden" name="custom_size" id="custom_size" value="" />';
        echo '<input type="hidden" name="custom_nft" id="custom_nft" value="" />';

        // Pass variations to JavaScript
        echo '<script>
            var product_variations = ' . json_encode($variations) . ';
        </script>';

        

        echo '</div></div>';
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
}
add_action('init', 'add_custom_account_endpoints');



function stolen_watch_content() {

    sell_my_watch();

    get_all_myWatches();
}
add_action('woocommerce_account_stolen-watch_endpoint', 'stolen_watch_content');


function sell_my_watch() {
   ?>
   <div class="box-content p-[25px]">
   
    <h2 class="text-[34px] font-semibold max-w-[410px] mx-auto md:leading-[41px]">Report a Lost or Stolen Watch</h2>
    <form class="mt-5 flex flex-col gap-5" id="stolen_watch">
    <div class="relative">
        <input type="text" name="model_no" placeholder="Rolex" id="model_no" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
        <span class="bg-white p-1 text-sm text-[#70776F] absolute -top-[15px] left-3">Watch Model</span>
    </div>
    <div class="grid grid-cols-2 gap-5">
        <input type="text" name="model_name" placeholder="Model Name" id="model_name" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
        <input type="text" name="serial_no" placeholder="Serial no" id="serial_no" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
    </div>
    <div class="grid grid-cols-2 gap-5">
        <input type="date" name="date" placeholder="dd/mm/yyyy" id="date" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
        <div class="border-[#C0C0C0] border flex items-center px-3 text-[#70776F] outline-black rounded-[5px] w-full">
            <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 7.25986C4.5264 7.25986 4.0722 7.07549 3.73731 6.7473C3.40242 6.41911 3.21429 5.97399 3.21429 5.50986C3.21429 5.04573 3.40242 4.60062 3.73731 4.27243C4.0722 3.94424 4.5264 3.75986 5 3.75986C5.4736 3.75986 5.9278 3.94424 6.26269 4.27243C6.59758 4.60062 6.78571 5.04573 6.78571 5.50986C6.78571 5.73968 6.73953 5.96724 6.64979 6.17956C6.56004 6.39188 6.42851 6.5848 6.26269 6.7473C6.09687 6.9098 5.90002 7.03871 5.68336 7.12665C5.46671 7.2146 5.2345 7.25986 5 7.25986ZM5 0.609863C3.67392 0.609863 2.40215 1.12611 1.46447 2.04504C0.526784 2.96397 0 4.2103 0 5.50986C0 9.18486 5 14.6099 5 14.6099C5 14.6099 10 9.18486 10 5.50986C10 4.2103 9.47322 2.96397 8.53553 2.04504C7.59785 1.12611 6.32608 0.609863 5 0.609863Z" fill="#888E87"/>
            </svg>
            <input type="text" name="location" id="location" placeholder="I-11, Islamabad" class="w-full border-none outline-none" />
        </div>
    </div>

    <h4 class="text-[#2B2B2B] font-medium text-lg text-center">Upload Proof</h4>
    <div>
        <label for="file-upload" class="w-full max-w-2xl h-36 border-2 border-dashed border-gray-400 bg-gray-50 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition p-4 rounded-md">
            <svg class="w-10 h-10 text-gray-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 12l5-5m0 0l5 5m-5-5v12"></path>
            </svg>
            <p class="text-gray-600 text-sm">Upload Images from four sides</p>
            <p class="text-gray-500 text-xs">(Each from one side)</p>
            <input type="file" id="file-upload" name="proof_image" class="hidden">
        </label>
    </div>

    <textarea id="details" name="details" class="border-[#C0C0C0] _textarea border flex items-center p-3 text-[#70776F] outline-black rounded-[5px] w-full"
        style="padding:10px; border: 1px solid #C0C0C0; border-radius: 5px; height:130px" placeholder="Description"></textarea>

    <button type="submit" class="font-bold text-2xl bg-[#B6E22E] w-full p-4 hover:bg-black hover:text-[#B6E22E]">Submit</button>
</form>

  </div>
   <?php
}

function get_all_myWatches() {
    ?>
    <div class="box-content mt-6">
        <?php
        $query = new WP_Query([
            'post_type'      => 'stolen_watch',
            'posts_per_page' => 10,
        ]);

        if ($query->have_posts()) : ?>
            <div class="watch-list p-5">
            <div class="grid grid-cols-6 gap-3 text-start py-3 border-b">
                        <div>Report ID</div>
                        <div>Watch Model</div>
                        <div>Serial Number</div>
                        <div>Date Reported</div>
                        <div>Status</div>
                        <div>Action</div>
                   
                    </div>
                <?php while ($query->have_posts()) : $query->the_post(); 
                    // Get meta fields
                    $ID     = get_the_ID();
                    $model     = get_the_title();
                    $serial    = get_post_meta(get_the_ID(), 'serial_number', true);
                    $status     = get_post_meta(get_the_ID(), 'status', true);
               
                    $reported_raw = get_post_meta(get_the_ID(), 'reported_date', true);
                    $reported = $reported_raw ? date('F j, Y', strtotime($reported_raw)) : 'N/A';

                ?>
                    <div class="grid grid-cols-6 gap-3 text-start border-b py-3">
                       
                        <div>#<?php echo esc_html($ID); ?></div>
                        <div><?php the_title(); ?></div>
                        <div> <?php echo esc_html($serial); ?></div>                        
                        <div> <?php echo esc_html($reported); ?></div>
                        <div> <?php echo esc_html($status); ?></div>
                        <div> <a href="<?php the_permalink()?>" >View</a></div>
                  
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>No stolen watches found.</p>
        <?php endif;

        wp_reset_postdata();
        ?>
    </div>
    <?php
}



function sell_my_watch_content() {
    ?>
    <div class="box-content p-[25px]">
    
     <h2 class="text-[34px] font-semibold max-w-[410px] mx-auto md:leading-[41px]">Sell My Watch</h2>
     <form class="mt-5 flex flex-col gap-5">
         <div class="relative">
             <input type="text" placeholder="Rolex" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
             <span class="bg-white p-1 text-sm text-[#70776F] absolute -top-[15px] left-3">Watch Model</span>
         </div>
         <div class="grid grid-cols-2 gap-5">
             <input type="text" placeholder="Model" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
             <input type="text" placeholder="Serial no" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
         </div>
         <div class="grid grid-cols-2 gap-5">
             <input type="date" placeholder="dd/mm/yyyy" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
             <div class="border-[#C0C0C0] border flex items-center px-3 text-[#70776F] outline-black rounded-[5px] w-full">
                 <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M5 7.25986C4.5264 7.25986 4.0722 7.07549 3.73731 6.7473C3.40242 6.41911 3.21429 5.97399 3.21429 5.50986C3.21429 5.04573 3.40242 4.60062 3.73731 4.27243C4.0722 3.94424 4.5264 3.75986 5 3.75986C5.4736 3.75986 5.9278 3.94424 6.26269 4.27243C6.59758 4.60062 6.78571 5.04573 6.78571 5.50986C6.78571 5.73968 6.73953 5.96724 6.64979 6.17956C6.56004 6.39188 6.42851 6.5848 6.26269 6.7473C6.09687 6.9098 5.90002 7.03871 5.68336 7.12665C5.46671 7.2146 5.2345 7.25986 5 7.25986ZM5 0.609863C3.67392 0.609863 2.40215 1.12611 1.46447 2.04504C0.526784 2.96397 0 4.2103 0 5.50986C0 9.18486 5 14.6099 5 14.6099C5 14.6099 10 9.18486 10 5.50986C10 4.2103 9.47322 2.96397 8.53553 2.04504C7.59785 1.12611 6.32608 0.609863 5 0.609863Z" fill="#888E87"/>
                 </svg>
                 <input type="text" placeholder="I-11, Islamabad" class="w-full border-none outline-none" />
             </div>
         </div>
         <h4 class="text-[#2B2B2B] font-medium text-lg text-center">Contact Info</h4>
         <div class="grid grid-cols-2 gap-5">
             <input type="text" placeholder="Name" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
             <input type="email" placeholder="Email" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
         </div>
         <div class="border-[#C0C0C0] border flex items-center px-3 text-[#70776F] outline-black rounded-[5px] w-full">
             <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                 <path d="M2.81556 6.05889C3.93556 8.26 5.74 10.0567 7.94111 11.1844L9.65222 9.47333C9.86222 9.26333 10.1733 9.19333 10.4456 9.28667C11.3167 9.57444 12.2578 9.73 13.2222 9.73C13.65 9.73 14 10.08 14 10.5078V13.2222C14 13.65 13.65 14 13.2222 14C5.91889 14 0 8.08111 0 0.777778C0 0.35 0.35 0 0.777778 0H3.5C3.92778 0 4.27778 0.35 4.27778 0.777778C4.27778 1.75 4.43333 2.68333 4.72111 3.55444C4.80667 3.82667 4.74444 4.13 4.52667 4.34778L2.81556 6.05889Z" fill="#888E87"/>
             </svg>
             <input type="text" placeholder="Ph no" class="w-full border-none outline-none" />
         </div>
         <h4 class="text-[#2B2B2B] font-medium text-lg text-center">Upload proof</h4>
         <div>
             <label for="file-upload" class="w-full max-w-2xl h-36 border-2 border-dashed border-gray-400 bg-gray-50 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition p-4 rounded-md">
                 <svg class="w-10 h-10 text-gray-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 12l5-5m0 0l5 5m-5-5v12"></path>
                 </svg>
                 <p class="text-gray-600 text-sm">Upload Images from four sides</p>
                 <p class="text-gray-500 text-xs">(Each from one side)</p>
                 <input type="file" id="file-upload" class="hidden">
             </label>
         </div>
         <textarea className="border-[#C0C0C0] _textarea border flex items-center !p-3 text-[#70776F] outline-black rounded-[5px] w-full"
             style="padding:10px; border: 1px solid #C0C0C0; border-radius: 5px; height:130px "
         >Description</textarea>
         <button type="submit" class="font-bold text-2xl bg-[#B6E22E] w-full p-4 hover:bg-black hover:text-[#B6E22E]">Confirm</button>
     </form>
   </div>
    <?php
 }
 add_action('woocommerce_account_sell-my-watch_endpoint', 'sell_my_watch_content');



