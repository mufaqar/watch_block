
<div class="flex md:flex-row flex-col gap-5">

<?php
defined( 'ABSPATH' ) || exit;



$current_user = wp_get_current_user();

// Check if the user is logged in
if ($current_user->exists()) {
    // Get the user's profile picture
    $user_id = get_current_user_id();
    $profile_picture = get_user_meta($user_id, 'profile_picture', true);

    ?>
    <div class="!max-w-[150px] w-full" style="max-width: 150px !important">
    <?php

    // Display the profile picture
    if ($profile_picture) {
        echo '<img src="' . esc_url($profile_picture) . '" alt="Profile Picture" width="150" style="border-radius: 10%; margin-bottom: 20px;" />';
    } else {
        echo '<p>No profile picture uploaded.</p>';
    }
    ?>
    </div>
    <div class=" w-full">
    <?php

    // Display the welcome message
    echo "<h2 class='!pl-0' style='padding-left: 0 !important'>Welcome, " . esc_html($current_user->display_name) . "!</h2>";

    display_user_badge();

    ?>
    </div>
   
    <?php

    // Display the user badge (if applicable)
   
}


?>
</div>

<!-- Slick Slider CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">


<div class="rounded-[21px] p-[18px] border border-[#d2d2d2] flex-1">
 
    <!-- Product Slider -->
    <div>
        <div class="nft_dash_slider">

            <?php
    $user_id = get_current_user_id();

    if (!$user_id) {
        echo '<p>Please log in to view your products.</p>';
    } else {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1, // Adjust as needed
            'author'         => $user_id, // Filter by logged-in user
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
         
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID()); // Get product object

			
                ?>
            <?php
global $product;
if (!$product) {
    $product = wc_get_product(get_the_ID());
}
?>

            <article class="px-2 boder">
                <figure class="bg-white h-[240px] flex justify-center !relative">
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                        alt="<?php the_title(); ?>" class="object-contain">
                </figure>
                <h3 class="text-lg mt-4">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <span class="text-lg text-gray-900 mt-2 block">
                    <?php echo $product->get_price_html(); ?>
                </span>
            </article>


            <?php
            }
          
        } else {
            echo '<p>No products found.</p>';
        }

        wp_reset_postdata();
    }
    ?>
        </div>


    </div>
</div>
</div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick Slider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>



<script>
jQuery(document).ready(function($) {
    $('.nft_dash_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});
</script>