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
    <div class="bg-black h-96 w-full flex items-center justify-center">
        <h1 class="text-center text-white text-[14vw] md:text-[115.42px] font-[600] container mx-auto"><?php the_title()?></h1>
    </div>

    <!-- Content Section -->
    <div class="mt-10  ">
        <div class="bg-[#F2F2F2] p-6 md:p-8">
            <div class=" flex flex-col xl:flex-row gap-6 lg:gap-10 container mx-auto">
                <!-- Image -->
                <img src="<?php echo get_template_directory_uri(); ?>/images/Rectangle.jpg" class="h-auto max-w-full lg:h-[618px] lg:w-auto" alt="About Us Image" />

                <!-- Text Content -->
               <div class="mx-auto justify-center align-middle items-center flex ">
               <div>
                    <h2 class="text-[6vw] md:text-[64px] font-[600] text-[#2B2B2B]">ABOUT US</h2>
                    <p class="text-[4vw] md:text-[18px] font-[500] text-[#676767] py-3 leading-relaxed ">                   
                      <?php the_field('about_details'); ?>
                    </p>
                    <div class="mt-6">
                        <a href="#" class="bg-[#B6E22E] px-6 md:px-10 py-3 md:py-4 font-[500] text-[4vw] md:text-[18px] rounded-[12px] inline-block">SEE MORE</a>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
    
<section>
    <!-- Black Background Section -->
    <div class="bg-black h-[321px] w-full flex items-center justify-center">
        <h1 class="text-center text-white text-[12vw] md:text-[115.42px] font-bold">
            OUR MISSION
        </h1>
    </div>

    <!-- Overlapping Light Gray Content Section -->
    <div class="bg-[#F2F2F2] w-[1028px] max-w-full relative -mt-16 z-10 container mx-auto ">
        <div class="p-6 md:p-8 w-[90%] lg:w-[1028px] mx-auto">
            <div class="text-[4vw] md:text-[19.5px] text-[#2B2B2B] leading-relaxed">
            <?php the_field('our_mission'); ?>  </div>
        </div>
    </div>

</section>

<section class="container mx-auto py-10 px-4">
    <h2 class="text-[8vw] md:text-[67.27px] font-[600]   text-center text-black">
        WHY CHOOSE US
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <!-- Card 1 -->
        <div class="bg-[#F2F2F2] p-6 md:p-8 ">
            <div class="bg-white rounded-full w-12 h-12 mb-4 flex items-center justify-center"></div>
            <p class="text-[4vw] md:text-[19.5px] font-[400] text-[#2B2B2B] leading-relaxed">
                Lorem ipsum dolor sit amet consectetur. Risus porttitor tempor adipiscing vestibulum non sed arcu. Potenti consectetur pellentesque.
            </p>
        </div>
        <!-- Card 2 -->
        <div class="bg-black p-6 md:p-8 ">
            <div class="bg-white rounded-full w-12 h-12 mb-4 flex items-center justify-center"></div>
            <p class="text-[4vw] md:text-[19.5px] font-[400] text-white leading-relaxed">
                Lorem ipsum dolor sit amet consectetur. Risus porttitor tempor adipiscing vestibulum non sed arcu. Potenti consectetur pellentesque.
            </p>
        </div>
        <!-- Card 3 -->
        <div class="bg-[#F2F2F2] p-6 md:p-8 ">
            <div class="bg-white rounded-full w-12 h-12 mb-4 flex items-center justify-center"></div>
            <p class="text-[4vw] md:text-[19.5px] font-[400] text-[#2B2B2B] leading-relaxed">
                Lorem ipsum dolor sit amet consectetur. Risus porttitor tempor adipiscing vestibulum non sed arcu. Potenti consectetur pellentesque.
            </p>
        </div>
    </div>
</section>
  
