<?php
global $product;
if (!$product) {
    $product = wc_get_product(get_the_ID());
}
?>

<article class="!text-left">
    <button type="button" class="compare-product" data-product-id="<?php echo get_the_ID() ?>">
        <figure class="bg-white h-[367px] flex justify-center !relative py-4">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>"
                class="object-contain">
            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/heart.svg" alt="Wishlist"
                class="w-[66px] right-0 top-2 absolute">
            <span
                class="bg-[#B6E22E] text-black uppercase text-2xl font-light px-5 py-1.5 rounded-[8px] absolute left-3 top-3">POPULAR</span>
        </figure>

        <h3 class="text-lg uppercase tracking-[4px] mt-2 text-left">


            <?php the_title(); ?>

        </h3>
    </button>

</article>