<section class="bg-[#F2F2F2] flex p-[10px] max-w-[1280px] mx-auto gap-3 rounded-[30px] px-3 mb-5">
    <aside class="bg-[#FFFFFF] p-3 rounded-[21px] max-w-[293px] w-full">
        <ul class="flex flex-col gap-1">
            <li>
                <button class="active_dashbord_page rounded-[12px] hover:bg-[#B6E22E] py-[18px] px-[30px] w-full text-left text-sm font-bold text-[#111111] uppercase">statistics</button>
            </li>
            <li>
                <button class="rounded-[12px] hover:bg-[#B6E22E] py-[18px] px-[30px] w-full text-left text-sm font-bold text-[#111111] uppercase">Sell my watch</button>
            </li>
            <li>
                <button class="rounded-[12px] hover:bg-[#B6E22E] py-[18px] px-[30px] w-full text-left text-sm font-bold text-[#111111] uppercase">Report lost/stolen Watch</button>
            </li>
            <li>
                <button class="rounded-[12px] hover:bg-[#B6E22E] py-[18px] px-[30px] w-full text-left text-sm font-bold text-[#111111] uppercase">Settings</button>
            </li>
        </ul>
    </aside>
    <div class="rounded-[21px] p-[18px] border border-[#d2d2d2] flex-1">
        <h6 class="text-center capitalize mb-6 font-medium text-black">Customer NFT Watches</h6>
        <!-- Product Slider -->
        <div>
            <div class="nft_dash_slider">
                <div><h3>1</h3></div>
                <div><h3>2</h3></div>
                <div><h3>3</h3></div>
                <div><h3>4</h3></div>
                <div><h3>5</h3></div>
                <div><h3>6</h3></div>
            </div>
        </div>
    </div>
</section>


<script>
    $('.nft_dash_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>


