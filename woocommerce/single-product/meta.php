<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
global $post;
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
?>

<div class="mt-6 md:mt-4">
            <h4 class="text-xl font-medium pb-[10px]">Description</h4>
            <!-- <ul class="text-[#676767] list-disc pl-5">
                <li>Manufacture Date:</li>
                <li>Crafted in [Year] at the renowned [Manufacturer] in [Country]. This watch is part of a limited production run, showcasing the brand’s commitment to precision and quality.</li>
                <li>Original Purchase:</li>
                <li>First purchased on [Date] by [First Owner’s Name], this watch was originally sold at [Store Name], located in [City, Country]. It has since been carefully maintained and appreciated for its timeless design.</li>
                <li>Service and Maintenance:</li>
                <li>[Date]: Full service at [Authorized Service Center], including movement calibration, pressure testing...</li>
            </ul> -->
			<?php echo $short_description; ?>
        </div>
<div class="product_meta">



	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<!-- <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?> -->

	<?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php //echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
