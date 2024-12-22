<?php
session_start();

if ($_SESSION['role'] !== 'user') {
    header('Location: loginRegister.php'); 
    exit;
}

$host = 'localhost';
$dbname = 'walkon'; 
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$username = $_SESSION['username']; 

$query = "SELECT username FROM users WHERE username = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: loginRegister.php');
    exit;
}

$fullName = $user['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Welcome - Walk On</title>
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
                        <a href="userDatabase.php" class="nav__link"><b>HOME</b></a>
                    </li>

                    <li class="nav__item">
                        <a href="product.php" class="nav__link">PRODUCTS</a>
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

                <!-- Close Button -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <!-- Toggle Button -->
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-apps-2-fill"></i>
            </div>
        </nav>
    </header>
</head>
<body>
      <main>
                  <section class="home" >
                     <div class="home__container container">
                         <div class="home__data">
                             <h2 class="home__subtitle">NIKE</h2>
                             <h1 class="home__title">
                                 LUPINEK<br>
                                 FLYKNIT<br>
                                 ACG
                             </h1>
                             <p class="home__description">
                                 Designed to withstand the rigors of adverse 
                                 conditions, the Nike ACC Flyknit Lupinek combines 
                                 flyknit, Flywire and a water-resistant Defender 
                                 Repellent system in the upper.
                             </p><br>
                             <a href="#" class="home__button">BUY NOW</a>
                         </div>
                         <div class="home__images">
                             <div class="home__circle"></div>
                             <div class="home__swiper swiper">
                                 <div class="swiper-wrapper">
                                     <article class="home__article swiper-slide">
                                         <img src="assets/img/shoe-1.png" alt="" class="home__shoe">
                                     </article>
                                     <article class="home__article swiper-slide">
                                         <img src="assets/img/shoe-2.png" alt="" class="home__shoe">
                                     </article>
                                     <article class="home__article swiper-slide">
                                         <img src="assets/img/shoe-3.png" alt="" class="home__shoe">
                                     </article>
                                 </div>
                             </div>
                             <div class="swiper-pagination"></div>
                         </div>
                         <div class="home__social">
                             <a href="#" target="_blank" class="home__social-link">
                                 <i class="ri-facebook-circle-fill"></i>
                             </a>
                             <a href="#" target="_blank" class="home__social-link">
                                 <i class="ri-instagram-fill"></i>
                             </a>
                             <a href="#" target="_blank" class="home__social-link">
                                 <i class="ri-youtube-fill"></i>
                             </a>
                         </div>
                     </div>
                 </section>
               
                 
         <section id="banner" class="section-m1">
            <h1>Explore More</h1>
            <p>Winter Collection</p>
         </section>


         <section>
         <section id="product1" class="section1">

            
            <div class="Converse">
               <h2>CONVERSE</h2>
               <img src="assets/img/LOGOS/converse.png" alt="Converse Logo" class="brand-logo"> 
               <div class="pro-container">
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
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

            

            <div class="jordan">
               <h2>JORDAN</h2>
               <img src="assets/img/LOGOS/jordan.png" alt="Jordan Logo" class="brand-logo">
               <div class="pro-container">
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i> 
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
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

            <div class="puma">
               <h2>PUMA</h2>
               <img src="assets/img/LOGOS/puma.png" alt="Puma Logo" class="brand-logo">
               <div class="pro-container">
                  <div class="pro">
                     <img src="assets/img/PUMA/PUMA-x-LAMELO-BALL-LaFrancé-Assist-Men's-Shoes.png" alt="PUMA LAMELO BALL LaFrancé Assist Men's Shoes" class="product-image">
                     <div class="des">
                        <br>
                        <span>PUMA</span>
                        <br>
                        <br>
                        <h5>PUMA x LAMELO-BALL LaFrancé Assist</h5>
                     </div>
                     <h4>RS. 7500</h4>
                     <br>
                     <div class="button-container">
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i>
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
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
               <h2>ADIDAS</h2>
               <img src="assets/img/LOGOS/adidas.png" alt="Adidas Logo" class="brand-logo">
               <div class="pro-container">
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i> 
                         </button>
                     </div>
                  </div>
                  <div class="pro">
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
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i> 
                         </button>
                     </div>
                  </div>
                  <div class="pro">
                     <img src="assets/img/ADIDAS/gazelle-bold-shoes.jpeg" alt="gazelle bold shoes" class="product-image">
                     <div class="des">
                        <br>
                        <span>ADIDAS</span>
                        <br>
                        <br>
                        <h5>gazelle bold shoes</h5>
                     </div>
                     <h4>RS. 4500</h4>
                     <br>
                     <div class="button-container">
                         <button class="cart-button" onclick="toggleCart(this)">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                         </button>
                         <button class="favorite-button" onclick="toggleFavorite(this)">
                             <i class="far fa-heart"></i> 
                         </button>
                     </div>
                  </div>
                  <div class="pro">
                     <img src="assets/img/ADIDAS/vl-court-3.0-dia-de-los-muertos-shoes.jpeg" alt="c" class="product-image">
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
                         <button class="cart-button" onclick="toggleCart(this)">
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
         </section>
      </main>


      <section id="Contactbanner" class="section-01">
         <h1>BUY 1 GET 20% OFF</h1>
         <p>On Winter Collection</p>
         <button class="contactbannerbutton">
             <a href="product.html" >BUY NOW</a>
         </button>
         
     </section>

      <section class="footer">
         <div class="footer-info">

               <div class="first-info">
                  <h1 class="footer__title">WalkOn</h1>
                  <p>Khairahani, Parsa</p>
                  <p>9812345678</p>
                  <p>walkon@gmail.com</p>

                  <div class="social-icon">
                     <p><a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAU1JREFUSEu1VYFtAyEM9G3STNJmk2aStJM0nSTdpOkkzt8LLD+YB5TGUsQrgM/2nQ3kyYYn+5cugKq+iQh/r2m9LeuPiPxxBcDvpjUBVPVFRL6S0z0fBDwC4FpZCKCqHyJynigfnX8D4L2NVQATzumUWXr7LEE2AKksvzuR0ymdXPKZIiDunzwvJcC1U/NDWesg4xuAQw7AAFT1PZHaSuAC4OQiZ3l4J6vL3yPpq7o8QI9Yq+9AMHbWA1CSjKhlrO1a+wEhsD+OZQYkt1SFB5sBMB58BhHAhrAoNVUNhYFFr2UG0cERgCgwE0SP5HUMrJG4UZD6JScU9U0IwIHGLP6DZONrptFGSTYFbThI8qOKWqNiFMCarALoaHwEYH/YNQZY/rsHYPuexJkHpwVQTdAhgGCo2fOYZhH5ohzDl6yapjvyfGir++g/5H25fAcXRb0Zoc7OswAAAABJRU5ErkJggg=="/></a>
                     <a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAASlJREFUSEvlVcsVwjAMszehkwCT0E4CTAJMAkwCm4ioz3mk+TU5cCKXNK1tObLsqvx46Y/jy58CANiJyFFENkbxTVVPAHge+eypX1AE4C4ik6q+S7UBMIrIJfOdPgSg/7UEAJcBDeeMciAAaFNa9H2YP/dvke16r8Dz7DK6hrepZB8C7lV1Dr4A4MEoIr9+MaP5RraTghw93p4JTSFaXAPyGxavt03KABmKeoPTflHgFop6QYZYgTFF5JhS9fruAlAnvdgheWFNdGDDdEXP0JNQZEoqNVIN762qQ84gO+xcL7HJqKbWtdB+UabhBz9XGoAS5VQBLDBteIO1OhQzTzrZArcqiKOgOhQTACsw5clRsTWphnLlyHjG82mtSH/6R1ujpUmmPUFqth9jNG4ZtZXXXAAAAABJRU5ErkJggg=="/></a>
                     <a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAYtJREFUSEvFVTtOw0AUnKmp6aFHIC4A5BhIFKRFAokTQG4ACGoSCYmeCxBugLgAoaKgp6B57CzPVrJ2TNZWlNf583Zm3meWWHJwyedjNQBmtgHgGMA+gIMGlRP/NgYwIFk8lykVBWamg+9blE6Hj0heTufOADjz9xaHFykC6ZOUohgpgJhLQU70vIwXnjQk2Z8HIPaqf10MA7uPQEAs1RsRmZDcTMo6JinQWgVWc3Ip28zWo2zyy8v57P9Pk4qgOQBi8wPgyJmLxAuABwCfACo9Y+j0ogCxnoH5HYCTRN0tyVMzk4qZUc4BULOenPFWAvBGcsfMNJZFg//qnqFgAOAmlEYstxOAV5K7XQHiRJjZNYCzBOCK5LmZVUY7R0GcIADfAA4B7DmImvwIYM3VzWDnACixsp16aWZqbDGmCwNUJsIzBaL116IpmkywcdHaWEW6m41WoY3sYnYC6801O69tW7tWupxUnlVG7Y3mPqPlkaKmC6cYglH4V6X5/8KpMbtOr1ZzJ3einCT/Agxmohk4DnrvAAAAAElFTkSuQmCC"/></a>
                     <a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAOtJREFUSEvtVAEOgjAM7P1Ef6I/kZfoT+Qn8hPhJZVb1gXIJB0TExOXLEBYe7vrtZCdF3bOL98FUNWHiJwqWfUAjpZjxkBVtTJ5CAeQ8q4BdCLSj/tSCuoBaAE0TLxFNg9AB+AcAe6lLDwAlIYSDSOJ6x4SEYCb6xA3Ae2bTzvD/zPneRhMaxAksiBVDckAGCDrdJsyrQLIyaWqZPFM3nfY9C2DhbMaAO3SbVUMokTseK6snWsB2HisyxIg2fkP8BGJrJOpM31PGwa3xHdrrNw59zQtnRDp/FqRiwdb5hZpUIaO33xNZ+DvA7wAYwXNGdbfQxoAAAAASUVORK5CYII="/></a></p>
                  </div>
               </div><br>

               <div class="second-info">
                  <h4>Support</h4>
                  <p>Contact Us</p>
                  <p>About Page</p>
                  <p>Size Guide</p>
                  <p>Shopping and Returns</p>
                  <p>Privacy</p><br>
               </div>

               <div class="third-info">
                  <h4>Shop</h4>
                  <p>Men's Shopping</p>
                  <p>Women's Shopping</p>
                  <p>Kid's Shopping</p>
                  <p>Discount</p><br>
               </div>

               <div class="fourth-info">
                  <h4>Company</h4>
                  <p>About</p>
                  <p>Login</p><br>
               </div>

               <div class="fifth-info">
                  <h4>Subscribe</h4>
                  <p>Receive Updates, Hot Deals, Discounts Sent Straight In Your Inbox Daily</p>
               </div>

               
         </div>
      </section>
      <div class="end-text">
         <p>Copyright © @2025. All Right Reserved. Designed By Anish Kumar Lama, Sanisha Sapkota.</p>
      </div>

      
   </section>
   </main>
      <script src="assets/js/swiper-bundle.min.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="assets/js/cart.js"></script>
   </body>
</body>
</html>