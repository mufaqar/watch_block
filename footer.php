<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package watch_block
 */

?>

	</div><!-- #content -->

	<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>

</div><!-- #page -->

<div class="mini-cart-wrapper" >    
    <div class="mini-cart pt-[50px] max-w-[771px] !w-full" id="mini-cart">
        <button id="close-cart" class="close-cart absolute top-14 right-4 text-4xl w-fit left-auto">&times;</button>
        <h3 class="text-[50px] text-center font-medium">Cart</h3>
        <div class="widget_shopping_cart_content">
            <!-- WooCommerce Mini-Cart will be loaded here -->
        </div>
    </div>
</div>


<?php wp_footer(); ?>




</body>
</html>
