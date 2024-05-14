<?PHP
// Initialize the session
session_start();

// Include connection file
require '../db.php';

// Define variables and initialize with empty values
$nic = $password = $user_type = $name = $email = $phone = "";
$nic_error = $name_error = $email_error = $password_error = $reg_error = $common_error =
  $phone_error = "";

  $op1 = "";
  $op2 = "";

if (isset($_POST["submit"])) {

  $op1 = $_POST["op1"];
  $op2 = $_POST["op2"];

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

  // Validate credentials
  if (empty($nic_error) && empty($password_error) && 
  empty($name_error) && empty($email_error)) 
  {
    // sql statement
    $sql1 = "SELECT * FROM staff_details 
    WHERE staff_details.staff_nic = '" . $nic . "'";

    $sql2 = "INSERT INTO `staff_details` (`staff_nic`, `staff_name`, 
    `staff_address`, `staff_phone`, `staff_email`) 
    VALUES ('" . $nic . "', '" . $name . "', '', '', '" . $email . "')";

    $sql3 = "INSERT INTO `staff_login` (`staff_nic`, `password`, `station_id`) 
    VALUES ('" . $nic . "', '" . $password . "', '" . $op2 . "')";

    $sql4 = "INSERT INTO `user_login_type` (`user_nic`, `user_type`) 
    VALUES ('" . $nic . "', '" . $op1 . "')";

    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
      // display a error message
      $reg_error = "Account already exists!!!";
      $view_error = $reg_error;
    } else {
      if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)
        && mysqli_query($conn, $sql4))
      {
        $view_message = "Staff Registration Successful.!!!";

      } else {
        $common_error = "Can't register staff.";
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
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php" role="button">
          <i class="fas fa-door-open"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FuelIn</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="01-adm.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Staff Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="02-staff.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Staff</p>
                </a>
              </li>
   <!-- <li class="nav-item">
                <a href="02-1-staffv1.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="02-2-staffd.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delete Staff</p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Clerk</p>
                </a>
              </li> -->
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Fule Station Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="03-adtw.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Town</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="04-adst.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Station</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Vehicle Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="05-advhty.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Vehicle Type</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Quota Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="06-adqut.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Vehicle Type Quota</p>
                </a>
              </li>
            </ul>
          </li>

         <!-- <li class="nav-item">
            <a href="07-adchps.php" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                User Settings
              </p>
            </a>
          </li> -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Staff</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Staff</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background-color: #ff6a06;">
                <h3 class="card-title">Add Staff</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIC</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter nic" name="nic">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="op1">
                      <option value="2">Station Manager</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Office / Station</label>
                    <select class="form-control" name="op2">
                    <?php 
                        $sql = "SELECT * FROM `fuel_stations`";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                          // output data of each row
                          while($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="'.$row["station_id"].'">'.$row["station_name"].'</option>';
                          }
                        } else {
                          echo '<option>----</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="password">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary col-12" 
                  style="background-color: #ff6a06; border-color: #ff6a06;">Add</button>
                </div>
                <!-- /.card-body -->

                <!-- <div class="card-footer">
                  
                </div> -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->

          

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>FuelIn System 2023</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Sweet Alert 2 -->
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

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
