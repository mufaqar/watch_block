<?php
$taxonomy = 'cat_faqs'; // Your taxonomy slug.
$post_type = 'faqs'; // Your post type slug.

// Get all terms in the taxonomy.
$terms = get_terms([
    'taxonomy'   => $taxonomy,
    'hide_empty' => true, // Change to false if you want to show terms with no posts.
]);
?>

<section class="py-14">
    <div class="max-w-[1280px] px-3 mx-auto">
        <h2 class="text-center text-[40px] font-semibold text-[#2B2B2B] md:text-[64px] mb-28">FAQ’s</h2>
        <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
            <?php foreach ($terms as $term) : ?>
                <h3 class="text-[36px] uppercase font-semibold text-[#2B2B2B]">
                    <?php echo esc_html($term->name); ?>
                </h3>

                <?php
                $query = new WP_Query([
                    'post_type'      => $post_type,
                    'posts_per_page' => -1, // Fetch all posts.
                    'tax_query'      => [
                        [
                            'taxonomy' => $taxonomy,
                            'field'    => 'term_id',
                            'terms'    => $term->term_id,
                        ],
                    ],
                ]);
                ?>

                <?php if ($query->have_posts()) : ?>
                    <ul class="faq-list mb-5">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li class="faq-item">
                                <div class="p-6">
                                    <button class="faq-question flex justify-between items-center text-left font-bold text-lg border-b-[2px] border-[#111111] pb-4 w-full">
                                        <?php the_title(); ?>
                                        <img 
                                            class="transition-all duration-100 ease-linear" 
                                            src="<?php echo get_template_directory_uri(); ?>/public/svg/chevron.svg" 
                                            alt="Chevron"
                                        />
                                    </button>
                                    <p class="faq-answer pt-4 text-[18px]">
                                        <?php the_excerpt(); ?> 123
                                    </p>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>No posts available under this category.</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No terms found in this taxonomy.</p>
        <?php endif; ?>
    </div>
</section>
