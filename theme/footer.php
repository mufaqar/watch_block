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

<div class="mini-cart-wrapper">    
    <div class="mini-cart" id="mini-cart">
        <button id="close-cart" class="close-cart">&times;</button>
        <h3>Cart</h3>
        <div class="widget_shopping_cart_content">
            <!-- WooCommerce Mini-Cart will be loaded here -->
        </div>
    </div>
</div>


<?php wp_footer(); ?>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick Slider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


</body>
</html>
