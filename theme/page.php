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


<?php if (is_shop()): ?>
    <main class="h-96 w-full !bg-top bg-no-repeat bg-cover px-3 sm:px-4 lg:px-8 2xl:px-[64px] flex flex-col justify-center text-white py-20" style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/main.jpg')">
    <div class="max-w-[450px] pt-20">
        <h1 class="md:text-[64px] font-semibold text-5xl mfont md:leading-[70px]"> </h1>
    </div>
    </main>

<?php else: ?>
    <section class="page_title">
        <h2 class="uppercase text-center text-4xl mb-5 sm:text-5xl md:text-[64px] font-semibold text-[#2B2B2B] mt-[125px]">
            <?php the_title(); ?>
        </h2>
    </section>
<?php endif; ?>


<section class="PageContent">
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