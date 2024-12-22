<?php
session_start();

// Redirect if not admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: loginRegister.php');
    exit;
}

// CSRF Token validation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
    die('Invalid CSRF token.');
}

// Include database connection
include '../../dbConnection.php'; // Ensure the correct path to dbConnection.php

// Get product ID from URL
$product_id = $_GET['id'];
$productQuery = "SELECT * FROM product WHERE product_id = :product_id";
$stmt = $pdo->prepare($productQuery);
$stmt->execute(['product_id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Form submission logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $stock = $_POST['stock'];
    
    $updateQuery = "UPDATE product SET name = :name, brand = :brand, price = :price, material = :material, color = :color, size = :size, stock = :stock WHERE product_id = :product_id";
    $updateStmt = $pdo->prepare($updateQuery);
    $result = $updateStmt->execute([
        'name' => $name,
        'brand' => $brand,
        'price' => $price,
        'material' => $material,
        'color' => $color,
        'size' => $size,
        'stock' => $stock,
        'product_id' => $product_id
    ]);

    if ($result) {
        $_SESSION['message'] = 'Product updated successfully!';
        header('Location: adminPanel.php'); // Redirect back to adminPanel
        exit;
    } else {
        $_SESSION['message'] = 'Failed to update product!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Add your CSS & JS includes here -->
</head>
<body>

    <header>
        <!-- Add your header content -->
    </header>

    <main>
        <h1>Edit Product</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php unset($_SESSION['message']); endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="name">Product Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            
            <label for="brand">Brand</label>
            <input type="text" name="brand" value="<?php echo htmlspecialchars($product['brand']); ?>" required>
            
            <label for="price">Price</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            
            <label for="material">Material</label>
            <input type="text" name="material" value="<?php echo htmlspecialchars($product['material']); ?>" required>
            
            <label for="color">Color</label>
            <input type="text" name="color" value="<?php echo htmlspecialchars($product['color']); ?>" required>
            
            <label for="size">Size</label>
            <input type="text" name="size" value="<?php echo htmlspecialchars($product['size']); ?>" required>
            
            <label for="stock">Stock</label>
            <input type="number" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
            
            <button type="submit">Update Product</button>
        </form>
    </main>

</body>
</html>
