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

// Get product IDs from URL parameters (e.g., ?p1=123&p2=456)
$product1 = isset($_GET['p1']) ? wc_get_product($_GET['p1']) : null;
$product2 = isset($_GET['p2']) ? wc_get_product($_GET['p2']) : null;

function render_product_section($product) {
    if (!$product || !is_a($product, 'WC_Product')) {
        echo '<div class="w-full md:w-1/2 text-center text-red-500">Product not found.</div>';
        return;
    }

    $image_url = wp_get_attachment_image_url($product->get_image_id(), 'full');
    $price = $product->get_price_html();
    $title = $product->get_name();
    $colors = get_post_meta($product->get_id(), 'available_colors', true) ?: [];
    $sizes = get_post_meta($product->get_id(), 'available_sizes', true) ?: [];
    ?>

<div class="border-gray-300 first:md:border-r-[2px] md:px-5">
    <section class="flex flex-col gap-10 pt-[100px] mb-12">
        <div>
            <div id="page">
                <div class="row">
                    <div class="column small-11 small-centered">
                        <div class="slider slider-single">
                            <div><img class="max-w-[415px] w-full object-contain mx-auto h-[415px]"
                                    src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20">
            <div class="flex flex-col mb-2 md:flex-row justify-between gap-2 border-b pb-3 md:pb-1">
                <div>
                    <h2 class="text-2xl font-bold"><?php echo esc_html($title); ?></h2>
                    <div class="flex justify-between gap-4 items-center max-w-[250px] my-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/star-bar.svg" alt="" />
                        <p><?php echo $product->get_review_count(); ?> Reviews</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <h4 class="text-[28px] sm:text-[36px] font-bold"><?php echo $price; ?></h4>
                </div>
            </div>
            <!-- <div class="pb-4">
                <h4 class="text-xl font-medium">Colors available</h4>
                <div class="py-[14px] flex gap-2 flex-wrap">
                    <?php foreach ($colors as $clr) { ?>
                    <div class="bg-[#EAEAEA] px-[2px] pt-[2px] pb-[5px] rounded-[10px]">
                        <figure class="bg-white p-1 rounded-[8px]">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/demo-watch.png"
                                class="w-[50px] object-contain h-[50px]" alt="" />
                        </figure>
                        <p class="capitalize text-center mt-1 text-[#676767] text-xs font-medium">
                            <?php echo esc_html($clr); ?></p>
                    </div>
                    <?php } ?>
                </div>
                <h4 class="text-xl font-medium">Choose size:</h4>
                <div class="mt-2 flex gap-2 flex-wrap">
                    <?php foreach ($sizes as $size) {
                                        echo "<button class='bg-[#F0F0F0] py-[9.5px] rounded-full px-6 text-black/60'>{$size}</button>";
                                    } ?>
                </div>

            </div> -->
        </div>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 gap-9 my-12 mt-20">
        <div>
            <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Watch Details</h4>
            <ul>

                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Brand</h6>
                    <a class="text-black underline text-sm mt-1 capitalize"><?php
                $product_brands = get_the_terms(get_the_ID(), 'product_brand');

                if ($product_brands && !is_wp_error($product_brands)) {
                    $brand = $product_brands[0]; 
                    echo  esc_html($brand->name) ;
                } 
                ?>
                    </a>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Model Name</h6>
                    <a class="text-black underline text-sm mt-1 capitalize"><?php the_title(); ?></a>
                </li>
            </ul>
        </div>
        <div>
            <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Case</h4>
            <ul>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Material</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'case_material', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Crystal</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'case_crystal', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Size</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'case_size', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Bezel</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'case_bezel', true ); ?></p>
                </li>
            </ul>
        </div>
        <div>
            <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Movement</h4>
            <ul>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Calibre</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'movement_calibre', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Type</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'movement_type', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Bezel</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'movement_bezel', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Complication</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'movement_complication', true ); ?></p>
                </li>
            </ul>
        </div>
        <div>
            <h4 class="text-xl uppercase font-bold w-full pb-4 border-b border-[#111] mb-6">Bracelet</h4>
            <ul>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Material</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'bracelet_material', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Type</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'bracelet_type', true ); ?></p>
                </li>
                <li class="py-3 border-b">
                    <h6 class="text-sm uppercase text-black/90 font-semibold">Clasp</h6>
                    <p class="text-black/70 text-sm mt-1">
                        <?php echo get_post_meta( get_the_ID(), 'bracelet_clasp', true ); ?></p>
                </li>
            </ul>
        </div>
    </section>
</div>

<?php } ?>



<section class="max-w-[1280px] mx-auto px-5 grid grid-cols-1 md:grid-cols-2 mb-10">
    <?php render_product_section($product1); ?>
    <?php render_product_section($product2); ?>
</section>

<div class="bg-[#F2F2F2] py-3 sticky bottom-0 left-0 right-0 flex justify-center items-center mb-28">
    <a href="/shop" class="single_add_to_cart_button !rounded-none">Back to product page</a>
</div>

<?php get_footer();