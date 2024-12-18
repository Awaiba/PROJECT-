<?php
$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your database username
$password = "";             // Replace with your database password
$database = "walkon";      // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your database username
$password = "";             // Replace with your database password
$database = "walkon";       // Replace with your database name

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
