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
                        <a href="trackingorder.php" class="nav__link"><?php echo htmlspecialchars($username); ?></a>
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
   </head>
   <body>
            <main>
            <section class="productandsidebar">
            <aside class="filter-sidebar">
                <h2>Filter Products</h2>
                    <div class="filter-category">
                    <h3>Category</h3>
                    <ul>
                        <li><input type="checkbox" id="men" name="category" value="men" aria-label="Filter Men's Shoes"><label for="men">Men's Shoes</label></li>
                        <li><input type="checkbox" id="women" name="category" value="women" aria-label="Filter Women's Shoes"><label for="women">Women's Shoes</label></li>
                        <li><input type="checkbox" id="kids" name="category" value="kids" aria-label="Filter Kids' Shoes"><label for="kids">Kids' Shoes</label></li>
                    </ul>
                </div>
                    <div class="filter-size">
                    <h3>Size</h3>
                    <ul>
                        <li><input type="checkbox" id="size-6" name="size" value="6" aria-label="Filter size 6"><label for="size-6">6</label></li>
                        <li><input type="checkbox" id="size-7" name="size" value="7" aria-label="Filter size 7"><label for="size-7">7</label></li>
                        <li><input type="checkbox" id="size-8" name="size" value="8" aria-label="Filter size 8"><label for="size-8">8</label></li>
                        <li><input type="checkbox" id="size-9" name="size" value="9" aria-label="Filter size 9"><label for="size-9">9</label></li>
                        <li><input type="checkbox" id="size-10" name="size" value="10" aria-label="Filter size 10"><label for="size-10">10</label></li>
                    </ul>
                </div>
                    <div class="filter-color">
                    <h3>Color</h3>
                    <ul>
                        <li><input type="checkbox" id="black" name="color" value="black" aria-label="Filter Black color"><label for="black">Black</label></li>
                        <li><input type="checkbox" id="white" name="color" value="white" aria-label="Filter White color"><label for="white">White</label></li>
                        <li><input type="checkbox" id="red" name="color" value="red" aria-label="Filter Red color"><label for="red">Red</label></li>
                        <li><input type="checkbox" id="blue" name="color" value="blue" aria-label="Filter Blue color"><label for="blue">Blue</label></li>
                        <li><input type="checkbox" id="grey" name="color" value="grey" aria-label="Filter Grey color"><label for="grey">Grey</label></li>
                    </ul>
                </div>
                    <div class="filter-brand">
                    <h3>Brand</h3>
                    <ul>
                        <li><input type="checkbox" id="nike" name="brand" value="nike" aria-label="Filter Nike"><label for="nike">Nike</label></li>
                        <li><input type="checkbox" id="adidas" name="brand" value="adidas" aria-label="Filter Adidas"><label for="adidas">Adidas</label></li>
                        <li><input type="checkbox" id="puma" name="brand" value="puma" aria-label="Filter Puma"><label for="puma">Puma</label></li>
                        <li><input type="checkbox" id="reebok" name="brand" value="reebok" aria-label="Filter Reebok"><label for="reebok">Reebok</label></li>
                    </ul>
                </div>
                    <div class="filter-price">
                    <h3>Price</h3>
                    <input type="range" id="price-range" name="price" min="0" max="10000" value="250" step="10" aria-label="Filter Price Range">
                    <label for="price-range">Price: $<span id="price-min">0</span> - $<span id="price-max">10000</span></label>
                </div>
                    <div class="filter-material">
                    <h3>Material</h3>
                    <ul>
                        <li><input type="checkbox" id="leather" name="material" value="leather" aria-label="Filter Leather"><label for="leather">Leather</label></li>
                        <li><input type="checkbox" id="synthetic" name="material" value="synthetic" aria-label="Filter Synthetic"><label for="synthetic">Synthetic</label></li>
                        <li><input type="checkbox" id="mesh" name="material" value="mesh" aria-label="Filter Mesh"><label for="mesh">Mesh</label></li>
                        <li><input type="checkbox" id="canvas" name="material" value="canvas" aria-label="Filter Canvas"><label for="canvas">Canvas</label></li>
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
            <br>
            <br>
            <h5>Air Jordan 1 Low SE</h5>
         </div>
         <h4>RS. 6000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Air Jordan 1 Low SE', 'assets/img/JORDAN/AIR+JORDAN+1+LOW+SE.png', '6000', 'Blue', 'Leather', '9')">
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
            <br>
            <br>
            <h5>Air Jordan 1 Low</h5>
         </div>
         <h4>RS. 5500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Air Jordan 1 Low', 'assets/img/JORDAN/AIR+JORDAN+1+LOW.png', '5500', 'Black', 'Leather', '9')">
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
            <br>
            <br>
            <h5>Air Jordan 1 Mid</h5>
         </div>
         <h4>RS. 8000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Air Jordan 1 Mid', 'assets/img/JORDAN/AIR+JORDAN+1+MID.png', '8000', 'White', 'Leather', '9')">
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
            <br>
            <br>
            <h5>Jordan Max Aura</h5>
         </div>
         <h4>RS. 8400</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Jordan Max Aura', 'assets/img/JORDAN/JORDAN+MAX+AURA+5.png', '8400', 'Red, White', 'Leather', '9')">
               <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
            <button class="favorite-button" onclick="toggleFavorite(this)">
               <i class="far fa-heart"></i>
            </button>
         </div>
      </div>
   </div>
