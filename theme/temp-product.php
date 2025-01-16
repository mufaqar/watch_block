<?php
/**
* Template Name: Product
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
$sizes = ["16mm", "18mm", "20mm", "22mm"];
$color = ["silver", "golden"];

get_header(); ?>

<!-- Filters -->
<section class="bg-white mt-20">
    <div class="max-w-[1280px] mx-auto px-3 py-10 gap-[33px] flex justify-between flex-wrap">
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


<script>
document.querySelectorAll('.condition-button').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.condition-button').forEach(btn => btn.classList.remove('selected'));
        button.classList.add('selected');
    });
});
document.querySelectorAll('.condition-button_for_price').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.condition-button_for_price').forEach(btn => btn.classList.remove('selected'));
        button.classList.add('selected');
    });
});
</script>





































<main class="max-w-[1280px] flex flex-col lg:flex-row mx-auto px-3 gap-10 mt-[140px] mb-12">
    <div class="lg:w-[35%]">
        <div id="page">
            <div class="row">
                <div class="column small-11 small-centered">
                    <div class="slider slider-single">
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                        <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                    </div>
                    <div class="slider slider-nav mt-10 px-8">
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                        <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lg:w-[65%]">
        <div class="flex flex-col mb-2 md:flex-row justify-between gap-2 border-b pb-3 md:pb-1">
            <div>
                <h2 class="text-2xl font-bold">Apple Watch Ultra 2</h2>
                <div class="flex justify-between gap-4 items-center max-w-[250px] my-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/public/svg/star-bar.svg" alt=""/>
                    <p>246 Reviews</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <h4 class="text-[28px] sm:text-[36px] font-bold">$ 99.99</h4>
                <button class="border-l-[2px] px-4 border-r-[2px] border-gray-300">
                    <a class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow">
                        <img src="<?php echo get_template_directory_uri(); ?>/public/svg/heart2.svg" alt="" class="w-[26px] h-[16px]">
                    </a>
                </button>
                <a href="#">                
                    <span class="bg-[#B6E22E] text-black uppercase text-2xl font-light px-3 py-1.5 rounded-[8px]">Follow</span>
                </a>
            </div>
        </div>

        <div class="border-b pb-4">
            <h4 class="text-xl font-medium">Registry Number</h4>
            <div class="flex gap-6 py-[14px]">
                <p class="text-[#676767]">#4564655</p>
                <img src="<?php echo get_template_directory_uri(); ?>/public/svg/barcode.svg" alt="" srcset="">
            </div>
            <h4 class="text-xl font-medium">Colors available</h4>
            <div class="py-[14px]">
                <div class=" flex gap-2 flex-wrap">
                    <?php foreach ($color as $clr) { ?>
                        <div class="bg-[#EAEAEA] px-[2px] pt-[2px] pb-[5px] rounded-[10px]">
                            <figure class="bg-white p-1 rounded-[8px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/public/images/demo-watch.png" class="w-[50px] object-contain h-[50px]" alt=""/>
                            </figure>
                            <p class="capitalize text-center mt-1 text-[#676767] text-xs font-medium"><?php echo $clr; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <h4 class="text-xl font-medium">Choose size:</h4>
            <div class="mt-2 flex gap-2 flex-wrap">
                <?php foreach ($sizes as $size) {
                    echo " <button class='bg-[#F0F0F0] py-[9.5px] rounded-full px-6 text-black/60'>{$size}</button>";
                }?>
            </div>
        </div>
        
        <div class="mt-[14px] flex gap-6 md:gap-3 flex-wrap items-center">
            <div class="bg-[#F0F0F0] inline-flex p-[14px] items-center rounded-full justify-between gap-9">
                <button>
                    <img src="<?php echo get_template_directory_uri(); ?>/public/svg/menus.svg" alt=""/>
                </button>
                1
                <button>
                    <img src="<?php echo get_template_directory_uri(); ?>/public/svg/plus.svg" alt=""/>
                </button>
            </div>
            <a href="#">                
                <span class="bg-[#B6E22E] text-black uppercase font-semibold text-2xl px-6 py-3 rounded-[14px]">ADD TO CART</span>
            </a>
            <a href="#">                
                <span class="bg-[#B6E22E] text-black uppercase font-semibold text-2xl px-6 py-3 rounded-[14px]">COMPARE PRODUCT</span>
            </a>
        </div>

        <div class="mt-6 md:mt-4">
            <h4 class="text-xl font-medium pb-[10px]">Description</h4>
            <ul class="text-[#676767] list-disc pl-5">
                <li>Manufacture Date:</li>
                <li>Crafted in [Year] at the renowned [Manufacturer] in [Country]. This watch is part of a limited production run, showcasing the brand’s commitment to precision and quality.</li>
                <li>Original Purchase:</li>
                <li>First purchased on [Date] by [First Owner’s Name], this watch was originally sold at [Store Name], located in [City, Country]. It has since been carefully maintained and appreciated for its timeless design.</li>
                <li>Service and Maintenance:</li>
                <li>[Date]: Full service at [Authorized Service Center], including movement calibration, pressure testing...</li>
            </ul>
        </div>

    </div>
</main>

<section class="max-w-[1280px] px-3 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-9 my-12">
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Watch Details</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Regular Price</h6>
                <p class="text-black/70 text-sm mt-1">$149,199.86</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Brand</h6>
                <a class="text-black underline text-sm mt-1 capitalize">Rolex</a>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Model Name</h6>
                <a class="text-black underline text-sm mt-1 capitalize">Submariner</a>
            </li>
        </ul>
    </div>
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Case</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Material</h6>
                <p class="text-black/70 text-sm mt-1">White Gold</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Crystal</h6>
                <p class="text-black/70 text-sm mt-1">Sapphire</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Size</h6>
                <p class="text-black/70 text-sm mt-1">40mm</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Bezel</h6>
                <p class="text-black/70 text-sm mt-1">18k White Gold Diamond</p>
            </li>
        </ul>
    </div>
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Movement</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Calibre</h6>
                <p class="text-black/70 text-sm mt-1">3135</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Type</h6>
                <p class="text-black/70 text-sm mt-1">Automatic</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Bezel</h6>
                <p class="text-black/70 text-sm mt-1">Unidirectional</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Complication</h6>
                <p class="text-black/70 text-sm mt-1">Date</p>
            </li>
        </ul>
    </div>
    <div>
        <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Bracelet</h4>
        <ul>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Material</h6>
                <p class="text-black/70 text-sm mt-1">White Gold</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Type</h6>
                <p class="text-black/70 text-sm mt-1">Oyster</p>
            </li>
            <li class="py-3 border-b">
                <h6 class="text-sm uppercase text-black/90 font-semibold">Clasp</h6>
                <p class="text-black/70 text-sm mt-1">Glidelock</p>
            </li>
        </ul>
    </div>
</section>

<section class="max-w-[1280px] px-3 mx-auto mb-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-12">
        <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
        <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
        <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
        <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
    </div>
    <div class="flex justify-center">
        <a href="#" class="bg-[#B6E22E] text-black uppercase text-2xl font-light px-6 py-3 rounded-[14px]">see all</a>
    </div>
</section>

<!-- YOU MAY ALSO LIKE -->
<section class="bg-[#F2F2F2] py-14 pb-28">
    <div class="max-w-[1280px] px-3 mx-auto">
        <h2 class="uppercase font-semibold text-[#2B2B2B] text-center text-3xl sm:text-5xl md:text-[64px]">YOU MAY ALSO LIKE</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-14 gap-[52px]">
            <?php get_template_part('template-parts/product/product', 'card' ); ?>
            <?php get_template_part('template-parts/product/product', 'card' ); ?>
            <?php get_template_part('template-parts/product/product', 'card' ); ?>
        </div>
    </div>
</section>


<<<<<<< HEAD


=======
>>>>>>> b293ebd025ad908db09877ce47ab01bab074cbf2
<?php get_footer();