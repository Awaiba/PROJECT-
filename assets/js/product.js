// product.js

document.addEventListener('DOMContentLoaded', function() {
    // Event listener for Add to Cart buttons
    document.querySelectorAll('.cart-button').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('.pro').dataset.id; // Assuming each product has a unique ID attribute (data-id="productId")
            addToCart(productId);
        });
    });
});

// Add to Cart function
function addToCart(productId) {
    // Retrieve product details from the DOM
    const productName = document.querySelector(`#product-${productId}-name`).textContent;
    const productImage = document.querySelector(`#product-${productId}-image`).src;
    const productPrice = document.querySelector(`#product-${productId}-price`).textContent;

    // Prepare product details to store in the cart
    const product = {
        id: productId,
        name: productName,
        image: productImage,
        price: productPrice,
        quantity: 1
    };

    // Get existing cart from local storage or initialize an empty array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Check if the product already exists in the cart
    const existingProduct = cart.find(item => item.id === productId);

    if (existingProduct) {
        // Update quantity if the product already exists
        existingProduct.quantity += 1;
    } else {
        // Add the new product to the cart
        cart.push(product);
    }

    // Save the updated cart back to local storage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Redirect to buyout.php with product details as query params
    window.location.href = `buyout.php?name=${encodeURIComponent(productName)}&image=${encodeURIComponent(productImage)}&price=${encodeURIComponent(productPrice)}`;
}
