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

// Database connection
include 'dbConnection.php'; // Ensure the correct path to dbConnection.php

// Get user ID from URL
$id = $_GET['id'];
$userQuery = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($userQuery);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Form submission logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    $updateQuery = "UPDATE users SET username = :username, phone_no = :phone_no, email = :email, role = :role WHERE id = :id";
    $updateStmt = $pdo->prepare($updateQuery);
    $result = $updateStmt->execute([
        'username' => $username,
        'phone_no' => $phone_no,
        'email' => $email,
        'role' => $role,
        'id' => $id
    ]);

    if ($result) {
        $_SESSION['message'] = 'User updated successfully!';
        header('Location: adminPanel.php'); // Redirect back to adminPanel
        exit;
    } else {
        $_SESSION['message'] = 'Failed to update user!';
        header('Location: editUser.php'); // Redirect back to adminPanel

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

    <header>
    <style>
        .header {
        position: fixed;
        width: 100%;
        top: -10px;
        left: 0;
        background-color: var(--body-color);
        z-index: var(--z-fixed);
        transition: box-shadow .4s;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
    </header>

    <main>
        <h1>Edit User</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php unset($_SESSION['message']); endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label for="phone_no">Phone Number</label>
            <input type="text" name="phone_no" value="<?php echo htmlspecialchars($user['phone_no']); ?>" required>
            
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label for="role">Role</label>
            <select name="role" required>
                <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
            </select>
            
            <button type="submit">Update User</button>
            
        </form>
    </main>

</body>
</html>
