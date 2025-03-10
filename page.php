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
if ( is_shop() ) :
    ?>
        <main class="h-[420px] md:h-[700px] w-full bg-no-repeat bg-cover !bg-center px-5 sm:px-4 lg:px-8 2xl:px-[64px] flex flex-col justify-center text-white py-20 mt-[-140px]" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images//main.jpg')">
            <div class="max-w-[450px] pt-20">
                <h1 class="md:text-[64px] font-semibold text-5xl mfont md:leading-[70px]"></h1>
            </div>
        </main>
        <?php get_template_part( 'template-parts/product/product', 'filter' ); ?>
    <?php endif; ?>



<section class="PageContent">
    <div class="w-full pb-6 max-w-[1280px] px-5 lg:px-0 !pt-[55px] mx-auto">
        <?php
        while ( have_posts() ) : the_post();
        the_content();
        endwhile; // End of the loop.
        ?>
    </div>
</section>

<?php

get_footer();