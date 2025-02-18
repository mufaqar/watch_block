document.addEventListener("DOMContentLoaded", function () {
    let selectedAttributes = {}; 

    function updateSelectedAttributes(attribute, value) {
        selectedAttributes[attribute] = value;
        findMatchingVariation();
    }

    function findMatchingVariation() {
        
        if (!window.product_variations) return;


        let matchingVariation = window.product_variations.find(variation => {
            console.log(selectedAttributes);
            console.log(variation);

            return Object.keys(selectedAttributes).every(attr => {
                return variation.attributes["attribute_pa_" + attr] === selectedAttributes[attr];
                
            });
        });

        console.log(matchingVariation);

        if (matchingVariation) {
            let priceElement = document.getElementById("selected-price");

            if (matchingVariation.display_price) {
                priceElement.innerHTML = `₨ ${matchingVariation.display_price}`;
            } else {
                priceElement.innerHTML = "Unavailable";
            }

            // Update hidden input for variation ID (optional, useful for checkout)
            document.querySelector('input[name="variation_id"]').value = matchingVariation.variation_id;
          
        }
    }

    document.querySelectorAll(".color-button, .size-button, .nft-button").forEach(button => {
        button.addEventListener("click", function () {
            let attribute = this.getAttribute("data-attribute");
            let value = this.getAttribute("data-value");

            updateSelectedAttributes(attribute, value);

            // Highlight selected button
            document.querySelectorAll(`[data-attribute="${attribute}"]`).forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
              // Enable Add to Cart button when a valid variation is selected
              document.querySelector('.single_add_to_cart_button').classList.remove('disabled');
        });
    });
});
