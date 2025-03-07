<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CBL_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>



    <!-- Hero Section -->
    <div class="bg-white h-96 w-full flex items-center justify-center mt-[-140px] pt-[140px]">
        <h1 class="text-center text-black text-[14vw] md:text-[42px] font-[600] container mx-auto">
            <?php the_archive_title()?></h1>
    </div>

    <div class="max-w-[1280px] mx-auto px-5 mb-28">
        <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            
            <div>
                <div class="flex items-center gap-2 m-6">
                    <p class="text-black font-semibold text-sm">
                        <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $first_category = $categories[0]; // Get the first category
                                    echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '" class="hover:underline">' . esc_html($first_category->name) . '</a>';
                                } else {
                                    echo 'Uncategorized';
                                }
                                ?>
                    </p>
                </div>
                <h2 class="text-[41px] leading-[45px] mb-5"><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="postExcerpt"><?php the_excerpt(); ?></div>
                <div class="flex items-center gap-2 mt-6">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/svg/calandar.svg" alt=""
                        class="w-[42px]" />
                    <p class="text-black/30 font-semibold text-sm">
                        <?php echo get_the_date(); ?>
                    </p>
                </div>
            </div>
        </div>

        <?php

			endwhile;

			

		endif;
		?>
    </div>

</main><!-- #main -->

<?php

get_footer();