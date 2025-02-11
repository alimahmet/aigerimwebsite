<?php
// welcome.php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Bookstore</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 0;
      text-align: center;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      background-color: #3498db;
      color: white;
      padding: 20px;
    }
    header h2 {
      margin: 0;
      font-size: 32px;
    }
    .container {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .container a {
      text-decoration: none;
      padding: 10px 20px;
      margin: 10px;
      border: 1px solid #3498db;
      border-radius: 5px;
      color: #3498db;
      font-size: 18px;
    }
    .container a:hover {
      background-color: #3498db;
      color: #fff;
    }
    footer {
      background-color: #3498db;
      color: white;
      padding: 10px;
    }
  </style>
</head>
<body>
  <header>
    <h2>Dashboard</h2>
  </header>
  <div class="container">
    <p>Welcome! You are logged in.</p>
    <a href="mainpage.html">Go to Bookstore</a>
    <a href="logout.php">Logout</a>
  </div>
  <footer>
    <p>&copy; 2025 Bookstore</p>
  </footer>
</body>
</html>

