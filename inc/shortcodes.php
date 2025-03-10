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
//add_shortcode('crypto_payment_button', 'crypto_payment_button_shortcode');
// Register custom payment gateway
function register_crypto_payment_gateway($gateways) {
    $gateways['crypto_payment'] = 'WC_Gateway_Crypto_Payment';
    return $gateways;
}
add_filter('woocommerce_payment_gateways', 'register_crypto_payment_gateway');

class WC_Gateway_Crypto_Payment extends WC_Payment_Gateway {

    public function __construct() {
        $this->id                 = 'crypto_payment';
        $this->method_title       = __('Pay With Crypto', 'woocommerce');
        $this->method_description = __('Redirect customers to pay via cryptocurrency.', 'woocommerce');
        $this->has_fields         = false;
        $this->supports           = array('products', 'woocommerce_blocks'); // Ensures support for WooCommerce Checkout Blocks

        // Load settings
        $this->init_form_fields();
        $this->init_settings();

        $this->title       = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->enabled     = $this->get_option('enabled');
        $this->api_url     = $this->get_option('api_url');

        // Save admin settings
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => __('Enable/Disable', 'woocommerce'),
                'type'    => 'checkbox',
                'label'   => __('Enable Pay With Crypto', 'woocommerce'),
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => __('Title', 'woocommerce'),
                'type'        => 'text',
                'default'     => __('Pay With Crypto', 'woocommerce'),
            ),
            'description' => array(
                'title'       => __('Description', 'woocommerce'),
                'type'        => 'textarea',
                'default'     => __('Use cryptocurrency to complete your payment.', 'woocommerce'),
            ),
            'api_url' => array(
                'title'       => __('API URL', 'woocommerce'),
                'type'        => 'text',
                'description' => __('Enter the API endpoint for processing the payment.', 'woocommerce'),
                'default'     => '',
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $randomHex = bin2hex(random_bytes(8));

        // Payment data
        $data = array(
            'checkout_id' => $randomHex,
            'currency'    => get_woocommerce_currency(),
            'total'       => $order->get_total(),
            'subtotal'    => $order->get_subtotal(),
            'return_url'  => site_url('/checkout/order-received/'),
            'cancel_url'  => wc_get_checkout_url(),
            'billing'     => array(
                'first_name' => $order->get_billing_first_name(),
                'last_name'  => $order->get_billing_last_name(),
                'email'      => $order->get_billing_email(),
                'phone'      => $order->get_billing_phone(),
                'address_1'  => $order->get_billing_address_1(),
                'address_2'  => $order->get_billing_address_2(),
                'city'       => $order->get_billing_city(),
                'state'      => $order->get_billing_state(),
                'postcode'   => $order->get_billing_postcode(),
                'country'    => $order->get_billing_country(),
            ),
            'shipping'    => array(
                'first_name' => $order->get_shipping_first_name(),
                'last_name'  => $order->get_shipping_last_name(),
                'address_1'  => $order->get_shipping_address_1(),
                'address_2'  => $order->get_shipping_address_2(),
                'city'       => $order->get_shipping_city(),
                'state'      => $order->get_shipping_state(),
                'postcode'   => $order->get_shipping_postcode(),
                'country'    => $order->get_shipping_country(),
            ),
        );

        $response = wp_remote_post( 'https://watchblock-backend.onrender.com/api/payments/crypto-wallet', array(
            'method'    => 'POST',
            'body'      => json_encode( $data ), // Encode the data as JSON
            'headers'   => array(
                'Content-Type' => 'application/json', // Ensure the server knows we're sending JSON
            ),
        ) );

        // Redirect user to external crypto payment page
        $redirect_url = "https://nft-watch-dashboard.vercel.app/crypto-wallet?checkout_id={$randomHex}";

        return array(
            'result'   => 'success',
            'redirect' => esc_url_raw($redirect_url),
        );
    }
}
