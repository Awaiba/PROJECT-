<?php
session_start();
include 'dbConnection.php'; // Ensure correct path to dbConnection.php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the product from the database
    $deleteQuery = "DELETE FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($deleteQuery);
    $result = $stmt->execute(['product_id' => $product_id]);

    if ($result) {
        $_SESSION['message'] = 'Product deleted successfully!';
        header('Location: adminPanel.php'); // Redirect back to the product listing
        exit;
    } else {
        $_SESSION['message'] = 'Failed to delete product!';
        header('Location: adminPanel.php'); // Redirect back to the product listing
        exit;
    }
}
?>
