<?php
session_start();

// Redirect if not an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php'); // Redirect to login if not admin
    exit;
}

// Database connection
include 'dbConnection.php';

// Fetch user data to edit
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update query
    $updateQuery = "UPDATE users SET full_name = '$full_name', phone_no = '$phone_no', email = '$email', role = '$role' WHERE id = $id";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = 'User updated successfully!';
        header('Location: adminPanel.php');
        exit;
    } else {
        $_SESSION['message'] = 'Failed to update user: ' . mysqli_error($conn);
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
    <form action="" method="POST">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required>

        <label for="phone_no">Phone Number:</label>
        <input type="tel" id="phone_no" name="phone_no" value="<?php echo $user['phone_no']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
