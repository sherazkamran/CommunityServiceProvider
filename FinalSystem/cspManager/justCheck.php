<?php include("header.php"); ?>
<?php
if (isset($_SESSION['login_id'])) {
    if ($_SESSION['type'] == "pm") {
        header('location:orders.php');
    } else if ($_SESSION['type'] == "deo") {
        header('location:productlist.php');
    } else if ($_SESSION['type'] == "admin") {
        header('location:admin_panel.php');
    }
}
?>

<title>Log in</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
$error = "";


if (isset($_POST['btnSubmit'])) {
    $identity = $_POST['identity'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    if ($identity == 1) {
        $querry = "SELECT * FROM userlogin WHERE email='$email' AND password='$password' ";
        $data = mysqli_query($conn, $querry);

        if (mysqli_num_rows($data) > 0) {
            while ($row = $data->fetch_assoc()) {
                if ($row['type'] == "admin") {
                    session_start();
                    $_SESSION['login_id'] = $row['id'];
                    $_SESSION['login'] = "1";
                    $_SESSION['type'] = $row['type'];

                    header('location:admin_panel.php');
                } else {
                    $error = "This Email Does not belongs to admin";
                }
            }
        } else {
            $error = "No user Found";
        }
    } elseif ($identity == 2) {
        $querry = "SELECT * FROM userlogin WHERE email='$email' AND password='$password' ";
        $data = mysqli_query($conn, $querry);

        if (mysqli_num_rows($data) > 0) {
            while ($row = $data->fetch_assoc()) {
                if ($row['type'] == "deo") {
                    session_start();
                    $_SESSION['login_id'] = $row['id'];
                    $_SESSION['login'] = "1";
                    $_SESSION['type'] = $row['type'];
                    header('location:productlist.php');
                } else {
                    $error = "This Account does not belongs to DEO";
                }
            }
        } else {
            $error = "No User Found";
        }
    } elseif ($identity == 3) {
        $querry = "SELECT * FROM userlogin WHERE email='$email' AND password='$password' ";
        $data = mysqli_query($conn, $querry);

        if (mysqli_num_rows($data) > 0) {
            while ($row = $data->fetch_assoc()) {
                if ($row['type'] == "pm") {
                    session_start();
                    $_SESSION['login_id'] = $row['id'];
                    $_SESSION['login'] = "1";
                    $_SESSION['type'] = $row['type'];
                    header('location:orders.php');
                } else {
                    $error = "This Account does not belongs to Production Manager";
                }
            }
        } else {
            $error = "No User Found";
        }
    }
}

if (isset($_POST['btnSignUp'])) {
    header("Location: signup.php");
}

?>


<center>

    <div class="container col-md-12" style="align-content: center; align-self:center; justify-content:center !important  ">
        <div class="login-box col-md-5  rounded border shadow-sm mt-5 ml-5 mb-5 ">

            <div class="login-box-body">
                <p class="login-box-msg">Enter Your Login Details</p>

                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="txtEmail" required="required">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="txtPassword" required="required">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label>Sign In as</label>
                        <select class="form-control" name="identity">
                            <option value="1">Admin</option>
                            <option value="2">Data Entry Operator
                            </option>
                            <option value="3">Production Manager
                            </option>
                        </select>
                    </div>
                    <div class="row">

                        <label style="color: red;"><?php echo $error; ?></label>
                        <div class="col-xs-12">
                            <center>
                                <br>
                                <button name="btnSubmit" type="submit" class="btn btn-primary btn-block ">Sign In</button>
                                <br>

                            </center>


                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <form action="" method="POST">



                </form>



            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </div>
</center>
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


<?php include("footer.php"); ?>