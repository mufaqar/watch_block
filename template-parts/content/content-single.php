<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watch_block
 */
?>


 <!-- Hero Section -->
 <div class="bg-white h-96 w-full flex items-center justify-center mt-[-140px] pt-[140px] border-b-[1px] border-[#E5E5E5]">
        <h1 class="text-center text-black text-[14vw] md:text-[115.42px] font-[600] container mx-auto">
            <?php the_title()?></h1>
    </div>

<div class="w-full py-6 max-w-[1280px] px-5 mx-auto">
    <article id="post-<?php the_ID(); ?>" <?php post_class("flex flex-col md:flex-row gap-8"); ?>>
        
        <!-- Image Section (Left - 4 Columns) -->
        <div class="w-full md:w-1/3">
            <a href="<?php the_permalink(); ?>">
                <?php 
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-full rounded-[16px]'));
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images/noaimage.png" alt="Placeholder Image" class="w-full rounded-[16px]">';
                }
                ?>
            </a>
        </div>

        <!-- Text Content (Right - 8 Columns) -->
        <div class="w-full md:w-2/3">
           
            <div class="blog_content"><?php the_content(); ?></div>
        </div>

    </article><!-- #post-${ID} -->
</div>
