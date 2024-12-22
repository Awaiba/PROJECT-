<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO product (name, brand, price, material, color, size, stock) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsssi", $name, $brand, $price, $material, $color, $size, $stock);

    if ($stmt->execute()) {
        header("Location: adminPanel.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<html>
    <head>
    </head>
    <body>
    <div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddProductModal()">&times;</span>
        <h2>Add Product</h2>
        <form action="addProduct.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
            <label for="material">Material:</label>
            <input type="text" id="material" name="material" required>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
            <button type="submit">Add Product</button>
        </form>
    </div>
</div>

</body>
<script>
function openAddProductModal() {
    document.getElementById('addProductModal').style.display = 'block';
}

function closeAddProductModal() {
    document.getElementById('addProductModal').style.display = 'none';
}
</script>
</html>