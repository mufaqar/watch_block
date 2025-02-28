<section class="bg-[#F2F2F2] py-[28px] rounded-[20px] px-[32px] review-card">
    <div class="flex items-center gap-2">
        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/rating-star.svg" alt="Rating Star"/>
        <h5 class="flex text-xl items-center gap-1 mt-4">
            <?php echo esc_html(get_comment_author()); ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/green-checks.svg" alt="Verified"/>
        </h5>
    </div>

    <?php 
    $rating = get_comment_meta(get_comment_ID(), 'rating', true);
    if (!empty($rating)) : ?>
        <div class="mt-2 text-yellow-500">
            <?php echo str_repeat('★', intval($rating)); // Display rating stars ?>
        </div>
    <?php endif; ?>

    <p class="mt-3 text-[#676767]">"<?php echo esc_html(get_comment_text()); ?>"</p>
    <p class="mt-6 text-[#676767] text-sm">Posted on <?php echo get_comment_date('F j, Y'); ?></p>
</section>
