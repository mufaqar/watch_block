<?php

function handle_stolen_watch_form() {
    // Verify nonce (add nonce to form if needed)
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'stolen_watch_nonce')) {
        wp_send_json_error(array('message' => 'Invalid security token'), 400);
    }

    // Get form data
    $brand   = sanitize_text_field($_POST['brand']);
    $model_no = sanitize_text_field($_POST['model_no']);
    $serial_no  = sanitize_text_field($_POST['serial_no']);
    $date       = sanitize_text_field($_POST['date']);
    $location   = sanitize_text_field($_POST['location']);
    $details    = sanitize_textarea_field($_POST['details']);
    $name       = sanitize_text_field($_POST['name']);
    $email      = sanitize_text_field($_POST['email']);
    $phone      = sanitize_textarea_field($_POST['phone']);

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
        'post_title'   => $model_no . ' (' . $brand . ')',
        'post_content' => $details,
        'post_status'  => 'publish',
        'post_type'    => 'stolen_watch',
        'meta_input'   => array(
            'model_no'   => $model_no,
            'serial_number'  => $serial_no,
            'reported_date'    => $date,
            'brand'   => $brand,           
            'name'   => $name,
            'email'   => $email,
            'phone'   => $phone,           
            'location'   => $location,
            'image'      => $file_url,
            'status'   => "Still Lost",
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


function handle_add_request_watch() {
    // Verify nonce (add nonce to form if needed)
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'stolen_watch_nonce')) {
        wp_send_json_error(array('message' => 'Invalid security token'), 400);
    }

    // Get form data
    $model_no   = sanitize_text_field($_POST['model_no']);
    $model_name = sanitize_text_field($_POST['model_name']);
    $price  = sanitize_text_field($_POST['price']);
    $size   = sanitize_text_field($_POST['size']);
    $brand   = sanitize_text_field($_POST['brand']);
    $details    = sanitize_textarea_field($_POST['details']);

    // Handle file upload
    $attachment_id = '';
    if (!empty($_FILES['file'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $uploaded_file = wp_handle_upload($_FILES['file'], array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            $file_url = $uploaded_file['url'];

            // Get the file path
            $file_path = $uploaded_file['file'];

            // Prepare an attachment array
            $attachment = array(
                'guid'           => $file_url,
                'post_mime_type' => $_FILES['file']['type'],
                'post_title'     => sanitize_file_name($_FILES['file']['name']),
                'post_content'   => '',
                'post_status'    => 'inherit',
            );

            // Insert attachment to the media library
            $attachment_id = wp_insert_attachment($attachment, $file_path);

            if (!is_wp_error($attachment_id)) {
                // Generate attachment metadata
                $attachment_metadata = wp_generate_attachment_metadata($attachment_id, $file_path);
                wp_update_attachment_metadata($attachment_id, $attachment_metadata);
            }
        } else {
            wp_send_json_error(array('message' => 'File upload failed'), 400);
        }
    }

    // Insert post
    $post_data = array(
        'post_title'   => $model_name . ' (' . $model_no . ')',
        'post_content' => $details,
        'post_status'  => 'publish',
        'post_type'    => 'request_watch',
        'meta_input'   => array(
            'model_no'   => $model_no,            
            'model_name' => $model_name,
            'price'  => $price,
            'size'   => $size,
            'brand'  => $brand,
        ),
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        // Set featured image
        if (!empty($attachment_id)) {
            set_post_thumbnail($post_id, $attachment_id);
        }

        wp_send_json_success(array('message' => 'New Watch Request submitted successfully'));
    } else {
        wp_send_json_error(array('message' => 'Failed to submit the report'), 500);
    }
}
add_action('wp_ajax_handle_add_request_watch', 'handle_add_request_watch');
add_action('wp_ajax_nopriv_handle_add_request_watch', 'handle_add_request_watch');



function handle_ajax_product_review() {
    if (!isset($_POST['product_id'], $_POST['review_author'], $_POST['review_content'], $_POST['review_rating'])) {
        wp_send_json_error(['message' => 'Invalid request.']);
    }

    $product_id = intval($_POST['product_id']);
    $author_id = intval($_POST['review_author']);
    $author_name = ($author_id > 0) ? get_the_author_meta('display_name', $author_id) : 'Guest';
    $content = sanitize_textarea_field($_POST['review_content']);
    $rating = intval($_POST['review_rating']);

    // Insert comment (review)
    $comment_id = wp_insert_comment([
        'comment_post_ID'  => $product_id,
        'comment_author'   => $author_name, // Ensure it's a string
        'user_id'          => $author_id,   // Store user ID correctly
        'comment_content'  => $content,
        'comment_approved' => 0, // Set to 1 for auto-approval
    ]);

    if ($comment_id && !is_wp_error($comment_id)) {
        // Save rating as comment meta
        update_comment_meta($comment_id, 'rating', $rating);

        wp_send_json_success(['message' => 'Review submitted successfully! Pending approval.']);
    } else {
        wp_send_json_error(['message' => 'Failed to submit review.']);
    }
}

add_action('wp_ajax_handle_ajax_product_review', 'handle_ajax_product_review');
add_action('wp_ajax_nopriv_handle_ajax_product_review', 'handle_ajax_product_review');



function handle_ajax_contact_form() {
    
    parse_str($_POST['formData'], $formData);
    
    $to = get_option('admin_email');
    $to = "mufaqar@gmail.com";
    $subject = 'New Contact Form Submission';
    $message = "Name: " . sanitize_text_field($formData['first_name']) . "\n" .
               "Job Title: " . sanitize_text_field($formData['job_title']) . "\n" .
               "Email: " . sanitize_email($formData['email']) . "\n" .
               "Phone: " . sanitize_text_field($formData['phone']) . "\n" .
               "Country: " . sanitize_text_field($formData['country']);
    
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    
    if (wp_mail($to, $subject, $message, $headers)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
    
    wp_die();
}

add_action('wp_ajax_handle_ajax_contact_form', 'handle_ajax_contact_form');
add_action('wp_ajax_nopriv_handle_ajax_contact_form', 'handle_ajax_contact_form');

