<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';

// Get any error message if redirected with params
$error_message = $_GET['error'] ?? 'Your payment could not be processed.';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed - Unisex Shoes</title>
</head>
<body>
<div class="container">
    <h2> Payment Failed!</h2>
    <p><?php echo htmlspecialchars($error_message); ?></p>
    <p>If the amount was deducted, please contact our support team with your transaction details.</p>
    <a href="cart.php">Return to Cart</a> | 
    <a href="index.php">Continue Shopping</a>
</div>
</body>
</html>
