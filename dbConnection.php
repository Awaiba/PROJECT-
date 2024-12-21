<?php
$servername = "localhost"; 
$username = "root";       
$password = "";           
$database = "walkon";    

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$servername = "localhost"; 
$username = "root";       
$password = "";             
$database = "walkon";      
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
