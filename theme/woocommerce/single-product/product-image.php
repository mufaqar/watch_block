<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
    return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();
?>

<div class="row">
    <div class="column small-11 small-centered">
        <div class="slider slider-single">
            <?php
            // Display main product images in the slider
            if ( $attachment_ids && $product->get_image_id() ) {
                foreach ( $attachment_ids as $attachment_id ) {
                    $image_url = wp_get_attachment_url( $attachment_id );
                    echo '<div><img class="max-w-[415px] w-full object-contain mx-auto !h-[415px]" src="' . esc_url( $image_url ) . '" alt="Product Image"></div>';
                }
            }
            ?>
        </div>

        <div class="slider slider-nav mt-10 px-8">
            <?php
            // Display thumbnail navigation
            if ( $attachment_ids && $product->get_image_id() ) {
                foreach ( $attachment_ids as $attachment_id ) {
                    $image_url = wp_get_attachment_url( $attachment_id );
                    echo '<div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden">';
                    echo '<img class="rounded-xl object-cover !h-[75px] !my-0" src="' . esc_url( $image_url ) . '" alt="Thumbnail">';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>
