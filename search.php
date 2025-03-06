<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package watch_block
 */

get_header();
?>

<section id="primary">
    <main id="main">

        <?php if ( have_posts() ) : ?>

        <section class="bg-[#F2F2F2] py-14 pb-28">
            <div class="max-w-[1280px] px-5 mx-auto">
                <?php
                printf(
                    '<h1 class="uppercase font-semibold text-[#2B2B2B] text-center text-3xl sm:text-5xl md:text-[64px]">%1$s <span>%2$s</span></h1>',
                    esc_html__( 'Search results for:', 'watch_block' ),
                    get_search_query()
                );
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-14 gap-[52px]">

                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php if ( get_post_type() === 'product' ) : ?>
                    <?php get_template_part('template-parts/product/product', 'card'); ?>
                    <?php else : ?>
                    <?php get_template_part('template-parts/content/content', 'search'); ?>
                    <?php endif; ?>
                    <?php endwhile; ?>

                </div>
            </div>
        </section>

        <?php else : ?>
        <section class="bg-[#F2F2F2] py-14 pb-28">
            <div class="max-w-[1280px] px-5 mx-auto">
                <?php
printf(
    '<h3 class="uppercase font-semibold text-[#2B2B2B] text-center text-3xl sm:text-5xl md:text-[64px]">%1$s <span>%2$s</span></h3>',
    esc_html__( 'Result Not Found:', 'watch_block' ),
    get_search_query()
);
?>

            </div>
        </section>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>