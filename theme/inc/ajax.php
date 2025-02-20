<?php

function handle_stolen_watch_form() {
    // Verify nonce (add nonce to form if needed)
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'stolen_watch_nonce')) {
        wp_send_json_error(array('message' => 'Invalid security token'), 400);
    }

    // Get form data
    $model_no   = sanitize_text_field($_POST['model_no']);
    $model_name = sanitize_text_field($_POST['model_name']);
    $serial_no  = sanitize_text_field($_POST['serial_no']);
    $date       = sanitize_text_field($_POST['date']);
    $location   = sanitize_text_field($_POST['location']);
    $details    = sanitize_textarea_field($_POST['details']);

    // Handle file upload
    if (!empty($_FILES['file'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        $uploaded_file = wp_handle_upload($_FILES['file'], array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            $file_url = $uploaded_file['url'];
        } else {
            wp_send_json_error(array('message' => 'File upload failed'), 400);
        }
    } else {
        $file_url = '';
    }

    // Insert data into custom post type or send email
    $post_data = array(
        'post_title'   => $model_name . ' (' . $model_no . ')',
        'post_content' => $details,
        'post_status'  => 'publish',
        'post_type'    => 'stolen_watch',
        'meta_input'   => array(
            'model_no'   => $model_no,
            'serial_no'  => $serial_no,
            'reported_date'       => $date,
            'location'   => $location,
            'image'      => $file_url,
        ),
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        wp_send_json_success(array('message' => 'Report submitted successfully'));
    } else {
        wp_send_json_error(array('message' => 'Failed to submit the report'), 500);
    }
}
add_action('wp_ajax_handle_stolen_watch_form', 'handle_stolen_watch_form');
add_action('wp_ajax_nopriv_handle_stolen_watch_form', 'handle_stolen_watch_form');
