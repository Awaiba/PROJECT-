// Fetching the product data from products.json
const productsContainer = document.querySelector('.listProduct');
const cartItemsContainer = document.querySelector('.listCart');
const cartTab = document.getElementById('cartTab');
const cartCloseBtn = document.getElementById('close-cart');
const cartIcon = document.querySelector('.icon-cart span');

// Load products dynamically from JSON
fetch('products.json')
    .then(response => response.json())
    .then(data => {
        const productsHTML = data.products.map(product => `
            <div class="product-card">
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>Price: $${product.price}</p>
                <button class="add-to-cart" data-id="${product.id}">Add to Cart</button>
            </div>
        `).join('');
        productsContainer.innerHTML = productsHTML;
    })
    .catch(error => console.error('Error loading products:', error));

// Cart functionality
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function updateCart() {
    cartItemsContainer.innerHTML = cart.map(item => `
        <div class="cart-item">
            <img src="${item.image}" alt="${item.name}">
            <div>
                <h4>${item.name}</h4>
                <p>Price: $${item.price}</p>
            </div>
        </div>
    `).join('');

    localStorage.setItem('cart', JSON.stringify(cart));
    cartIcon.textContent = cart.length;
}

productsContainer.addEventListener('click', function(e) {
    if (e.target.classList.contains('add-to-cart')) {
        const productId = e.target.getAttribute('data-id');
        const product = data.products.find(p => p.id == productId);
        if (product && !cart.some(item => item.id == product.id)) {
            cart.push(product);
            updateCart();
        }
    }
});

cartCloseBtn.addEventListener('click', function() {
    cartTab.style.display = 'none';
});

// Show cart tab
cartIcon.addEventListener('click', function() {
    cartTab.style.display = 'block';
});

// Initialize cart
updateCart();
