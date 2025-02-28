<?php
include "../database/database.php";

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO entries (title, content) VALUES (?, ?)");
    
    if (!$stmt) {
        die('Prepare Error: ' . $conn->error);
    }

    $stmt->bind_param("ss", $title, $content);
    
    if (!$stmt->execute()) {
        die('Execute Error: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();

   
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Diary Entry</title>
    <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
    <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-6">
            <div class="row text-center">
                <p class="display-5 fw-bold">Add Diary Entry</p>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea id="content" name="content" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Entry</button>
            </form>
            <div class="mt-3">
                <a href="../index.php" class="btn btn-secondary">Back to Entries</a>
            </div>
        </div>
    </div>
</body>
</html>
