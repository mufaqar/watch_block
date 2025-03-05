<?php


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

        <?php foreach ($cart_items as $index => $cart_item) :
            
            $product = wc_get_product($cart_item['product_id']);
            $product_type = $product ? $product->get_type() : ''; // Get product type
            
            ?>
        <input type="hidden" name="cart_items[<?php echo $index; ?>][product_id]"
            value="<?php echo esc_attr($cart_item['product_id']); ?>">
        <input type="hidden" name="cart_items[<?php echo $index; ?>][name]"
            value="<?php echo esc_attr($cart_item['data']->get_name()); ?>">
        <input type="hidden" name="cart_items[<?php echo $index; ?>][quantity]"
            value="<?php echo esc_attr($cart_item['quantity']); ?>">
        <input type="hidden" name="cart_items[<?php echo $index; ?>][price]"
            value="<?php echo esc_attr($cart_item['data']->get_price()); ?>">
            <input type="hidden" name="cart_items[<?php echo $index; ?>][product_type]"
            value="<?php echo esc_attr($product_type); ?>">
            <?php
    // Get product attributes for simple product
    $product = wc_get_product($cart_item['product_id']);
    if ($product) {
        $attributes = $product->get_attributes();
        foreach ($attributes as $attribute_name => $attribute) {
            $attr_label = wc_attribute_label($attribute_name);
            $attr_value = $product->get_attribute($attribute_name); // Get attribute value
            if (!empty($attr_value)) {
            ?>
                <input type="hidden" name="cart_items[<?php echo $index; ?>][attributes][<?php echo esc_attr($attr_label); ?>]"
                    value="<?php echo esc_attr($attr_value); ?>">
            <?php
            }
        }
    }
    ?>
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

     // Extract cart items and attributes
     for (let pair of formData.entries()) {
        const key = pair[0];
        const value = pair[1];

        // Match cart item keys like cart_items[unique_id][field] or cart_items[unique_id][attributes][attribute_name]
        const match = key.match(/^cart_items\[(.*?)\]\[(.*?)\](?:\[(.*?)\])?$/);
        if (match) {
            const itemKey = match[1]; // Unique identifier for each cart item
            const fieldName = match[2]; // Field name (product_id, name, quantity, price, attributes)
            const attributeName = match[3]; // Attribute name (e.g., color, size)

            // Find or create the cart item object
            let item = data.cart_items.find(i => i.id === itemKey);
            if (!item) {
                item = { id: itemKey, attributes: {} };
                data.cart_items.push(item);
            }

            // If it's an attribute, store it inside the `attributes` object
            if (attributeName) {
                item.attributes[attributeName] = value;
            } else {
                item[fieldName] = value;
            }
        }
    }

    // Remove the temporary id field
    data.cart_items = data.cart_items.map(({ id, ...rest }) => rest);

    console.log("Processed Data:", JSON.stringify(data, null, 2));

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
