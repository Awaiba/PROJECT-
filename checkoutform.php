<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- Font Awesome CDN -->
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
                     <a href="index.php" class="nav__link"><b>HOME</b></a>
                  </li>

                  <li class="nav__item">
                     <a href="product.php" class="nav__link">PRODUCTS</a>
                  </li>

                  <li class="nav__item">
                     <a href="contact.php" class="nav__link">CONTACT</a>
                  </li>
                  
                  <li class="nav__item">
                     <a href="loginRegister.php" class="nav__link">Login</a>
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
    <style>
        body {
            font-family: var(--body-font);
            background-color: var(--body-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .checkout-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .checkout-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 375px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--title-color);
            font-family: var(--second-font);
            font-size: 40px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: var(--normal-font-size);
            margin-bottom: 5px;
            color: var(--text-color);
            font-family: var(--body-font);
        }

        .input-group input, 
        .input-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
            font-family: var(--body-font);
        }

        .input-group input:focus, 
        .input-group textarea:focus {
            border-color: #111111;
        }

        .input-group textarea {
            height: 100px; /* Optional: Adjust height for textarea */
            resize: none; /* Optional: Prevent resizing */
        }

        .input-group .checkbox-group {
            display: flex;
            align-items: center;
        }

        .input-group .checkbox-group input {
            width: auto;
            margin-right: 8px;
        }

        .checkout-btn {
            width: 100%;
            padding: 12px;
            background-color: #202020;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: var(--body-font);
        }

        .checkout-btn:hover {
            background-color: #505050;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #3a42bb;
            font-size: var(--normal-font-size);
            font-family: var(--body-font);
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .register {
            text-align: center;
            margin-top: 10px;
        }

        .register a {
            text-decoration: none;
            color: #3a42bb;
            font-size: var(--normal-font-size);
            font-family: var(--body-font);
        }

        .register a:hover {
            text-decoration: underline;
        }
        .input-group {
            margin-bottom: 20px;
        }

        .input-group .option {
            display: flex;
            align-items: center; /* Align items vertically centered */
        }

        .input-group .option input {
            width: auto; /* Keep the checkbox width to a minimum */
            margin-right: 8px; /* Add some spacing between the checkbox and label */
        }

        .input-group .option label {
            font-size: var(--normal-font-size);
            color: var(--text-color);
            font-family: var(--body-font);
}
    </style>
</head>
<body>
    <div class="checkout-container">
        <div class="checkout-form">
            <h2>Checkout</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter your address" required>
                </div>
                <div class="input-group">
                    <label for="district">District</label>
                    <input type="text" id="district" name="district" placeholder="Enter your district" required>
                </div>
                <div class="input-group">
                    <label for="street">Street Name</label>
                    <input type="text" id="street" name="street" placeholder="Enter your street name" required>
                </div>
                <div class="input-group">
                <div class="option">
                    <input type="checkbox" id="cod" name="cod" value="COD">
                    <label for="cod">Cash on Delivery</la>
                </div>
                </div>

                <button type="submit" class="checkout-btn">Proceed</button>
            </form>
        </div>
    </div>
</body>
</html>
