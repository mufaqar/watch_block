document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll("#brand-filter, #color-filter, #size-filter");
    const conditionButtons = document.querySelectorAll(".condition-button");
    const shopContainer = document.querySelector(".products"); // Ensure this matches WooCommerce product container

    function updateFilters() {
        let params = new URLSearchParams(window.location.search);
        let formData = new FormData();
        
        // Collect filter values
        filters.forEach(filter => {
            if (filter.value) {
                formData.append(filter.id.replace("-filter", ""), filter.value);
                params.set(filter.id.replace("-filter", ""), filter.value);
            }
        });

        // Collect condition buttons
        conditionButtons.forEach(button => {
            if (button.classList.contains("active")) {
                formData.append("condition", button.dataset.condition);
                params.set("condition", button.dataset.condition);
            }
        });

        window.history.pushState({}, "", `?${params.toString()}`);

        // Send AJAX request
        formData.append("action", "filter_products");
        fetch(woocommerce_ajax.ajax_url, {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            shopContainer.innerHTML = data;
        })
        .catch(error => console.error("Error fetching filtered products:", error));
    }

    // Apply filters on change
    filters.forEach(filter => filter.addEventListener("change", updateFilters));

    // Condition button click event
    conditionButtons.forEach(button => {
        button.addEventListener("click", function () {
            conditionButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            updateFilters();
        });
    });
});
