<?php
session_start();

// Generate a CSRF token if not already set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get the logged-in username
$username = $_SESSION['username'];

// Prepare a statement to fetch user data based on the session username
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "walkon";

try {   
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT username FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walk On - Checkout</title>
    <link rel="stylesheet" href="assets/css/styles.css">
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
                        <a href="trackingorder.php" class="nav__link"><?php echo htmlspecialchars($username); ?></a>
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
    <style>
        body {
            font-family: var(--body-font);
            background-color: var(--body-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .checkout-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .checkout-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 375px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--title-color);
            font-family: var(--second-font);
            font-size: 40px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: var(--normal-font-size);
            margin-bottom: 5px;
            color: var(--text-color);
            font-family: var(--body-font);
        }

        .input-group input, 
        .input-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
            font-family: var(--body-font);
        }

        .input-group input:focus, 
        .input-group textarea:focus {
            border-color: #111111;
        }

        .input-group textarea {
            height: 100px;
            resize: none; 
        }

        .input-group .checkbox-group {
            display: flex;
            align-items: center;
        }

        .input-group .checkbox-group input {
            width: auto;
            margin-right: 8px;
        }

        .checkout-btn {
            width: 100%;
            padding: 12px;
            background-color: #202020;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: var(--body-font);
        }

        .checkout-btn:hover {
            background-color: #505050;
        }

        .thank-you-message {
            text-align: center;
            color: var(--text-color);
        }

        .thank-you-message h2 {
            font-size: 24px;
            color: #333;
        }

        .thank-you-message p {
            font-size: 18px;
            color: #555;
        }

        .thank-you-message a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #3a42bb;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .thank-you-message a:hover {
            background-color: #505050;
        }

        .error {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    </style>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('orderForm');

        // Function to show or hide error messages
        function showError(input, message) {
            const errorElement = document.getElementById(`${input.id}Error`);
            if (message) {
                errorElement.textContent = message;
            } else {
                errorElement.textContent = '';
            }
        }

        // Validate Name (only alphabetic characters allowed)
        document.getElementById('name').addEventListener('input', function() {
            const namePattern = /^[A-Za-z\s]+$/;
            if (!this.value.trim() || !namePattern.test(this.value.trim())) {
                showError(this, 'Full Name should contain only alphabetic characters.');
            } else {
                showError(this, '');
            }
        });

        // Validate Phone
        document.getElementById('phone').addEventListener('input', function() {
            const phonePattern = /^\d{10}$/;
            if (!this.value.trim() || !phonePattern.test(this.value.trim())) {
                showError(this, 'Valid phone number is required.');
            } else {
                showError(this, '');
            }
        });

        // Validate Email
        document.getElementById('email').addEventListener('input', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.value.trim() || !emailPattern.test(this.value.trim())) {
                showError(this, 'Valid email is required.');
            } else {
                showError(this, '');
            }
        });

        // Validate Address
        document.getElementById('address').addEventListener('input', function() {
            if (!this.value.trim()) {
                showError(this, 'Address is required.');
            } else {
                showError(this, '');
            }
        });

        // Validate District
        document.getElementById('district').addEventListener('input', function() {
            if (!this.value.trim()) {
                showError(this, 'District is required.');
            } else {
                showError(this, '');
            }
        });

        // Validate Street
        document.getElementById('street').addEventListener('input', function() {
            if (!this.value.trim()) {
                showError(this, 'Street is required.');
            } else {
                showError(this, '');
            }
        });

        // Form submission with real-time validation
        form.addEventListener('submit', function(event) {
            let isValid = true;

            // Check each field again for validation
            ['name', 'phone', 'email', 'address', 'district', 'street'].forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    showError(field, `${fieldId.charAt(0).toUpperCase() + fieldId.slice(1)} is required.`);
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>

</head>
<body>
    <!-- Display Thank You Message if session is set -->
    <?php if (isset($_SESSION['thank_you_message'])): ?>
        <?php echo $_SESSION['thank_you_message']; ?>
        <?php unset($_SESSION['thank_you_message']); // Clear the message after displaying ?>
    <?php else: ?>
        <div class="checkout-container">
            <div class="checkout-form">
                <h2>Checkout</h2>
                <form action="processOrder.php" method="post" id="orderForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div class="checkout-container">
        <div class="checkout-form">
            <h2>Checkout</h2>
            <form action="processOrder.php" method="post" id="orderForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="input-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                    <span class="error" id="nameError"></span>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required>
                    <span class="error" id="phoneError"></span>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <span class="error" id="emailError"></span>
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                    <span class="error" id="addressError"></span>
                </div>

                <div class="input-group">
                    <label for="district">District</label>
                    <input type="text" id="district" name="district" required>
                    <span class="error" id="districtError"></span>
                </div>

                <div class="input-group">
                    <label for="street">Street</label>
                    <input type="text" id="street" name="street" required>
                    <span class="error" id="streetError"></span>
                </div>

                <div class="input-group">
                    <input type="checkbox" id="cod" name="cod">
                    <label for="cod">Cash on Delivery</label>
                </div>
                    <button type="submit" class="checkout-btn">Place Order</button>
            </form>
            </div>
        </div>
    <?php endif; ?>

    
</body>
</html>
