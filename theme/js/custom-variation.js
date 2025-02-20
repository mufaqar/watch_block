
jQuery(document).ready(function($) {
    // Store selected color and size values
    let selectedColor = '';
    let selectedSize = '';

    // Handle color button clicks
    $('#color-buttons .color-button').on('click', function() {
        // Remove active class from all color buttons
        $('#color-buttons .color-button').removeClass('active');
        
        // Add active class to clicked color button
        $(this).addClass('active');
        
        // Get the selected color value
        selectedColor = $(this).data('color');

        // Set the selected color value in the hidden input field
        $('#custom_color').val(selectedColor);
    });

    // Handle size button clicks
    $('#size-buttons .size-button').on('click', function() {
        // Remove active class from all size buttons
        $('#size-buttons .size-button').removeClass('active');
        
        // Add active class to clicked size button
        $(this).addClass('active');
        
        // Get the selected size value
        selectedSize = $(this).data('size');

        // Set the selected size value in the hidden input field
        $('#custom_size').val(selectedSize);
    });
});