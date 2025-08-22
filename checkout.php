<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token.');
    }

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

    $servername = "localhost"; 
    $username_db = "root"; 
    $password_db = ""; 
    $dbname = "walkon";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user_id = null;

        if (isset($username)) {
            $query = "SELECT id FROM users WHERE username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                $user_id = $user['id'];
            }
        }

        $productStmt = $pdo->prepare("SELECT price FROM product WHERE product_id = ?");
        $productStmt->execute([$product_id]);
        $product = $productStmt->fetch();
        $product_price = $product['price'];
        $total_price = $product_price * $quantity;

        // Insert order
        $stmt = $pdo->prepare("INSERT INTO user_orders (user_id, product_id, quantity, total_price, name, phone, email, address, district, street, payment_method) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $quantity, $total_price, $name, $phone, $email, $address, $district, $street, $cod]);

        $order_id = $pdo->lastInsertId(); // Grab the inserted order ID

        // If COD, just redirect back
        if ($cod === "COD") {
            $_SESSION['thank_you_message'] = '<div class="thank-you-message">
                                                  <h2>Thank You for Your Purchase!</h2>
                                                  <p>We appreciate your order. Our team will contact you soon.</p>
                                                  <a href="userDashboard.php" class="btn">Back to Home</a>
                                              </div>';
            unset($_SESSION['csrf_token']);
            header('Location: checkoutform.php'); 
            exit;
        } else {
            // eSewa Payment Gateway
            $success_url = "http://localhost/walkon/success.php?q=su"; 
            $failure_url = "http://localhost/walkon/failure.php?q=fu"; 

            echo "
            <form id='esewaForm' action='https://uat.esewa.com.np/epay/main' method='POST'>
                <input value='{$total_price}' name='tAmt' type='hidden'>
                <input value='{$total_price}' name='amt' type='hidden'>
                <input value='0' name='txAmt' type='hidden'>
                <input value='0' name='psc' type='hidden'>
                <input value='0' name='pdc' type='hidden'>
                <input value='EPAYTEST' name='scd' type='hidden'>
                <input value='{$order_id}' name='pid' type='hidden'>
                <input value='{$success_url}' type='hidden' name='su'>
                <input value='{$failure_url}' type='hidden' name='fu'>
            </form>
            <script>document.getElementById('esewaForm').submit();</script>";
            exit;
        }

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
