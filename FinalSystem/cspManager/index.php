<!DOCTYPE html>
<html>

<head>
  <?php
  //session_start();
  if (isset($_SESSION['login_id'])) {
    if ($_SESSION['type'] == "Shop Manager") {
      header('location:orders.php');
    } else if ($_SESSION['type'] == "Booking Manager") {
      header('location:productlist.php');
    } else if ($_SESSION['type'] == "Service Manager") {
      header('location:additem.php');
    } else if ($_SESSION['type'] == "Billing Manager") {
      header('location:invoice.php');
    } else if ($_SESSION['type'] == "Complain Manager") {
      header('location:edit_cat.php');
    } else if ($_SESSION['type'] == "User Manager") {
      header('location:viewuserlist.php');
    }
  }

  ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="contents/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="contents/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="contents/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="contents/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="contents/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <?php
  $error = "";


  include("connection.php");
  if (isset($_POST['btnSubmit'])) {
    $identity = $_POST['identity'];
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    if ($identity == 1) {
      $querry = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
      $data = mysqli_query($conn, $querry);

      if (mysqli_num_rows($data) > 0) {
        while ($row = $data->fetch_assoc()) {
          if ($row['name'] == "User Manager") {
            session_start();
            $_SESSION['login_id'] = $row['admin_id'];
            $_SESSION['login'] = "1";
            $_SESSION['type'] = $row['name'];

            header('location:viewuserlist.php');
          } else {
            $error = "This Account does not belong to User Manager";
          }
        }
      }
    } elseif ($identity == 2) {
      $querry = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
      $data = mysqli_query($conn, $querry);

      if (mysqli_num_rows($data) > 0) {
        while ($row = $data->fetch_assoc()) {
          if ($row['name'] == "Shop Manager") {
            session_start();
            $_SESSION['login_id'] = $row['admin_id'];
            $_SESSION['login'] = "1";
            $_SESSION['type'] = $row['name'];

            header('location:orders.php');
          } else {
            $error = "This Username Does not belong to Shop Manager";
          }
        }
      }
    } elseif ($identity == 3) {
      $querry = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
      $data = mysqli_query($conn, $querry);

      if (mysqli_num_rows($data) > 0) {
        while ($row = $data->fetch_assoc()) {
          if ($row['name'] == "Booking Manager") {
            session_start();
            $_SESSION['login_id'] = 2;
            $_SESSION['login'] = "1";
            $_SESSION['type'] = $row['name'];
            header('location:viewcarlist.php');
          } else {
            $error = "This Account does not  to Booking Manager";
          }
        }
      }
    } elseif ($identity == 4) {
      $querry = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
      $data = mysqli_query($conn, $querry);

      if (mysqli_num_rows($data) > 0) {
        while ($row = $data->fetch_assoc()) {
          if ($row['name'] == "Service Manager") {
            session_start();
            $_SESSION['login_id'] = $row['admin_id'];
            $_SESSION['login'] = "1";
            $_SESSION['type'] = $row['name'];
            header('location:viewhiringrequest.php');
          } else {
            $error = "This Account does not belong to Service Manager";
          }
        }
      }
    } elseif ($identity == 5) {
      $querry = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
      $data = mysqli_query($conn, $querry);

      if (mysqli_num_rows($data) > 0) {
        while ($row = $data->fetch_assoc()) {
          if ($row['name'] == "Billing Manager") {
            session_start();
            $_SESSION['login_id'] = $row['admin_id'];
            $_SESSION['login'] = "1";
            $_SESSION['type'] = $row['name'];
            header('location:viewbill_list.php');
          } else {
            $error = "This Account does not belong to Billing Manager";
          }
        }
      }
    } elseif ($identity == 6) {
      $querry = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
      $data = mysqli_query($conn, $querry);

      if (mysqli_num_rows($data) > 0) {
        while ($row = $data->fetch_assoc()) {
          if ($row['name'] == "Complain Manager") {
            session_start();
            $_SESSION['login_id'] = $row['admin_id'];
            $_SESSION['login'] = "1";
            $_SESSION['type'] = $row['name'];
            header('location:viewcomplainlist.php');
          } else {
            $error = "This Account does not belong to Complain Manager";
          }
        }
      }
    } else {
      $error = "No Manager Found";
    }
  }



  ?>


</head>

<body class="hold-transition login-page" style="display: flex; align-items: center;">
  <div class="login-box allign-items-center" style="margin-bottom: 200px;">
    <div class="login-logo">
      <a href="#"><small>Community<b> Service </b>Provider </small> </a> </div> <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Enter Your Login Details</p>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="username" class="form-control" placeholder="Username" name="txtUsername" required="required">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="txtPassword" required="required">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group">
          <label>Sign In as</label>
          <select class="form-control" name="identity">
            <option value="1">User Manager</option>
            <option value="2">Shop Manager
            </option>
            <option value="3">Booking Manager
            </option>
            <option value="4">Service Manager</option>
            <option value="5">Billing Manager</option>
            <option value="6">Complain Manager</option>
          </select>
        </div>
        <div class="row">

          <label style="color: red;"><?php echo $error; ?></label>
          <div class="col-xs-12">
            <center>
              <button name="btnSubmit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              <br>

            </center>
          </div>
          <!-- /.col -->
        </div>
      </form>



    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="scripts/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="scripts/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="scripts/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>

</html>