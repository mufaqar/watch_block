jQuery(document).ready(function ($) {
    var $form = $('form.variations_form');

    // Initialize WooCommerce variation form
    if ($form.length > 0 && $.fn.wc_variation_form) {
        $form.wc_variation_form();
    }

    // Handle radio button selection
    $('.variation-radios input[type="radio"]').on('change', function () {
       
        var $this = $(this);
       
        var attributeName = $this.closest('.variation-radios').data('attribute-name');
        var attributeValue = $this.val();

    

        // Update WooCommerce's variation selection dropdown (hidden)
        var $select = $('select[name="attribute_' + attributeName + '"]');
        if ($select.length) {
            $select.val(attributeValue).trigger('change');
        }

        // Update the hidden input field for form submission
        $('input[name="attribute_' + attributeName + '"]').val(attributeValue);

        // Trigger WooCommerce's variation update
        $form.trigger('check_variations');
    });

    // Ensure variations update on page load
    $form.trigger('check_variations');
});
