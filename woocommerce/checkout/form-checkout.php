<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<div>
    <h2 class="checkout_page_title mb-10 text-center">CHECKOUT</h2>
</div>

<form name="checkout" method="post" class="checkout woocommerce-checkout max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <!-- Left Column (Billing & Shipping) -->
    <div class="space-y-6">
        <?php if ( $checkout->get_checkout_fields() ) : ?>
            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div id="customer_details" class="bg-white">
                <div class="mb-6">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>
                <div>
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
        <?php endif; ?>
    </div>

    <!-- Right Column (Order Summary) -->
    <div class="">
        
    <div>
        <h2 class="your_order mb-4"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h2>
        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
        <div class="order-summary-wrapper"> <!-- Parent div -->
            <?php do_action( 'woocommerce_before_checkout_order_review' ); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            <div class="checkout-coupon-form">
                <?php do_action( 'woocommerce_before_checkout_form', WC()->checkout() ); ?>
            </div>
        </div>
    </div>

        
        <!-- Coupon Code Above Payment Method -->
        <div class="mt-6">
            <?php do_action( 'woocommerce_before_checkout_payment' ); ?>
        </div>
    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
