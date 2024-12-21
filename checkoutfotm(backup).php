<?php
session_start(); 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "walkon";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $thank_you_message = ''; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $street = $_POST['street'];
        $cod = isset($_POST['cod']) ? 'COD' : 'Online Payment'; 

        $product_id = 1; 
        $quantity = 1; 

        $username = $_SESSION['username']; 

        $query = "SELECT username FROM users WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $productStmt = $pdo->prepare("SELECT price FROM product WHERE product_id = ?");
        $productStmt->execute([$product_id]);
        $product = $productStmt->fetch();
        $product_price = $product['price'];

        $total_price = $product_price * $quantity;

        $stmt = $pdo->prepare("INSERT INTO user_orders (user_id, product_id, quantity, total_price, name, phone, email, address, district, street, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([null, $product_id, $quantity, $total_price, $name, $phone, $email, $address, $district, $street, $cod]);

        $thank_you_message = '<div class="thank-you-message">
                                <h2>Thank You for Your Purchase!</h2>
                                <p>We appreciate your order. Our team will contact you soon.</p>
                                <a href="userDashboard.php" class="btn">Back to Home</a>
                              </div>';
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
    <title>Walk On - Checkout</title>

    <link rel="stylesheet" href="assets/css/styles.css">
    
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
            height: 100px;
            resize: none; 
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
                <input type="checkbox" id="cod" name="cod">
                <label for="cod">Cash on Delivery</label>
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
