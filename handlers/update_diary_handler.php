<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        // Get and validate input
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $id = (int)$_POST['id'];

       
        if (empty($title) || empty($content) || empty($id)) {
            echo "Title, content, and ID cannot be empty.";
            exit;
        }

        $stmt = $conn->prepare("UPDATE entries SET title = ?, content = ? WHERE id = ?");

        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("ssi", $title, $content, $id);

        
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Operation failed: " . $stmt->error;
        }
        $stmt->close();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
