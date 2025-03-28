<?php
/**
* Template Name: About Us
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

get_header();
?>


<main>
    <!-- Hero Section -->
    <div class="bg-black min-h-96 w-full flex items-center justify-center mt-[-140px] pt-[140px]">
        <h1 class="text-center text-white text-[8vw] md:text-[115.42px] font-[600] container mx-auto">
            <?php the_title()?></h1>
    </div>

    <!-- Content Section -->
    <div class="mt-10  ">
        <div class="bg-[#F2F2F2] px-2 py-6 md:p-8">
            <div class=" flex flex-col xl:flex-row gap-6 lg:gap-10 container mx-auto">
                <!-- Image -->
                <img src="<?php echo get_template_directory_uri(); ?>/images/Rectangle.jpg"
                    class="h-auto max-w-full lg:h-[618px] lg:w-auto" alt="About Us Image" />

                <!-- Text Content -->
                <div class="mx-auto justify-center align-middle items-center flex ">
                    <div>
                        <h2 class="text-[6vw] md:text-[64px] font-[600] text-[#2B2B2B]">ABOUT US</h2>
                        <p class="text-[4vw] md:text-[18px] font-[500] text-[#676767] py-3 leading-relaxed ">
                            <?php the_field('about_details'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <!-- Black Background Section -->
        <div class="bg-black h-[230px] md:h-[321px] w-full flex items-center justify-center">
            <h1 class="text-center text-white text-[12vw] md:text-[115.42px] font-bold">
                OUR MISSION
            </h1>
        </div>

        <!-- Overlapping Light Gray Content Section -->
        <div class="bg-[#F2F2F2] w-[1028px] max-w-full relative -mt-16 z-10 container mx-auto ">
            <div class="px-2 py-6 md:p-8 w-full lg:w-[1028px] mx-auto">
                <div class="text-[4vw] md:text-[19.5px] text-[#2B2B2B] leading-relaxed">
                    <?php the_field('our_mission'); ?> </div>
            </div>
        </div>

    </section>

    <section class="container mx-auto pt-10 px-4">
        <h2 class="text-[8vw] md:text-[67.27px] font-[600] text-center text-black">
            Why Choose WatchBlock?
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-[60px]">
            <!-- Card 1 -->
            <div class="bg-[#F2F2F2] px-2 py-6 md:p-8 ">
                <div class="bg-white rounded-full w-12 h-12 mb-4 flex items-center justify-center"></div>
                <p class="text-[4vw] md:text-[22px] font-[400] text-[#2B2B2B] leading-relaxed">
                    Blockchain Security
                </p>
                <p class="text-[4vw] md:text-[19.5px] font-[400] text-[#2B2B2B] leading-relaxed">
                    Your watch ownership is permanently recorded on the blockchain.
                </p>
            </div>
            <!-- Card 2 -->
            <div class="bg-black p-6 md:p-8 ">
                <div class="bg-white rounded-full w-12 h-12 mb-4 flex items-center justify-center"></div>
                <p class="text-[4vw] md:text-[22px] font-[400] text-white leading-relaxed">
                    Authenticity Guaranteed
                </p>
                <p class="text-[4vw] md:text-[19.5px] font-[400] text-white leading-relaxed">
                    Say goodbye to counterfeit concerns with verifiable proof.
                </p>
            </div>
            <!-- Card 3 -->
            <div class="bg-[#F2F2F2] px-2 py-6 md:p-8 ">
                <div class="bg-white rounded-full w-12 h-12 mb-4 flex items-center justify-center"></div>
                <p class="text-[4vw] md:text-[22px] font-[400] text-[#2B2B2B] leading-relaxed">
                    Exclusive Perks
                </p>
                <p class="text-[4vw] md:text-[19.5px] font-[400] text-[#2B2B2B] leading-relaxed">
                    Gain access to special rewards, upgrades, and community benefits.
                </p>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 pt-[50px] md:pt-[150px]">
        <h2 class="text-[8vw] md:text-[67.27px] font-[600] text-center mb-[50px] text-black uppercase">OUR TEAM</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 items-center">
            <?php
            $args = array(
                'post_type' => 'team',
                'posts_per_page' => 3,
            );
            $team_query = new WP_Query($args);
            if ($team_query->have_posts()) :
                while ($team_query->have_posts()) : $team_query->the_post(); ?>

            <article class="team-member bg-[#F2F2F2]">
                <div>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full') ?: 'default-image-path.jpg'); ?>"
                        class="h-auto w-full md:h-[300px] lg:h-[454px] object-cover"
                        alt="<?php echo esc_attr(get_the_title()); ?> Image" />
                </div>
                <div class="px-4 md:px-6 text-center py-4 text-black">
                   
                    <h3 class="text-[6vw] md:text-[36px] font-[500] mt-2 uppercase md:leading-[40px]">
                        <?php echo esc_html(get_the_title()); ?>
                    </h3>
                    <h4 class="text-2xl my-2 uppercase ">
                    <?php the_field('designation'); ?>
                    </h4>
                    <p class="text-lg md:text-[16px] ">
                        <?php echo esc_html(get_the_content()); ?>
            </p>
                </div>
            </article>

            <?php endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No team members found.</p>';
            endif;
        ?>
        </div>
    </section>


    <section class="container mx-auto px-4 md:mt-[106px] my-[50px] md:mb-[177px]" id="reviews">
        <h2 class="text-[8vw] md:text-[67.27px] font-[600] text-center mb-[50px] text-black uppercase">Testimonials</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:flex gap-6 items-center md:items-start">
            <!-- Testimonial Card -->
            <?php
            $args = array(
                'post_type' => 'reviews', 
                'posts_per_page' => 3, 
            );
            $reviews_query = new WP_Query( $args );
            if ( $reviews_query->have_posts() ) : 
                while ( $reviews_query->have_posts() ) : $reviews_query->the_post(); ?>
            <div class="flex flex-col flex-1">
                <div class="bg-[#F2F2F2] p-6 pb-28">
                    <!-- Display Review Icon (replace with dynamic content if needed) -->
                    <img src="<?php echo get_template_directory_uri(); ?>/images/“.png"
                        class="h-auto w-[64px] md:w-[50px] lg:w-[64px]  mb-3" alt="Testimonial Icon" />
                    <!-- Display Review Content -->
                    <div class="py-3 text-[16px] line-clamp-5 md:text-[18px] leading-relaxed">
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="bg-black h-28 text-center flex flex-col items-center justify-center -mt-14">
                    <!-- Display Profile Image (use featured image for review if available) -->
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>"
                        class="h-auto w-[80px] md:w-[60px] lg:w-[80px] rounded-full -mt-14"
                        alt="<?php the_title(); ?> Profile Picture" />
                    <!-- Display Reviewer's Name (use the title or custom field for name) -->
                    <h3 class="text-white text-[4vw] md:text-[22px] font-[600] mt-4 pb-4">
                        <?php the_title(); ?>
                        <!-- Display the reviewer's name -->
                    </h3>
                </div>
            </div>

            <?php endwhile;
                wp_reset_postdata(); 
            else :
                echo '<p>No reviews found.</p>';
            endif; 
        ?>
        </div>
    </section>
</main>


<?php get_footer(); ?>