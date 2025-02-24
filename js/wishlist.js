jQuery(document).ready(function ($) {
    $('.add-to-wishlist').on('click', function () {
       
        var button = $(this);
        var product_id = button.data('product-id');

        // Disable button and add loading class
        button.prop('disabled', true).addClass('loading');

        $.ajax({
            url: wishlist_params.ajax_url,
            method: 'POST',
            data: {
                action: 'add_to_wishlist',
                product_id: product_id,
            },
            success: function (response) {
                if (response.success) {
                    alert('Success: ' + response.data);
                } else {
                    alert('Error: ' + response.data);
                }
            },
            error: function () {
                alert('An error occurred while processing your request.');
            },
            complete: function () {
                // Re-enable button and remove loading class
                button.prop('disabled', false).removeClass('loading');
            },
        });
    });
});
