<?php
// Enable detailed error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";  // Server name or IP address
$username = "root";         // Database username
$password = "";             // Database password (if any)
$dbname = "walkon";         // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3306);  // Port 3306

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full-name'];
    $phone_no = $_POST['phone-no'];
    $email = $conn->real_escape_string($_POST['email']);  // Prevent SQL Injection
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Password match check
    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    // Check if the email is already registered
    $sql_check_email = "SELECT email FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check_email);

    if ($result->num_rows > 0) {
        die("The email address is already registered.");
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (full_name, phone_no, email, password) VALUES ('$full_name', '$phone_no', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;  // Show the error if query fails
    }

    $conn->close();  // Close the connection
} else {
    header("Location: ../register.html");
    exit;
}
?>
