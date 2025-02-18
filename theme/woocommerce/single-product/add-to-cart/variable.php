<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 * 
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

// Trigger before add to cart form
do_action( 'woocommerce_before_add_to_cart_form' );

// Call the custom function to display color, size, and NFT options
add_custom_color_size_nft_fields(); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">

	<?php
		// This is where we skip the default variations table and just render the custom options.
		// You can remove or comment out this entire section if you don’t want any default table or dropdowns rendered.
		// do_action( 'woocommerce_before_variations_form' );
	?>

	<div class="single_variation_wrap">
		<?php
			/**
			 * Hook: woocommerce_before_single_variation.
			 */
			do_action( 'woocommerce_before_single_variation' );

			/**
			 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
			 *
			 * @since 2.4.0
			 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
			 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
			 */
			do_action( 'woocommerce_single_variation' );

			/**
			 * Hook: woocommerce_after_single_variation.
			 */
			do_action( 'woocommerce_after_single_variation' );
		?>
	</div>

	<!-- Hidden input fields for custom options -->
	<input type="hidden" name="custom_color" id="custom_color" value="" />
	<input type="hidden" name="custom_size" id="custom_size" value="" />
	<input type="hidden" name="custom_nft" id="custom_nft" value="" />

	<?php
		// Trigger after add to cart form
		do_action( 'woocommerce_after_add_to_cart_form' );
	?>
</form>
