<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package watch_block
 */

get_header();
?>


<section class="">
    
        <?php
        /* Start the Loop */
        while ( have_posts() ) :  the_post();

            if ( is_singular( 'post' ) ) {

                get_template_part( 'template-parts/content/content', 'single' );                
            } elseif ( is_singular( 'product' ) ) {
                // Template for single product
                get_template_part( 'template-parts/content/content', 'product' );
            }

            // Load comments if open or available
            if ( comments_open() || get_comments_number() ) {
             //   comments_template();
            }

        endwhile;
        ?>
  
</section><!-- #primary -->

<?php
get_footer();
