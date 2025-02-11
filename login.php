<?php
include 'db.php';
session_start();

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $errorMessage = "All fields are required.";
    } else {
        $statement = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows > 0) {
            $statement->bind_result($id, $hashed_password);
            $statement->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $id;
                header("Location: welcome.php");  // Redirect to the protected welcome/dashboard page
                exit;
            } else {
                $errorMessage = "Invalid password.";
            }
        } else {
            $errorMessage = "No user found.";
        }
        $statement->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f2f2f2;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin: 0;
      }
      .form-container {
         background-color: rgba(255, 255, 255, 0.9);
         padding: 30px 40px;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0,0,0,0.1);
         width: 100%;
         max-width: 400px;
         text-align: center;
      }
      h1 {
         font-size: 2rem;
         color: #333;
         margin-bottom: 20px;
         font-weight: bold;
      }
      label {
         font-size: 1rem;
         color: #333;
         margin-bottom: 5px;
         display: block;
      }
      input[type="text"], input[type="password"] {
         width: 100%;
         padding: 10px;
         margin: 10px 0 20px 0;
         border: 2px solid #ccc;
         border-radius: 5px;
         font-size: 1rem;
         transition: border-color 0.3s ease;
      }
      input[type="text"]:focus, input[type="password"]:focus {
         border-color: #007bff;
         outline: none;
      }
      button {
         width: 100%;
         padding: 12px;
         background-color: #b18327;
         color: white;
         font-size: 1.2rem;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }
      button:hover {
         background-color: #b86f15;
      }
      .error-message {
         color: red;
         font-size: 1rem;
         margin-top: 10px;
      }
   </style>
</head>
<body>
   <div class="form-container">
      <h1>Log-in</h1>
      <?php if (!empty($errorMessage)) { ?>
         <p class="error-message"><?php echo $errorMessage; ?></p>
      <?php } ?>
      <form method="POST" action="">
         <label for="username">Username:</label>
         <input type="text" name="username" id="username" required>
         
         <label for="password">Password:</label>
         <input type="password" name="password" id="password" required>
         
         <button type="submit">Login</button>
      </form>
   </div>
</body>
</html>

