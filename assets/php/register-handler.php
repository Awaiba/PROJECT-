<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['full-name'];
    $phoneNo = $_POST['phone-no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo 'Passwords do not match!';
        exit;
    }

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $stmt = $pdo->prepare('INSERT INTO users (full_name, phone_no, email, password) VALUES (?, ?, ?, ?)');
        $stmt->execute([$fullName, $phoneNo, $email, $hashedPassword]);
        echo 'Registration successful!';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
