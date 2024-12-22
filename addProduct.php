<?php
// Include your database connection
include 'dbConnection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $stock = $_POST['stock'];

    // Insert the new product into the database
    $insertQuery = "INSERT INTO product (name, brand, price, material, color, size, stock) 
                    VALUES (:name, :brand, :price, :material, :color, :size, :stock)";
    $stmt = $pdo->prepare($insertQuery);
    $result = $stmt->execute([
        'name' => $name, 
        'brand' => $brand, 
        'price' => $price, 
        'material' => $material, 
        'color' => $color, 
        'size' => $size, 
        'stock' => $stock
    ]);

    if ($result) {
        $_SESSION['message'] = 'Product added successfully!';
        header('Location: adminPanel.php'); // Redirect to the product listing page
    } else {
        $_SESSION['message'] = 'Failed to add product!';
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="path/to/your/css/style.css">
    <script src="path/to/your/js/script.js">
    </script>
</head>
<body>
    <h1>Add Product</h1>
    <form action="addProduct.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        
        <label for="brand">Brand:</label>
        <input type="text" name="brand" id="brand" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br>

        <label for="material">Material:</label>
        <input type="text" name="material" id="material" required><br>

        <label for="color">Color:</label>
        <input type="text" name="color" id="color" required><br>

        <label for="size">Size:</label>
        <input type="text" name="size" id="size" required><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
