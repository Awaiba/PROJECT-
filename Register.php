<?php
session_start();
include 'dbConnection.php';

function sanitizeInput($input) {
    global $conn; 
    return mysqli_real_escape_string($conn, trim($input));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['username']);
    $phone_no = sanitizeInput($_POST['phone-no']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $cpassword = sanitizeInput($_POST['confirm-password']);
    $role = sanitizeInput($_POST['role']); 
    $checkAdminQuery = mysqli_query($conn, "SELECT * FROM `users` WHERE `role` = 'admin' LIMIT 1");
    if (mysqli_num_rows($checkAdminQuery) > 0 && $role === 'admin') {
        $_SESSION['message'] = 'An admin already exists. Only one admin is allowed.';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'");
        if (mysqli_num_rows($select) > 0) {
            $_SESSION['message'] = 'User already exists!';
        } else {
            if ($password !== $cpassword) {
                $_SESSION['message'] = 'Passwords do not match!';
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO `users` (username, phone_no, email, password, role) VALUES ('$name', '$phone_no', '$email', '$hashed_password', '$role')";
                if (mysqli_query($conn, $query)) {
                    $_SESSION['message'] = 'Registration successful!';
                    echo "<script>alert('Registration successful!'); window.location.href = 'loginRegister.php';</script>"; 
                    exit;
                } else {
                    $_SESSION['message'] = 'Query failed: ' . mysqli_error($conn);
                }
            }
        }
    }
}

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
            width: 400px; 
            gap: 15px;
            margin: 0; 
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const username = document.getElementById("username");
    const phoneNo = document.getElementById("phone-no");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");
    const role = document.getElementById("role");

    // Helper function to show error messages
    const showError = (element, message) => {
        let error = element.parentElement.querySelector(".error-message");
        if (!error) {
            error = document.createElement("span");
            error.className = "error-message";
            error.style.color = "red";
            error.style.fontSize = "0.9em";
            element.parentElement.appendChild(error);
        }
        error.innerText = message;
    };

    // Helper function to remove error messages
    const clearError = (element) => {
        const error = element.parentElement.querySelector(".error-message");
        if (error) {
            error.remove();
        }
    };

    // Validation functions
    const validateUsername = () => {
        const value = username.value.trim();
        if (value.length < 3) {
            showError(username, "Username must be at least 3 characters long.");
        } else {
            clearError(username);
        }
    };

    const validatePhoneNo = () => {
        const value = phoneNo.value.trim();
        const phonePattern = /^[0-9]{10}$/;
        if (!phonePattern.test(value)) {
            showError(phoneNo, "Phone number must be 10 digits.");
        } else {
            clearError(phoneNo);
        }
    };

    const validateEmail = () => {
        const value = email.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            showError(email, "Please enter a valid email address.");
        } else {
            clearError(email);
        }
    };

    const validatePassword = () => {
        const value = password.value;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordPattern.test(value)) {
            showError(password, "Password must include uppercase, lowercase, number, and special character.");
        } else {
            clearError(password);
        }
    };

    const validateConfirmPassword = () => {
        const value = confirmPassword.value;
        if (value !== password.value) {
            showError(confirmPassword, "Passwords do not match.");
        } else {
            clearError(confirmPassword);
        }
    };

    const validateRole = () => {
        if (!role.value) {
            showError(role, "Please select a role.");
        } else {
            clearError(role);
        }
    };

    // Attach event listeners for real-time validation
    username.addEventListener("input", validateUsername);
    phoneNo.addEventListener("input", validatePhoneNo);
    email.addEventListener("input", validateEmail);
    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validateConfirmPassword);
    role.addEventListener("blur", validateRole);

    // Optional: Validate on blur for more comprehensive checking
    username.addEventListener("blur", validateUsername);
    phoneNo.addEventListener("blur", validatePhoneNo);
    email.addEventListener("blur", validateEmail);
    password.addEventListener("blur", validatePassword);
    confirmPassword.addEventListener("blur", validateConfirmPassword);
});
</script>


</html>
