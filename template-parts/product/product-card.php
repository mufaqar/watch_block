<?php
global $product;
if (!$product) {
    $product = wc_get_product(get_the_ID());
}
?>

<article class="">
    <figure class="bg-white h-[367px] flex justify-center !relative py-4">
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" class="object-contain">
        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/heart.svg" alt="Wishlist" class="w-[66px] right-0 top-2 absolute">
        <span class="bg-[#B6E22E] text-black uppercase text-2xl font-light px-5 py-1.5 rounded-[8px] absolute left-3 top-3">POPULAR</span>
    </figure>
    
    <h3 class="text-2xl mt-4">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>
    
    <p class="text-sm text-gray-600 mt-10">
        <?php echo apply_filters('woocommerce_short_description', $product->get_short_description()); ?>
    </p>
    
    <span class="text-2xl text-gray-900 mt-4 block">
        <?php echo $product->get_price_html(); ?>
    </span>
</article>
