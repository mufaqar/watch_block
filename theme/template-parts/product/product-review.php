<section class="bg-[#F2F2F2] py-[28px] rounded-[20px] px-[32px] review-card">
    <img src="<?php echo get_template_directory_uri(); ?>/public/svg/rating-star.svg" alt=""/>
    <h5 class="flex text-xl items-center gap-1 mt-4">
        <?php the_title() ?>
        <img src="<?php echo get_template_directory_uri(); ?>/public/svg/green-checks.svg" alt=""/>
    </h5>
    <p class="mt-3 text-[#676767]">"<?php the_content() ?>"</p>
    <p class="mt-6 text-[#676767]">Posted on <?php echo get_the_date('F j, Y'); ?></p>
</section>