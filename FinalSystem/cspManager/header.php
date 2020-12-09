<?php
include 'connection.php';
?>
<?php
session_start();
error_reporting(0);
if ($_SESSION['login_id'] == "0" || $_SESSION['login_id'] == "") {

  echo '<script type="text/javascript">';
  echo "alert('You Must Login First')";
  echo "</script>";
  header("Location: index.php");
}
$adminId = $_SESSION['login_id'];
?>
<!DOCTYPE html>
<html lang="en ">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Community Service Provider</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="contents/bootstrap.min.css">
  ​
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="contents/font-awesome.min.css">
  <link rel="stylesheet" href="contents/ionicons.min.css">
  <link rel="stylesheet" href="contents/AdminLTE.min.css">
  <link rel="stylesheet" href="contents/skin-blue.min.css">
  <!-- <link rel="stylesheet" href="./contents/style.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini" style="margin-top: -20px;">

  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>SP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CSP</b>
        </span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <?php

                $q = "SELECT * FROM admin WHERE admin_id='$adminId' ";
                $data = mysqli_query($conn, $q);
                while ($row = $data->fetch_assoc()) { ?>
                  <img src="images/avatar.jpg" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $row['name'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <!-- 
                <img src="<?php echo $row['image'] ?>" alt="User Image"> -->

                  <p>
                    <span class="hidden-xs"><?php echo $row['name'] ?></span>
                    <small> @<?php echo $row['username'] ?></small>
                  </p>
                  <img src="images/avatar.jpg" class="img-circle" alt="User Image">

                </li>
              <?php } ?>

              <!-- Menu Body -->
              <!--  <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
          
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!-- <a href="../dashboard/std_profile.php" class="btn btn-default btn-flat">Profile</a> -->
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
          </ul>
        </div>
      </nav>
    </header>