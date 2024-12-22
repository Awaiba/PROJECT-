<?php
session_start();

// Redirect if not admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php');
    exit;
}

// CSRF Token validation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
    die('Invalid CSRF token.');
}

// Include database connection
include '../../dbConnection.php'; // Ensure the correct path to dbConnection.php

// Get order ID from URL
$order_id = $_GET['id'];
$orderQuery = "SELECT * FROM user_orders WHERE order_id = :order_id";
$stmt = $pdo->prepare($orderQuery);
$stmt->execute(['order_id' => $order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// Form submission logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $street = $_POST['street'];
    $payment_method = $_POST['payment_method'];
    
    $updateQuery = "UPDATE user_orders SET user_id = :user_id, product_id = :product_id, quantity = :quantity, total_price = :total_price, name = :name, phone = :phone, email = :email, address = :address, district = :district, street = :street, payment_method = :payment_method WHERE order_id = :order_id";
    $updateStmt = $pdo->prepare($updateQuery);
    $result = $updateStmt->execute([
        'user_id' => $user_id,
        'product_id' => $product_id,
        'quantity' => $quantity,
        'total_price' => $total_price,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'district' => $district,
        'street' => $street,
        'payment_method' => $payment_method,
        'order_id' => $order_id
    ]);

    if ($result) {
        $_SESSION['message'] = 'Order updated successfully!';
        header('Location: adminPanel.php'); // Redirect back to adminPanel
        exit;
    } else {
        $_SESSION['message'] = 'Failed to update order!';
    }
}
?>
