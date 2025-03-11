<section class="bg-white" id="filter">
    <div class="max-w-[1320px] mx-auto px-5 py-10 gap-[33px] flex justify-between md:flex-nowrap flex-wrap">
        
        <!-- Brands -->
        <div class="flex flex-col w-full sm:w-auto">
            <h6 class="font-semibold mb-[9px]">Brand</h6>
            <div class="form-select">
                <select id="brand-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                  
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
        <?php 
            $colors = get_terms(['taxonomy' => 'pa_watches_colors', 'hide_empty' => false]);
            if (!empty($colors)) : ?>
                <h6 class="font-semibold mb-[9px]">Color Available</h6>
                <div class="form-select">
                    <select id="color-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                        <?php 
                        foreach ($colors as $color) {
                            echo '<option value="' . esc_attr($color->slug) . '">' . esc_html($color->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            <?php endif; ?>

        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Condition -->
        <div class="flex flex-col ">
            <h6 class="font-semibold mb-[9px]">Condition</h6>
            <div class="flex gap-[5px] min-w-[120px]">
            <button class="condition-button text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full" data-condition="New">New</button>
            <button class="condition-button text-[12.25px] py-[7px] px-[15px] border-[1.3px] border-[#BAC8D3] hover:bg-[#B6E22E] text-black hover:border-[#B6E22E] rounded-full" data-condition="Used">Used</button>
        </div>


        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Price -->
        <div class="flex flex-col ">
            <h6 class="font-semibold mb-[9px]">Price</h6>
            <div class="flex gap-[5px] min-w-[201px]">
                <button class="condition-button_for_price filter_button text-nowrap"  data-condition="low">High to Low</button>
                <button class="condition-button_for_price filter_button text-nowrap"  data-condition="high">Low to High</button>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px] hidden sm:block"></div>

        <!-- Sizes -->
        <div class="flex flex-col w-full sm:w-auto">
            <h6 class="font-semibold mb-[9px]">Size Available</h6>
            <div class="form-select">
                <select id="size-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                 
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
    const brandFilter = document.getElementById("brand-filter");
    const colorFilter = document.getElementById("color-filter");
    const sizeFilter = document.getElementById("size-filter");
    const conditionButtons = document.querySelectorAll(".condition-button");
    const priceButtons = document.querySelectorAll(".condition-button_for_price");

    function updateURL(param, value) {
        let url = new URL(window.location.href);
        if (value) {
            url.searchParams.set(param, value);
        } else {
            url.searchParams.delete(param);
        }
        window.history.pushState({}, "", url);
        applyFilters();
    }

    function applyFilters() {
        let urlParams = new URLSearchParams(window.location.search);
        console.log("Updated Filters:", urlParams.toString());
        // AJAX request to filter products dynamically (to be implemented)
    }

    function setActiveButton(buttons, selectedValue) {
        buttons.forEach((button) => {
            if (button.dataset.condition === selectedValue) {
                button.classList.add("bg-[#B6E22E]", "border-[#B6E22E]"); // Active styling
            } else {
                button.classList.remove("bg-[#B6E22E]", "border-[#B6E22E]"); // Reset others
            }
        });
    }

    // Handle dropdown changes
    brandFilter?.addEventListener("change", function () {
        updateURL("brand", this.value);
    });

    colorFilter?.addEventListener("change", function () {
        updateURL("color", this.value);
    });

    sizeFilter?.addEventListener("change", function () {
        updateURL("size", this.value);
    });

    // Handle condition button clicks
    conditionButtons.forEach((button) => {
        button.addEventListener("click", function () {
            updateURL("condition", this.dataset.condition);
            setActiveButton(conditionButtons, this.dataset.condition);
        });
    });

    // Handle price sorting clicks
    priceButtons.forEach((button) => {
        button.addEventListener("click", function () {
            updateURL("price", this.dataset.condition);
            setActiveButton(priceButtons, this.dataset.condition);
        });
    });

    // Load active filters from URL on page load
    function setActiveFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const activeCondition = urlParams.get("condition");
        const activePrice = urlParams.get("price");

        if (activeCondition) setActiveButton(conditionButtons, activeCondition);
        if (activePrice) setActiveButton(priceButtons, activePrice);
    }

    setActiveFromURL();
});

    </script>

