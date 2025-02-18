<?php
/**
 * Template Name: Coming Soon
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="mt-60 mb-40">
    <?php
    // Start the loop to fetch the page's title and content
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <h1 class="text-4xl text-center font-bold"><?php the_title(); ?></h1>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
            <?php
        endwhile;
    endif;
    ?>
</section>

<?php get_footer(); ?>