</div>
<script>
   function redirectToBuyout(name, image, price, color, material, size) {
      const url = `buyout.php?name=${encodeURIComponent(name)}&image=${encodeURIComponent(image)}&price=${encodeURIComponent(price)}&color=${encodeURIComponent(color)}&material=${encodeURIComponent(material)}&size=${encodeURIComponent(size)}`;
      window.location.href = url;
   }
</script>
               <br><br> 
                  <div class="puma">
   <div class="pro-container">
      <div class="pro" data-category="men" data-brand="puma" data-price="7500" data-material="leather" data-color="green" data-size="7">
         <img src="assets/img/PUMA/PUMA-x-LAMELO-BALL-LaFrancé-Assist-Men's-Shoes.png" alt="PUMA LAMELO BALL LaFrancé Assist Men's Shoes" class="product-image">
         <div class="des">
            <br>
            <span>PUMA</span>
            <br>
            <br>
            <h5>PUMA x LAMELO BALL LaFrancé Assist</h5>
         </div>
         <h4>RS. 7500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('PUMA x LAMELO BALL LaFrancé Assist', 'assets/img/PUMA/PUMA-x-LAMELO-BALL-LaFrancé-Assist-Men%27s-Shoes.png', '7500', 'Green', 'Leather', '7')">
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
            <br>
            <br>
            <h5>PUMA x LAMELO BALL MB</h5>
         </div>
         <h4>RS. 7500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('PUMA x LAMELO BALL MB', 'assets/img/PUMA/PUMA-x-LAMELO-BALL-MB.png', '7500', 'Orange', 'Leather', '8')">
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
            <br>
            <br>
            <h5>PUMA x LMC GV Special</h5>
         </div>
         <h4>RS. 4500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('PUMA x LMC GV Special', 'assets/img/PUMA/PUMA-x-LMC-GV-Special-Men%27s-Sneakers.png', '4500', 'Grey', 'Leather', '7')">
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
            <br>
            <br>
            <h5>Suede XL Día De Los Muertos</h5>
         </div>
         <h4>RS. 5000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Suede XL Día De Los Muertos', 'assets/img/PUMA/Suede-XL-Día-De-Los-Muertos-Men%27s-Sneakers.png', '5000', 'Orange', 'Leather', '6')">
               <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
            <button class="favorite-button" onclick="toggleFavorite(this)">
               <i class="far fa-heart"></i>
            </button>
         </div>
      </div>
   </div>
</div>

<script>
   function redirectToBuyout(name, image, price, color, material, size) {
      const url = `buyout.php?name=${encodeURIComponent(name)}&image=${encodeURIComponent(image)}&price=${encodeURIComponent(price)}&color=${encodeURIComponent(color)}&material=${encodeURIComponent(material)}&size=${encodeURIComponent(size)}`;
      window.location.href = url;
   }
