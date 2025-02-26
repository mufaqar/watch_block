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
	<div class="max-w-[612px] px-5 md:px-0 mx-auto text-center flex flex-col pt-12 items-center">
		<a href="#">
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="watch-blocks" class="min-w-[120px]"/>
		</a>
		<p class="text-white mt-[10px] mb-14">YOUR PERFECT WATCH IS STILL HERE – GRAB YOURS BEFORE IT'S GONE!</p>
		<div class="text-white capitalize flex justify-center items-center gap-4 flex-wrap font-normal">
			<a href="<?php echo home_url('/blog') ?>">Blog</a>
			<button id="stolen-report">Report Stolen Watch</button>
			<a href="<?php echo home_url('/contact-us') ?>">Contact us</a>
		</div>
		<div class="my-9 flex items-center gap-4 sm:gap-[30px]">
			<a href="https://x.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/svg/x.svg" alt="" /></a>
			<a href="https://youtube.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/svg/yt.svg" alt="" /></a>
			<a href="https://www.google.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/svg/fb.svg" alt="" /></a>
			<a href="https://cloud.google.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/svg/cloud.svg" alt="" /></a>
		</div>
	</div>
	<div class="text-white flex items-center px-5 text-center justify-center flex-wrap pb-3 gap-4">
			<p>@2024 VOOKUM. All rights reserved</p>
			<div class="w-[2px] h-[15px] bg-[white]"></div>
			<a href="<?php echo home_url('/terms-and-condition') ?>">Terms & Conditions</a>
			<div class="w-[2px] h-[15px] bg-[white]"></div>
			<a href="<?php echo home_url('/privacy-policy') ?>">Privacy Policy</a>
		</div>
</footer>


<?php get_template_part( 'template-parts/layout/stolen', 'model' ); ?>
<?php get_template_part( 'template-parts/layout/compare', 'model' ); ?>


<script>
	document.getElementById("stolen-report").addEventListener("click", function () {
		document.getElementById("modal").style.display = "block";
	});
	document.querySelector(".close").addEventListener("click", function () {
		document.getElementById("modal").style.display = "none";
	});
	window.addEventListener("click", function (event) {
		if (event.target === document.getElementById("modal")) {
			document.getElementById("modal").style.display = "none";
		}
	});
</script>


<script>
	document.getElementById("compare-action").addEventListener("click", function () {
		document.getElementById("compare-modal").style.display = "block";
	});
	document.querySelector(".close-compare").addEventListener("click", function () {
		document.getElementById("compare-modal").style.display = "none";
	});
	window.addEventListener("click", function (event) {
		if (event.target === document.getElementById("compare-modal")) {
			document.getElementById("compare-modal").style.display = "none";
		}
	});
</script>