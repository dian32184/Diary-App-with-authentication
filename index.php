<?php
session_start();
include 'database/database.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();

}


$sql = "SELECT id, title, content, date_added FROM entries ORDER BY date_added DESC";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diary App - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 32px;
            color: #343a40;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
            border-radius: 20px;
        }
        .btn-add:hover {
            background-color: #218838;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border-radius: 20px;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        .entry-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .entry-actions {
            display: flex;
            gap: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">📖 Diary App</div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="views/add_entry.php" class="btn btn-add"><i class="fas fa-plus"></i> Add Diary Entry</a>
            <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <?php
        if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="entry-card mt-3">';
        echo '<strong>Title: ' . htmlspecialchars($row['title']) . '</strong> ';
        echo '<span class="text-muted">(' . htmlspecialchars($row['date_added']) . ')</span>';
        echo '<p>' . nl2br(htmlspecialchars($row['content'])) . '</p>';
        echo '<div class="entry-actions">';
        echo '<a href="views/update_diary.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a> ';
        echo '<a href="handlers/delete_diary_handler.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p class='text-muted'>No diary entries found.</p>";
} 
?>



        </div>
    </div>
</body>

</html>