</script>
               <br><br> 
                   <div class="Converse">
   <div class="pro-container">
      <div class="pro" data-category="men" data-brand="Converse" data-price="5000" data-material="leather" data-color="black" data-size="9">
         <img src="assets/img/CONVERSE/Chuck 70 Canvas.png" alt="Converse Chuck 70 Canvas shoe" class="product-image">
         <div class="des">
            <br>
            <span>Converse</span>
            <br>
            <br>
            <h5>Chuck 70 Canvas</h5>
         </div>
         <h4>RS. 5000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Converse Chuck 70 Canvas', 'assets/img/CONVERSE/Chuck 70 Canvas.png', '5000', 'Black', 'Leather', '9')">
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
            <br>
            <br>
            <h5>Chuck Taylor All Star Glitter</h5>
         </div>
         <h4>RS. 4000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Converse Chuck Taylor All Star Glitter', 'assets/img/CONVERSE/Chuck Taylor All Star Glitter.png', '4000', 'Black', 'Leather', '9')">
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
            <br>
            <br>
            <h5>All Star Lugged Heel</h5>
         </div>
         <h4>RS. 5500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Converse All Star Lugged Heel', 'assets/img/CONVERSE/Chuck Taylor All Star Lugged Heel Platform.png', '5500', 'Black', 'Leather', '9')">
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
            <br>
            <br>
            <h5>CHUCK TAYLOR</h5>
         </div>
         <h4>RS. 3500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Converse CHUCK TAYLOR', 'assets/img/CONVERSE/CHUCK taylor.jpg', '3500', 'White', 'Leather', '9')">
               <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
            <button class="favorite-button" onclick="toggleFavorite(this)">
               <i class="far fa-heart"></i>
            </button>
         </div>
      </div>
   </div>
</div>

<script>
   function redirectToBuyout(name, image, price, color, material, size) {
      const url = `buyout.php?name=${encodeURIComponent(name)}&image=${encodeURIComponent(image)}&price=${encodeURIComponent(price)}&color=${encodeURIComponent(color)}&material=${encodeURIComponent(material)}&size=${encodeURIComponent(size)}`;
      window.location.href = url;
   }
</script>
   <br><br>                
   <div class="adidas">
   <div class="pro-container">
      <div class="pro" data-category="men" data-brand="adidas" data-price="5000" data-material="leather" data-color="orange" data-size="9">
         <img src="assets/img/ADIDAS/handball-spezial-shoes.jpeg" alt="handball spezial shoes" class="product-image">
         <div class="des">
            <br>
            <span>ADIDAS</span>
            <br>
            <br>
            <h5>Handball Spezial Shoes</h5>
         </div>
         <h4>RS. 5000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Adidas Handball Spezial Shoes', 'assets/img/ADIDAS/handball-spezial-shoes.jpeg', '5000', 'Orange', 'Leather', '9')">
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
            <br>
            <br>
            <h5>Samba Og Shoes</h5>
         </div>
         <h4>RS. 4000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Adidas Samba Og Shoes', 'assets/img/ADIDAS/samba-og-shoes.jpeg', '4000', 'White', 'Leather', '7')">
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
            <br>
            <br>
            <h5>Gazelle Bold Shoes</h5>
         </div>
         <h4>RS. 4500</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Adidas Gazelle Bold Shoes', 'assets/img/ADIDAS/gazelle-bold-shoes.jpeg', '4500', 'Black', 'Leather', '6')">
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
            <br>
            <br>
            <h5>Dia-De-Los-Muertos</h5>
         </div>
         <h4>RS. 4000</h4>
         <br>
         <div class="button-container">
            <button class="cart-button" onclick="redirectToBuyout('Adidas Dia-De-Los-Muertos', 'assets/img/ADIDAS/vl-court-3.0-dia-de-los-muertos-shoes.jpeg', '4000', 'Black', 'Leather', '6')">
               <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
            <button class="favorite-button" onclick="toggleFavorite(this)">
               <i class="far fa-heart"></i>
            </button>
         </div>
      </div>
   </div>
</div>

<script>
   function redirectToBuyout(name, image, price, color, material, size) {
      const url = `buyout.php?name=${encodeURIComponent(name)}&image=${encodeURIComponent(image)}&price=${encodeURIComponent(price)}&color=${encodeURIComponent(color)}&material=${encodeURIComponent(material)}&size=${encodeURIComponent(size)}`;
      window.location.href = url;
   }
   </script>
   <br><br> 
      </section>
      </main>
   </section>
   </main>
      <script src="assets/js/swiper-bundle.min.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="assets/js/cart.js"></script>
      <script src="assets/js/sbjs.js"></script>

   </body>
</html>