<?php



/* Variable Options */





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
                        <img decoding="async" src="' . esc_url(get_template_directory_uri() . '/images//demo-watch.png') . '" 
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

?>


<script>


document.addEventListener("DOMContentLoaded", function () {
    let selectedAttributes = {}; 

    function updateSelectedAttributes(attribute, value) {
        selectedAttributes[attribute] = value;
        findMatchingVariation();
    }

    function findMatchingVariation() {
        
        if (!window.product_variations) return;


        let matchingVariation = window.product_variations.find(variation => {
            console.log(selectedAttributes);
            console.log(variation);

            return Object.keys(selectedAttributes).every(attr => {
                return variation.attributes["attribute_pa_" + attr] === selectedAttributes[attr];
                
            });
        });

       // console.log(matchingVariation);

        if (matchingVariation) {
            let priceElement = document.getElementById("selected-price");

            if (matchingVariation.display_price) {
                priceElement.innerHTML = `$ ${matchingVariation.display_price}`;
            } else {
                priceElement.innerHTML = "Unavailable";
            }

            // Update hidden input for variation ID (optional, useful for checkout)
            document.querySelector('input[name="variation_id"]').value = matchingVariation.variation_id;
          
        }
    }

    document.querySelectorAll(".color-button, .size-button, .nft-button").forEach(button => {
        button.addEventListener("click", function () {
            let attribute = this.getAttribute("data-attribute");
            let value = this.getAttribute("data-value");

            updateSelectedAttributes(attribute, value);

            // Highlight selected button
            document.querySelectorAll(`[data-attribute="${attribute}"]`).forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
              // Enable Add to Cart button when a valid variation is selected
              document.querySelector('.single_add_to_cart_button').classList.remove('disabled');
        });
    });
});
