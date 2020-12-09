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
                                        <input id="signupUserName" type="text" name="name" placeholder="Name" required="" data-msg="Please enter your name" class="input-material">
                                        <!-- <label for="name" class="label-material">Name</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="singupUsername" type="email" name="email" placeholder="Email" required="" data-msg="Please enter your email" class="input-material">
                                        <!-- <label for="email" class="label-material">Email</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signupUserCnic" type="text" name="cnic" placeholder="CNIC" required="" data-msg="Please enter your cnic" class="input-material">
                                        <!-- <label for="cnic" class="label-material">CNIC</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signupUserBlock" type="text" name="blockNum" placeholder="Block#" required="" data-msg="Please enter your block number" class="input-material">
                                        <!-- <label for="blockNum" class="label-material">Block#</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signupUserStreet" type="text" name="streetNum" placeholder="Street#" required="" data-msg="Please enter your street number" class="input-material">
                                        <!-- <label for="streetNum" class="label-material">Street#</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signupUserHouse" type="text" name="houseNum" placeholder="House#" required="" data-msg="Please enter your house number" class="input-material">
                                        <!-- <label for="houseNum" class="label-material">House#</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signupUserContact" type="text" name="contactNum" placeholder="Contact#" required="" data-msg="Please enter your contact number" class="input-material">
                                        <!-- <label for="contactNum" class="label-material">Contact#</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signupUserPassword" type="password" name="pswd" placeholder="Password" required="" data-msg="Please enter your password" class="input-material">
                                        <!-- <label for="pswd" class="label-material">Password</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input id="signUserRePassword" type="password" name="rePswd" placeholder="Confirm Password" required="" data-msg="Please re-enter your password" class="input-material">
                                        <!-- <label for="rePswd" class="label-material">Confirm Password</label> -->
                                    </div>

                                    <input type="submit" name="submit2" style="background-color: #6FB856; border-color: black; width: 90px;" class="btn btn-primary" value="Sign Up">
                                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                                </form><small>Already have an account? </small><a href="login.php" class="signup">Login</a>
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
$success = "";

if (!empty($_POST['email']) && !empty($_POST['pswd']) && !empty($_POST['name']) && !empty($_POST['cnic']) && !empty($_POST['blockNum']) && !empty($_POST['streetNum']) &&  !empty($_POST['houseNum']) && !empty($_POST['contactNum']) &&  !empty($_POST['rePswd'])) {

    if (isset($_POST['submit2'])) {
        $email = $_POST['email'];
        $password = $_POST['pswd'];
        $name = $_POST['name'];
        $cnic = $_POST['cnic'];
        $phase = $_POST['blockNum'];
        $streetNo = $_POST['streetNum'];
        $houseNo = $_POST['houseNum'];
        $fullAddress = "House No $houseNo  ,Street  $streetNo, Phase  $phase, Comsian Residential Colony, Attock City.";
        $contactNo = $_POST['contactNum'];
        $repassword = $_POST['rePswd'];
        if ($password == $repassword) {
            if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
                echo '<script>window.alert("The email you have entered is invalid, please try again!)</script>';
            } else {
                $hash = md5(rand(100, 1000));
                $sql = "INSERT into user (name, email, password, cnic, phase, streetNo, houseNo,fulladdress, contactNo) values ('$name','$email','$password','$cnic','$phase','$streetNo','$houseNo','$fullAddress','$contactNo')";
                if (mysqli_query($conn, $sql)) {
                    echo '<script>window.alert("SignUp successfull! You can login when approved by the manager.")</script>';
                } else {
                    echo $fullAddress;
                    echo '<script>window.alert(" Check your connection with database.")</script>';
                }
            }
        } else {
            echo '<script>window.alert("Make sure passwords match!")</script>';
        }
    }
}
?>