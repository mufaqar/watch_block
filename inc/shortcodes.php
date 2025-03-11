<?php


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
        $this->supports           = array('products', 'woocommerce_blocks');

        // Load settings
        $this->init_form_fields();
        $this->init_settings();

        $this->title       = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->enabled     = $this->get_option('enabled');
<<<<<<< HEAD
        // $this->api_url     = $this->get_option('api_url');
=======
        $this->api_url     = $this->get_option('api_url');
        $this->api_sucess  = $this->get_option('api_sucess');
>>>>>>> 08d8499b597dcf0f5f95046e134d116843eb8a0c

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
            'api_sucess' => array(
                'title'       => __('Success URL', 'woocommerce'),
                'type'        => 'text',
                'description' => __('Enter the Success URL.', 'woocommerce'),
                'default'     => '',
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $randomHex = bin2hex(random_bytes(8));

        $checkout_id = $randomHex; 
        //https://nft-watch-dashboard.vercel.app/crypto-wallet
        $success_url = rtrim($this->api_sucess, '/') . "?checkout_id={$checkout_id}"; // Fix success URL

        // Get order total, currency, and subtotal
        $currency = $order->get_currency();
        $total = $order->get_total();
        $subtotal = $order->get_subtotal();

        // Get cart items
        $cart_items = array();
        foreach ($order->get_items() as $item_id => $item) {
            $product = $item->get_product();
            $attributes = array();

            if ($product->is_type('variable')) {
                $variation_id = $item->get_variation_id();
                $variation = wc_get_product($variation_id);
                if ($variation) {
                    foreach ($variation->get_attributes() as $key => $value) {
                        $attributes[$key] = $value;
                    }
                }
            } else {
                foreach ($product->get_attributes() as $attr_name => $attr) {
                    if ($attr->is_taxonomy()) {
                        $terms = wc_get_product_terms($product->get_id(), $attr->get_name(), array('fields' => 'names'));
                        $attributes[$attr_name] = implode(', ', $terms);
                    } else {
                        $attributes[$attr_name] = $attr->get_options();
                    }
                }
            }

            $cart_items[] = array(
                'product_id'   => $product->get_id(),
                'name'         => $product->get_name(),
                'quantity'     => $item->get_quantity(),
                'price'        => $product->get_price(),
                'product_type' => $product->get_type(),
                'attributes'   => $attributes,
            );
        }

        // Get billing & shipping details
        $billing = array(
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
        );

        $shipping = array(
            'first_name' => $order->get_shipping_first_name(),
            'last_name'  => $order->get_shipping_last_name(),
            'address_1'  => $order->get_shipping_address_1(),
            'address_2'  => $order->get_shipping_address_2(),
            'city'       => $order->get_shipping_city(),
            'state'      => $order->get_shipping_state(),
            'postcode'   => $order->get_shipping_postcode(),
            'country'    => $order->get_shipping_country(),
        );

        $data = array(
            'currency'    => $currency,
            'total'       => $total,
            'subtotal'    => $subtotal,
            'return_url'  => $order->get_checkout_order_received_url(),
            'success_url' => $success_url,
            'checkout_id' => $checkout_id,
            'cart_items'  => $cart_items,
            'billing'     => $billing,
            'shipping'    => $shipping,
        );

        // Send POST request
        //https://watchblock-backend.onrender.com/api/payments/crypto-wallet
        $response = wp_remote_post($this->api_url, array(
            'method'    => 'POST',
            'body'      => json_encode($data),
            'headers'   => array(
                'Content-Type' => 'application/json',
            ),
        ));

        if (is_wp_error($response)) {
            wc_add_notice(__('Payment error:', 'woocommerce') . ' Unable to process payment.', 'error');
            return array(
                'result'   => 'failure',
                'redirect' => wc_get_checkout_url(),
            );
        }

        $response_body = wp_remote_retrieve_body($response);
        $response_data = json_decode($response_body, true);

        if (!empty($response_data['message']) && $response_data['message'] === 'Session Successfully created!') {
            return array(
                'result'   => 'success',
                'redirect' => $success_url,
            );
        } else {
            wc_add_notice(__('Payment error:', 'woocommerce') . ' ' . ($response_data['message'] ?? 'Unknown error'), 'error');
            return array(
                'result'   => 'failure',
                'redirect' => wc_get_checkout_url(),
            );
        }
    }
}
