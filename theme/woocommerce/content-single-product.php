<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <main class="max-w-[1280px] flex flex-col lg:flex-row mx-auto px-3 gap-10 mt-[140px] mb-12">
        <div class="lg:w-[35%]">
            <?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */

				do_action( 'woocommerce_before_single_product_summary' );
				
				?>
        </div>
		<div class="lg:w-[65%]">
			
           		 <?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					
					?>
        </div>
		

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        //do_action( 'woocommerce_after_single_product_summary' );
        ?>
	
	</main>


<section class="max-w-[1280px] px-3 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-9 my-12">
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Watch Details</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Regular Price</h6>
                <p class="text-black/70 text-sm mt-1">$149,199.86</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Brand</h6>
                <a class="text-black underline text-sm mt-1 capitalize">Rolex</a>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Model Name</h6>
                <a class="text-black underline text-sm mt-1 capitalize">Submariner</a>
            </li>
        </ul>
    </div>
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Case</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Material</h6>
                <p class="text-black/70 text-sm mt-1">White Gold</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Crystal</h6>
                <p class="text-black/70 text-sm mt-1">Sapphire</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Size</h6>
                <p class="text-black/70 text-sm mt-1">40mm</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Bezel</h6>
                <p class="text-black/70 text-sm mt-1">18k White Gold Diamond</p>
            </li>
        </ul>
    </div>
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Movement</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Calibre</h6>
                <p class="text-black/70 text-sm mt-1">3135</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Type</h6>
                <p class="text-black/70 text-sm mt-1">Automatic</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Bezel</h6>
                <p class="text-black/70 text-sm mt-1">Unidirectional</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Complication</h6>
                <p class="text-black/70 text-sm mt-1">Date</p>
            </li>
        </ul>
    </div>
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Bracelet</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Material</h6>
                <p class="text-black/70 text-sm mt-1">White Gold</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Type</h6>
                <p class="text-black/70 text-sm mt-1">Oyster</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Clasp</h6>
                <p class="text-black/70 text-sm mt-1">Glidelock</p>
            </li>
        </ul>
    </div>
</section>



<section class="max-w-[1280px] px-3 mx-auto mb-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-12">
	<?php do_action('watch_block_single_reviews'); ?>
    </div>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>


<section class="bg-[#F2F2F2] py-14 pb-28">
    <div class="max-w-[1280px] px-3 mx-auto">
		<?php do_action('watch_block_related_products'); ?>
    </div>
</section>