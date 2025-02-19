<?php
/**
* Template Name: Contact US
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/



get_header(); ?>


<section class="mt-28 max-w-[1280px] grid gap-5 grid-cols-1 md:grid-cols-2 px-3 mx-auto mb-12">
    <div class="bg-[#2B2B2B] p-8 md:p-5 lg:p-12">
        <h3 class="text-white text-3xl sm:text-[48px] sm:leading-[55px] font-semibold">Request a call</h3>
        <p class="mt-4 text-xl font-light text-white">Give us some info so the right person can get back to you</p>
        <div class="flex flex-col mt-8 gap-4">
            <input type="text" placeholder="First Name" class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md"/>
            <input type="text" placeholder="Job Title" class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md"/>
            <input type="email" placeholder="Email" class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md"/>
            <input type="number" placeholder="Phone" class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md"/>
            <input type="text" placeholder="Country/Region" class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md"/>
            <button class="bg-[#B6E22E] p-[14px] text-black w-full rounded-md text-center">Send Request</button>
        </div>
    </div>
    <div class="flex flex-col gap-5">
        <div class="bg-[#F2F2F2] py-8 px-16 flex-1">
            <h2 class="font-semibold text-[35px] mb-5">Contact us at</h2>
            <p class="text-xl font-light">We'd love to hear from you! Whether you have a question, feedback, or need assistance, please don't hesitate to contact us.</p>
            <div class="mt-6">
                <ul class="flex flex-col gap-5">
                    <li class="flex items-center gap-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/public/svg/phone.svg" alt=""/>
                        <a href="mailto:sprinkautopilot@gmail.com">sprinkautopilot@gmail.com</a>
                    </li>
                    <li class="flex items-center gap-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/public/svg/envlop.svg" alt=""/>
                        <a href="tel:+552890123409">+552 890123409</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bg-[#F2F2F2] py-8 px-16 flex-1">
            <h2 class="font-semibold text-[35px] mb-5">Leave us some feedback</h2>
            <p class="text-xl font-light">Have a question or feedback? We're here to help! Contact us, and we'll respond within one business day.</p>
            <div class="mt-6">
                <a class="bg-[#B6E22E] py-[14px] px-[25px]">Send Feedback</a>
            </div>
        </div>
    </div>
</section>







<?php get_footer();