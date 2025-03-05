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

    // Get customer billing and shipping details
    $customer = WC()->customer;
    $billing = [
        'first_name' => $customer->get_billing_first_name(),
        'last_name'  => $customer->get_billing_last_name(),
        'email'      => $customer->get_billing_email(),
        'phone'      => $customer->get_billing_phone(),
        'address_1'  => $customer->get_billing_address_1(),
        'address_2'  => $customer->get_billing_address_2(),
        'city'       => $customer->get_billing_city(),
        'state'      => $customer->get_billing_state(),
        'postcode'   => $customer->get_billing_postcode(),
        'country'    => $customer->get_billing_country(),
    ];
    
    $shipping = [
        'first_name' => $customer->get_shipping_first_name(),
        'last_name'  => $customer->get_shipping_last_name(),
        'address_1'  => $customer->get_shipping_address_1(),
        'address_2'  => $customer->get_shipping_address_2(),
        'city'       => $customer->get_shipping_city(),
        'state'      => $customer->get_shipping_state(),
        'postcode'   => $customer->get_shipping_postcode(),
        'country'    => $customer->get_shipping_country(),
    ];

    ob_start();
    ?>

    <div id="crypto-payment-wrapper" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">
        <h3>Pay with Crypto</h3>

        <form id="crypto-payment-form">
            <input type="hidden" name="currency" value="<?php echo esc_attr($currency); ?>">
            <input type="hidden" name="total" value="<?php echo esc_attr($total); ?>">
            <input type="hidden" name="subtotal" value="<?php echo esc_attr($subtotal); ?>">
            <input type="hidden" name="checkout_id" value="<?php echo esc_attr($randomHex); ?>">
            <input type="hidden" name="return_url" value="<?php echo esc_url($api_url); ?>">
            <input type="hidden" name="success_url" value="<?php echo esc_url($success_url); ?>">

            <?php foreach ($cart_items as $index => $cart_item) :
                $product = wc_get_product($cart_item['product_id']);
                $product_type = $product ? $product->get_type() : ''; 
            ?>
                <input type="hidden" name="cart_items[<?php echo $index; ?>][product_id]" value="<?php echo esc_attr($cart_item['product_id']); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][name]" value="<?php echo esc_attr($cart_item['data']->get_name()); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][quantity]" value="<?php echo esc_attr($cart_item['quantity']); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][price]" value="<?php echo esc_attr($cart_item['data']->get_price()); ?>">
                <input type="hidden" name="cart_items[<?php echo $index; ?>][product_type]" value="<?php echo esc_attr($product_type); ?>">

                <?php
                // Get product attributes
                if ($product) {
                    $attributes = $product->get_attributes();
                    foreach ($attributes as $attribute_name => $attribute) {
                        $attr_label = wc_attribute_label($attribute_name);
                        $attr_value = $product->get_attribute($attribute_name); 
                        if (!empty($attr_value)) {
                ?>
                    <input type="hidden" name="cart_items[<?php echo $index; ?>][attributes][<?php echo esc_attr($attr_label); ?>]" value="<?php echo esc_attr($attr_value); ?>">
                <?php
                        }
                    }
                }
                ?>
            <?php endforeach; ?>

            <!-- Billing Information -->
            <?php foreach ($billing as $key => $value) : ?>
                <input type="hidden" name="billing[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>">
            <?php endforeach; ?>

            <!-- Shipping Information -->
            <?php foreach ($shipping as $key => $value) : ?>
                <input type="hidden" name="shipping[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>">
            <?php endforeach; ?>

            <button type="submit" class="button alt" id="crypto-pay-button" style="background: #ff9800; color: #fff; padding: 10px 20px; font-size: 16px; border: none; cursor: pointer;">
                Pay with Crypto
            </button>
        </form>
    </div>

    <script>
    document.getElementById('crypto-payment-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const data = {
            currency: formData.get('currency'),
            total: formData.get('total'),
            subtotal: formData.get('subtotal'),
            return_url: formData.get('return_url'),
            success_url: formData.get('success_url'),
            checkout_id: formData.get('checkout_id'),
            cart_items: [],
            billing: {},
            shipping: {}
        };

        // Extract cart items and attributes
        for (let pair of formData.entries()) {
            const key = pair[0];
            const value = pair[1];

            const match = key.match(/^cart_items\[(.*?)\]\[(.*?)\](?:\[(.*?)\])?$/);
            if (match) {
                const itemKey = match[1];
                const fieldName = match[2];
                const attributeName = match[3];

                let item = data.cart_items.find(i => i.id === itemKey);
                if (!item) {
                    item = { id: itemKey, attributes: {} };
                    data.cart_items.push(item);
                }

                if (attributeName) {
                    item.attributes[attributeName] = value;
                } else {
                    item[fieldName] = value;
                }
            }

            // Extract billing and shipping data
            const billingMatch = key.match(/^billing\[(.*?)\]$/);
            if (billingMatch) {
                data.billing[billingMatch[1]] = value;
            }

            const shippingMatch = key.match(/^shipping\[(.*?)\]$/);
            if (shippingMatch) {
                data.shipping[shippingMatch[1]] = value;
            }
        }

        // Remove the temporary id field
        data.cart_items = data.cart_items.map(({ id, ...rest }) => rest);

        console.log("Processed Data:", JSON.stringify(data, null, 2));

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
                window.location.href = "<?php echo esc_url($success_url); ?>";
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('crypto_payment_button', 'crypto_payment_button_shortcode');
