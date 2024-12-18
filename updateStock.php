<?php
session_start();

// Redirect if not logged in as admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php');
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

// CSRF Token verification
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token.");
}

$product_id = intval($_POST['product_id']);
$new_stock = intval($_POST['stock_update']);

// Update stock query
$query = "UPDATE product SET stock = :new_stock WHERE product_id = :product_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['new_stock' => $new_stock, 'product_id' => $product_id]);

header('Location: adminPanel.php'); // Redirect back to the admin panel
exit;
?>
