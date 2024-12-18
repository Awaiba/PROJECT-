<?php
session_start(); // Start session for storing messages

// Include database connection
include 'dbConnection.php'; // Make sure this is included

// Function to sanitize input
function sanitizeInput($pdo, $input) {
    return htmlspecialchars(trim($input)); // Basic sanitization
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = sanitizeInput($pdo, $_POST['username']);
    $password = sanitizeInput($pdo, $_POST['password']);
    
    // Query to check if user exists
    $query = "SELECT id, username, phone_no, email, password, role FROM users WHERE username = ? OR email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // User exists and password is correct, start session and redirect
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Store the user role in session
            
            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header('Location: adminDashboard.php'); // Redirect to admin dashboard
            } else {
                header('Location: userDashboard.php'); // Redirect to user dashboard
            }
            exit();
        } else {
            // Invalid password
            $_SESSION['message'] = 'Invalid username/email or password';
        }
    } else {
        // User does not exist
        $_SESSION['message'] = 'Invalid username/email or password';
    }
    
    header('Location: loginRegister.php'); // Redirect back to login page if login fails
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
</head>
<body>

    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="input-group">
                    <label for="username">Email or Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your email or Username" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="login-btn">Login</button>

            </form>
            <p class="register"><a href="Register.php">Register Here</a></p>
        </div>
    </div>

</body>
</html>
