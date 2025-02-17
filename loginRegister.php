<?php
session_start();
include 'dbConnection.php'; 
function sanitizeInput($pdo, $input) {
    return htmlspecialchars(trim($input)); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = sanitizeInput($pdo, $_POST['username']);
    $password = sanitizeInput($pdo, $_POST['password']);
    
    $query = "SELECT id, username, phone_no, email, password, role FROM users WHERE username = ? OR email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; 
            
            if ($user['role'] === 'admin') {
                header('Location: adminDashboard.php'); 
            } else {
                header('Location: userDashboard.php'); 
            }
            exit();
        } else {
            $_SESSION['message'] = 'Invalid username/email or password';
        }
    } else {
        $_SESSION['message'] = 'Invalid username/email or password';
    }
    
    header('Location: loginRegister.php');
    exit();
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
    <link rel="stylesheet" href="assets/css/loginRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>WalkOn - Login</title>
    
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
                        <a href="Register.php" class="nav__link">REGISTER</a>
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
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
        .input-group input:invalid {
            border: 1px solid red;
        }
        .input-group input:valid {
            border: 1px solid green;
        }
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
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form id="loginForm" method="POST">

                <div class="input-group">
                    <label for="username">Email or Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your email or username" required>
                    <div id="usernameError" class="error-message"></div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <div id="passwordError" class="error-message"></div>
                </div>

                <button type="submit" class="login-btn">Login</button>

            </form>
            <p class="register"><a href="Register.php">Register Here</a></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const usernameInput = document.getElementById("username");
            const passwordInput = document.getElementById("password");
            const usernameError = document.getElementById("usernameError");
            const passwordError = document.getElementById("passwordError");
            const form = document.getElementById("loginForm");

            function validateUsername() {
                const value = usernameInput.value.trim();
                if (value === "") {
                    usernameError.textContent = "Email or Username is required.";
                    usernameInput.setCustomValidity("Invalid");
                } else {
                    usernameError.textContent = "";
                    usernameInput.setCustomValidity("");
                }
            }

            function validatePassword() {
                const value = passwordInput.value.trim();
                if (value === "") {
                    passwordError.textContent = "Password is required.";
                    passwordInput.setCustomValidity("Invalid");
                } else {
                    passwordError.textContent = "";
                    passwordInput.setCustomValidity("");
                }
            }

            usernameInput.addEventListener("input", validateUsername);
            passwordInput.addEventListener("input", validatePassword);

            form.addEventListener("submit", function (e) {
                validateUsername();
                validatePassword();

                if (!form.checkValidity()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
