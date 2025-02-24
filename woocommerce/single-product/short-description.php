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

    <div class="registry_block">
        <h4 class="text-xl font-medium">Registry Number</h4>
        <div class="flex gap-6 py-[14px]">
            <p class="text-[#676767]">#<?php echo $product->get_id() ?></p>
            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/barcode.svg" alt="" srcset="">
        </div>            
    </div>

	
	<?php //add_custom_color_size_nft_fields(); ?>

