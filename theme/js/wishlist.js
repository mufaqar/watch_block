jQuery(document).ready(function ($) {
    $('.add-to-wishlist').on('click', function () {
        var button = $(this);
        var product_id = button.data('product-id');

        $.ajax({
            url: wishlist_params.ajax_url,
            method: 'POST',
            data: {
                action: 'add_to_wishlist',
                product_id: product_id,
            },
            success: function (response) {
                if (response.success) {
                    alert(response.data);
                } else {
                    alert(response.data);
                }
            },
        });
    });
});
