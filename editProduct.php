<?php
session_start();
include 'dbConnection.php'; // Ensure correct path to dbConnection.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $stock = $_POST['stock'];

    // Update product details
    $updateQuery = "UPDATE product SET name = :name, brand = :brand, price = :price, material = :material, color = :color, size = :size, stock = :stock WHERE product_id = :product_id";
    $stmt = $pdo->prepare($updateQuery);
    $result = $stmt->execute([
        'product_id' => $product_id,
        'name' => $name,
        'brand' => $brand,
        'price' => $price,
        'material' => $material,
        'color' => $color,
        'size' => $size,
        'stock' => $stock,
    ]);

    if ($result) {
        $_SESSION['message'] = 'Product updated successfully!';
        header('Location: adminPanel.php'); // Redirect back to the product listing
    } else {
        $_SESSION['message'] = 'Failed to update product!';
        header('Location: editProduct.php?id=' . $product_id); // Redirect back to the edit form with error
    }
    exit;
}

// Fetch product details for editing
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $productQuery = "SELECT * FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($productQuery);
    $stmt->execute(['product_id' => $product_id]);
    $product = $stmt->fetch();

    if (!$product) {
        $_SESSION['message'] = 'Product not found!';
        header('Location: adminPanel.php'); // Redirect if product not found
        exit;
    }
} else {
    $_SESSION['message'] = 'Invalid request!';
    header('Location: editProduct.php'); // Redirect if no product ID is passed
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS file -->
</head>
<body>
    <h1>Edit Product</h1>

    <form action="editProduct.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label for="brand">Brand:</label>
        <input type="text" name="brand" value="<?php echo htmlspecialchars($product['brand']); ?>" required>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>

        <label for="material">Material:</label>
        <input type="text" name="material" value="<?php echo htmlspecialchars($product['material']); ?>" required>

        <label for="color">Color:</label>
        <input type="text" name="color" value="<?php echo htmlspecialchars($product['color']); ?>" required>

        <label for="size">Size:</label>
        <input type="text" name="size" value="<?php echo htmlspecialchars($product['size']); ?>" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>

        <button type="submit" class="btn btn-update">Update Product</button>
    </form>

    <a href="productDetails.php" class="btn btn-cancel">Cancel</a>
</body>
</html>
