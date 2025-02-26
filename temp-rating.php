<?php
/**
* Template Name: Rating
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
session_start();
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
    <h1 class="uppercase text-[64px] text-center font-semibold mt-12">Ratings</h1>
    <div class="stars flex justify-center text-xl">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="star <?php echo ($i <= $rating) ? 'dark' : 'faded'; ?>" 
                data-value="<?= $i ?>">★</span>
        <?php endfor; ?>
    </div>
    <textarea placeholder="Tell us about your thoughts" class="border-[#C0C0C0] mt-4 border max-w-[1050px] w-full mx-auto h-[149px] rounded-[5px] p-3"></textarea>
    <div class="flex justify-center my-7">
        <button class="bg-[#B6E22E] text-[24px] mfont text-[#111111] uppercase font-medium py-[10px] px-6 rounded-[12px] hover:scale-105 transition-all duration-200 ease-linear cursor-pointer">Submit</button>
    </div>
</main>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6 max-w-[1280px] mx-auto px-5">
    <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
    <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
    <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
    <?php get_template_part( 'template-parts/product/product', 'review' ); ?>
</div>


<!-- <p>Selected Rating: <span id="selectedRating"><?= $rating ?></span></p> -->


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star");
        let selectedRating = <?= $rating ?>;

        function updateStars(rating) {
            stars.forEach((star, index) => {
                star.classList.toggle("dark", index < rating);
                star.classList.toggle("faded", index >= rating);
            });
            document.getElementById("selectedRating").innerText = rating;
        }

        stars.forEach(star => {
            star.addEventListener("click", function () {
                selectedRating = parseInt(this.getAttribute("data-value"));
                
                // Send rating to server
                fetch("save_rating.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "rating=" + selectedRating
                }).then(response => response.text())
                  .then(() => updateStars(selectedRating));
            });
        });
    });
</script>


<?php get_footer();