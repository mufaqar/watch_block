<?php
/**
 * Template Name: Home Page
 */

get_header();
?>
	<?php get_template_part( 'template-parts/home-page/hero', 'content' ); ?>
	<?php get_template_part( 'template-parts/home-page/logo-bar', 'content' ); ?>
	<?php get_template_part( 'template-parts/home-page/product-tabs', 'content' ); ?>
	<?php get_template_part( 'template-parts/home-page/secure', 'registor' ); ?>
	<?php get_template_part( 'template-parts/home-page/certified', 'network' ); ?>
	<?php get_template_part( 'template-parts/home-page/reviews-and-articles', 'tab' ); ?>
	<?php get_template_part( 'template-parts/home-page/timepiece', 'spotlight' ); ?>
	<?php get_template_part( 'template-parts/home-page/faqs', 'section' ); ?>
	<section class="bg-[#1C1C1C] max-w-[1280px] mx-auto px-3 mb-20 p-[33px] grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:gap-14">
		<div>
			<h3 class="text-[23px] font-bold text-white uppercase text-center">Free Shipping</h3>
			<p class="text-center text-[#FDFDFD] mt-4">Enjoy free domestic ground shipping on all orders over $150! Shop with ease and have your favorites delivered straight to your doorstep at no extra cost.</p>
		</div>
		<div>
			<h3 class="text-[23px] font-bold text-white uppercase text-center">PATH TO SUSTAINABILITY</h3>
			<p class="text-center text-[#FDFDFD] mt-4">We’re committed to making a difference. By utilizing sustainable materials and following best practices, we’re taking a step toward a greener planet. Let’s make every purchase count. #ForThePlanet.</p>
		</div>
		<div>
			<h3 class="text-[23px] font-bold text-white uppercase text-center">30-DAY TRIAL</h3>
			<p class="text-center text-[#FDFDFD] mt-4">Not satisfied with your purchase? Return any pair (except Second Chance items) within 30 days for a hassle-free refund.</p>
		</div>
	</section>



<?php
get_footer();
