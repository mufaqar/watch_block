<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watch_block
 */

get_header();
?>

<main class="max-w-[1280px] mx-auto px-3 z-[1]">
    <img src="<?php echo get_template_directory_uri(); ?>/public/images/timepiece.png" alt="" class="h-[300px] w-full object-cover mt-24 rounded-[16px]"/>
</main>
<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .page-header -->




			<div class="max-w-[1280px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mx-auto px-3 mb-28">

		<?php if ( have_posts() ) : ?>			

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
		//	watch_block_the_posts_navigation();

		else :

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
	
	</section><!-- #primary -->

<?php
get_footer();
