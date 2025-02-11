<?php
// register.php
include 'db.php';  // This file should establish a connection and assign it to $conn
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and trim form inputs
    $username         = trim($_POST['username']);
    $password         = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check for empty fields
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }
    
    // Verify that passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit();
    }
    
    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    if (!$stmt) {
        echo "<script>alert('Database error.'); window.history.back();</script>";
        exit();
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->close();
        echo "<script>alert('Username already taken.'); window.history.back();</script>";
        exit();
    }
    $stmt->close();
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user record
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if (!$stmt) {
        echo "<script>alert('Database error.'); window.history.back();</script>";
        exit();
    }
    $stmt->bind_param("ss", $username, $hashed_password);
    
    if ($stmt->execute()) {
        // Close statement and connection before redirection
        $stmt->close();
        $conn->close();
        header("Location: mainpage.html");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        echo "<script>alert('Registration error. Please try again later.'); window.history.back();</script>";
        exit();
    }
}
?>


