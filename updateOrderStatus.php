<?php
session_start();
include 'dbConnection.php'; // Direct inclusion for testing

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    
    // Update the order status
    $updateQuery = "UPDATE user_orders SET order_status = :order_status WHERE order_id = :order_id";
    $updateStmt = $pdo->prepare($updateQuery);
    $result = $updateStmt->execute(['order_status' => $order_status, 'order_id' => $order_id]);

    if ($result) {
        $_SESSION['message'] = 'Order status updated successfully!';
        header('Location: adminPanel.php'); // Redirect back to admin panel
        exit;
    } else {
        $_SESSION['message'] = 'Failed to update order status!';
        header('Location: adminPanel.php');
        exit;
    }
}
?>
