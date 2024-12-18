<?php
session_start(); // Start session at the beginning

// Database connection
$servername = "localhost"; // change to your server if necessary
$username = "root"; // change to your database username
$password = ""; // change to your database password
$dbname = "walkon"; // change to your database name

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $thank_you_message = ''; // Initialize the thank you message

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form was submitted already
        if (!isset($_SESSION['form_submitted'])) {
            $_SESSION['form_submitted'] = true;

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $district = $_POST['district'];
            $street = $_POST['street'];
            $cod = isset($_POST['cod']) ? 'COD' : 'Online Payment'; // COD or Online Payment

            // Assuming product_id = 1, adjust as necessary
            $product_id = 1; 
            $quantity = 1; // Default quantity, you can expand as per your requirements

            // Fetch product price
            $productStmt = $pdo->prepare("SELECT price FROM product WHERE product_id = ?");
            $productStmt->execute([$product_id]);
            $product = $productStmt->fetch();
            $product_price = $product['price'];

            $total_price = $product_price * $quantity;

            // Insert into user_orders
            $stmt = $pdo->prepare("INSERT INTO user_orders (user_id, product_id, quantity, total_price, name, phone, email, address, district, street, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([null, $product_id, $quantity, $total_price, $name, $phone, $email, $address, $district, $street, $cod]);

            // Show thank you message after successful form submission
            $thank_you_message = '<div class="thank-you-message">
                                    <h2>Thank You for Your Purchase!</h2>
                                    <p>We appreciate your order. Our team will contact you soon.</p>
                                    <a href="userDashboard.php" class="btn">Back to Home</a>
                                  </div>';
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
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

        .thank-you-message {
            text-align: center;
            color: var(--text-color);
        }

        .thank-you-message h2 {
            font-size: 24px;
            color: #333;
        }

        .thank-you-message p {
            font-size: 18px;
            color: #555;
        }

        .thank-you-message a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #3a42bb;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .thank-you-message a:hover {
            background-color: #505050;
        }
    </style>
</head>
<body>

<?php
// Your existing PHP code for form submission
?>

<div class="checkout-container">
    <div class="checkout-form">
        <h2>Checkout</h2>

        <?php if ($thank_you_message == ''): ?>
            <form action="" method="post">
                <div class="input-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="input-group">
                    <label for="district">District</label>
                    <input type="text" id="district" name="district" required>
                </div>

                <div class="input-group">
                    <label for="street">Street</label>
                    <input type="text" id="street" name="street" required>
                </div>

                <div class="input-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="cod" name="cod">
                        <label for="cod">Cash on Delivery</label>
                    </div>
                </div>

                <button type="submit" class="checkout-btn">Place Order</button>
            </form>
        <?php else: ?>
            <?= $thank_you_message ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
