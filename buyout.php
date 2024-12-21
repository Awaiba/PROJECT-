<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: loginRegister.php'); 
    exit;
}

$username = $_SESSION['username']; 

?><!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
      <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
      <link rel="stylesheet" href="assets/css/contactCss.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <title>WalkOn | Contacts</title>
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
                        <a href="product.php" class="nav__link">PRODUCTS</a>
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
      <style>
        * {
            --body-font: "Poppins", sans-serif;
        }
        .body {
            font-family: var(--body-font);
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        section {
            padding: 20px;
            background-color: white;
            margin: 20px;
            border-radius: 8px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h1, h2 {
            text-align: center;
        }

        .product-image {
            width: 100%; 
            max-width: 300px; 
            height: auto; 
            border-radius: 8px;
            margin: 0 auto; 
            display: block; 
         }  


        .product-description {
            font-display: center;
        }

        .price {
            font-size: 24px;
            color: #2470c2;
            text-align: center;
            font-weight: bold;
        }

        .buy-btn {
            display: block;
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        .buy-btn:hover {
            background-color: #0056b3;
        }
    </style>
   </head>
<body>
<section id="Contactbanner" class="section-01">
            <h1>Walk On</h1>
            <p>Footware For Everyone</p>
            <button class="contactbannerbutton">
                <a href="product.php" >E-mail</a>
            </button>
        </section>



    <main>
        <section class="product-details">
            <h1>Product Buyout</h1>

            <div class="product-info">
                <img id="product-image" src="" alt="Product Image">
                <h2 id="product-name">Product Name</h2>
                <p class="price" id="product-price">Product Price</p>
            </div>

            <button class="buy-btn">Proceed to Checkout</button>
        </section>

        <script>
            const params = new URLSearchParams(window.location.search);
            const productName = params.get('name');
            const productImage = params.get('image');
            const productPrice = params.get('price');

            document.getElementById('product-name').innerText = decodeURIComponent(productName);
            document.getElementById('product-image').src = decodeURIComponent(productImage);
            document.getElementById('product-price').innerText = decodeURIComponent(productPrice);

            document.querySelector('.buy-btn').addEventListener('click', function() {
                window.location.href = 'checkoutform.php'; 
            });
        </script>
    </main>

    <section class="footer">
         <div class="footer-info">

               <div class="first-info">
                  <h1 class="footer__title">Walk On</h1>
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
      </body>
      </head>
      </html>