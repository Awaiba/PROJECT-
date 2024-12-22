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
require_once 'dbConnection.php';

// Get user ID from URL
$id = $_GET['id'];

// Delete query
$query = "DELETE FROM users WHERE id = :id";
$stmt = $pdo->prepare($query);
$result = $stmt->execute(['id' => $id]);

if ($result) {
    $_SESSION['message'] = 'User deleted successfully!';
    header('Location: adminPanel.php'); // Redirect back to adminPanel
} else {
    $_SESSION['message'] = 'Failed to delete user!';
    header('Location: adminPanel.php'); // Redirect back to adminPanel
}
exit;
?>
