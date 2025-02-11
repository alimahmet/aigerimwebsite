<?php
// db.php
$hostName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "registerform";

$conn = new mysqli($hostName, $userName, $userPassword, $dbName);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
