<?php
/**
* Template Name: Blogs
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
$args = array(
    'posts_per_page' => 1, // Get only the first post
    'orderby' => 'date',   // Order by publish date
    'order' => 'DESC',     // Get the latest post first
);

$query = new WP_Query($args);

$argsForBlogs = array(
    'posts_per_page' => -1, // Get only the first post
    'orderby' => 'date',   // Order by publish date
    'order' => 'DESC',     // Get the latest post first
);

$queryBlogs = new WP_Query($argsForBlogs);

get_header(); ?>


<main class="max-w-[1280px] mx-auto px-5 z-[1]">
    <img src="<?php echo get_template_directory_uri(); ?>/images/timepiece.png" alt="" class="h-[300px] w-full object-cover mt-24 rounded-[16px]"/>
</main>

<div class="!bg-white shadow-lg z-[50] mb-10 -mt-10 relative rounded-[12px] max-w-[709px] w-full mx-auto px-[25px]">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="py-[22px] flex gap-5">
        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/search.svg" alt="Search Icon" class="w-[36px]"/>
        <input type="text" name="s" placeholder="Search" class="text-lg focus:outline-none w-full border-none ring-0 focus:border-none" value="<?php echo get_search_query(); ?>">
        <input type="hidden" name="post_type" value="post"> <!-- Only search in posts -->
    </form>
</div>


<div class="flex justify-center max-w-[1280px] mx-auto px-5 mb-10">
    <a href="<?php echo home_url('/blog'); ?>" class="py-[11px] px-[38px] font-medium hover:bg-[#B6E22E] rounded-full">All</a>
    
    <?php
$categories = get_categories(); // Get all categories
foreach ($categories as $category): ?>
    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
       class="py-[11px] px-[38px] font-medium hover:bg-[#B6E22E] rounded-full">
       <?php echo esc_html($category->name); ?>
    </a>
<?php endforeach; ?>

</div>


<div class="max-w-[1280px] mx-auto px-5 mb-28">
    <?php
        if ($query->have_posts()) {
            while ($query->have_posts()) {  
                $query->the_post(); 
                // Get the post thumbnail URL
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <figure class="h-full">
                        <?php if ($image_url): ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full xl:max-h-[560px]  object-cover object-center" />
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images//noaimage.png" alt="Default Image" class="w-full h-full xl:max-h-[560px] object-cover object-center"/>
                        <?php endif; ?>
                    </figure>
                    <div>
                        <div class="flex items-center gap-2 mb-6">
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
                        <h2 class="text-[41px] leading-[45px] mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="postExcerpt"><?php the_excerpt(); ?></div>
                        <div class="flex items-center gap-2 mt-6">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/calandar.svg" alt="" class="w-[42px]" />
                            <p class="text-black/30 font-semibold text-sm">
                                <?php echo get_the_date(); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php }
            wp_reset_postdata();
        } else {
            echo 'No posts found.';
        }
    ?>
</div>


<div class="max-w-[1280px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mx-auto px-5 mb-28">
    <?php
        if ($queryBlogs->have_posts()) {
            while ($queryBlogs->have_posts()) {  
                $queryBlogs->the_post(); 
                // Get the post thumbnail URL
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                <div class="grid grid-cols-1 gap-5 items-center">
                    <figure class="max-h-[280px]">
                        <?php if ($image_url): ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full !rounded-tl-[6px] !rounded-tr-[6px] max-h-[280px] object-cover object-center" />
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images//noaimage.png" alt="Default Image" class="w-full max-h-[280px] object-cover object-center"/>
                        <?php endif; ?>
                    </figure>
                    <div>
                        <div class="flex items-center gap-2 mb-6">
                            <p class="text-[#B6E22E] font-semibold text-sm">
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
                        <h2 class="text-[22px] font-medium leading-[22px] mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="postExcerpt"><?php the_excerpt(); ?></div>
                        <div class="flex items-center gap-2 mt-6">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/calandar.svg" alt="" class="w-[42px]" />
                            <p class="text-black/30 font-semibold text-sm">
                                <?php echo get_the_date(); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php }
            wp_reset_postdata();
        } else {
            echo 'No posts found.';
        }
    ?>
</div>






<?php get_footer();