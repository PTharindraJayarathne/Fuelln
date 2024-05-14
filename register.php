<?PHP
// Initialize the session
session_start();

// Include connection file
require 'db.php';

// Define variables and initialize with empty values
$nic = $password = $user_type = $name = $email = $phone = "";
$nic_error = $name_error = $email_error = $password_error = $reg_error = $common_error =
  $phone_error = "";

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

  // Check if name is empty
  if (empty(trim($_POST["name"]))) {
    $name_error = "Please enter your name.";
    $view_error = $name_error;
  } else {
    $name = trim($_POST["name"]);
  }

  // Check if email is empty
  if (empty(trim($_POST["email"]))) {
    $email_error = "Please enter your email.";
    $view_error = $email_error;
  } else {
    $email = trim($_POST["email"]);
  }

  // Check if phone is empty
  if (empty(trim($_POST["phone"]))) {
    $phone_error = "Please enter your phone number.";
    $view_error = $phone_error;
  } else {
    $phone = trim($_POST["phone"]);
  }

  // Validate credentials
  if (empty($nic_error) && empty($password_error) && 
  empty($name_error) && empty($email_error) && empty($phone_error)) 
  {
    // sql statement
    $sql1 = "SELECT * FROM consumer_details 
      WHERE consumer_details.consumer_nic = '" . $nic . "'";

    $sql2 = "INSERT INTO fuelin_db.consumer_details
      (consumer_nic, consumer_name, consumer_phone, consumer_email) 
      VALUES 
      ('" . $nic . "', '" . $name . "', '" . $phone . "', '" . $email . "');";

    $sql3 = "INSERT INTO fuelin_db.consumer_login(consumer_nic, password) 
      VALUES ('" . $nic . "', '" . $password . "');";

    $sql4 = "INSERT INTO fuelin_db.user_login_type (user_nic, user_type) 
      VALUES ('" . $nic . "', '0') ";

    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
      // display a error message
      $reg_error = "Account already exists!!!";
      $view_error = $reg_error;
    } else {
      if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)
        && mysqli_query($conn, $sql4))
      {
        $view_message = "User Registration Successful.!!! 
        Goto Login Page to login to the system.";

      } else {
        $common_error = "Can't register user.";
        $view_error = $common_error;
      }
    }
  } else {
    $common_error = "Please input valid data.";
    $view_error = $common_error;
  }
}
//echo $view_erroror;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuelIn Registration Page</title>

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

<body class="hold-transition">
  <div class="container-fluid">
    <ul class="nav justify-content-end">
      <li class="nav-item" style="margin-right: 1%;">
        <a class="nav-link" style="background-color: #ff6a06;
        color: white; font-weight: 400; border-radius: 10px; 
        margin: 3%; width: 100%;" href="company/">Company Login >>></a>
      </li>
    </ul>
  </div>

  <div class="register-page">
    <div class="register-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1 login-title"><b>FuelIn</b><br>Registration</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Register a new membership</p>

          <form action="" method="post" class="mb-2">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Full name" name="name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user main-font-color"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope main-font-color"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="NIC" name="nic">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-id-card main-font-color"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Mobile Phone Number" name="phone">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone main-font-color"></span>
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

            <!-- <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock main-font-color"></span>
                </div>
              </div>
            </div> -->
            <div class="row">
              <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <a href="index.php" class="text-center login-title">
            I already have a membership >>></a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
  </div>


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
    } else if (!empty($view_message)) {
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