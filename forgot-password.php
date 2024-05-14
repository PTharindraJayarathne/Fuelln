<?php 
  // Initialize the session
  session_start();

  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  // Include connection file
  require 'db.php';

  $nic = $email = "";
  $nic_error = $email_error = $common_error = "";
  $otp = "";

  if (isset($_POST["submit"])) { 
    // Check if nic is empty
    if (empty(trim($_POST["nic"]))) {
      $nic_error = "Please enter NIC.";
      $view_error = $nic_error;
    } else {
      $nic = trim($_POST["nic"]);
    }

    // Validate credentials
    if (empty($nic_error)) 
    {
      $otp = rand(123456,987654);
      // sql statement
      $sql1 = "SELECT * FROM consumer_details 
      WHERE consumer_details.consumer_nic = '" . $nic . "'";

      $sql2 = "UPDATE consumer_login SET otp = '".$otp."' 
      WHERE consumer_login.consumer_nic = '".$nic."';";

      $result1 = mysqli_query($conn, $sql1);
      try {
        if (mysqli_num_rows($result1) == 1) {
          while($row1 = mysqli_fetch_assoc($result1)) {
            $email = $row1["consumer_email"];
            //$name = $row["consumer_name"];
          }
          if (mysqli_query($conn, $sql2)) {
            //Server settings
            $mail->SMTPDebug = 0;                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'tesla.nodebuckethost.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@webtestgo.xyz';                     //SMTP username
            $mail->Password   = 'S9m*Zt7#KcYH4';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('info@webtestgo.xyz', 'FuelIn System');
            $mail->addAddress($email, 'Recovery Email');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Reset Email from FuelIn System';
            $mail->Body    = '<h2>Your OTP Code to Reset your Password : </h2>
            <p><b>'.$otp.'</b></p>
            <p>Enter OTP and verify >>> https://webtestgo.xyz/recover-otp.php</p>
            <p>Thank You!!</p>';
            //$mail->AltBody = 'Your OTP Code to Reset your Password : '.$otp;
        
            //$mail->send();
            if ($mail->send()) {
              $view_message = "Reset OTP send to your email. Please check your email!!!";
            } else {
              $view_error = "Reset email sending error. Please try again!!!";
              //$view_error = $mail->ErrorInfo;
            }
            //echo 'Message has been sent';
            
          }
        } else {
          // display a error message
          $common_error = "NIC can't find. Please use correct NIC!!!";
          $view_error = $common_error;
        }
      } catch (Exception $e) {
        $view_error = "Reset email sending error. Please try again!!!";
        //$view_error = $mail->ErrorInfo;
        //$view_error = $e;
      }
    } else {
      // $common_error = "Please input valid data.";
      // $view_error = $common_error;
    }
  }

  //echo $view_error;
  //echo $otp;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuelIn Forgot Password</title>

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
      <a href="#" class="h1 login-title"><b>FuelIn</b><br>Forgot Password</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIC" name="nic">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card main-font-color"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Request new password</button>
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
