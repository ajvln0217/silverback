<?php
session_start();
include('../connection/connect.php');


if (isset($_SESSION['auth'])) {
  $_SESSION['message'] = "You are already logged in";
  header('Location: ../index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Silverback | Login</title>
  <link rel="stylesheet" href="login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <div class="wrapper">
    <?php
    if (isset($_SESSION['message'])) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong></strong> <?= $_SESSION['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
      unset($_SESSION['message']);
    }
    ?>
    <header>Welcome to Silverback</header>
    <h2>Log-in</h2>
    <form class = "form" name = "userForm" id = "userForm" action="../functions/authentication.php" method="POST">
      <div class="field email">
        <div class="input-area">
          <input name="user_email" type="email" placeholder="Email Address">
          <i class="icon fas fa-envelope"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt"></div>
      </div>
      <div class="field password">
        <div class="input-area">
          <input name="user_password" type="password" placeholder="Password">
          <i class="icon fas fa-lock"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt"></div>
      </div>
      <div class="pass-txt"><a href="./forgot-pass.php">Forgot password?</a></div>
      <input name="log_in" type="submit" value="Login">
    </form>
    <div class="sign-txt">Not yet registered? <a href="./register.php">Signup now</a></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>