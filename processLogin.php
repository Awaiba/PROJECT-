<?php
session_start();

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

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if user exists
    $query = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Store user ID in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the user orders page
        header('Location: userOrders.php');
        exit;
    } else {
        // Incorrect login
        $_SESSION['login_error'] = 'Invalid username or password.';
        header('Location: loginForm.php');
        exit;
    }
} else {
    header('Location: loginForm.php');
    exit;
}
?>
