<?PHP
// Initialize the session
session_start();

$_SESSION["email"] = "";
$_SESSION["nic"] = "";

// Include connection file
require 'db.php';

// Define variables and initialize with empty values
$nic = $email = "";
$nic_error = $email_error = $common_error = "";
$otp = $otp_error = "";

if (isset($_POST["submit"])) {

  // Check if otp is empty
  if (empty(trim($_POST["otp"]))) {
    $otp_error = "Please enter OTP.";
    $view_error = $otp_error;
  } else {
    $otp = trim($_POST["otp"]);
  }

  // Validate credentials
  if (empty($otp_error)) 
  {
    // sql statement
    $sql1 = "SELECT consumer_details.consumer_nic,consumer_details.consumer_email 
    FROM consumer_details, consumer_login 
    WHERE consumer_login.otp = '".$otp."' 
    AND consumer_login.consumer_nic = consumer_details.consumer_nic;";

    $sql2 = "UPDATE consumer_login SET otp = '' 
    WHERE consumer_login.otp = '".$otp."';";

    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) == 1) {
      while($row1 = mysqli_fetch_assoc($result1)) {
        $email = $row1["consumer_email"];
        $nic = $row1["consumer_nic"];
      }
      if (mysqli_query($conn, $sql2)) {
        $_SESSION["email"] = $email;
        $_SESSION["nic"] = $nic;
        $view_message = "OTP Verified. Please Wait to Continue....";
      } else {
        //$view_error = "OTP is incorrect. Please input valid OTP";
      }
    } else {
      $view_error = "OTP is incorrect. Please input valid OTP";
    }
  } else {
    $common_error = "Error : Please try again.";
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
  <title>FuelIn Recover Password - OTP</title>

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
      <a href="#" class="h1 login-title"><b>FuelIn</b><br>Recover Password<br>OTP</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter your OTP and Verify.</p>
      <form action="" method="post" class="mb-2">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="OTP" name="otp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock main-font-color"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Verify and Continue</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <!-- <a href="login.html" class="login-title">Goto Login >>></a> -->
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
      // else if (!empty($view_message)) {
      //   echo "Swal.fire({
      //       icon: 'info',
      //       text: '" . $view_message . "',
      //       });
      //       wait(5000);  //5 seconds in milliseconds
      //       console.log('after');
      //       //window.location.href = 'recover-password.php';";
      //   $view_message = "";
      //   //header("location:recover-password.php");
      //   //exit;
      // }
      else if (!empty($view_message)) {
        echo "let timerInterval;
              Swal.fire({
                html: '" . $view_message . "',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                  }, 100)
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  //console.log('I was closed by the timer');
                  window.location.href = 'recover-password.php';
                }
              });
            //wait(5000);  //5 seconds in milliseconds
            //console.log('after');
            //window.location.href = 'recover-password.php';";
        $view_message = "";
        //header("location:recover-password.php");
        //exit;
      }
  ?>
</script>

</body>
</html>
