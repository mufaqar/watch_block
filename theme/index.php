<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watch_block
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
			<p class="text-center text-[#FDFDFD] mt-4">Free domestic ground shipping on all orders over
			$150.</p>
		</div>
		<div>
			<h3 class="text-[23px] font-bold text-white uppercase text-center">Path to sustainability</h3>
			<p class="text-center text-[#FDFDFD] mt-4">We utilize sustainable materials and best practices
			#ForethePlanet.
			$150.</p>
		</div>
		<div>
			<h3 class="text-[23px] font-bold text-white uppercase text-center">30-day Trial</h3>
			<p class="text-center text-[#FDFDFD] mt-4">Don't love your TRUEs? We'll take any new pair
			(excluding Second Chance) back within 30 days.
			$150.</p>
		</div>
	</section>


<?php
get_footer();
