<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget !pl-6 !pr-14 !mt-9 <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="flex gap-4">
						<figure class="max-w-[124px] w-full h-[124px] bg-[#F0EEED] p-4 flex justify-center flex-col items-center">
							<?php if ( empty( $product_permalink ) ) : ?>
								<?php echo $thumbnail; // Display the product image ?>
								<figcaption><?php echo wp_kses_post( $product_name ); ?></figcaption>
							<?php else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>">
									<?php echo $thumbnail; // Display the product image ?>
								</a>
							<?php endif; ?>
						</figure>
						<div class="flex-1 flex flex-col justify-between gap-3">
							<div class="flex justify-between w-full gap-3">
								<div>
									<h4 class="text-black font-medium"><?php echo wp_kses_post( $product_name ); ?></h4>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<p class="text-sm">
										<span class="text-black">Quantity: </span>
										<?php echo apply_filters( 
											'woocommerce_widget_cart_item_quantity', 
											'<span class="quantity">' . sprintf( '%s', $cart_item['quantity'] ) . '</span>', 
											$cart_item, 
											$cart_item_key 
										); ?>
									</p>
								</div>
								<?php echo apply_filters(
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">
											<svg width="25" height="24" viewBox="0 0 25 24" fill="none">
												<path d="M21.1504 4.5H17.4004V3.75C17.4004 3.15326 17.1633 2.58097 16.7414 2.15901C16.3194 1.73705 15.7471 1.5 15.1504 1.5H10.6504C10.0537 1.5 9.48136 1.73705 9.0594 2.15901C8.63744 2.58097 8.40039 3.15326 8.40039 3.75V4.5H4.65039C4.45148 4.5 4.26071 4.57902 4.12006 4.71967C3.97941 4.86032 3.90039 5.05109 3.90039 5.25C3.90039 5.44891 3.97941 5.63968 4.12006 5.78033C4.26071 5.92098 4.45148 6 4.65039 6H5.40039V19.5C5.40039 19.8978 5.55843 20.2794 5.83973 20.5607C6.12103 20.842 6.50257 21 6.90039 21H18.9004C19.2982 21 19.6797 20.842 19.9611 20.5607C20.2424 20.2794 20.4004 19.8978 20.4004 19.5V6H21.1504C21.3493 6 21.5401 5.92098 21.6807 5.78033C21.8214 5.63968 21.9004 5.44891 21.9004 5.25C21.9004 5.05109 21.8214 4.86032 21.6807 4.71967C21.5401 4.57902 21.3493 4.5 21.1504 4.5ZM11.4004 15.75C11.4004 15.9489 11.3214 16.1397 11.1807 16.2803C11.0401 16.421 10.8493 16.5 10.6504 16.5C10.4515 16.5 10.2607 16.421 10.1201 16.2803C9.97941 16.1397 9.90039 15.9489 9.90039 15.75V9.75C9.90039 9.55109 9.97941 9.36032 10.1201 9.21967C10.2607 9.07902 10.4515 9 10.6504 9C10.8493 9 11.0401 9.07902 11.1807 9.21967C11.3214 9.36032 11.4004 9.55109 11.4004 9.75V15.75ZM15.9004 15.75C15.9004 15.9489 15.8214 16.1397 15.6807 16.2803C15.5401 16.421 15.3493 16.5 15.1504 16.5C14.9515 16.5 14.7607 16.421 14.6201 16.2803C14.4794 16.1397 14.4004 15.9489 14.4004 15.75V9.75C14.4004 9.55109 14.4794 9.36032 14.6201 9.21967C14.7607 9.07902 14.9515 9 15.1504 9C15.3493 9 15.5401 9.07902 15.6807 9.21967C15.8214 9.36032 15.9004 9.55109 15.9004 9.75V15.75ZM15.9004 4.5H9.90039V3.75C9.90039 3.55109 9.97941 3.36032 10.1201 3.21967C10.2607 3.07902 10.4515 3 10.6504 3H15.1504C15.3493 3 15.5401 3.07902 15.6807 3.21967C15.8214 3.36032 15.9004 3.55109 15.9004 3.75V4.5Z" fill="#FF3333"/>
											</svg>
										</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								); ?>
							</div>
							<div>
								<?php
									echo apply_filters( 
										'woocommerce_widget_cart_item_price', 
										'<span class="price">' . sprintf( '%s', $product_price ) . '</span>', 
										$cart_item, 
										$cart_item_key 
									);
								?>
							</div>
						</div>
					</div>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="!pl-6 !pr-14">
		<div class="mb-6 pt-4 border-t border-black/10">
			<p class="woocommerce-mini-cart__total total flex justify-between">
				<?php
				/**
				 * Hook: woocommerce_widget_shopping_cart_total.
				 *
				 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
				 */
				do_action( 'woocommerce_widget_shopping_cart_total' );
				?>
			</p>
			<p class="text-[#70776F] -mt-1">(incl. fees and tax)</p>
		</div>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
		<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
		<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
	</div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
