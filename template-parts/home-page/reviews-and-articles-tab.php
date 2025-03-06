<?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date', // Order by date
    'order'          => 'DESC', // Latest first
);

$review_args = array(
    'post_type'      => 'reviews',
    'posts_per_page' => 4,
    'orderby'        => 'date', // Order by date
    'order'          => 'DESC', // Latest first
);

$pressargs = array(
  'post_type'      => 'post',
  'posts_per_page' => 3,
  'orderby'        => 'date', // Order by date
  'order'          => 'DESC', // Latest first
  'tax_query'      => array(
        array(
            'taxonomy' => 'category', // Replace with your actual taxonomy name if different
            'field'    => 'slug',
            'terms'    => 'press', // The slug of the "press" category
        ),
    ),
);

$press = new WP_Query($pressargs);
$review = new WP_Query($review_args);
$query = new WP_Query($args);


?>

<section class="bg-[#F2F2F2]">
    <div class="w-full py-6 max-w-[1280px] px-5 mx-auto">
        <!-- Tabs -->
        <ul class="flex gap-3 sm:gap-3 md:gap-6 lg:gap-[50px] text-xl sm:text-3xl md:text-[34px] font-semibold">
            <li>
                <button class="ra_tab-button text-black font-semibold py-2" data-tab="REVIEWS">
                    REVIEWS
                </button>
            </li>
            <li>
                <button class="ra_tab-button text-black font-semibold py-2" data-tab="ARTICLES">
                    ARTICLES
                </button>
            </li>
            <li>
                <button class="ra_tab-button text-black font-semibold py-2" data-tab="PRESS">
                    PRESS
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="ra_tab-content mt-10 mb-12 hidden" id="REVIEWS">
            <div class="grid grid-cols-1 md:grid-cols-2 mt-10 gap-5">
                <?php
            if ($review->have_posts()) {
                while ($review->have_posts()) {
                    $review->the_post();
                ?>
                <section class="bg-[#F2F2F2] py-[28px] rounded-[20px] px-[32px] review-card">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/rating-star.svg"
                            alt="Rating Star" />
                        <h5 class="flex text-xl items-center gap-1">
                            <?php echo esc_html(get_comment_author()); ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/green-checks.svg"
                                alt="Verified" />
                        </h5>
                    </div>

                    <?php 
                    $rating = get_comment_meta(get_comment_ID(), 'rating', true);
                    if (!empty($rating)) : ?>
                    <div class="mt-2 text-yellow-500">
                        <?php echo str_repeat('★', intval($rating)); // Display rating stars ?>
                    </div>
                    <?php endif; ?>

                    <p class="mt-3 text-[#676767]">"<?php the_content() ?></p>
                    <p class="mt-6 text-[#676767] text-sm">Posted on <?php echo get_comment_date('F j, Y'); ?></p>
                </section>




                <?php }
                wp_reset_postdata();
            } else {
                echo '<p>No Review found.</p>';
            }
        ?>

            </div>
            <div class="flex justify-center mt-16">
                <a href="#" class="bg-[#B6E22E] text-black uppercase text-2xl font-light px-6 py-3 rounded-[14px]">see
                    all</a>
            </div>
        </div>

        <div class="ra_tab-content mt-10 mb-12 hidden" id="ARTICLES">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[26px]">
                <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                ?>
                <?php get_template_part( 'template-parts/articles/article', 'card' ); ?>
                <?php }
                wp_reset_postdata();
            } else {
                echo '<p>No Posts found.</p>';
            }
        ?>
            </div>
        </div>

        <div class="ra_tab-content mt-10 mb-12 hidden" id="PRESS">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[26px]">
                <?php
              if ($press->have_posts()) {
                  while ($press->have_posts()) {
                      $press->the_post();
                  ?>
                <?php get_template_part( 'template-parts/articles/article', 'card' ); ?>
                <?php }
                  wp_reset_postdata();
              } else {
                  echo '<p>No Press found.</p>';
              }
          ?>
            </div>
        </div>
    </div>
</section>