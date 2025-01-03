<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
global $product;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

$attributes = $product->get_attributes();


 // Get terms of the `pa_watches_colors` attribute
 $terms_colors = wp_get_post_terms( $product->get_id(), 'pa_watches_colors', array( 'fields' => 'names' ) );
 $terms_sizes = wp_get_post_terms( $product->get_id(), 'pa_watches_size', array( 'fields' => 'names' ) );

//  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
// 	 echo '<div class="product-watches-colors">';
// 	 echo '<h3>' . __( 'Watch Colors', 'your-textdomain' ) . '</h3>';
// 	 echo '<p>' . implode( ', ', $terms ) . '</p>';
// 	 echo '</div>';
//  }

// die();

?>

<div class="border-b pb-4">
            <h4 class="text-xl font-medium">Registry Number</h4>
            <div class="flex gap-6 py-[14px]">
                <p class="text-[#676767]">#4564655</p>
                <img src="<?php echo get_template_directory_uri(); ?>/public/svg/barcode.svg" alt="" srcset="">
            </div>
            <h4 class="text-xl font-medium">Colors available</h4>
            <div class="py-[14px]">
                <div class=" flex gap-2 flex-wrap">
                    <?php foreach ($terms_colors as $clr) { ?>
                        <div class="bg-[#EAEAEA] px-[2px] pt-[2px] pb-[5px] rounded-[10px]">
                            <figure class="bg-white p-1 rounded-[8px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" class="w-[50px] object-contain h-[50px]" alt=""/>
                            </figure>
                            <p class="capitalize text-center mt-1 text-[#676767] text-xs font-medium"><?php echo $clr; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <h4 class="text-xl font-medium">Choose size:</h4>
            <div class="mt-2 flex gap-2 flex-wrap">
                <?php foreach ($terms_sizes as $size) {
                    echo " <button class='bg-[#F0F0F0] py-[9.5px] rounded-full px-6 text-black/60'>{$size}</button>";
                }?>
            </div>
        </div>
<div class="woocommerce-product-details__short-description">
	
	<?php //echo $short_description; // WPCS: XSS ok. ?>
</div>
