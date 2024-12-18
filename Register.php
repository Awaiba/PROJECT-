<?php
session_start();

// Include database connection
include 'dbConnection.php';

// Function to sanitize input and prevent SQL injection
function sanitizeInput($input) {
    global $conn; // Use the global connection
    return mysqli_real_escape_string($conn, trim($input));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['username']);
    $phone_no = sanitizeInput($_POST['phone-no']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $cpassword = sanitizeInput($_POST['confirm-password']);
    $role = sanitizeInput($_POST['role']); // Ensure role is sanitized

    // Check if an admin already exists
    $checkAdminQuery = mysqli_query($conn, "SELECT * FROM `users` WHERE `role` = 'admin' LIMIT 1");
    if (mysqli_num_rows($checkAdminQuery) > 0 && $role === 'admin') {
        $_SESSION['message'] = 'An admin already exists. Only one admin is allowed.';
    } else {
        // Check if user already exists
        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'");
        if (mysqli_num_rows($select) > 0) {
            $_SESSION['message'] = 'User already exists!';
        } else {
            // Check if passwords match
            if ($password !== $cpassword) {
                $_SESSION['message'] = 'Passwords do not match!';
            } else {
                // Encrypt password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insert user data into the database
                $query = "INSERT INTO `users` (username, phone_no, email, password, role) VALUES ('$name', '$phone_no', '$email', '$hashed_password', '$role')";
                if (mysqli_query($conn, $query)) {
                    $_SESSION['message'] = 'Registration successful!';
                    echo "<script>alert('Registration successful!'); window.location.href = 'loginRegister.php';</script>"; // Redirect with success message
                    exit;
                } else {
                    $_SESSION['message'] = 'Query failed: ' . mysqli_error($conn);
                }
            }
        }
    }
}

// Display messages if any
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>WalkOn - Register</title>

    <header class="header" id="header">
        <nav class="nav container">
            <div class="navLOGO">
                <a href="index.php" class="nav__logo">
                    <img src="assets/img/logoSHOES.png" alt="Logo of Shoes">
                </a>
                <h1 class="nav__logo-title">Walk On</h1>
            </div>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="loginRegister.php" class="nav__link">LOG IN</a>
                    </li>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-apps-2-fill"></i>
            </div>
        </nav>
    </header>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .register-form {
            display: flex;
            flex-direction: column;
            width: 400px; /* Set width to 400px */
            gap: 15px;
            margin: 0; /* Center the form */
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input, .input-group select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .register-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .register-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form class="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h2>Create an Account</h2>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="input-group">
            <label for="phone-no">Phone Number</label>
            <input type="tel" id="phone-no" name="phone-no" placeholder="Enter your phone number" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>
        <div class="input-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
        </div>
        <div class="input-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="register-btn">Register</button>
        <div class="login-link">
            <p>Already have an account? <a href="loginRegister.php">Login here</a></p>
        </div>
    </form>

</body>
</html>
