<?php
/**
* Template Name: Escrow
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

$items = [
    (object)[
        'title' => 'fees',
        'description' => 'Transparent and competitive fee structures.',
    ],
    (object)[
        'title' => 'Customer Service',
        'description' => '24/7 support to address inquiries and concerns.',
    ],
    (object)[
        'title' => 'Security',
        'description' => 'Ensures safe transactions with trusted intermediaries.',
    ],
    (object)[
        'title' => 'Fund Transparency',
        'description' => 'Real-time visibility into escrowed funds.',
    ],
    (object)[
        'title' => 'Ease of Use',
        'description' => 'Intuitive processes for all parties involved.',
    ],
    (object)[
        'title' => 'Dispute Resolution',
        'description' => 'Assistance in resolving conflicts effectively.',
    ],
];

get_header(); ?>


<main class="bg-black h-96 w-full flex items-center justify-center mt-[-140px] pt-[140px]">
    <h1 class="text-center text-white text-[14vw] md:text-[115.42px] uppercase font-[600] max-w-[1280px] mx-auto">escrow services</h1>
</main>

<section class="py-[81px] max-w-[1280px] items-center gap-6 md:gap-[43px] grid grid-cols-1 md:grid-cols-2 mx-auto px-3 overflow-x-hidden">
    <div class="relative">
        <img src="<?php echo get_template_directory_uri(); ?>/images/escrow.png" class="z-[2] relative" alt="" srcset="">
        <div class="bg-[#F2F2F2] w-[787px] h-[430px] absolute top-1/2 -translate-y-1/2 -left-4 "></div>
    </div>
    <div class="z-[2] relative mfont">
        <h2 class="font-semibold text-3xl lg:text-[64px] uppercase lg:leading-[78px]">Buyer & Seller Agreement</h2>
        <p class="text-lg font-medium text-[#676767] my-4">Start your deal with ease, whether you're buying or selling. Just register on WatchBlock, set the conditions, and both parties are ready to proceed.</p>
        <a href="/contact-us" class="bg-[#B6E22E] text-[24px] mfont text-[#111111] font-semibold py-[10px] px-[9px] rounded-[12px] hover:scale-105 transition-all duration-200 ease-linear cursor-pointer">
            Available Escrow Services
        </a>
    </div>
</section>

<section class="mt-[213px] px-3 mb-[73px] mfont">
    <h2 class="text-center font-semibold text-3xl uppercase md:text-[48px]">what is an escrow account & how it works</h2>
    <div class="mt-[102px] max-w-[920px] flex mx-auto relative">
        <div class="h-full w-[31px] bg-[#B6E22E] absolute rounded-b-full"></div>
        <ul class="flex-1">
            <?php foreach ($items as $item): ?>
                <li class="border-t-[5px] border-dashed border-[#676767] pl-16 pt-5 pb-20 relative">
                    <h6 class="uppercase font-semibold text-[22px]"><?php echo $item->title; ?></h6>
                    <p class="text-xl font-medium"><?php echo $item->description ; ?></p>
                    <div class="absolute -top-[40px] -left-[24px] h-[78px] w-[78px] bg-white/80 flex flex-col justify-center items-center backdrop-blur-none escrow_list_dot_border rounded-full">
                        <div class="bg-[#B6E22E] h-[31px] w-[31px] rounded-full"></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>


<?php get_footer();