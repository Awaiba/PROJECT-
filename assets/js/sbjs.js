// Function to filter products based on selected criteria
function filterProducts() {
    const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(cb => cb.value);
    const selectedBrands = Array.from(document.querySelectorAll('input[name="brand"]:checked')).map(cb => cb.value);
    const selectedColors = Array.from(document.querySelectorAll('input[name="color"]:checked')).map(cb => cb.value);
    const selectedPriceRanges = Array.from(document.querySelectorAll('input[name="price"]:checked')).map(cb => cb.value);

    document.querySelectorAll('.pro').forEach(product => {
        const category = product.getAttribute('data-category');
        const brand = product.getAttribute('data-brand');
        const color = product.getAttribute('data-color').toLowerCase();
        const price = parseInt(product.getAttribute('data-price'), 10);

        let showProduct = true;

        if (selectedCategories.length > 0 && !selectedCategories.includes(category)) {
            showProduct = false;
        }
        if (selectedBrands.length > 0 && !selectedBrands.includes(brand)) {
            showProduct = false;
        }
        if (selectedColors.length > 0 && !selectedColors.some(color => product.getAttribute('data-color').toLowerCase().includes(color))) {
            showProduct = false;
        }
        if (selectedPriceRanges.length > 0) {
            let priceMatch = false;
            for (const range of selectedPriceRanges) {
                const [min, max] = range.split('-').map(Number);
                if (price >= min && price <= max) {
                    priceMatch = true;
                    break;
                }
            }
            if (!priceMatch) {
                showProduct = false;
            }
        }

        if (showProduct) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

// Add event listeners to filter checkboxes
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[name="category"], input[name="brand"], input[name="color"], input[name="price"]').forEach(checkbox => {
        checkbox.addEventListener('change', filterProducts);
    });
});
