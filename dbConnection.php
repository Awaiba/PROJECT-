<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost"; 
$username = "root";         
$password = "";            
$dbname = "walkon";         
$conn = new mysqli($servername, $username, $password, $dbname, 3306); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful!<br>";

    $sql = "SELECT * FROM users LIMIT 5"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Connected successfully. Here are the first 5 records from the 'users' table:<br>";
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Name: " . $row["full_name"] . " - Email: " . $row["email"] . "<br>";
        }
    } else {
        echo "No records found in the 'users' table.";
    }

    $conn->close();  
}
?>
