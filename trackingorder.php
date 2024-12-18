<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: loginRegister.php'); // Redirect if not logged in
    exit;
}

// Database connection settings
$host = 'localhost';
$dbname = 'walkon'; // Your database name
$username = 'your_username'; // Replace with your DB username
$password = 'your_password'; // Replace with your DB password

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get logged-in user's username from session
$userEmail = $_SESSION['username']; // Assuming email is stored in session as username

// Query to fetch orders for the logged-in user
$stmt = $pdo->prepare("SELECT * FROM user_orders WHERE email = :email");
$stmt->execute([':email' => $userEmail]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if orders exist
if ($orders) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Order ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Order Date</th>
          </tr>";

    foreach ($orders as $order) {
        echo "<tr>
                <td>" . htmlspecialchars($order['order_id']) . "</td>
                <td>" . htmlspecialchars($order['name']) . "</td>
                <td>" . htmlspecialchars($order['phone']) . "</td>
                <td>" . htmlspecialchars($order['address']) . ", " . htmlspecialchars($order['district']) . ", " . htmlspecialchars($order['street']) . "</td>
                <td>" . htmlspecialchars($order['product_id']) . "</td>
                <td>" . htmlspecialchars($order['quantity']) . "</td>
                <td>$" . htmlspecialchars($order['total_price']) . "</td>
                <td>" . htmlspecialchars($order['payment_method']) . "</td>
                <td>" . htmlspecialchars($order['created_at']) . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No orders found for this user.</p>";
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
                        <a href="userDatabase.php" class="nav__link">HOME</a>
                    </li>

                    <li class="nav__item">
                        <a href="product.php" class="nav__link">PRODUCTS</a>
                    </li>

                    <li class="nav__item">
                        <a href="contact.php" class="nav__link">CONTACT</a>
                    </li>

                    <li class="nav__item">
                        <a href="trackingorder.php" class="nav__link"><b><?php echo htmlspecialchars($username); ?></b></a>
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
    <h1>Your Orders</h1>
</body>
</html>
