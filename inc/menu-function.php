<?php
include_once 'cpts.php';
include_once 'woo.php';
include_once 'ajax.php';
include_once 'temp-account.php';
include_once 'shortcodes.php';


function add_menu_link_class($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_link_class', 1, 3);








add_filter('loop_shop_columns', 'set_custom_columns');
function set_custom_columns($columns) {
    return 3; 
}


// Add excerpt below the product title
add_action('watch_block_product_desc', 'add_product_excerpt', 5);
function add_product_excerpt() {
    global $post;
    if (has_excerpt($post->ID)) {
        $raw_excerpt = get_the_excerpt();
        $trimmed_excerpt = wp_html_excerpt($raw_excerpt, 80, '...');
        echo '<div class="product-excerpt">' . wp_kses_post($trimmed_excerpt) . '</div>';
    }
}


function get_custom_limited_content( $limit = 50 ) {
    $content = get_the_content();
    $content = wp_strip_all_tags( $content ); // Remove HTML tags
    $words   = explode( ' ', $content );

    if ( count( $words ) > $limit ) {
        $content = implode( ' ', array_slice( $words, 0, $limit ) ) . '...';
    }

    return $content;
}




function mytheme_customize_register($wp_customize) {
    // Add a section
    $wp_customize->add_section('wb_theme_options', array(
        'title'    => __('Theme Options', 'mytheme'),
        'priority' => 30,
    ));

    // Add a setting
    $wp_customize->add_setting('mytheme_api_url', array(
        'default'   => 'https://15e7-154-192-137-1.ngrok-free.app/api/payments/crypto-wallet',
        'sanitize_callback' => 'esc_url_raw', // Use esc_url_raw() for URL sanitization
    ));

    // Add a control
    $wp_customize->add_control('mytheme_api_url_control', array(
        'label'    => __('API URL', 'mytheme'),
        'section'  => 'wb_theme_options',
        'settings' => 'mytheme_api_url',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'mytheme_customize_register');
