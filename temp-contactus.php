<?php
/**
* Template Name: Contact US
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/



get_header(); ?>


<section class="mt-28 max-w-[1280px] grid gap-5 grid-cols-1 md:grid-cols-2 px-5 mx-auto mb-12">
    <div class="bg-[#2B2B2B] p-8 md:p-5 lg:p-12">
        <h3 class="text-white text-3xl sm:text-[48px] sm:leading-[55px] font-semibold">Request a call</h3>
        <p class="mt-4 text-xl font-light text-white">Give us some info so the right person can get back to you</p>

        <div class="success_message hidden bg-green-200 text-green-800 p-3 rounded mt-5">
            Email submitted successfully! We will contact you shortly.

        </div>

        <form id="contactForm" class="flex flex-col mt-8 gap-4">
            <input type="text" id="first_name" name="first_name" placeholder="First Name"
                class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md" required />
            <input type="text" id="job_title" name="job_title" placeholder="Job Title"
                class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md" required />
            <input type="email" id="email" name="email" placeholder="Email"
                class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md" required />
            <input type="number" id="phone" name="phone" placeholder="Phone"
                class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md" required />
            <input type="text" id="country" name="country" placeholder="Country/Region"
                class="px-4 py-3 bg-white text-[#70776F] border-[#C0C0C0] border rounded-md" required />
            <button type="submit" class="bg-[#B6E22E] p-[14px] text-black w-full rounded-md text-center">Send
                Request</button>
        </form>


    </div>
    <div class="flex flex-col gap-5">
        <div class="bg-[#F2F2F2] py-8 px-16 flex-1">
            <h2 class="font-semibold text-[35px] mb-5">Contact us at</h2>
            <p class="text-xl font-light">We'd love to hear from you! Whether you have a question, feedback, or need
                assistance, please don't hesitate to contact us.</p>
            <div class="mt-6">
                <ul class="flex flex-col gap-5">
                    <li class="flex items-center gap-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/phone.svg" alt="" />
                        <a href="mailto:sprinkautopilot@gmail.com">sprinkautopilot@gmail.com</a>
                    </li>
                    <li class="flex items-center gap-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/envlop.svg" alt="" />
                        <a href="tel:+552890123409">+552 890123409</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bg-[#F2F2F2] py-8 px-16 flex-1">
            <h2 class="font-semibold text-[35px] mb-5">Leave us some feedback</h2>
            <p class="text-xl font-light">Have a question or feedback? We're here to help! Contact us, and we'll respond
                within one business day.</p>
            <div class="mt-6">
                <a class="bg-[#B6E22E] py-[14px] px-[25px]">Send Feedback</a>
            </div>
        </div>
    </div>
</section>







<?php get_footer(); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#contactForm").submit(function(e) {
        e.preventDefault();

        var first_name = $('#first_name').val();
        var job_title = $('#job_title').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var country = $('#country').val();

        var form_data = new FormData();
        form_data.append('action', 'handle_ajax_contact_form');
        form_data.append('first_name', first_name);
        form_data.append('job_title', job_title);
        form_data.append('email', email);
        form_data.append('phone', phone);
        form_data.append('country', country);

        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: form_data,
            contentType: false, // Optional (only needed for file uploads)
            processData: false, // Optional (only needed for file uploads)
            beforeSend: function() {
                $("#loader").show(); // Ensure #loader exists in your HTML
            },
            complete: function() {
                $("#loader").hide(); // Ensure #loader exists in your HTML
            },
            success: function(response) {
                if (response.success) { // WordPress AJAX returns "success: true"
                    $(".success_message").css("display", "flex").text(response.data
                    .message);
                } else {
                    $(".success_message").css("display", "flex").text(
                        "Error submitting review.");
                }
            },
            error: function() {
                $(".success_message").css("display", "flex").text(
                    "An unexpected error occurred.");
            }
        });
    });
});
</script>