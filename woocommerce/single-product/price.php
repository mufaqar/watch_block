<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$product_id = $product->get_id();



?>

<div class="flex flex-col mb-2 md:flex-row justify-between gap-2 border-b pb-3 md:pb-1">
    <div>
        <h2 class="text-2xl !pl-0 font-bold"><?php the_title()?></h2>
        <div class="flex justify-between gap-4 items-center max-w-[250px] my-2">
            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/star-bar.svg" alt="" />
            <p><?php echo $review_count ?> Reviews</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <h4 class="text-[28px] sm:text-[36px] font-bold"><?php echo $product->get_price_html(); ?></h4>
        <!-- <button class="border-l-[2px] px-4 border-r-[2px] border-gray-300">
            <a class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow">
                <img src="<?php echo get_template_directory_uri(); ?>/images/svg/heart2.svg" alt=""
                    class="w-[26px] h-[16px]">
            </a>
        </button> -->
        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>


        <a href="/">
            <span class="bg-[#B6E22E] text-black uppercase text-2xl font-light px-5 py-1.5 rounded-[8px]">Follow</span>
        </a>
    </div>
</div>