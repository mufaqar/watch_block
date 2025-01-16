jQuery(document).ready(function ($) {
  const $miniCart = $('#mini-cart');
  const $openCartBtn = $('#open-cart');
  const $closeCartBtn = $('#close-cart');

  // Open the mini-cart
  $openCartBtn.on('click', function () {
      $miniCart.addClass('open');
      updateWooMiniCart(); // Update mini-cart content when opened
  });

  // Close the mini-cart
  $closeCartBtn.on('click', function () {
      $miniCart.removeClass('open');
  });

  // Close the cart when clicking outside
  $(document).on('click', function (event) {
      if (!$(event.target).closest('#mini-cart, #open-cart').length) {
          $miniCart.removeClass('open');
      }
  });

  // Function to update WooCommerce mini-cart
  function updateWooMiniCart() {
      $.ajax({
          url: wc_cart_fragments_params.wc_ajax_url.replace('%%endpoint%%', 'get_refreshed_fragments'),
          type: 'POST',
          success: function (response) {
              if (response && response.fragments) {
                  $.each(response.fragments, function (key, value) {
                      $(key).html(value);
                  });
              }
          },
          error: function () {
              console.error('Error loading WooCommerce mini-cart');
          }
      });
  }
});



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
