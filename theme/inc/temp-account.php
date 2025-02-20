<?php


function get_all_watches() {
    ?>


<div class="flex md:flex-row flex-col gap-5">
    <div class="md:w-1/2 w-full">
        <h4 class="text-2xl font-bold">Listed watches</h4>
    </div>
    <div class="md:w-1/2 w-full align-right flex align-center  justify-end gap-5">
        <a href="#" class="text-xl bg-[#B6E22E] w-fit p-2 hover:bg-black hover:text-[#B6E22E] rounded-lg ">Sell
            Watch</a>
    </div>


</div>


<div class="box-content mt-6">

    <?php
        $query = new WP_Query([
            'post_type'      => 'product',
            'posts_per_page' => -1,
        ]);

        if ($query->have_posts()) : ?>
    <div class="watch-list p-5">

        <?php while ($query->have_posts()) : $query->the_post(); 
                    // Get meta fields
                    $ID     = get_the_ID();
                    $model     = get_the_title();
                    $serial    = get_post_meta(get_the_ID(), 'serial_number', true);
                    $status     = get_post_meta(get_the_ID(), 'status', true);
               
                    $reported_raw = get_post_meta(get_the_ID(), 'reported_date', true);
                    $reported = $reported_raw ? date('F j, Y', strtotime($reported_raw)) : 'N/A';

                ?>
        <div class="grid grid-cols-6 gap-3 text-start border-b py-3">

            <div>
                <h5>Registry ID</h5>
                <p><?php echo esc_html($ID); ?></p>

            </div>
            <div class="flex item-center col-span-2 gap-2">
                <img src="<?php echo get_template_directory_uri(); ?>/public/images/place.png" alt="watch"
                    class="w-[49px] h-[49px] object-cover rounded-full bg-[#f2f2f2]" />
                <div>
                    <h5><?php the_title(); ?></h5>
                    <p>
                        Size: Large</p>
                </div>

            </div>
            <div><span class="bg-[#f2f2f2] rounded-xl p-2">Stock</span></div>
            <div>$ 120.00</div>
            <div> <a href="<?php the_permalink()?>"
                    class="text-base bg-[#B6E22E] w-fit p-2 hover:bg-black hover:text-[#B6E22E] rounded-lg">View
                    Details</a></div>

        </div>
        <?php endwhile; ?>
    </div>
    <?php else : ?>
    <p>No watches found.</p>
    <?php endif;

        wp_reset_postdata();
        ?>
</div>
<?php
}




function get_Stolen_Watches() {
    ?>
<div class="box-content mt-6">
    <?php
        $query = new WP_Query([
            'post_type'      => 'stolen_watch',
            'posts_per_page' => -1,
        ]);

        if ($query->have_posts()) : ?>
    <div class="watch-list p-5">
        <div class="grid grid-cols-6 gap-3 text-start py-3 border-b">
            <div>Report ID</div>
            <div>Watch Model</div>
            <div>Serial Number</div>
            <div>Date Reported</div>
            <div>Status</div>
            <div>Action</div>
        </div>
        <?php while ($query->have_posts()) : $query->the_post(); 
                            $ID     = get_the_ID();
                            $model     = get_the_title();
                            $serial    = get_post_meta(get_the_ID(), 'serial_number', true);
                            $status     = get_post_meta(get_the_ID(), 'status', true);               
                            $reported_raw = get_post_meta(get_the_ID(), 'reported_date', true);
                            $reported = $reported_raw ? date('F j, Y', strtotime($reported_raw)) : 'N/A';

                        ?>
        <div class="grid grid-cols-6 gap-3 text-start border-b py-3">
            <div>#<?php echo esc_html($ID); ?></div>
            <div><?php the_title(); ?></div>
            <div> <?php echo esc_html($serial); ?></div>
            <div> <?php echo esc_html($reported); ?></div>
            <div> <?php echo esc_html($status); ?></div>
            <div> <a href="<?php the_permalink()?>">View</a></div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else : ?>
    <p>No stolen watches found.</p>
    <?php endif;
        wp_reset_postdata();
        ?>
</div>
<?php
}


function report_stolen_watch() {
    ?>
<div class="box-content p-[25px]">
    <h2 class="text-[34px] font-semibold max-w-[410px] mx-auto md:leading-[41px]">Report a Lost or Stolen Watch</h2>
    <form class="mt-5 flex flex-col gap-5" id="stolen_watch">
        <div class="relative">
            <input type="text" name="model_no" placeholder="Rolex" id="model_no"
                class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" />
            <span class="bg-white p-1 text-sm text-[#70776F] absolute -top-[15px] left-3">Watch Model</span>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <input type="text" name="model_name" placeholder="Model Name" id="model_name"
                class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" />
            <input type="text" name="serial_no" placeholder="Serial no" id="serial_no"
                class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" />
        </div>
        <div class="grid grid-cols-2 gap-5">
            <input type="date" name="date" placeholder="dd/mm/yyyy" id="date"
                class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" />
            <div
                class="border-[#C0C0C0] border flex items-center px-3 text-[#70776F] outline-black rounded-[5px] w-full">
                <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 7.25986C4.5264 7.25986 4.0722 7.07549 3.73731 6.7473C3.40242 6.41911 3.21429 5.97399 3.21429 5.50986C3.21429 5.04573 3.40242 4.60062 3.73731 4.27243C4.0722 3.94424 4.5264 3.75986 5 3.75986C5.4736 3.75986 5.9278 3.94424 6.26269 4.27243C6.59758 4.60062 6.78571 5.04573 6.78571 5.50986C6.78571 5.73968 6.73953 5.96724 6.64979 6.17956C6.56004 6.39188 6.42851 6.5848 6.26269 6.7473C6.09687 6.9098 5.90002 7.03871 5.68336 7.12665C5.46671 7.2146 5.2345 7.25986 5 7.25986ZM5 0.609863C3.67392 0.609863 2.40215 1.12611 1.46447 2.04504C0.526784 2.96397 0 4.2103 0 5.50986C0 9.18486 5 14.6099 5 14.6099C5 14.6099 10 9.18486 10 5.50986C10 4.2103 9.47322 2.96397 8.53553 2.04504C7.59785 1.12611 6.32608 0.609863 5 0.609863Z"
                        fill="#888E87" />
                </svg>
                <input type="text" name="location" id="location" placeholder="I-11, Islamabad"
                    class="w-full border-none outline-none" />
            </div>
        </div>
        <h4 class="text-[#2B2B2B] font-medium text-lg text-center">Upload Proof</h4>
        <div>
            <label for="file-upload"
                class="w-full max-w-2xl h-36 border-2 border-dashed border-gray-400 bg-gray-50 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition p-4 rounded-md">
                <svg class="w-10 h-10 text-gray-500 mb-2" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 12l5-5m0 0l5 5m-5-5v12"></path>
                </svg>
                <p class="text-gray-600 text-sm">Upload Images from four sides</p>
                <p class="text-gray-500 text-xs">(Each from one side)</p>
                <input type="file" id="file-upload" name="proof_image" class="hidden">
            </label>
        </div>
        <textarea id="details" name="details"
            class="border-[#C0C0C0] _textarea border flex items-center p-3 text-[#70776F] outline-black rounded-[5px] w-full"
            style="padding:10px; border: 1px solid #C0C0C0; border-radius: 5px; height:130px"
            placeholder="Description"></textarea>
        <button type="submit"
            class="font-bold text-2xl bg-[#B6E22E] w-full p-4 hover:bg-black hover:text-[#B6E22E]">Submit</button>
    </form>
</div>
<?php
 }
 
 