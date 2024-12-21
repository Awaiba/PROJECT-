document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cart-button').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('.pro').dataset.id; 
            addToCart(productId);
        });
    });
});

function addToCart(productId) {
    const productName = document.querySelector(`#product-${productId}-name`).textContent;
    const productImage = document.querySelector(`#product-${productId}-image`).src;
    const productPrice = document.querySelector(`#product-${productId}-price`).textContent;

    const product = {
        id: productId,
        name: productName,
        image: productImage,
        price: productPrice,
        quantity: 1
    };
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existingProduct = cart.find(item => item.id === productId);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push(product);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    window.location.href = `buyout.php?name=${encodeURIComponent(productName)}&image=${encodeURIComponent(productImage)}&price=${encodeURIComponent(productPrice)}`;
}
