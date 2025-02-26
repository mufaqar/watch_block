<?php
$taxonomy = 'cat_faqs'; // Your taxonomy slug.
$post_type = 'faqs'; // Your post type slug.

// Get all terms in the taxonomy.
$terms = get_terms(array(
    'taxonomy'   => $taxonomy,
    'hide_empty' => true, 
    'orderby'    => 'menu_order', 
    'order'      => 'DESC'
));

?>

<section class="py-14">
    <div class="max-w-[1280px] px-5 lg:px-0 mx-auto">
        <h2 class="text-center text-[40px] font-semibold text-[#2B2B2B] md:text-[64px] mb-28">FAQ’s</h2>
        <?php
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    echo '<h3 class="text-[36px] uppercase font-semibold text-[#2B2B2B]">' . esc_html($term->name) . '</h3>'; 
                    $query = new WP_Query(array(
                        'post_type'      => $post_type,
                        'posts_per_page' => -1, // Fetch all posts.
                        'tax_query'      => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'term_id',
                                'terms'    => $term->term_id,
                            ),
                        ),
                    ));

                    if ($query->have_posts()) {
                        echo '<ul class="faq-list mb-5">';
                        while ($query->have_posts()) {
                            $query->the_post();
                            echo '<li class="faq-item">
                                <div class="py-6">
                                    <button class="faq-question flex justify-between items-center text-left font-bold text-lg border-b-[2px] border-[#111111] pb-4 w-full">' . get_the_title() . '
                                    <img class="transition-all duration-100 ease-linear" src="'. get_template_directory_uri().'/images/svg/chevron.svg" alt=""/>
                                    </button>
                                    <div class="faq-answer pt-4 text-[18px]">' . get_the_content() . '</div>
                                </div>
                            </li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>No posts available under this category.</p>';
                    }
                    wp_reset_postdata();
                }
            } else {
                echo '<p>No terms found in this taxonomy.</p>';
            }
        ?>
    </div>
</section>