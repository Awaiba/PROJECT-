<?php
// Database connection
include 'dbConnection.php';
session_start(); // Start session for storing messages

// Function to sanitize input
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($conn, $_POST['username']);
    $password = sanitizeInput($conn, $_POST['password']);
    
    // Query to check if user exists
    $query = "SELECT * FROM users WHERE email = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // User exists and password is correct, start session and redirect
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role']; // Store the user role in session
            
            // Redirect based on user role
            if ($row['role'] === 'admin') {
                header('Location: adminDashboard.php'); // Admin specific page
            } else {
                header('Location: userDashboard.php'); // User specific page
            }
            exit();
        } else {
            // Invalid password
            $_SESSION['message'] = 'Invalid email or password';
        }
    } else {
        // User does not exist
        $_SESSION['message'] = 'Invalid email or password';
    }
    
    header('Location: loginRegister.php'); // Redirect back to login page
    exit();
}

// Display session messages if any
if (isset($_SESSION['message'])) {
    echo '
    <div class="message">
        <span>' . $_SESSION['message'] . '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
    ';
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
    <link rel="stylesheet" href="assets/css/loginRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>WalkOn - Login</title>
</head>
<body>

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
                        <a href="index.php" class="nav__link">HOME</a>
                    </li>
                    <li class="nav__item">
                        <a href="product.php" class="nav__link">PRODUCTS</a>
                    </li>
                    <li class="nav__item">
                        <a href="contact.php" class="nav__link">CONTACT</a>
                    </li>
                    <li class="nav__item">
                        <a href="register.php" class="nav__link">REGISTER</a></li>
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

    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="input-group">
                    <label for="username">Email</label>
                    <input type="email" id="username" name="username" placeholder="Enter your email" required>
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
