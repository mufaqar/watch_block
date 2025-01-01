<?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date', // Order by date
    'order'          => 'DESC', // Latest first
);

$query = new WP_Query($args);


?>

<section class="bg-[#F2F2F2]">
  <div class="w-full py-6 max-w-[1280px] px-3 mx-auto">
    <!-- Tabs -->
    <ul class="flex gap-3 sm:gap-3 md:gap-6 text-xl sm:text-3xl md:text-[34px] font-semibold">
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
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10 gap-[52px]">
        <p>Reviews Content</p>
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
                echo '<p>No posts found.</p>';
            }
        ?>
      </div>
    </div>

    <div class="ra_tab-content mt-10 mb-12 hidden" id="PRESS">
      <div>
        <p>Press Content</p>
      </div>
    </div>
  </div>
</section>
