<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php'); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
    die('Invalid CSRF token.');
}

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

function fetchData($pdo, $query, $params = []) {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$username = $_SESSION['username']; 

$query = "SELECT username FROM users WHERE username = ? AND role = 'admin'";
$user = fetchData($pdo, $query, [$username]);

if (empty($user)) {
    header('Location: loginRegister.php');
    exit;
}

$fullName = htmlspecialchars($user[0]['username'], ENT_QUOTES, 'UTF-8'); 

$productQuery = "SELECT * FROM product";
$productResult = fetchData($pdo, $productQuery);

$userQuery = "SELECT * FROM users";
$userResult = fetchData($pdo, $userQuery);

$orderQuery = "SELECT * FROM user_orders";
$orderResult = fetchData($pdo, $orderQuery);

$orderQuery = "SELECT * FROM user_orders";
$orderResult = $pdo->query($orderQuery)->fetchAll(PDO::FETCH_ASSOC);
?>
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
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .admin-panel {
            padding: 20px;
            padding-top: 100px;
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
        .search-bar {
        width: 50%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        }
        .add-btn {
        margin: 10px 0;
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        }

        .add-btn:hover {
        background-color: #45a049;
    }
        .btn {
        padding: 5px 10px;
        text-decoration: none;
        color: white;
        border-radius: 3px;
        margin: 2px;
    }

    .btn-edit {
        background-color: #2196F3;
    }

    .btn-edit:hover {
        background-color: #1976D2;
    }

    .btn-delete {
        background-color: #f44336;
    }

    .btn-delete:hover {
        background-color: #d32f2f;
    }
.btn-update-status {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #007bff; 
    color: white;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-update-status:hover {
    background-color: #0056b3;
}

.btn-complete {
    background-color: #28a745;
}

.btn-complete:hover {
    background-color: #218838; 
}

.btn-pending {
    background-color: #ffc107; 
}

.btn-pending:hover {
    background-color: #e0a800;
}


/* CSS for updating order status button */
.btn-update {
    background-color: #007bff; /* Blue background */
    color: white; /* Text color */
    border: none; /* Remove border */
    padding: 10px 20px; /* Padding */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s ease-in-out; /* Smooth background color transition */
}

.btn-update:hover {
    background-color: #0056b3; /* Darker blue on hover */
    color: white; /* Keep text color */
}

.btn-update:disabled {
    background-color: #c0c0c0; /* Greyed out color when disabled */
    cursor: not-allowed; /* Pointer cursor */
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
                        <a href="adminPanel.php" class="nav__link"><b><?php echo htmlspecialchars($fullName); ?></b></a>
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

    <main class="admin-panel container">
    <h1>Product Details</h1>
    <input type="text" id="productSearch" placeholder="Search Products..." class="search-bar">
    <button class="add-btn" onclick="openAddProductModal()">Add Product</button>
    <table class="admin-table" id="productTable">
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
            <?php foreach ($productResult as $productRow) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($productRow['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['name']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['brand']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['price']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['material']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['color']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['size']); ?></td>
                    <td><?php echo htmlspecialchars($productRow['stock']); ?></td>
                    <td>
                        <a href="editProduct.php?id=<?php echo $productRow['product_id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="deleteProduct.php?id=<?php echo $productRow['product_id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h1>User Details</h1>
    <input type="text" id="userSearch" placeholder="Search Users..." class="search-bar">
    <table class="admin-table" id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userResult as $userRow) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($userRow['id']); ?></td>
                    <td><?php echo htmlspecialchars($userRow['username']); ?></td>
                    <td><?php echo htmlspecialchars($userRow['phone_no']); ?></td>
                    <td><?php echo htmlspecialchars($userRow['email']); ?></td>
                    <td><?php echo htmlspecialchars($userRow['role']); ?></td>
                    <td>
                        <a href="assets/inventoryMGMT/editUser.php?id=<?php echo $userRow['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="assets/inventoryMGMT/deleteUser.php?id=<?php echo $userRow['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h1>User Orders</h1>
    <input type="text" id="orderSearch" placeholder="Search Orders..." class="search-bar">
    <table class="admin-table" id="orderTable">
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
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderResult as $orderRow) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($orderRow['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['name']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['phone']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['email']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['address']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['district']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['street']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['payment_method']); ?></td>
                    <td><?php echo htmlspecialchars($orderRow['created_at']); ?></td>
                    <td>
                        <form action="updateOrderStatus.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $orderRow['order_id']; ?>">
                            <select name="order_status">
                                <option value="Pending" <?php echo ($orderRow['order_status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Completed" <?php echo ($orderRow['order_status'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                <!-- Add other statuses if needed -->
                            </select>
                            <button type="submit" class="btn btn-update">Update Status</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function filterTable(inputId, tableId) {
        const input = document.getElementById(inputId);
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName("tr");

        input.addEventListener("input", function () {
            const filter = input.value.toLowerCase();
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j] && cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        });
    }

    filterTable("productSearch", "productTable");
    filterTable("userSearch", "userTable");
    filterTable("orderSearch", "orderTable");
    });
    function openAddProductModal() {
        alert("Open Add Product Modal or Redirect to Add Product Page");
    }

    function openAddUserModal() {
        alert("Open Add User Modal or Redirect to Add User Page");
    }

    function openAddOrderModal() {
        alert("Open Add Order Modal or Redirect to Add Order Page");
    }
</script>

</html>
