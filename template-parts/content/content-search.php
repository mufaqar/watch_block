<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watch_block
 */

?>

<div class="w-full py-6 max-w-[1280px] px-5 mx-auto">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   
        <main class="max-w-[1280px] mx-auto z-[1]">
            <a href="<?php the_permalink(); ?>"><?php 
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'h-[300px] w-full object-cover mt-24 rounded-[16px] '));
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images//noaimage.png" alt="Placeholder Image" class="h-[300px] w-full object-cover mt-24 rounded-[16px]">';
                }
            ?></a>
         </main>
    <div>
        <div class="mb-8">
            <h2 class="text-[26px] font-semibold leading-[29px] mt-4 mb-8"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="blog_contnet"><?php the_content(); ?></div>
        </div>
       
    </div>
  
    

</article><!-- #post-${ID} -->
            </div>