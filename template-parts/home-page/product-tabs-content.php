<section class="bg-[#F2F2F2]">
<div class="w-full py-6 max-w-[1280px] px-3 mx-auto">
  <!-- Tabs -->
  <ul class="flex gap-3 sm:gap-3 md:gap-6 lg:gap-[50px] text-xl sm:text-3xl md:text-[34px] font-semibold">
    <li class="">
      <button class="tab-button text-black font-semibold py-2" data-tab="new">
        NEW 
      </button>
    </li>
    <li>
      <button class="tab-button text-black font-semibold py-2 hover:border-black" data-tab="featured">
        FEATURED 
      </button>
    </li>
    <li>
      <button class="tab-button text-black font-semibold py-2 hover:border-black" data-tab="brand">
        SHOP BY BRAND
      </button>
    </li>
  </ul>

  <!-- Tab Content -->

  <!-- Add content for "Shop by Brand" -->
  <div class="tab-content mt-10 mb-12 hidden" id="new">
      <?php echo do_shortcode('[products limit="3" columns="3"]'); ?>
  </div>

  <!-- Product Card -->
  <div class="tab-content mt-10 mb-12 hidden" id="featured">
    <div>
    <?php echo do_shortcode('[featured_products limit="3" columns="3"]'); ?>
    </div>
  </div>

  <!-- Add content for "Shop by Brand" -->
  <div class="tab-content mt-10 mb-12 hidden" id="brand">
    <div class="mt-10">
    <?php echo do_shortcode('[top_rated_products limit="3" columns="3"]'); ?>
    </div>
  </div>
</div>
</section>
