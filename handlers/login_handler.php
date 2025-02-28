<?php
include '../database/database.php'; 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id']; 

          
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='../login.php';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='../login.php';</script>";
    }
}
?>
