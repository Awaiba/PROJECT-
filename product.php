<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: loginRegister.php');
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/sbar.css">
    <link rel="stylesheet" href="assets/css/productPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Walk On</title>
    <style>
      /* Sidebar Styling */
.filter-sidebar {
    width: 300px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.filter-sidebar h2 {
    font-size: 22px;
    margin-bottom: 15px;
}

.filter-sidebar h3 {
    font-size: 18px;
    margin-top: 15px;
    color: #007bff;
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    margin: 8px 0;
    display: flex;
    align-items: center;
}

ul li input {
    margin-right: 10px;
}

.filter-reset button {
    margin-top: 15px;
    padding: 10px 15px;
    font-size: 16px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.filter-reset button:hover {
    background-color: #c82333;
}

.cart-sidebar {
    position: fixed;
    top: 0;
    right: -300px; /* Initially hidden */
    width: 300px;
    height: 100%;
    background-color: #f0f0f0;
    transition: right 0.3s ease-in-out;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    padding: 20px;
    box-sizing: border-box;
    overflow-y: auto;
}

.cart-sidebar.open {
    right: 0; /* Slide in when open */
}

.cart-content h2 {
    margin-bottom: 15px;
}

.cart-items {
    list-style: none;
    padding: 0;
}

.cart-items li {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-items li img {
    max-height: 50px;
    margin-right: 10px;
}

.cart-items li span {
    flex-grow: 1;
}

.cart-content button {
    margin-top: 15px;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

.header {
    position: fixed;
    width: 100%;
    top: -10px;
    left: 0;
    background-color: var(--body-color);
    z-index: var(--z-fixed);
    transition: box-shadow .4s;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.search-box {
    margin: 20px 0;
    padding: 10px;
    font-size: 16px;
    width: auto;
    border: 2px solid #007bff;
    border-radius: 5px;
}

.product-list {
    margin-top: 20px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    /* Add padding to the right to make space for the cart */
    padding-right: 300px; /* Adjust as needed */
}

.product-item {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.product-item h3 {
    margin-bottom: 10px;
    color: #007bff;
    font-size: 1.2em; /* Adjust product title font size */
}

.product-item p {
    color: #555;
    font-size: 1em; /* Adjust product description font size */
}

.product-item .price {
    font-weight: bold;
    color: #dc3545;
    font-size: 1em; /* Adjust product price font size */
}

.product-item .button-container button {
    font-size: 1em; /* Adjust cart/favorite button font size */
    padding: 8px 12px; /* Adjust button padding */
}


/* Optional: Adjust for smaller screens */
@media (max-width: 768px) {
    .product-list {
        grid-template-columns: 1fr; /* Stack products on smaller screens */
        padding-right: 0; /* Remove padding on smaller screens */
    }

    .cart-sidebar {
        width: 100%; /* Make cart full-width on smaller screens */
        right: -100%; /* Hide off-screen */
    }

    .cart-sidebar.open {
        right: 0; /* Slide in full-width */
    }
}

.product-item img.product-image {
    width: 200px !important;
    height: auto !important;
}   
    </style>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <div class="navLOGO">
                <a href="index.php" class="nav__logo">
                    <img src="assets/img/logoSHOES.png" alt="Logo of Shoes">
                </a>
                <h1 class="nav__logo-title">Walk On</h1>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="userDashboard.php" class="nav__link">HOME</a>
                    </li>
                    <li class="nav__item">
                        <a href="product.php" class="nav__link"><b>PRODUCTS</b></a>
                    </li>
                    <li class="nav__item">
                        <a href="contact.php" class="nav__link">CONTACT</a>
                    </li>
                    <li class="nav__item">
                        <a href="processLogin.php" class="nav__link"><?php echo htmlspecialchars($username); ?></a>
                    </li>
                    <li class="nav__item">
                        <a href="logout.php" class="nav__link">LOG OUT</a>
                    </li>
                </ul>

                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-apps-2-fill"></i>
            </div>
        </nav>
    </header>

    <main>
        <section class="productandsidebar">
            <aside class="filter-sidebar">
                <h2>Filter Products</h2>
                <div>
                    <input type="text" id="searchBox" class="search-box" placeholder="Search products..." onkeyup="filterProducts()">
                </div>

                <div class="filter-category">
                    <h3>Category</h3>
                    <ul>
                        <li><input type="checkbox" id="men" name="category" value="men"><label for="men">Men's Shoes</label></li>
                        <li><input type="checkbox" id="women" name="category" value="women"><label for="women">Women's Shoes</label></li>
                        <li><input type="checkbox" id="kids" name="category" value="kids"><label for="kids">Kids' Shoes</label></li>
                    </ul>
                </div>

                <div class="filter-size">
                    <h3>Size</h3>
                    <ul>
                        <li><input type="checkbox" id="size-6" name="size" value="6"><label for="size-6">6</label></li>
                        <li><input type="checkbox" id="size-7" name="size" value="7"><label for="size-7">7</label></li>
                        <li><input type="checkbox" id="size-8" name="size" value="8"><label for="size-8">8</label></li>
                        <li><input type="checkbox" id="size-9" name="size" value="9"><label for="size-9">9</label></li>
                        <li><input type="checkbox" id="size-10" name="size" value="10"><label for="size-10">10</label></li>
                    </ul>
                </div>

                <div class="filter-color">
                    <h3>Color</h3>
                    <ul>
                        <li><input type="checkbox" id="black" name="color" value="black"><label for="black">Black</label></li>
                        <li><input type="checkbox" id="white" name="color" value="white"><label for="white">White</label></li>
                        <li><input type="checkbox" id="red" name="color" value="red"><label for="red">Red</label></li>
                        <li><input type="checkbox" id="blue" name="color" value="blue"><label for="blue">Blue</label></li>
                        <li><input type="checkbox" id="grey" name="color" value="grey"><label for="grey">Grey</label></li>
                    </ul>
                </div>

                <div class="filter-brand">
                    <h3>Brand</h3>
                    <ul>
                        <li><input type="checkbox" id="nike" name="brand" value="nike"><label for="nike">Nike</label></li>
                        <li><input type="checkbox" id="adidas" name="brand" value="adidas"><label for="adidas">Adidas</label></li>
                        <li><input type="checkbox" id="puma" name="brand" value="puma"><label for="puma">Puma</label></li>
                        <li><input type="checkbox" id="reebok" name="brand" value="reebok"><label for="reebok">Reebok</label></li>
                    </ul>
                </div>

                <div class="filter-material">
                    <h3>Material</h3>
                    <ul>
                        <li><input type="checkbox" id="leather" name="material" value="leather"><label for="leather">Leather</label></li>
                        <li><input type="checkbox" id="synthetic" name="material" value="synthetic"><label for="synthetic">Synthetic</label></li>
                        <li><input type="checkbox" id="mesh" name="material" value="mesh"><label for="mesh">Mesh</label></li>
                        <li><input type="checkbox" id="canvas" name="material" value="canvas"><label for="canvas">Canvas</label></li>
                    </ul>
                </div>

                <div class="filter-reset">
                    <button type="button" id="reset-filters">Reset Filters</button>
                </div>
            </aside>
        </section>
        <section id="product1" class="section1">
            <div class="jordan">
                <div class="pro-container">
                    <div class="pro" data-category="men" data-brand="Jordan" data-price="6000" data-material="leather" data-color="blue" data-size="9">
                        <img src="assets/img/JORDAN/AIR+JORDAN+1+LOW+SE.png" alt="Air Jordan 1 Low SE" class="product-image">
                        <div class="des">
                            <br>
                            <span>Jordan</span>
                            <br><br>
                            <h5>Air Jordan 1 Low SE</h5>
                        </div>
                        <h4>RS 6000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Air Jordan 1 Low SE', 'assets/img/JORDAN/AIR+JORDAN+1+LOW+SE.png', '6000', 'Blue', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="men" data-brand="Jordan" data-price="5500" data-material="leather" data-color="black" data-size="9">
                        <img src="assets/img/JORDAN/AIR+JORDAN+1+LOW.png" alt="Air Jordan 1 Low" class="product-image">
                        <div class="des">
                            <br>
                            <span>Jordan</span>
                            <br><br>
                            <h5>Air Jordan 1 Low</h5>
                        </div>
                        <h4>RS 5500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Air Jordan 1 Low', 'assets/img/JORDAN/AIR+JORDAN+1+LOW.png', '5500', 'Black', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="men" data-brand="Jordan" data-price="8000" data-material="leather" data-color="white" data-size="9">
                        <img src="assets/img/JORDAN/AIR+JORDAN+1+MID.png" alt="Air Jordan 1 Mid" class="product-image">
                        <div class="des">
                            <br>
                            <span>Jordan</span>
                            <br><br>
                            <h5>Air Jordan 1 Mid</h5>
                        </div>
                        <h4>RS 8000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Air Jordan 1 Mid', 'assets/img/JORDAN/AIR+JORDAN+1+MID.png', '8000', 'White', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="men" data-brand="Jordan" data-price="8400" data-material="leather" data-color="red, white" data-size="9">
                        <img src="assets/img/JORDAN/JORDAN+MAX+AURA+5.png" alt="Jordan Max Aura" class="product-image">
                        <div class="des">
                            <br>
                            <span>Jordan</span>
                            <br><br>
                            <h5>Jordan Max Aura</h5>
                        </div>
                        <h4>RS 8400</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Jordan Max Aura', 'assets/img/JORDAN/JORDAN+MAX+AURA+5.png', '8400', 'Red, White', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="cart-sidebar" class="cart-sidebar">
                    <div class="cart-content">
                        <h2>Shopping Cart</h2>
                        <ul id="cart-items">
                        </ul>
                        <button onclick="redirectToBuyoutFromCart()">Proceed to Buyout</button>
                        <button onclick="closeCart()">Close Cart</button>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="puma">
                <div class="pro-container">
                    <div class="pro" data-category="men" data-brand="puma" data-price="7500" data-material="leather" data-color="green" data-size="7">
                        <img src="assets/img/PUMA/PUMA-x-LAMELO-BALL-LaFrancé-Assist-Men's-Shoes.png" alt="PUMA LAMELO BALL LaFrancé Assist Men's Shoes" class="product-image">
                        <div class="des">
                            <br>
                            <span>PUMA</span>
                            <br><br>
                            <h5>PUMA x LAMELO BALL LaFrancé Assist</h5>
                        </div>
                        <h4>RS 7500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('PUMA x LAMELO BALL LaFrancé Assist', 'assets/img/PUMA/PUMA-x-LAMELO-BALL-LaFrancé-Assist-Men%27s-Shoes.png', '7500', 'Green', 'Leather', '7')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="men" data-brand="puma" data-price="7500" data-material="leather" data-color="orange" data-size="8">
                        <img src="assets/img/PUMA/PUMA-x-LAMELO-BALL-MB.png" alt="PUMA x LAMELO BALL MB" class="product-image">
                        <div class="des">
                            <br>
                            <span>PUMA</span>
                            <br><br>
                            <h5>PUMA x LAMELO BALL MB</h5>
                        </div>
                        <h4>RS 7500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('PUMA x LAMELO BALL MB', 'assets/img/PUMA/PUMA-x-LAMELO-BALL-MB.png', '7500', 'Orange', 'Leather', '8')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="women" data-brand="puma" data-price="4500" data-material="leather" data-color="grey" data-size="7">
                        <img src="assets/img/PUMA/PUMA-x-LMC-GV-Special-Men's-Sneakers.png" alt="PUMA x LMC GV Special Men's Sneakers" class="product-image">
                        <div class="des">
                            <br>
                            <span>PUMA</span>
                            <br><br>
                            <h5>PUMA x LMC GV Special</h5>
                        </div>
                        <h4>RS 4500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('PUMA x LMC GV Special', 'assets/img/PUMA/PUMA-x-LMC-GV-Special-Men%27s-Sneakers.png', '4500', 'Grey', 'Leather', '7')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="kid" data-brand="puma" data-price="5000" data-material="leather" data-color="orange" data-size="6">
                        <img src="assets/img/PUMA/Suede-XL-Día-De-Los-Muertos-Men's-Sneakers.png" alt="Suede XL Día De Los Muertos Men's Sneakers" class="product-image">
                        <div class="des">
                            <br>
                            <span>PUMA</span>
                            <br><br>
                            <h5>Suede XL Día De Los Muertos</h5>
                        </div>
                        <h4>RS 5000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Suede XL Día De Los Muertos', 'assets/img/PUMA/Suede-XL-Día-De-Los-Muertos-Men%27s-Sneakers.png', '5000', 'Orange', 'Leather', '6')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div class="Converse">
                <div class="pro-container">
                    <div class="pro" data-category="men" data-brand="Converse" data-price="5000" data-material="leather" data-color="black" data-size="9">
                        <img src="assets/img/CONVERSE/Chuck 70 Canvas.png" alt="Converse Chuck 70 Canvas shoe" class="product-image">
                        <div class="des">
                            <br>
                            <span>Converse</span>
                            <br><br>
                            <h5>Chuck 70 Canvas</h5>
                        </div>
                        <h4>RS 5000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Converse Chuck 70 Canvas', 'assets/img/CONVERSE/Chuck 70 Canvas.png', '5000', 'Black', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="men" data-brand="Converse" data-price="4000" data-material="leather" data-color="black" data-size="9">
                        <img src="assets/img/CONVERSE/Chuck Taylor All Star Glitter.png" alt="Chuck Taylor All Star Glitter" class="product-image">
                        <div class="des">
                            <br>
                            <span>Converse</span>
                            <br><br>
                            <h5>Chuck Taylor All Star Glitter</h5>
                        </div>
                        <h4>RS 4000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Converse Chuck Taylor All Star Glitter', 'assets/img/CONVERSE/Chuck Taylor All Star Glitter.png', '4000', 'Black', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="women" data-brand="Converse" data-price="5500" data-material="leather" data-color="black" data-size="9">
                        <img src="assets/img/CONVERSE/Chuck Taylor All Star Lugged Heel Platform.png" alt="Chuck Taylor All Star Lugged Heel Platform" class="product-image">
                        <div class="des">
                            <br>
                            <span>Converse</span>
                            <br><br>
                            <h5>All Star Lugged Heel</h5>
                        </div>
                        <h4>RS 5500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Converse All Star Lugged Heel', 'assets/img/CONVERSE/Chuck Taylor All Star Lugged Heel Platform.png', '5500', 'Black', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="women" data-brand="Converse" data-price="3500" data-material="leather" data-color="white" data-size="9">
                        <img src="assets/img/CONVERSE/CHUCK taylor.jpg" alt="CHUCK Taylor" class="product-image">
                        <div class="des">
                            <br>
                            <span>Converse</span>
                            <br><br>
                            <h5>CHUCK TAYLOR</h5>
                        </div>
                        <h4>RS 3500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Converse CHUCK TAYLOR', 'assets/img/CONVERSE/CHUCK taylor.jpg', '3500', 'White', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div class="adidas">
                <div class="pro-container">
                    <div class="pro" data-category="men" data-brand="adidas" data-price="5000" data-material="leather" data-color="orange" data-size="9">
                        <img src="assets/img/ADIDAS/handball-spezial-shoes.jpeg" alt="handball spezial shoes" class="product-image">
                        <div class="des">
                            <br>
                            <span>ADIDAS</span>
                            <br><br>
                            <h5>Handball Spezial Shoes</h5>
                        </div>
                        <h4>RS 5000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Adidas Handball Spezial Shoes', 'assets/img/ADIDAS/handball-spezial-shoes.jpeg', '5000', 'Orange', 'Leather', '9')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="men" data-brand="adidas" data-price="4000" data-material="leather" data-color="white" data-size="7">
                        <img src="assets/img/ADIDAS/samba-og-shoes.jpeg" alt="samba og shoes" class="product-image">
                        <div class="des">
                            <br>
                            <span>ADIDAS</span>
                            <br><br>
                            <h5>Samba Og Shoes</h5>
                        </div>
                        <h4>RS 4000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Adidas Samba Og Shoes', 'assets/img/ADIDAS/samba-og-shoes.jpeg', '4000', 'White', 'Leather', '7')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="women" data-brand="adidas" data-price="4500" data-material="leather" data-color="black" data-size="6">
                        <img src="assets/img/ADIDAS/gazelle-bold-shoes.jpeg" alt="gazelle bold shoes" class="product-image">
                        <div class="des">
                            <br>
                            <span>ADIDAS</span>
                            <br><br>
                            <h5>Gazelle Bold Shoes</h5>
                        </div>
                        <h4>RS 4500</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Adidas Gazelle Bold Shoes', 'assets/img/ADIDAS/gazelle-bold-shoes.jpeg', '4500', 'Black', 'Leather', '6')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pro" data-category="kid" data-brand="adidas" data-price="4000" data-material="leather" data-color="black" data-size="6">
                        <img src="assets/img/ADIDAS/vl-court-3.0-dia-de-los-muertos-shoes.jpeg" alt="Dia-De-Los-Muertos" class="product-image">
                        <div class="des">
                            <br>
                            <span>ADIDAS</span>
                            <br><br>
                            <h5>Dia-De-Los-Muertos</h5>
                        </div>
                        <h4>RS 4000</h4>
                        <br>
                        <div class="button-container">
                            <button class="cart-button" onclick="addToCart('Adidas Dia-De-Los-Muertos', 'assets/img/ADIDAS/vl-court-3.0-dia-de-los-muertos-shoes.jpeg', '4000', 'Black', 'Leather', '6')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="favorite-button" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

            <script>
    function removeFromCart(button) {
    const section = button.parentElement;
    section.remove();
}

function changeQuantity(button, change) {
    const quantitySpan = button.parentElement.querySelector('.quantity');
    let quantity = parseInt(quantitySpan.textContent);
    quantity += change;
    if (quantity < 1) {
        quantity = 1; // Ensure quantity is at least 1
    }
    quantitySpan.textContent = quantity;
}

let cart = [];

function addToCart(name, image, price, color, material, size) {
    cart.push({ name, image, price, color, material, size });
    updateCartSidebar();
    document.getElementById('cart-sidebar').classList.add('open');
}

function updateCartSidebar() {
    const cartItemsList = document.getElementById('cart-items');
    cartItemsList.innerHTML = ''; // Clear previous items

    cart.forEach(item => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `<img src="${item.image}" alt="${item.name}"><span>${item.name} - RS ${item.price}</span>`;
        cartItemsList.appendChild(listItem);
    });
}

function redirectToBuyoutFromCart() {
    if (cart.length > 0) {
        const firstItem = cart[0]; // You can modify this to handle multiple items
        const url = `buyout.php?name=${encodeURIComponent(firstItem.name)}&image=${encodeURIComponent(firstItem.image)}&price=${encodeURIComponent(firstItem.price)}&color=${encodeURIComponent(firstItem.color)}&material=${encodeURIComponent(firstItem.material)}&size=${encodeURIComponent(firstItem.size)}`;
        window.location.href = url;
    } else {
        alert('Your cart is empty.');
    }
}

function closeCart() {
    document.getElementById('cart-sidebar').classList.remove('open');
}

function toggleFavorite(button) {
    button.classList.toggle('favorited');
    const icon = button.querySelector('i');
    icon.classList.toggle('far');
    icon.classList.toggle('fas');
}

document.addEventListener("DOMContentLoaded", function () {
    const filterGroups = ["category", "size", "color", "brand", "material"];

    // Ensure only one checkbox is checked per filter group
    filterGroups.forEach(group => {
        const checkboxes = document.querySelectorAll(`input[name="${group}"]`);

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                if (this.checked) {
                    checkboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                }
                filterProducts(); // Apply filtering when a filter is selected
            });
        });
    });

    // Reset Filters
    document.getElementById("reset-filters").addEventListener("click", function () {
        document.querySelectorAll(".filter-sidebar input[type='checkbox']").forEach(checkbox => {
            checkbox.checked = false;
        });
        filterProducts(); // Refresh
    });

    // Filter Products
    window.filterProducts = function() {
        const searchBox = document.getElementById("searchBox").value.toLowerCase();
        const categoryFilters = Array.from(document.querySelectorAll("input[name='category']:checked")).map(cb => cb.value);
        const sizeFilters = Array.from(document.querySelectorAll("input[name='size']:checked")).map(cb => cb.value);
        const colorFilters = Array.from(document.querySelectorAll("input[name='color']:checked")).map(cb => cb.value);
        const brandFilters = Array.from(document.querySelectorAll("input[name='brand']:checked")).map(cb => cb.value);
        const materialFilters = Array.from(document.querySelectorAll("input[name='material']:checked")).map(cb => cb.value);

        const products = document.querySelectorAll(".pro");

        products.forEach(product => {
            const productCategory = product.dataset.category;
            const productSize = product.dataset.size;
            const productColor = product.dataset.color.toLowerCase();
            const productBrand = product.dataset.brand;
            const productMaterial = product.dataset.material;
            const productName = product.querySelector("h5").textContent.toLowerCase();

            const categoryMatch = categoryFilters.length === 0 || categoryFilters.includes(productCategory);
            const sizeMatch = sizeFilters.length === 0 || sizeFilters.includes(productSize);
            const colorMatch = colorFilters.length === 0 || colorFilters.some(color => productColor.includes(color));
            const brandMatch = brandFilters.length === 0 || brandFilters.includes(productBrand);
            const materialMatch = materialFilters.length === 0 || materialFilters.includes(productMaterial);
            const searchMatch = productName.includes(searchBox);

            if (categoryMatch && sizeMatch && colorMatch && brandMatch && materialMatch && searchMatch) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    };
});
</script>