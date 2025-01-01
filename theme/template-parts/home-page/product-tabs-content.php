<section class="bg-[#F2F2F2]">
<div class="w-full py-6 max-w-[1280px] px-3 mx-auto">
  <!-- Tabs -->
  <ul class="flex gap-3 sm:gap-3 md:gap-6 text-xl sm:text-3xl md:text-[34px] font-semibold">
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10 gap-[52px]">
      <?php get_template_part('template-parts/product/product', 'card' ); ?>
      <?php get_template_part('template-parts/product/product', 'card' ); ?>
      <?php get_template_part('template-parts/product/product', 'card' ); ?>
      <!-- Repeat Product Cards as needed -->
    </div>
  </div>

  <!-- Product Card -->
  <div class="tab-content mt-10 mb-12 hidden" id="featured">
    <div>
        <p>Content for "Shop by Featured" goes here.</p>
    </div>
  </div>

  <!-- Add content for "Shop by Brand" -->
  <div class="tab-content mt-10 mb-12 hidden" id="brand">
    <div class="mt-10">
    <p>Content for "Shop by Brand" goes here.</p>
    </div>
  </div>
</div>
</section>
