<article>
        <div class="article_thumbnil">
            <a href="<?php the_permalink(); ?>"><?php 
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'post-thumbnail'));
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images//noaimage.png" alt="Placeholder Image" class="post-thumbnail w-full">';
                }
            ?></a>
        </div>
        
    <div>
        <div class="mb-8">
            <h2 class="text-xl md:text-[26px] font-semibold leading-[29px] md:min-h-[89.2px] mt-2.5 mb-2 md:mb-8"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_excerpt(); ?></p>
        </div>
        <a href="<?php the_permalink(); ?>">
            <button class="flex gap-2 items-center">
                Read more 
                <img src="<?php echo get_template_directory_uri(); ?>/images/svg/right-arrow.svg" alt="" class="w-3" />
            </button>
        </a>
    </div>
</article>