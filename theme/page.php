<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tp_theme
 */

get_header();
?>


<?php if (is_shop()): ?>
    <main class="h-96 w-full !bg-top bg-no-repeat bg-cover px-3 sm:px-4 lg:px-8 2xl:px-[64px] flex flex-col justify-center text-white py-20" style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/main.jpg')">
    <div class="max-w-[450px] pt-20">
        <h1 class="md:text-[64px] font-semibold text-5xl mfont md:leading-[70px]"> </h1>
    </div>
    </main>

    <section class="bg-white">
    <div class="max-w-[1320px] mx-auto px-3 py-10 gap-[33px] flex justify-between md:flex-nowrap flex-wrap">
        <!-- Brands  -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Brand</h6>
            <div class="form-select">    
                <select class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                    <option value="" disabled>Select brand</option>
                    <option value="">Brand Options</option>
                    <option value="">Brand Options</option>
                </select>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>
        <!-- Color  -->
        <div class=" flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Color</h6>
            <div class="flex gap-3 flex-wrap min-w-[140px]">    
                <button class="h-[25px] w-[25px] rounded-full bg-[#FB5252]"></button>
                <button class="h-[25px] w-[25px] rounded-full bg-[#FCA120]"></button>
                <button class="h-[25px] w-[25px] rounded-full bg-[#FFC0CB]"></button>
                <button class="h-[25px] w-[25px] rounded-full bg-[#FCDB7E]"></button>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>
        <!-- Condition  -->
        <div class=" flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Condition</h6>
            <div class="flex gap-[5px] min-w-[120px]">    
                <button class="condition-button text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full">New</button>
                <button class="condition-button text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full">Used</button>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>
        <!-- Price  -->
        <div class=" flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Price</h6>
            <div class="flex gap-[5px] min-w-[201px]">    
                <button class="condition-button_for_price text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full text-nowrap">High to Low</button>
                <button class="condition-button_for_price text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full text-nowrap">Low to High</button>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>
         <!-- Material  -->
         <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Material</h6>
            <div class="flex gap-[5px] flex-wrap">    
                <button class="condition-button_for_price text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full">Leather</button>
                <button class="condition-button_for_price text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full">Titanium</button>
                <button class="condition-button_for_price text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full">Stainless Steel</button>
            </div>
        </div>
    </div>
</section>

<?php else: ?>
    <section class="page_title">
        <h2 class="uppercase text-center text-4xl mb-5 sm:text-5xl md:text-[64px] font-semibold text-[#2B2B2B] mt-[125px]">
            <?php the_title(); ?>
        </h2>
    </section>
<?php endif; ?>


<section class="PageContent">
    <div class="w-full py-6 max-w-[1280px] px-3 mx-auto">
        <?php
        while ( have_posts() ) : the_post();
        the_content();
        endwhile; // End of the loop.
        ?>
    </div>
</section>

<?php

get_footer();