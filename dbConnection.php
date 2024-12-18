<?php
$servername = "localhost"; // Assuming localhost
$username = "root";         // Database username
$password = "";             // Database password (if any)
$dbname = "walkon";         // Database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
