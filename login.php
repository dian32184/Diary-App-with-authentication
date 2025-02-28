<?php 
include 'database/database.php'; 


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Diary App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Font Awesome Icons -->
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-4">
      <div class="row text-center">
        <p class="display-6 fw-bold">Login</p>
      </div>

      <form action="../handlers/login_handler.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i> Login</button>
        </div>
      </form>

      <div class="text-center mt-3">
        <p>Don't have an account? <a href="register.php" class="btn btn-outline-primary btn-sm"><i class="fas fa-user-plus"></i> Register</a></p>
      </div>
    </div>
  </div>
</body>

</html>
