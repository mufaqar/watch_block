<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tp_theme
 */

get_header();
?>
<section class="">
    <h2 class="uppercase text-center text-4xl mb-5 sm:text-5xl md:text-[64px] font-semibold text-[#2B2B2B] mt-[125px]">
        <?php the_title()?></h2>
</section>
<section class="">
    <div class="w-full py-6 max-w-[1280px] px-3 mx-auto">
        <?php
        while ( have_posts() ) :
        the_post();
        the_content();
        endwhile; // End of the loop.
        ?>
    </div>
</section>

<?php

get_footer();