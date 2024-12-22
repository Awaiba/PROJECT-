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
Here’s a complete and structured code snippet for editing product details, including necessary database connection and form handling for product updates.
dbConnection.php (Make sure this file exists and has proper configurations):

<?php
$host = 'localhost';  // Your database host
$db = 'walkon';        // Your database name
$user = 'root';        // Your database username
$pass = '';            // Your database password

// DSN for PDO connection
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<?php
// Database connection details
$host = 'localhost'; // or the appropriate database host
$dbname = 'walkon'; // Your database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
