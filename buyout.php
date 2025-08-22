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
      <style>
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
        </style>
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



        <?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$transaction_uuid = time() . generateRandomString(16);
$product_code = 'EPAYTEST';
$product_service_charge = 0;
$product_delivery_charge = 0;
$secretKey = '8gBm/:&EnhH.1/q';

$message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
$signature = base64_encode(hash_hmac('sha256', $message, $secretKey, true));
?>

    <main>
        <section class="product-details">
            <h1>Product Buyout</h1>

            <div class="product-info">
                <img id="product-image" src="" alt="Product Image">
                <h2 id="product-name">Product Name</h2>
                <p class="price" id="product-price">Product Price</p>
            </div>

        </section>

        <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the query parameters
        const params = new URLSearchParams(window.location.search);
        const productName = params.get('name');
        const productImage = params.get('image');
        const productPrice = params.get('price');

        // Update product details in the DOM
        document.getElementById('product-name').innerText = decodeURIComponent(productName);
        document.getElementById('product-image').src = decodeURIComponent(productImage);
        document.getElementById('product-price').innerText = decodeURIComponent(productPrice);
        console.log(decodeURIComponent(productPrice));

        // Set the price value
        var priceValue = parseFloat(decodeURIComponent(productPrice));
        console.log(priceValue);

        // Set the form input fields with the price and other parameters
        document.getElementById('amount').value = priceValue;
        document.getElementById('total_amount').value = priceValue;

        // Using PHP-generated values
        const transaction_uuid = <?php echo json_encode($transaction_uuid); ?>;
        const product_code = <?php echo json_encode($product_code); ?>;
        const product_service_charge = <?php echo json_encode($product_service_charge); ?>;
        const product_delivery_charge = <?php echo json_encode($product_delivery_charge); ?>;
        const secretKey = '8gBm/:&EnhH.1/q';  // Secret key must be consistent

        // Create the message string for signature (must match PHP message construction)
        const message = `total_amount=${priceValue},transaction_uuid=${transaction_uuid},product_code=${product_code}`;
        
        // Generate the HMAC-SHA256 signature in JavaScript (using Web Crypto API)
        const encoder = new TextEncoder();
        const key = encoder.encode(secretKey);
        const data = encoder.encode(message);

        window.crypto.subtle.importKey('raw', key, { name: 'HMAC', hash: { name: 'SHA-256' } }, false, ['sign'])
            .then((cryptoKey) => {
                return window.crypto.subtle.sign('HMAC', cryptoKey, data);
            })
            .then((signatureBuffer) => {
                const signatureArray = new Uint8Array(signatureBuffer);
                const signature = btoa(String.fromCharCode.apply(null, signatureArray));

                // Set the signature in the form
                document.getElementById('signature').value = signature;
                document.getElementById('transaction_uuid').value = transaction_uuid;
                document.getElementById('product_code').value = product_code;
                document.getElementById('product_service_charge').value = product_service_charge;
                document.getElementById('product_delivery_charge').value = product_delivery_charge;
            })
            .catch((error) => {
                console.error('Error generating signature:', error);
            });

        // Add event listener for the checkout button
        document.querySelector('.buy-btn').addEventListener('click', function() {
            window.location.href = 'checkoutform.php'; 
        });
    });
</script>


    </main>









<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <div style="display:none">
    <input type="text" id="amount" name="amount"  required>
    <input type="text" id="tax_amount" name="tax_amount" value="0"  required>
    <input type="text" id="total_amount" name="total_amount"  required>
    <input type="text" id="transaction_uuid" name="transaction_uuid" required>
    <input type="text" id="product_code" name="product_code" required>
    <input type="text" id="product_service_charge" name="product_service_charge"  required>
    <input type="text" id="product_delivery_charge" name="product_delivery_charge" required>
    <input type="text" id="success_url" name="success_url" value="https://developer.esewa.com.np/success" required>
    <input type="text" id="failure_url" name="failure_url" value="https://developer.esewa.com.np/failure" required>
    <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
    <input type="text" id="signature" name="signature"  required>

    </div>
    <input value="Proceed to Checkout" class="buy-btn" type="submit">
</form>



























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