<?php
session_start();
$host = '127.0.0.1'; // Your database host
$db = 'walkon'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
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
