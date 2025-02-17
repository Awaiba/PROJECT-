<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: loginForm.php'); 
    exit;
}

// Database connection
$host = 'localhost'; 
$dbname = 'walkon'; 
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch user's orders
$user_id = $_SESSION['user_id'];

$query = "SELECT user_orders.order_id, user_orders.quantity, user_orders.total_price, user_orders.name, user_orders.phone, user_orders.email, 
               user_orders.address, user_orders.district, user_orders.street, user_orders.payment_method, user_orders.created_at, 
               product.name AS product_name, product.brand, product.price, product.material, product.color, product.size 
        FROM user_orders 
        JOIN product ON user_orders.product_id = product.product_id 
        WHERE user_orders.user_id = :user_id";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders - Walk On</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            padding-top: 110px;
            padding-left: 100px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        h2 {
            color: black;
            margin-bottom: 20px;
        }

        .tablebox {
            padding: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
            transition: 0.3s ease-in-out;
        }

        /* Search Box Styles */
        .search-container {
            margin-bottom: 15px;
            text-align: right;
        }

        #searchInput {
            width: 300px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
    <h2>Your Orders</h2>

    <!-- Search Box -->
    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search orders...">
    </div>

    <div class="tablebox">
        <?php if ($orders): ?>
            <table id="ordersTable">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Material</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>District</th>
                    <th>Street</th>
                    <th>Payment Method</th>
                    <th>Ordered On</th>
                </tr>

                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['brand']); ?></td>
                        <td><?php echo htmlspecialchars($order['material']); ?></td>
                        <td><?php echo htmlspecialchars($order['color']); ?></td>
                        <td><?php echo htmlspecialchars($order['size']); ?></td>
                        <td><?php echo htmlspecialchars($order['price']); ?></td>
                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($order['name']); ?></td>
                        <td><?php echo htmlspecialchars($order['phone']); ?></td>
                        <td><?php echo htmlspecialchars($order['email']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['district']); ?></td>
                        <td><?php echo htmlspecialchars($order['street']); ?></td>
                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        <?php else: ?>
            <p>No orders found for your account.</p>
        <?php endif; ?>
    </div>

    <script>
        function searchTable() {
            let input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("ordersTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Start from 1 to skip header row
                tr[i].style.display = "none"; // Hide the row by default

                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) { // Loop through all columns
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = ""; // Show row if match is found
                            break; // Break to avoid redundant checks
                        }
                    }
                }
            }
        }
    </script>

</body>
</html>
