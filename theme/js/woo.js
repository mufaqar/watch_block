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



jQuery(document).ready(function ($) {
    $(".variation-buttons .variation-button").on("click", function () {
        let parent = $(this).closest(".variation-wrapper");
        let attributeName = parent.find(".variation-buttons").data("attribute");
        let selectedValue = $(this).data("value");

        parent.find(".variation-button").removeClass("active");
        $(this).addClass("active");

        $("#attribute_" + attributeName).val(selectedValue).trigger("change");
    });

    $(".reset_variations").on("click", function (e) {
        e.preventDefault();
        $(".variation-button").removeClass("active");
        $(".variation-wrapper input[type='hidden']").val("").trigger("change");
    });
});
