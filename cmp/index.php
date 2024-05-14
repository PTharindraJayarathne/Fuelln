<?php
  // Initialize the session
  session_start();

  // Include connection file
  require '../db.php';

  // Define variables and initialize with empty values
  $nic = $password = $user_type = "";
  $nic_error = $password_error = $login_error = $common_error = "";

  // Processing form data when form is submitted
  if (isset($_POST["submit"])) {
    // Check if nic is empty
    if (empty(trim($_POST["nic"]))) {
      $nic_error = "Please enter NIC.";
      $view_error = $nic_error;
    } else {
      $nic = trim($_POST["nic"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
      $password_error = "Please enter your password.";
      $view_error = $password_error;
    } else {
      $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($nic_error) && empty($password_error)) {
      // Select statement
      $sql = "SELECT SELECT staff_login.staff_nic, staff_login.`password`, 
      staff_details.staff_name, staff_details.staff_email, user_login_type.user_type 
      FROM staff_login, staff_details, user_login_type 
      WHERE staff_login.staff_nic = staff_details.staff_nic 
      AND staff_login.staff_nic = user_login_type.user_nic 
      AND staff_login.staff_nic = '".$nic."' 
      AND staff_login.`password` = '$password';";

      //echo $sql;

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) == 1) {
        // Store data in session variables
        $_SESSION["login"] = true;
        $_SESSION["nic"] = $nic;
        
        while ($row = mysqli_fetch_assoc($result)) {
          $_SESSION["u_type"] = $row["user_type"];
          $user_type = $row["user_type"];
          $_SESSION["email"] = $row["consumer_email"];
          $_SESSION["name"] = $row["consumer_name"];
        }
        // header("location:cus/index.php");
        // exit;
        if ($user_type == '1') {
          header("location:cus/index.php");
          exit;
        }

      } else {
        // User doesn't exist, display a error message
        $login_error = "Invalid user nic or password.";
        $view_error = $login_error;
      }
    } else {
      $common_error = "Please input valid data.";
      $view_error = $common_error;
      // Redirect user to index page
      //header("location:/index.php");
    }
    // Close connection
    mysqli_close($conn);
  }

  //echo $view_error;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuelIn Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

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
<body class="hold-transition">
  
  <div class="container-fluid">
    <ul class="nav justify-content-end">
      <li class="nav-item" style="margin-right: 1%;">
        <a class="nav-link" style="background-color: #ff6a06;
        color: white; font-weight: 400; border-radius: 10px; 
        margin: 3%; width: 100%;" href="../index.php"><<< Consumer Login</a>
      </li>
    </ul>
  </div>

  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1 login-title"><b>FuelIn</b><br>Company Login</a>
        </div>
        <div class="card-body">
          <form action="01-adm.php" method="post" class="mb-2">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="NIC" name="nic">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-id-card main-font-color"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock main-font-color"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-1">
            <a href="#" class="login-title">I forgot my password >>></a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
  </div>
  
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  </body>
</html>
