<?php
// Fetch three WooCommerce products
$args = array(
  'post_type'      => 'product',
  'posts_per_page' => 3,
  'orderby'        => 'date',
  'order'          => 'DESC',
);
$loop = new WP_Query($args);

?>

<div id="compare-modal" class="compare-modal">
  <div class="modal-content max-w-[1320px] p-[25px]">
    <button class="close-compare">
      <svg width="26" height="26" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.69997e-06 4.24264L4.24264 0L43.1335 38.8909L38.8909 43.1335L1.69997e-06 4.24264Z" fill="#111111"/>
        <path d="M38.8909 0L43.1335 4.24264L4.24264 43.1335L0 38.8909L38.8909 0Z" fill="#111111"/>
      </svg>
    </button>
    <h2 class="text-[34px] font-semibold max-w-[410px] mx-auto md:leading-[41px]">Select product for comparison</h2>
    <div class="flex items-center pr-3 max-w-[538px] mx-auto border bg-white border-[#C0C0C0] rounded-lg overflow-hidden my-[30px]">
      <input type="text" placeholder="Search product" class="outline-none border-none w-full ">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.5 13.002C4.68333 13.002 3.146 12.3726 1.888 11.114C0.63 9.85529 0.000667196 8.31795 5.29101e-07 6.50195C-0.000666138 4.68595 0.628667 3.14862 1.888 1.88995C3.14733 0.631287 4.68467 0.00195312 6.5 0.00195312C8.31533 0.00195312 9.853 0.631287 11.113 1.88995C12.373 3.14862 13.002 4.68595 13 6.50195C13 7.23529 12.8833 7.92695 12.65 8.57695C12.4167 9.22695 12.1 9.80195 11.7 10.302L17.3 15.902C17.4833 16.0853 17.575 16.3186 17.575 16.602C17.575 16.8853 17.4833 17.1186 17.3 17.302C17.1167 17.4853 16.8833 17.577 16.6 17.577C16.3167 17.577 16.0833 17.4853 15.9 17.302L10.3 11.702C9.8 12.102 9.225 12.4186 8.575 12.652C7.925 12.8853 7.23333 13.002 6.5 13.002ZM6.5 11.002C7.75 11.002 8.81267 10.5646 9.688 9.68995C10.5633 8.81529 11.0007 7.75262 11 6.50195C10.9993 5.25129 10.562 4.18895 9.688 3.31495C8.814 2.44095 7.75133 2.00329 6.5 2.00195C5.24867 2.00062 4.18633 2.43829 3.313 3.31495C2.43967 4.19162 2.002 5.25395 2 6.50195C1.998 7.74995 2.43567 8.81262 3.313 9.68995C4.19033 10.5673 5.25267 11.0046 6.5 11.002Z" fill="#A1A1A1"/>
      </svg>
    </div>
    <div class="compare-images grid grid-cols-3 max-w-[1020px] mx-auto mt-6 gap-10">
      <?php
        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                // Include the product card template
                get_template_part('template-parts/product/product-card-for-compare', 'model');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No products found</p>';
        endif;
      ?>
    </div>
    <div>
      <button class="bg-[#B6E22E] uppercase font-bold py-[15px] max-w-[541px] w-full hover:bg-black hover:text-[#B6E22E] text-2xl mt-8" id="comparison" >Continue</button>
    </div>
  </div>
</div>

<style>
  /* Modal styles */
  .compare-modal {
    display: none; 
    position: fixed; 
    z-index: 1000; 
    left: 0;
    top: 0;
    overflow-y: auto;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .compare-modal::-webkit-scrollbar {
    display: none;
   }

  .modal-content {
    background-color: white;
    margin: 8rem auto;
    border-radius: 10px;
    width: 100%;
    text-align: center;
    position: relative;
  }

  .close-compare {
    position: absolute;
    right: 24px;
    top: 24px;
    font-size: 25px;
    cursor: pointer;
  }
</style>