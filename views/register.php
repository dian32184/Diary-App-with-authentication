<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare SQL query and check for errors
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('User registered successfully!'); window.location.href = '../login.php';</script>";
    } else {
        die("Execute failed: " . $stmt->error);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .register-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .input-group {
            display: flex;
            align-items: center;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            background: white;
        }
        .input-group input {
            border: none;
            outline: none;
            padding: 10px;
            flex: 1;
        }
        .input-group i {
            padding: 10px;
            color: #555;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST">
            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="username" required placeholder="Username">
            </div>
            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" required placeholder="Password">
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