<section class="container mx-auto px-4">
    <h2 class="text-[67.27px] font-[600] text-center text-black">OUR TEAM</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 items-center">
            <?php
                $args = array(
                    'post_type' => 'team',  
                    'posts_per_page' => 3, 
                );
                $team_query = new WP_Query( $args );
                if ( $team_query->have_posts() ) : 
                    while ( $team_query->have_posts() ) : $team_query->the_post(); ?>
                    
                        <div class="team-member bg-[#F2F2F2]">
                            <div>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" 
                                class="h-auto w-full md:h-[300px] lg:h-[454px]" 
                                alt="<?php the_title(); ?> Image" />
                            </div>
                            <div class="px-4 md:px-6 text-center py-4 text-black">
                                <h5 class="!text-lg md:!text-[22px] !font-semibold uppercase">
                                    <?php the_content(); ?>
                                </h5>
                                <h3 class="text-[6vw] md:text-[36px] font-[500] mt-2 uppercase">
                                    <?php the_title(); ?>
                                </h3>
                            </div>
                        </div>

                    <?php endwhile;
                    wp_reset_postdata(); 
                else :
                    echo '<p>No teams found.</p>';
                endif;
            ?>
    </div>
</section>
    

<section class="container mx-auto px-4 py-10 mt-10">
    <h2 class="text-[8vw] md:text-[67.27px] font-[600] text-center text-black uppercase">Testimonials</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-6 mt-8 items-center">
        <!-- Testimonial Card -->
        <div class="flex flex-col ">
            <div class="bg-[#F2F2F2]  p-6 pb-28 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/“.png" 
                    class="h-auto w-[64px] md:w-[50px] lg:w-[64px]  mb-3" 
                    alt="Testimonial Icon" />
                <p class="py-3 text-[16px] md:text-[18px]  leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur. Risus porttitor tempor adipiscing vestibulum non sed arcu. Potenti consectetur pellentesque.
                </p>   
            </div>
            <div class="bg-black  h-28 text-center flex flex-col items-center justify-center -mt-14 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Rectangle.jpg" 
                    class="h-auto w-[80px] md:w-[60px] lg:w-[80px] rounded-full   -mt-14" 
                    alt="Profile Picture" />
                <h3 class="text-white text-[4vw] md:text-[22px] font-[600] mt-4 pb-4">
                    Lorem ipsum dolor
                </h3>
            </div>
        </div>
        <!-- ///////// card 2 -->
        <div class="flex flex-col ">
            <div class="bg-[#F2F2F2] p-6 pb-28 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/“.png" 
                    class="h-auto w-[64px] md:w-[50px] lg:w-[64px]  mb-3" 
                    alt="Testimonial Icon" />
                <p class="py-3 text-[16px] md:text-[18px]  leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur. Risus porttitor tempor adipiscing vestibulum non sed arcu. Potenti consectetur pellentesque.
                </p>   
            </div>
            <div class="bg-black  h-28 text-center flex flex-col items-center justify-center -mt-14 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Rectangle.jpg" 
                    class="h-auto w-[80px] md:w-[60px] lg:w-[80px] rounded-full   -mt-14" 
                    alt="Profile Picture" />
                <h3 class="text-white text-[4vw] md:text-[22px] font-[600] mt-4 pb-4">
                    Lorem ipsum dolor
                </h3>
            </div>
        </div>
        <!-- //////////// card 3 -->
        <div class="flex flex-col ">
            <div class="bg-[#F2F2F2] p-6 pb-28 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/“.png" 
                    class="h-auto w-[64px] md:w-[50px] lg:w-[64px]  mb-3" 
                    alt="Testimonial Icon" />
                <p class="py-3 text-[16px] md:text-[18px]  leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur. Risus porttitor tempor adipiscing vestibulum non sed arcu. Potenti consectetur pellentesque.
                </p>   
            </div>
            <div class="bg-black  h-28 text-center flex flex-col items-center justify-center -mt-14 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Rectangle.jpg" 
                    class="h-auto w-[80px] md:w-[60px] lg:w-[80px] rounded-full   -mt-14" 
                    alt="Profile Picture" />
                <h3 class="text-white text-[4vw] md:text-[22px] font-[600] mt-4 pb-4">
                    Lorem ipsum dolor
                </h3>
            </div>
        </div>

        
        
    </div>
</section>





</main>


<?php get_footer(); ?>