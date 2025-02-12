<section class="bg-white">
    <div class="max-w-[1320px] mx-auto px-3 py-10 gap-[33px] flex justify-between md:flex-nowrap flex-wrap">
        <!-- Brands -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Brand</h6>
            <div class="form-select">
                <select id="brand-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                    <option value="" disabled selected>Select brand</option>
                    <option value="brand1">Brand 1</option>
                    <option value="brand2">Brand 2</option>
                </select>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>
        
        <!-- Color -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Color</h6>
            <div class="flex gap-3 flex-wrap min-w-[140px]">
                <a href="?color=red" class="filter-button h-[25px] w-[25px] rounded-full bg-[#FB5252]"></a>
                <a href="?color=orange" class="filter-button h-[25px] w-[25px] rounded-full bg-[#FCA120]"></a>
                <a href="?color=pink" class="filter-button h-[25px] w-[25px] rounded-full bg-[#FFC0CB]"></a>
                <a href="?color=yellow" class="filter-button h-[25px] w-[25px] rounded-full bg-[#FCDB7E]"></a>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>
        
        <!-- Condition -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Condition</h6>
            <div class="flex gap-[5px] min-w-[120px]">
                <a href="?condition=new" class="condition-button filter_button">New</a>
                <a href="?condition=used" class="condition-button filter_button">Used</a>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>

        <!-- Price -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Price</h6>
            <div class="flex gap-[5px] min-w-[201px]">
                <a href="?orderby=price-desc" class="condition-button_for_price filter_button text-nowrap">High to Low</a>
                <a href="?orderby=price-asc" class="condition-button_for_price filter_button text-nowrap">Low to High</a>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>

        <!-- Material -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Material</h6>
            <div class="flex gap-[5px] flex-wrap">
                <a href="?material=leather" class="condition-button_for_price filter_button">Leather</a>
                <a href="?material=titanium" class="condition-button_for_price filter_button">Titanium</a>
                <a href="?material=stainless-steel" class="condition-button_for_price filter_button">Stainless Steel</a>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('brand-filter').addEventListener('change', function() {
    window.location.href = '?brand=' + this.value;
});
</script>
