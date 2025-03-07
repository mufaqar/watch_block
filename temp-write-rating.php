<?php
/**
* Template Name: Write Rating
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
session_start();

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$rating = isset($_SESSION['rating']) ? $_SESSION['rating'] : 0;


if (isset($_POST['rating'])) {
    $_SESSION['rating'] = intval($_POST['rating']);
    echo "Rating saved: " . $_SESSION['rating'];
}

get_header(); ?>
<style>
.stars {
    display: flex;
    flex-direction: row;
    gap: 5px;
}

.star {
    font-size: 40px;
    cursor: pointer;
    color: gold;
    transition: opacity 0.3s;
}

.dark {
    color: gold;
}

.faded {
    opacity: 0.2;
}
</style>

<main class="max-w-[1280px] mx-auto flex flex-col justify-center px-5">
    <h1 class="uppercase text-[64px] text-center font-semibold mt-12">
        <?php
        if ($product_id) {
            $product = wc_get_product($product_id);
            if ($product) {
                echo 'Review for: ' . esc_html($product->get_name()) ;
            }
        } 
        ?>
    </h1>

    <div class="success_message hidden bg-green-200 text-green-800 p-3 rounded mt-5">
        Review submitted successfully! Pending approval.
    </div>

    <?php if (is_user_logged_in()): ?>
    <form id="review_form">

        <input type="hidden" name="product_id" id="product_id" value="<?php echo esc_attr($product_id); ?>">
        <input type="hidden" name="review_rating" id="review_rating">
        <input type="hidden" name="review_author" id="review_author" value="<?php echo is_user_logged_in() ? get_current_user_id() : 0; ?>">
        
        <span id="selectedRating" class="hidden">0</span>
        <div class="stars flex justify-center text-xl">
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="star <?php echo ($i <= $rating) ? 'dark' : 'faded'; ?>" data-value="<?= $i ?>">★</span>
            <?php endfor; ?>
        </div>
        <textarea name="review_content" id="review_content" placeholder="Tell us about your thoughts"
            class="border-[#C0C0C0] mt-4 border max-w-[1050px] w-full mx-auto h-[149px] rounded-[5px] p-3"
            required></textarea>
        <div class="flex justify-center my-7">
            <button
                class="bg-[#B6E22E] text-[24px] mfont text-[#111111] uppercase font-medium py-[10px] px-6 rounded-[12px] hover:scale-105 transition-all duration-200 ease-linear cursor-pointer">Submit</button>
        </div>
    </form>
    <?php else: ?>
    <p class="text-center text-red-500 font-bold text-lg">You must be logged in to leave a review. 
    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="text-blue-500 underline">Login here</a>

    </p>
<?php endif; ?>
</main>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6 max-w-[1280px] mx-auto px-5">
   

    <?php
    global $product;

    if (!$product) {
        return; // Exit if no product is found.
    }

    $comments = get_comments([
        'post_id' => $product->get_id(),
        'status'  => 'approve', // Only approved reviews
        'orderby' => 'comment_date',
        'order'   => 'DESC', // Latest reviews first
    ]);

    if ($comments) :
        foreach ($comments as $comment) :
            $rating = get_comment_meta($comment->comment_ID, 'rating', true); // Get rating if stored
    ?>
             <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
    <?php
        endforeach;
    else :
    ?>
        <p class="text-center text-gray-500"><?php _e('No reviews yet. Be the first to review this product!', 'textdomain'); ?></p>
    <?php endif; ?>


</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".star");
    let selectedRating = <?= $rating ?>;

    function updateStars(rating) {
        stars.forEach((star, index) => {
            star.classList.toggle("dark", index < rating);
            star.classList.toggle("faded", index >= rating);
        });
        document.getElementById("selectedRating").innerText = rating;
        document.getElementById("review_rating").value = rating;
    }

    stars.forEach(star => {
        star.addEventListener("click", function() {
            selectedRating = parseInt(this.getAttribute("data-value"));

            // Send rating to server
            fetch("save_rating.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "rating=" + selectedRating
                }).then(response => response.text())
                .then(() => updateStars(selectedRating));
        });
    });
});
</script>


<?php get_footer(); ?>

<script type="text/javascript">   
    

    jQuery(document).ready(function($) {	
    $("#review_form").submit(function(e) {                     
        e.preventDefault(); 
    
        var review_rating = $('#review_rating').val();	             
        var review_author = $('#review_author').val();	       
        var review_content = $('#review_content').val();	             
        var product_id = $('#product_id').val();	 
  
        var form_data = new FormData();       
        form_data.append('action', 'handle_ajax_product_review');
        form_data.append('review_rating', review_rating);
        form_data.append('review_author', review_author);
        form_data.append('review_content', review_content);
        form_data.append('product_id', product_id);
        
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
                if (response.success) {  // WordPress AJAX returns "success: true"
                    $(".success_message").css("display", "flex").text(response.data.message);
                } else {
                    $(".success_message").css("display", "flex").text("Error submitting review.");
                }      
            },
            error: function() {
                $(".success_message").css("display", "flex").text("An unexpected error occurred.");
            }
        });
    }); 
});

	</script>

