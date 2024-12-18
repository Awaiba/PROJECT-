<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php'); // Redirect to login if not admin
    exit;
}
?>
<h1>Welcome Admin</h1>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="anonymous">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Walk On</title>
    <!--==================== HEADER ====================-->
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
                        <a href="adminPanel.php" class="nav__link">ADMIN</a>
                    </li>

                    <li class="nav__item">
                        <a href="logout.php" class="nav__link">LOG OUT</a>
                    </li>
                </ul>

                <!-- Close Button -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <!-- Toggle Button -->
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-apps-2-fill"></i>
            </div>
        </nav>
    </header>
</head>
<body>
    <!--==================== MAIN ====================-->
    <main>
        <!--==================== HOME ====================-->
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

        <!-- BANNER SECTION -->
        <section id="Contactbanner" class="section-01">
            <h1>BUY 1 GET 20% OFF</h1>
            <p>On Winter Collection</p>
            <button class="contactbannerbutton">
                <a href="product.html">BUY NOW</a>
            </button>
        </section>

        <!-- FOOTER -->
        <section class="footer">
            <div class="footer-info">
                <div class="first-info">
                    <h1 class="footer__title">WalkOn</h1>
                    <p>Khairahani, Parsa</p>
                    <p>9812345678</p>
                    <p>walkon@gmail.com</p>

                    <div class="social-icon">
                        <p><a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAU1JREFUSEu1VYFtAyEM9G3STNJmk2aStJM0nSTdpOkkzt8LLD+YB5TGUsQrgM/2nQ3kyYYn+5cugKq+iQh/r2m9LeuPiPxxBcDvpjUBVPVFRL6S0z0fBDwC4FpZCKCqHyJynigfnX8D4L2NVQATzumUWXr7LEE2AKksvzuR0ymdXPKZIiDunzwvJcC1U/NDWesg4xuAQw7AAFT1PZHaSuAC4OQiZ3l4J6vL3yPpq7o8QI9Yq+9AMHbWA1CSjKhlrO1a+wEhsD+OZQYkt1SFB5sBMB58BhHAhrAoNVUNhYFFr2UG0cERgCgwE0SP5HUMrJG4UZD6JScU9U0IwIHGLP6DZONrptFGSTYFbThI8qOKWqNiFMCarALoaHwEYH/YNQZY/rsHYPuexJkHpwVQTdAhgGCo2fOYZhH5ohzDl6yapjvyfGir++g/5H25fAcXRb0Zoc7OswAAAABJRU5ErkJggg=="/></a>
                        <a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAASlJREFUSEvlVcsVwjAMszehkwCT0E4CTAJMAkwCm4ioz3mk+TU5cCKXNK1tObLsqvx46Y/jy58CANiJyFFENkbxTVVPAHge+eypX1AE4C4ik6q+S7UBMIrIJfOdPgSg/7UEAJcBDeeMciAAaFNa9H2YP/dvke16r8Dz7DK6hrepZB8C7lV1Dr4A4MEoIr9+MaP5RraTghw93p4JTSFaXAPyGxavt03KABmKeoPTflHgFop6QYZYgTFF5JhS9fruAlAnvdgheWFNdGDDdEXP0JNQZEoqNVIN762qQ84gO+xcL7HJqKbWtdB+UabhBz9XGoAS5VQBLDBteIO1OhQzTzrZArcqiKOgOhQTACsw5clRsTWphnLlyHjG82mtSH/6R1ujpUmmPUFqth9jNG4ZtZXXXAAAAABJRU5ErkJggg=="/></a>
                        <a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAYtJREFUSEvFVTtOw0AUnKmp6aFHIC4A5BhIFKRFAokTQG4ACGoSCYmeCxBugLgAoaKgp6B57CzPVrJ2TNZWlNf583Zm3meWWHJwyedjNQBmtgHgGMA+gIMGlRP/NgYwIFk8lykVBWamg+9blE6Hj0heTufOADjz9xaHFykC6ZOUohgpgJhLQU70vIwXnjQk2Z8HIPaqf10MA7uPQEAs1RsRmZDcTMo6JinQWgVWc3Ip28zWo2zyy8v57P9Pk4qgOQBi8wPgyJmLxAuABwCfACo9Y+j0ogCxnoH5HYCTRN0tyVMzk4qZUc4BULOenPFWAvBGcsfMNJZFg//qnqFgAOAmlEYstxOAV5K7XQHiRJjZNYCzBOCK5LmZVUY7R0GcIADfAA4B7DmImvwIYM3VzWDnACixsp16aWZqbDGmCwNUJsIzBaL116IpmkywcdHaWEW6m41WoY3sYnYC6801O69tW7tWupxUnlVG7Y3mPqPlkaKmC6cYglH4V6X5/8KpMbtOr1ZzJ3einCT/Agxmohk4DnrvAAAAAElFTkSuQmCC"/></a></p>
                    </div>
                </div><br>

                <div class="second-info">
                    <h4>Support</h4>
                    <p>Contact Us</p>
                    <p>About Page</p>
                    <p>Size Guide</p>
                    <p>Shopping and Returns</p>
                    <p>Privacy</p><br>
                </div>

                <div class="third-info">
                    <h4>Shop</h4>
                    <p>Men's Shopping</p>
                    <p>Women's Shopping</p>
                    <p>Kid's Shopping</p>
                    <p>Discount</p><br>
                </div>

                <div class="fourth-info">
                    <h4>Company</h4>
                    <p>About</p>
                    <p>Login</p><br>
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

    <!--=============== SWIPER JS ===============-->
    <script src="assets/js/swiper-bundle.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/cart.js"></script>

</body>
</html>
