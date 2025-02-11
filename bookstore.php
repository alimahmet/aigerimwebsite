<?php
$hostName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "bookstore";

$conn = new mysqli( $hostName, $userName, $userPassword, $dbName);


if ($conn->connect_error) {
    die("Something went wrong with the database!");
}
?>