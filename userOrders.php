<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: loginForm.php'); 
    exit;
}

// Database connection
$host = 'localhost'; 
$dbname = 'walkon'; 
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch user's orders
$user_id = $_SESSION['user_id'];

$query = "SELECT user_orders.order_id, user_orders.quantity, user_orders.total_price, user_orders.name, user_orders.phone, user_orders.email, 
               user_orders.address, user_orders.district, user_orders.street, user_orders.payment_method, user_orders.created_at, 
               product.name AS product_name, product.brand, product.price, product.material, product.color, product.size 
        FROM user_orders 
        JOIN product ON user_orders.product_id = product.product_id 
        WHERE user_orders.user_id = :user_id";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                        <a href="userDatabase.php" class="nav__link">HOME</a>
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
        body{
        padding-top: 110px;
        padding-left: 100px;
        }
        h2{
            color: black;
        }
        th{
            color: black;
        }
        .tablebox{
            padding: 7px;
        }
    </style>
</head>
<body>
    <h2>Your Orders</h2>
<br>
<div class="tablebox">
    <?php if ($orders): ?>
        <table class="table" border=".5">
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Material</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>District</th>
                <th>Street</th>
                <th>Payment Method</th>
                <th>Ordered On</th>
            </tr>

            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['brand']); ?></td>
                    <td><?php echo htmlspecialchars($order['material']); ?></td>
                    <td><?php echo htmlspecialchars($order['color']); ?></td>
                    <td><?php echo htmlspecialchars($order['size']); ?></td>
                    <td><?php echo htmlspecialchars($order['price']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                    <td><?php echo htmlspecialchars($order['phone']); ?></td>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                    <td><?php echo htmlspecialchars($order['district']); ?></td>
                    <td><?php echo htmlspecialchars($order['street']); ?></td>
                    <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                    <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else: ?>
        <p>No orders found for your account.</p>
    <?php endif; ?>
</div>
</body>
</html>
