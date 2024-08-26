document.addEventListener("DOMContentLoaded", function () {
    const productTypeSelect = document.getElementById("productType");
    const productFields = document.querySelectorAll(".product-field");

    // Function to show or hide fields based on selected option
    function updateProductFields(selectedType) {
        productFields.forEach(field => {
            field.style.display = field.id === `${selectedType}Field` ? "block" : "none";
        });
    }

    // Initial call to update fields on page load
    updateProductFields(productTypeSelect.value);

    // Event listener for product type change
    productTypeSelect.addEventListener("change", function () {
        updateProductFields(this.value);
    });
});
