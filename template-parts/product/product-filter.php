<section class="bg-white" id="filter">
    <div class="max-w-[1320px] mx-auto px-5 py-10 gap-[33px] flex justify-between md:flex-nowrap flex-wrap">
        
        <!-- Brands -->
        <div class="flex flex-col w-full sm:w-auto">
            <h6 class="font-semibold mb-[9px]">Brand</h6>
            <div class="form-select">
                <select id="brand-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                    <option value="" disabled selected>Select brand</option>
                    <?php 
                    $brands = get_terms(['taxonomy' => 'product_brand', 'hide_empty' => false]);
                    foreach ($brands as $brand) {
                        echo '<option value="' . esc_attr($brand->slug) . '">' . esc_html($brand->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Color -->
        <div class="flex flex-col w-full sm:w-auto">
            <h6 class="font-semibold mb-[9px]">Color Available</h6>
            <div class="form-select">
                <select id="color-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                    <option value="" disabled selected>Select Color</option>
                    <?php 
                     $colors = get_terms(['taxonomy' => 'pa_watches_colors', 'hide_empty' => false]);
                     foreach ($colors as $color) {
                         echo '<option value="' . esc_attr($color->slug) . '">' . esc_html($color->name) . '</option>';
                     }
                    ?>
                </select>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Condition -->
        <div class="flex flex-col ">
            <h6 class="font-semibold mb-[9px]">Condition</h6>
            <div class="flex gap-[5px] min-w-[120px]">
            <button class="condition-button text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full" data-condition="new">New</button>
            <button class="condition-button text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full" data-condition="used">Used</button>
        </div>


        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Price -->
        <div class="flex flex-col ">
            <h6 class="font-semibold mb-[9px]">Price</h6>
            <div class="flex gap-[5px] min-w-[201px]">
                <a href="<?php echo home_url('shop/?orderby=price#filter'); ?>" class="condition-button_for_price filter_button text-nowrap">High to Low</a>
                <a href="<?php echo home_url('shop/?orderby=price-desc#filter'); ?>" class="condition-button_for_price filter_button text-nowrap">Low to High</a>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Sizes -->
        <div class="flex flex-col w-full sm:w-auto">
            <h6 class="font-semibold mb-[9px]">Size Available</h6>
            <div class="form-select">
                <select id="size-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                    <option value="" disabled selected>Select Size</option>
                    <?php 
                     $colors = get_terms(['taxonomy' => 'pa_watches_size', 'hide_empty' => false]);
                     foreach ($colors as $color) {
                         echo '<option value="' . esc_attr($color->slug) . '">' . esc_html($color->name) . '</option>';
                     }
                    ?>
                </select>
            </div>
        </div>
    </div>
    
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    function updateURLParam(key, value) {
        let url = new URL(window.location.href);
        url.searchParams.set(key, value);
        url.hash = "filter";
        window.location.href = url.toString();
    }

    // Handle Brand Filter Change
    document.getElementById("brand-filter").addEventListener("change", function () {
        updateURLParam("brand", this.value);
    });

    // Handle Color Filter Change
    document.getElementById("color-filter").addEventListener("change", function () {
        updateURLParam("color", this.value);
    });

    // Handle Size Filter Change
    document.getElementById("size-filter").addEventListener("change", function () {
        updateURLParam("size", this.value);
    });

    // Handle Condition Filter Buttons
    document.querySelectorAll(".condition-button").forEach(button => {
        button.addEventListener("click", function () {
            updateURLParam("condition", this.getAttribute("data-condition"));
        });
    });

    // Handle Price Sorting
    document.querySelectorAll(".condition-button_for_price").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let paramValue = new URL(this.href).searchParams.get("orderby");
            updateURLParam("orderby", paramValue);
        });
    });
});

</script>




<?php

