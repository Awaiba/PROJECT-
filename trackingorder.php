<?php
session_start();

// Redirect to login page if not logged in or role is not 'user'
if (!isset($_SESSION['username'])) {
    header('Location: loginRegister.php'); // Redirect if not logged in
    exit;
}

$username = $_SESSION['username']; // Assuming username is stored in session

// Other database checks, if required, can be placed here
// Include database connection
$host = 'localhost'; // or your database host
$dbname = 'walkon'; // your database name
$username = 'root'; // your database username
$password = ''; // your database password (empty if no password)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    // If connection fails, handle the error
    die("Database connection failed: " . $e->getMessage());
}

// Get user information from session
$user_id = $_SESSION['user_id']; // Get the user ID from session

// Fetch all orders for the user
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

if ($orders) {
    // Display all orders in a table
    echo "<h1>Order Details</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Order ID</th><th>Product Name</th><th>Brand</th><th>Material</th><th>Color</th><th>Size</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Customer Name</th><th>Phone</th><th>Email</th><th>Address</th><th>District</th><th>Street</th><th>Payment Method</th><th>Ordered On</th></tr>";

    foreach ($orders as $order) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($order['order_id']) . "</td>";
        echo "<td>" . htmlspecialchars($order['product_name']) . "</td>";
        echo "<td>" . htmlspecialchars($order['brand']) . "</td>";
        echo "<td>" . htmlspecialchars($order['material']) . "</td>";
        echo "<td>" . htmlspecialchars($order['color']) . "</td>";
        echo "<td>" . htmlspecialchars($order['size']) . "</td>";
        echo "<td>" . htmlspecialchars($order['price']) . "</td>";
        echo "<td>" . htmlspecialchars($order['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($order['total_price']) . "</td>";
        echo "<td>" . htmlspecialchars($order['name']) . "</td>";
        echo "<td>" . htmlspecialchars($order['phone']) . "</td>";
        echo "<td>" . htmlspecialchars($order['email']) . "</td>";
        echo "<td>" . htmlspecialchars($order['address']) . "</td>";
        echo "<td>" . htmlspecialchars($order['district']) . "</td>";
        echo "<td>" . htmlspecialchars($order['street']) . "</td>";
        echo "<td>" . htmlspecialchars($order['payment_method']) . "</td>";
        echo "<td>" . htmlspecialchars($order['created_at']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No orders found for your account.</p>";
}
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
    <h2>Your Orders</h2>
</body>
</html>
