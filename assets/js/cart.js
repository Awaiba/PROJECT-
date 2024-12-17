/*=============== ADD to CART ===============*/

// Toggle Cart Function
function toggleCart(button) {
    const productElement = button.closest('.pro'); // Get the parent product div
    const productId = productElement.getAttribute('data-id'); // Assuming data-id contains product id

    // Retrieve product details from the data attributes
    const productName = productElement.querySelector('h5').innerText; // Product Name
    const productImageSrc = productElement.querySelector('img').src; // Product Image Source
    const productPrice = productElement.querySelector('h4').innerText; // Product Price
    const productDescription = productElement.querySelector('.des').innerText.trim(); // Product Description

    // Redirect to buyout page with product details as query parameters
    window.location.href = `buyout.html?product_id=${productId}&name=${encodeURIComponent(productName)}&image=${encodeURIComponent(productImageSrc)}&price=${encodeURIComponent(productPrice)}&description=${encodeURIComponent(productDescription)}`;
}

// Toggle Favorite Function
function toggleFavorite(button) {
    const productElement = button.closest('.pro'); // Get the parent product div
    const favoriteIcon = button.querySelector('i'); // Get the heart icon element

    // Toggle the "active" class to change the heart color
    favoriteIcon.classList.toggle('fas');  // Switch to solid heart (red)
    favoriteIcon.classList.toggle('far');  // Switch to outlined heart (gray)

    const productId = productElement.getAttribute('data-id'); // Assuming data-id contains product id
    console.log('Favorited:', productId);
}
