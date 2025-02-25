<?php
/**
* Template Name: Comparison
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
$sizes = ["16mm", "18mm", "20mm", "22mm"];
$color = ["silver", "golden"];

get_header();



$product1 = isset($_GET['p1']) ? get_post($_GET['p1']) : null;
$product2 = isset($_GET['p2']) ? get_post($_GET['p2']) : null;

if ($product1 && $product2) {
    echo "<h2>Comparing Products</h2>";
    echo "<div class='compare-container'>";
    
    foreach ([$product1, $product2] as $product) {
        echo "<div class='compare-product'>";
        echo "<h3>" . get_the_title($product->ID) . "</h3>";
        echo get_the_post_thumbnail($product->ID, 'medium');
        echo "<p>Price: " . wc_price(get_post_meta($product->ID, '_price', true)) . "</p>";
        echo "<p>" . $product->post_content . "</p>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p>Please select two products to compare.</p>";
}




// if (isset($_GET['data'])) {
//     $value = $_GET['data'];
//     echo "Received Local Storage value: " . htmlspecialchars($value);
// } else {
//     echo "No Local Storage value received.";
// }









?>

<section class="max-w-[1280px] mx-auto px-3 grid grid-cols-1 md:grid-cols-2 mb-28">
    <div class="border-black md:border-r md:pr-5">
        <section class="flex flex-col gap-10 pt-[100px] mb-12">
            <div class="">
                <div id="page">
                    <div class="row">
                        <div class="column small-11 small-centered">
                            <div class="slider slider-single">
                                <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                            </div>
                            <div class="slider slider-nav flex gap-1 justify-center mt-14 px-8">
                                <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt=""></div>
                                <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt=""></div>
                                <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20">
                <div class="flex flex-col mb-2 md:flex-row justify-between gap-2 border-b pb-3 md:pb-1">
                    <div>
                        <h2 class="text-2xl font-bold">Apple Watch Ultra 2</h2>
                        <div class="flex justify-between gap-4 items-center max-w-[250px] my-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/star-bar.svg" alt=""/>
                            <p>246 Reviews</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <h4 class="text-[28px] sm:text-[36px] font-bold">$ 99.99</h4>
                    </div>
                </div>

                <div class="pb-4">
                    <h4 class="text-xl font-medium">Registry Number</h4>
                    <div class="flex gap-6 py-[14px]">
                        <p class="text-[#676767]">#4564655</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/barcode.svg" alt="" srcset="">
                    </div>
                    <h4 class="text-xl font-medium">Colors available</h4>
                    <div class="py-[14px]">
                        <div class=" flex gap-2 flex-wrap">
                            <?php foreach ($color as $clr) { ?>
                                <div class="bg-[#EAEAEA] px-[2px] pt-[2px] pb-[5px] rounded-[10px]">
                                    <figure class="bg-white p-1 rounded-[8px]">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" class="w-[50px] object-contain h-[50px]" alt=""/>
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
                
                <div class="mt-2 md:mt-2">
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
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 gap-9 my-12 mt-20">
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
    </div>
    <div class="border-black md:pl-5">
        <section class="flex flex-col gap-10 pt-[100px] mb-12">
            <div class="">
                <div id="page">
                    <div class="row">
                        <div class="column small-11 small-centered">
                            <div class="slider slider-single">
                                <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt="" class="h-full object-cover w-full"></div>
                            </div>
                            <div class="slider slider-nav flex gap-1 justify-center mt-14 px-8">
                                <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt=""></div>
                                <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt=""></div>
                                <div class="mx-[5px] !flex justify-center bg-gray-200 p-2 border border-[#B6E22E] rounded-xl overflow-hidden"><img class="rounded-xl object-cover h-[75px]" src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20">
                <div class="flex flex-col mb-2 md:flex-row justify-between gap-2 border-b pb-3 md:pb-1">
                    <div>
                        <h2 class="text-2xl font-bold">Apple Watch Ultra 2</h2>
                        <div class="flex justify-between gap-4 items-center max-w-[250px] my-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/star-bar.svg" alt=""/>
                            <p>246 Reviews</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <h4 class="text-[28px] sm:text-[36px] font-bold">$ 99.99</h4>
                    </div>
                </div>

                <div class="pb-4">
                    <h4 class="text-xl font-medium">Registry Number</h4>
                    <div class="flex gap-6 py-[14px]">
                        <p class="text-[#676767]">#4564655</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/barcode.svg" alt="" srcset="">
                    </div>
                    <h4 class="text-xl font-medium">Colors available</h4>
                    <div class="py-[14px]">
                        <div class=" flex gap-2 flex-wrap">
                            <?php foreach ($color as $clr) { ?>
                                <div class="bg-[#EAEAEA] px-[2px] pt-[2px] pb-[5px] rounded-[10px]">
                                    <figure class="bg-white p-1 rounded-[8px]">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images//demo-watch.png" class="w-[50px] object-contain h-[50px]" alt=""/>
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
                
                <div class="mt-2 md:mt-2">
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
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 gap-9 my-12 mt-20">
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
    </div>
</section>

<?php get_footer();