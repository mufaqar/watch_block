<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watch_block
 */

?>

<footer class="bg-[#1C1C1C]">
	<div class="max-w-[612px] mx-auto text-center flex flex-col pt-12 items-center">
		<a href="#">
			<img src="<?php echo get_template_directory_uri(); ?>/public/logo.svg" alt="watch-blocks" class="min-w-[120px]"/>
		</a>
		<p class="text-white mt-[10px] mb-14">Lorem ipsum dolor sit amet consectetur. Semper ipsum elementum in ipsum fringilla id. Elit velit id maecenas tortor euismod.</p>
		<div class="text-white capitalize font-normal">
			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<nav aria-label="<?php esc_attr_e( 'Footer Menu', 'watch_block' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-2',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
							)
						);
						?>
				</nav>
			<?php endif; ?>
		</div>
		<div class="my-9 flex items-center gap-4 sm:gap-[30px]">
			<a href="https://x.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/public/svg/x.svg" alt="" /></a>
			<a href="https://youtube.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/public/svg/yt.svg" alt="" /></a>
			<a href="https://www.google.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/public/svg/fb.svg" alt="" /></a>
			<a href="https://cloud.google.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/public/svg/cloud.svg" alt="" /></a>
		</div>
	</div>
	<div class="text-white flex items-center px-3 text-center justify-center flex-wrap pb-3 gap-4">
			<p>@2024 VOOKUM. All rights reserved</p>
			<div class="w-[2px] h-[15px] bg-[white]"></div>
			<a href="<?php echo home_url('/terms-and-condition') ?>">Terms & Conditions</a>
			<div class="w-[2px] h-[15px] bg-[white]"></div>
			<a href="<?php echo home_url('/privacy-policy') ?>">Privacy Policy</a>
		</div>
</footer>


<footer id="colophon" >

	

</footer><!-- #colophon -->
