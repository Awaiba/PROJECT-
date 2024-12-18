<?php
session_start();

// Redirect if not admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php'); // Redirect to login if not admin
    exit;
}

// Database connection
include 'dbConnection.php';

// Get user ID from URL
$id = $_GET['id'];

// Delete query
$query = "DELETE FROM users WHERE id = $id";
if (mysqli_query($conn, $query)) {
    $_SESSION['message'] = 'User deleted successfully!';
} else {
    $_SESSION['message'] = 'Failed to delete user: ' . mysqli_error($conn);
}
header('Location: adminPanel.php');
exit;
?>
