<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package watch_block
 */

get_header();
?>

<section class="container mx-auto py-10">
    <?php while (have_posts()) : the_post();
        $ID       = get_the_ID();
        $model    = get_the_title();
        $serial   = get_post_meta($ID, 'serial_number', true);
        $status   = get_post_meta($ID, 'status', true);
        $reported = get_post_meta($ID, 'reported_date', true);
        $details  = get_post_meta($ID, 'details', true);
    ?>
        <div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold mb-4"><?php echo esc_html($model); ?></h1>

            <div class="grid grid-cols-2 gap-4 border-b pb-4 mb-4">
                <div><strong>Report ID:</strong> #<?php echo esc_html($ID); ?></div>
                <div><strong>Serial Number:</strong> <?php echo esc_html($serial); ?></div>
                <div><strong>Date Reported:</strong> <?php echo esc_html($reported); ?></div>
                <div><strong>Status:</strong> <?php echo esc_html($status); ?></div>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Details</h2>
                <p><?php echo esc_html($details); ?></p>
            </div>

            <a href="<?php echo home_url('my-account/stolen-watch/'); ?>" class="text-blue-500 hover:underline">← Back to Reports</a>
        </div>

    <?php endwhile; ?>
</section>

<?php get_footer(); ?>
