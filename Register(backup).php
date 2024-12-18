<?php
// Start session to store messages
session_start();

// Include database connection
include 'dbConnection.php';

// Function to sanitize input and check for errors
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($conn, $_POST['full-name']);
    $phone_no = sanitizeInput($conn, $_POST['phone-no']);
    $email = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']);
    $cpassword = sanitizeInput($conn, $_POST['confirm-password']);

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
            $query = "INSERT INTO `users` (full_name, phone_no, email, password) VALUES ('$name', '$phone_no', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = 'Registered successfully!';
                header('Location: loginRegister.php'); // Redirect to login page
                exit;
            } else {
                $_SESSION['message'] = 'Query failed: ' . mysqli_error($conn);
            }
        }
    }
}

// Display messages if any
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
    <link rel="stylesheet" href="assets/css/Register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>WalkOn - Register</title>
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
                        <a href="login.php" class="nav__link">LOGIN</a>
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

    <div class="register-container">
        <form class="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h2>Create an Account</h2>
            <div class="input-group">
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="full-name" placeholder="Enter your full name" required>
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
            <button type="submit" class="register-btn">Register</button>
            <div class="login-link">
                <p>Already have an account? <a href="loginRegister.php">Login here</a></p>
            </div>
        </form>
    </div>

</body>
</html>
