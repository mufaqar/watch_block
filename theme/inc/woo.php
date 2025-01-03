<?php


function display_all_reviews() {


    global $product;

    $comments = get_comments(array(
        'post_id' => $product->get_id(),
        'status' => 'approve',
    ));

    if ($comments) {
        
        foreach ($comments as $comment) {
			//get_template_part( 'template-parts/product/product', 'review' );
            echo '<section class="bg-[#F2F2F2] py-[28px] rounded-[20px] px-[32px]">';
			echo '<img src="' . get_template_directory_uri() . '/public/svg/rating-star.svg" alt=""/>';
			echo '<h5 class="flex text-xl items-center gap-1 mt-4">' . esc_html($comment->comment_author) . '.<img src="' . get_template_directory_uri() . '/public/svg/green-checks.svg" alt=""/></h5>';
			echo '<p class="mt-3 text-[#676767]">"' . esc_html($comment->comment_content) . '</p>';
			echo '<p class="mt-6 text-[#676767]">' . esc_html(get_comment_date('', $comment)) . '</p>';
            echo '</section>';
        }
       
    } else {
        echo '<p>' . __('No reviews yet. Be the first to review this product!', 'textdomain') . '</p>';
    }
}
add_action('watch_block_single_reviews', 'display_all_reviews');
