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

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/67c56c41396224190a362e18/1ilditor3';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->




</body>
</html>
