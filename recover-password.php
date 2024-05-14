<?php 
  // Initialize the session
  session_start();
//echo $_SESSION["email"];

// Include connection file
require 'db.php';

// Define variables and initialize with empty values
$nic = $password = $password2 = $user_type = $name = $email = $phone = "";
$nic_error = $name_error = $email_error = $password_error = $password_error2
 = $reg_error = $common_error =
  $phone_error = "";

$nic = $_SESSION["nic"];
//$nic = "123";

if (isset($_POST["submit"])) {

  // Check if password is empty
  if (empty(trim($_POST["pass1"]))) {
    $password_error = "Please enter your password.";
    $view_error = $password_error;
  } else {
    $password = trim($_POST["pass1"]);
  }

  // Check if name is empty
  if (empty(trim($_POST["pass2"]))) {
    $password_error2 = "Please enter confirm password.";
    $view_error = $password_error2;
  } else {
    $password2 = trim($_POST["pass2"]);
  }

  // Check if both passwords are same
  if ($password == $password2) {
    // Validate credentials
    if (empty($password_error) && empty($password_error2)) {
      // sql statement
      $sql1 = "UPDATE consumer_login SET password = '".$password."' 
      WHERE consumer_login.consumer_nic = '".$nic."' ";

      if (mysqli_query($conn, $sql1)) {
        // display a error message
        $view_message = "Password Reset Successful. Please login with new password!!!!";
      } else {
        $common_error = "Error. Can't reset password";
        $view_error = $common_error;
      }
    } else {
      $common_error = "Please input valid data.";
      $view_error = $common_error;
    }
  } else {
    $common_error = "Please enter same password for both inputs.";
    $view_error = $common_error;
  }
}
//echo $view_error;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuelIn Recover Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    .card-primary.card-outline {
      border-top: 6px solid #ff6a06;
      border-right: 3px solid #ff6a06;
      border-bottom: 3px solid #ff6a06;
      border-left: 3px solid #ff6a06;
      border-radius: 12px;
    }
    .login-title {
      color: #ff6a06;
    }
    .login-box-msg {
      color: #ff6a06;
    }
    a:hover {
      color: #b34700;
    }
    .btn-primary {
      background-color: #ff6a06;
      border-color: #ff6a06;
      font-weight: 600;
    }
    .btn-primary:hover {
      background-color: #b34700;
      border-color: #b34700;
    }
    .form-control::placeholder {
      color: #ff8533;
      opacity: 1;
    }

    .input-group {
      border: 1px solid #ff6a06;
      border-radius: 4px;
    }
    .main-font-color {
      color: #ff6a06;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1 login-title"><b>FuelIn</b><br>Recover Password</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form action="" method="post" class="mb-2">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock main-font-color"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="pass2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock main-font-color"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" 
            class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php" class="login-title">Goto Login >>></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Sweet Alert 2 -->
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Other JavaScript -->
<script>
  <?php
      if (!empty($view_error)) {
        echo "Swal.fire({
          icon: 'error',
          text: '" . $view_error . "',
          });";
        $view_error = "";
      }
      else if (!empty($view_message)) {
        echo "Swal.fire({
            icon: 'info',
            text: '" . $view_message . "',
            });";
        $view_message = "";
      }
  ?>
</script>
</body>
</html>
