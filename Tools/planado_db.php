<?php
$servername = "localhost";
$username = "root";
//$password = "root"; // Remove pw if using XAMPP
$password = ""; // Use this line if you are using XAMPP
$dbname = "planado_db";
$charset = 'utf8mb4';

$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
