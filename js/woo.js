jQuery(document).ready(function ($) {
    // Mini Cart functionality
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

    // Stolen Watch Form Submission
    $('#stolen_watch').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);    

        // Append additional data
        formData.append('action', 'handle_stolen_watch_form');
        formData.append('nonce', ajax_object.nonce);

        // Append input values manually
        formData.append('brand', $('#brand').val());
        formData.append('model_no', $('#model_no').val());
        formData.append('serial_no', $('#serial_no').val());
        formData.append('date', $('#date').val());
        formData.append('location', $('#location').val());
        formData.append('email', $('#email').val());
        formData.append('name', $('#name').val());
        formData.append('phone', $('#phone').val());
        formData.append('details', $('#details').val());

        // Append file input manually
        var fileInput = $('#file-upload')[0].files;
        if (fileInput.length > 0) {
            formData.append('file', fileInput[0]);
        }
        console.log("🚀 ~ fileInput:", fileInput)

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#stolen_watch button[type="submit"]').text('Submitting...').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    alert(response.data.message);
                   // $('#stolen_watch')[0].reset();
                } else {
                    alert(response.data.message);
                }
            },
            error: function () {
                alert('Something went wrong. Please try again.');
            },
            complete: function () {
                $('#stolen_watch button[type="submit"]').text('Submit').prop('disabled', false);
            }
        });
    });


    // Stolen Watch Form Submission
    $('#add_new_watch').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);     

        // Append additional data
        formData.append('action', 'handle_add_request_watch');
        formData.append('nonce', ajax_object.nonce);

        // Append input values manually
        formData.append('model_no', $('#model_no').val());
        formData.append('model_name', $('#model_name').val());
        formData.append('serial_no', $('#serial_no').val());
        formData.append('date', $('#date').val());
        formData.append('location', $('#location').val());
        formData.append('details', $('#details').val());

        // Append file input manually
        var fileInput = $('#file-upload')[0].files;
        if (fileInput.length > 0) {
            formData.append('file', fileInput[0]);
        }

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#stolen_watch button[type="submit"]').text('Submitting...').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    alert(response.data.message);
                    $('#stolen_watch')[0].reset();
                } else {
                    alert(response.data.message);
                }
            },
            error: function () {
                alert('Something went wrong. Please try again.');
            },
            complete: function () {
                $('#stolen_watch button[type="submit"]').text('Submit').prop('disabled', false);
            }
        });
    });
});


jQuery(document).ready(function ($) {
    let compareList = [];

    $(".compare-product").click(function () {
        let productId = $(this).attr("data-product-id").toString();

        // Check if the product is already in the list
        let index = compareList.indexOf(productId);

        if (index !== -1) {
            // Remove product if it already exists
            compareList.splice(index, 1);
            $(this).removeClass("comactive");
        } else {
            if (compareList.length >= 2) {
                // Remove the first product and remove the "comactive" class from the button
                let removedProduct = compareList.shift();
                $(`.compare-product[data-product-id='${removedProduct}']`).removeClass("comactive");
            }
            // Add the new product
            compareList.push(productId);
            $(this).addClass("comactive");
        }

        console.log("compareList", compareList);
    });

    $("#comparison").click(function () {
        if (compareList.length < 2) {
            alert("Please select two products for comparison.");
            return;
        }
        let compareUrl = `/comparison?p1=${compareList[0]}&p2=${compareList[1]}`;
        window.location.href = compareUrl;
    });
});


jQuery(document).ready(function ($) {
    $('input.qty').on('input', function () {
        let max = 10; // Set maximum quantity
        if ($(this).val() > max) {
            $(this).val(max);
        }
    });
});


