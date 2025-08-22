<?php
session_start();

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token.');
    }

    // Extract form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $street = $_POST['street'];
    $cod = isset($_POST['cod']) ? 'COD' : 'Online Payment'; 

    echo $name, $phone, $email, $address, $district, $street, $cod;
    $product_id = 1; // Assuming a product ID for order
    $quantity = 1; // Assuming a quantity for order

    $username = $_SESSION['username']; 

    $servername = "localhost"; 
    $username_db = "root"; 
    $password_db = ""; 
    $dbname = "walkon";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user_id = null;

        // Fetch user_id from session if username exists
        if (isset($username)) {
            $query = "SELECT id FROM users WHERE username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                $user_id = $user['id'];
            }
        }

        // Fetch product price
        $productStmt = $pdo->prepare("SELECT price FROM product WHERE product_id = ?");
        $productStmt->execute([$product_id]);
        $product = $productStmt->fetch();
        $product_price = $product['price'];

        // Calculate total price
        $total_price = $product_price * $quantity;

        // Insert order into database
        $stmt = $pdo->prepare("INSERT INTO user_orders (user_id, product_id, quantity, total_price, name, phone, email, address, district, street, payment_method) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $quantity, $total_price, $name, $phone, $email, $address, $district, $street, $cod]);

        // Set thank you message
        $_SESSION['thank_you_message'] = '<div class="thank-you-message">
                                              <h2>Thank You for Your Purchase!</h2>
                                              <p>We appreciate your order. Our team will contact you soon.</p>
                                              <a href="userDashboard.php" class="btn">Back to Home</a>
                                          </div>';

        // Clear CSRF token after use
        unset($_SESSION['csrf_token']);

        // Redirect to checkout form with thank you message displayed
        header('Location: checkoutform.php'); 
        exit;

    } catch (PDOException $e) {
        // Handle database error
        die("Error: " . $e->getMessage());
    }
}
?>
