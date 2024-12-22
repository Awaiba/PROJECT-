<?php
session_start();
include 'dbConnection.php'; // Correct path to dbConnection.php

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Delete query
    $deleteQuery = "DELETE FROM user_orders WHERE order_id = :order_id";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $result = $deleteStmt->execute(['order_id' => $order_id]);

    if ($result) {
        $_SESSION['message'] = 'Order deleted successfully!';
        header('Location: adminPanel.php'); // Redirect to the admin panel
    } else {
        $_SESSION['message'] = 'Failed to delete order!';
        header('Location: adminPanel.php'); // Redirect to the admin panel
    }
    exit;
} else {
    $_SESSION['message'] = 'Invalid request!';
    header('Location: adminPanel.php');
    exit;
}
?>
