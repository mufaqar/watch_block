<section class="bg-white">
    <div class="max-w-[1320px] mx-auto px-3 py-10 gap-[33px] flex justify-between md:flex-nowrap flex-wrap">
        
        <!-- Brands -->
        <div class="flex flex-col justify-between w-full sm:w-auto">
            <h6 class="font-semibold mb-[9px]">Brand</h6>
            <div class="form-select">
                <select id="brand-filter" class="bg-[#F9F9F9] text-[#C9C4C4] min-w-[185px] w-full py-[10px] px-[15px] font-medium rounded-[10px]">
                    <option value="" disabled selected>Select brand</option>
                    <?php 
                    $brands = get_terms(['taxonomy' => 'watch_brands', 'hide_empty' => false]);
                    foreach ($brands as $brand) {
                        echo '<option value="' . esc_attr($brand->slug) . '">' . esc_html($brand->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>

        <!-- Color -->
        <div class="flex flex-col justify-between">
    <h6 class="font-semibold mb-[9px]">Color Available</h6>
    <div class="flex gap-3 flex-wrap min-w-[140px]">
        <?php 
        $colors = get_terms(['taxonomy' => 'pa_watches_colors', 'hide_empty' => false]);
        foreach ($colors as $color) {
            // Get the color name or meta value (if stored in the term meta)
            $color_name = esc_attr($color->slug); // Assuming slug is the color name
            echo '<a href="?color=' . $color_name . '" class="filter-button h-[25px] w-[25px] rounded-full" style="background-color: ' . $color_name . ';"></a>';
        }
        ?>
    </div>
</div>
        <div class="w-[1.33px] bg-[#F4F4F4] h-[77px]"></div>

        <!-- Condition -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Condition</h6>
            <div class="flex gap-[5px] min-w-[120px]">
                <?php 
                $conditions = get_terms(['taxonomy' => 'watch_type', 'hide_empty' => false]);
                foreach ($conditions as $condition) {
                    echo '<a href="?condition=' . esc_attr($condition->slug) . '" class="condition-button filter_button">' . esc_html($condition->name) . '</a>';
                }
                ?>
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

        <!-- Sizes -->
        <div class="flex flex-col justify-between">
            <h6 class="font-semibold mb-[9px]">Sizes Available</h6>
            <div class="flex gap-[5px] flex-wrap">
                <?php 
                $sizes = get_terms(['taxonomy' => 'pa_watches_size', 'hide_empty' => false]);
                foreach ($sizes as $size) {
                    echo '<a href="?size=' . esc_attr($size->slug) . '" class="condition-button_for_price filter_button">' . esc_html($size->name) . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('brand-filter').addEventListener('change', function() {
        window.location.href = '?brand=' + this.value;
    });
</script>
<?php

function filter_woocommerce_shop_query($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
        
        // Filtering by Brand
        if (!empty($_GET['brand'])) {
            $query->set('tax_query', [
                [
                    'taxonomy' => 'watch_brands',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['brand']),
                ],
            ]);
        }

        // Filtering by Color
        if (!empty($_GET['color'])) {
            $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];
            $tax_query[] = [
                'taxonomy' => 'pa_watches_colors',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['color']),
            ];
            $query->set('tax_query', $tax_query);
        }

        // Filtering by Condition
        if (!empty($_GET['condition'])) {
            $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];
            $tax_query[] = [
                'taxonomy' => 'watch_type',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['condition']),
            ];
            $query->set('tax_query', $tax_query);
        }

        // Filtering by Size
        if (!empty($_GET['size'])) {
            $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];
            $tax_query[] = [
                'taxonomy' => 'pa_watches_size',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['size']),
            ];
            $query->set('tax_query', $tax_query);
        }

        // Sorting by Price
        if (!empty($_GET['orderby'])) {
            if ($_GET['orderby'] === 'price-desc') {
                $query->set('orderby', 'meta_value_num');
                $query->set('meta_key', '_price');
                $query->set('order', 'DESC');
            } elseif ($_GET['orderby'] === 'price-asc') {
                $query->set('orderby', 'meta_value_num');
                $query->set('meta_key', '_price');
                $query->set('order', 'ASC');
            }
        }
    }
}
add_action('pre_get_posts', 'filter_woocommerce_shop_query');
