<?php
defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
echo "<h2>Welcome, " . esc_html( $current_user->display_name ) . "!</h2>";


echo do_shortcode('[products]');

// Get latest products
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 5, // Show 5 products
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) {
    echo '<ul class="dashboard-products">';
    while ( $products->have_posts() ) {
        $products->the_post();
        global $product;
        ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'thumbnail' ); ?>
                <h4><?php the_title(); ?></h4>
                <p><?php echo $product->get_price_html(); ?></p>
            </a>
        </li>
        <?php
    }
    echo '</ul>';
    wp_reset_postdata();
} else {
    echo '<p>No products found.</p>';
}
?>
