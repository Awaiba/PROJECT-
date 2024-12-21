<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php'); 
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$host = 'localhost'; 
$dbname = 'walkon'; 
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$username = $_SESSION['username']; 

$query = "SELECT username FROM users WHERE username = ? AND role = 'admin'";
$stmt = $pdo->prepare($query);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: loginRegister.php');
    exit;
}

$fullName = htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Welcome - Walk On</title>

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
                        <a href="adminDashboard.php" class="nav__link"><b>HOME</b></a>
                    </li>
                    <li class="nav__item">
                        <a href="adminPanel.php" class="nav__link"><?php echo htmlspecialchars($username); ?></a>
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
 

    <main>
        <section class="home">
            <div class="home__container container">
                <div class="home__data">
                    <h2 class="home__subtitle">WALK ON</h2>
                    <h1 class="home__title">
                        WELCOME<br>
                        ADMIN<br>
                    </h1>
                    <a href="#" class="home__button">PANEL</a>
                </div>
                <div class="home__images">
                    <div class="home__circle"></div>
                    <div class="home__swiper swiper">
                        <div class="swiper-wrapper">
                            <article class="home__article swiper-slide">
                                <img src="assets/img/logoSHOES.png" alt="" class="home__shoe">
                            </article>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="home__social">
                    <a href="#" target="_blank" class="home__social-link">
                        <i class="ri-facebook-circle-fill"></i>
                    </a>
                    <a href="#" target="_blank" class="home__social-link">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="#" target="_blank" class="home__social-link">
                        <i class="ri-youtube-fill"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="Contactbanner" class="section-01">
            <h1>BUY 1 GET 20% OFF</h1>
            <p>On Winter Collection</p>
            <button class="contactbannerbutton">
                <a href="product.html">BUY NOW</a>
            </button>
        </section>

        <section class="footer">
            <div class="footer-info">
                <div class="first-info">
                    <h1 class="footer__title">WalkOn</h1>
                    <p>Khairahani, Parsa</p>
                    <p>9812345678</p>
                    <p>walkon@gmail.com</p>
                    <div class="social-icon">
                        <p><a href="#"><img src="data:image/png;base64,..."/></a></p>
                    </div>
                </div>
                <br>
                <div class="second-info">
                    <h4>Support</h4>
                    <p>Contact Us</p>
                    <p>About Page</p>
                    <p>Size Guide</p>
                    <p>Shopping and Returns</p>
                    <p>Privacy</p>
                    <br>
                </div>
                <div class="third-info">
                    <h4>Shop</h4>
                    <p>Men's Shopping</p>
                    <p>Women's Shopping</p>
                    <p>Kid's Shopping</p>
                    <p>Discount</p>
                    <br>
                </div>
                <div class="fourth-info">
                    <h4>Company</h4>
                    <p>About</p>
                    <p>Login</p>
                    <br>
                </div>
                <div class="fifth-info">
                    <h4>Subscribe</h4>
                    <p>Receive Updates, Hot Deals, Discounts Sent Straight In Your Inbox Daily</p>
                </div>
            </div>
        </section>
        <div class="end-text">
            <p>Copyright © @2025. All Right Reserved. Designed By Anish Kumar Lama, Sanisha Sapkota.</p>
        </div>
    </main>

    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/cart.js"></script>
</body>
</html>
