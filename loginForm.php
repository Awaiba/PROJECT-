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
    <style>
        .login-form {
        background-color: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 510px;
        }
        h1 {
            color: black;
        }

        button{
            padding: 5px;
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
                        <a href="userDatabase.php" class="nav__link"><b>HOME</b></a>
                    </li>

                    <li class="nav__item">
                        <a href="product.php" class="nav__link">PRODUCTS</a>
                    </li>

                    <li class="nav__item">
                        <a href="contact.php" class="nav__link">CONTACT</a>
                    </li>

                    <li class="nav__item">
                        <a href="logout.php" class="nav__link">LOG OUT</a>
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
        <?php
        session_start();
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error-message">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form action="processLogin.php" method="POST" class="login-form">
        <h1>Login to View Your Orders</h1><br>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your Email or Username" required>
                <div id="usernameError" class="error-message"></div>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div id="passwordError" class="error-message"></div>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
