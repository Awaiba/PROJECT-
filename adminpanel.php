<?php
session_start();

// Check if the user is not an admin, redirect to login
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php'); // Redirect to login if not admin
    exit;
}

// Database connection
include 'dbConnection.php';

// Fetch user data
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

include 'dbConnection.php';
// Ensure $conn is properly set up to connect to your database

// Fetch Product data
$productQuery = "SELECT * FROM product";
$productResult = mysqli_query($conn, $productQuery);

include 'dbConnection.php';
// Ensure $conn is properly set up to connect to your database

// Fetch user order details
$orderQuery = "SELECT * FROM user_orders";
$orderResult = mysqli_query($conn, $orderQuery);
?>
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
    <link rel="stylesheet" href="assets/css/adminPanel.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Admin Panel - Walk On</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .admin-panel {
            padding: 20px;
            padding-top: 100px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .admin-table th, .admin-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .admin-table th {
            background-color: #f4f4f4;
        }

        .admin-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
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
                        <a href="adminDashboard.php" class="nav__link">HOME</a>
                    </li>
                    <li class="nav__item">
                        <a href="adminPanel.php" class="nav__link"><b>ADMIN</b></a>
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

    <main class="admin-panel container">
        <h1>User Details</h1> <!-- Big Heading for User Details -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['phone_no']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <a href="editUser.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="deleteUser.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h1>INVENTORY</h1> <!-- Big Heading for User Details -->
        <table class="admin-table">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Material</th>
            <th>Color</th>
            <th>Size</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($productRow = mysqli_fetch_assoc($productResult)) : ?>
            <tr>
                <td><?php echo $productRow['product_id']; ?></td>
                <td><?php echo $productRow['name']; ?></td>
                <td><?php echo $productRow['brand']; ?></td>
                <td><?php echo $productRow['price']; ?></td>
                <td><?php echo $productRow['material']; ?></td>
                <td><?php echo $productRow['color']; ?></td>
                <td><?php echo $productRow['size']; ?></td>
                <td><?php echo $productRow['stock']; ?></td>
                <td>
                    <a href="editProduct.php?id=<?php echo $productRow['product_id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="deleteProduct.php?id=<?php echo $productRow['product_id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
        </table>
        <h1>User Orders</h1> <!-- Big Heading for User Details -->
        <table class="admin-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>District</th>
            <th>Street</th>
            <th>Payment Method</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($orderRow = mysqli_fetch_assoc($orderResult)) : ?>
            <tr>
                <td><?php echo $orderRow['order_id']; ?></td>
                <td><?php echo $orderRow['user_id']; ?></td>
                <td><?php echo $orderRow['product_id']; ?></td>
                <td><?php echo $orderRow['quantity']; ?></td>
                <td><?php echo $orderRow['total_price']; ?></td>
                <td><?php echo $orderRow['name']; ?></td>
                <td><?php echo $orderRow['phone']; ?></td>
                <td><?php echo $orderRow['email']; ?></td>
                <td><?php echo $orderRow['address']; ?></td>
                <td><?php echo $orderRow['district']; ?></td>
                <td><?php echo $orderRow['street']; ?></td>
                <td><?php echo $orderRow['payment_method']; ?></td>
                <td><?php echo $orderRow['created_at']; ?></td>
                <td>
                    <a href="editOrder.php?id=<?php echo $orderRow['order_id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="deleteOrder.php?id=<?php echo $orderRow['order_id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

    </main>

</body>
</html>
