<?php
include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (empty($title) || empty($content)) {
            echo "Title and content cannot be empty.";
            exit;
        }

       
        $stmt = $conn->prepare("INSERT INTO entries (title, content) VALUES (?, ?)");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("ss", $title, $content);

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
} finally {
    if ($conn) {
        $conn->close();
    }
} 
