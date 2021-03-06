<?php
ob_start();
session_start();
include("connection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Community Service Provider">
    <meta name="keywords" content="Community Service Provider, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Community Service Provider</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="./css/login_style.css" rel="stylesheet">
</head>

<body>
    <div class="page login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">

                        <div class="info d-flex flex-column align-items-center justify-content-around ">

                            <img class="" src="assets/logo/community_logo_1mixg.png" alt="CSP Logo" width="20%">
                            <div class="content mb-5">
                                <div class="logo">
                                    <h1 class="font-weight-bold">COMMUNITY </b>
                                        <h3 class="text-center" style="color: orange;"> SERVICE PROVIDER</h3>
                                    </h1>

                                </div>
                            </div>
                            <small class="text-center">Developed by Codepub Inc. </small>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">

                        <div class="form d-flex align-items-center">

                            <div class="content">
                                <form action="#" method="post" class="form-validate" novalidate="novalidate">
                                    <div class="form-group">
                                        <input id="loginUsername" type="email" name="email" required="" placeholder="Email" data-msg="Please enter your username" class="input-material">
                                        <!-- <label for="email" class="label-material">Email</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="loginUserPassword" type="password" name="password" placeholder="Password" required="" data-msg="Please enter your password" class="input-material">
                                        <!-- <label for="password" class="label-material">Password</label> -->
                                    </div>
                                    <input type="submit" name="submit1" style="background-color: #6FB856; border-color: black; width: 90px;" class="btn btn-primary" value="Login">
                                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                                </form><a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="signup.php" class="signup">Signup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

</html>

<?php
if (isset($_POST['submit1'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query2 = "SELECT * FROM user where email = '$email' AND password='$password' && status != 'pending'";
    $run2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($run2) > 0) {
        $row = mysqli_fetch_array($run2);
        $_SESSION['auth'] = $row[0];
        $_SESSION['name'] = $row[1];
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo '<script>window.alert("Make sure both email and password are correct")                
                window.location.href = "login.php";
                </script>';
    }
}
?>