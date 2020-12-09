<?php
ob_start();
session_start();
if (isset($_SESSION['auth'])) {
  if ($_SESSION['auth'] == "0" || $_SESSION['auth'] == "") {

    echo '<script type="text/javascript">';
    echo "alert('You Must Login First')";
    echo "</script>";
    header("Location: login.php");
  }
  include "connection.php";
  $userId = $_SESSION['auth'];
} else {
  header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<title>CSP</title>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <!-- <script src="js/jquery.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
  <!-- bootstrap css file cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <style>
    .scrollbarStyle {

      float: left;
      max-height: 300px;
      width: 65px;
      background: #F5F5F5;
      overflow-y: hidden;

      margin-bottom: 25px;
    }

    .dropdown-menu:hover {
      overflow-y: auto;

    }

    .scrollbarStyle::-webkit-scrollbar-track {
      box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      background-color: #F5F5F5;
      border-radius: 10px;
    }

    .scrollbarStyle::-webkit-scrollbar {
      width: 6px;
      background-color: #F5F5F5;

    }

    .scrollbarStyle::-webkit-scrollbar-thumb {
      background-color: #AAA;
      border-radius: 10px;
      background-image: -webkit-linear-gradient(90deg,
          rgba(0, 0, 0, .2) 25%,
          transparent 25%,
          transparent 50%,
          rgba(0, 0, 0, .2) 50%,
          rgba(0, 0, 0, .2) 75%,
          transparent 75%,
          transparent)
    }
  </style>

  <!-- font awesome cdn link -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
  <!-- custom stylesheet -->

  <link rel="icon" href="assets/icons/main_icon.png" type="image/ico">

  <!-- <link rel="stylesheet" href="./css/style.css"> -->

</head>

<body>
  <!-- #navbar start  "   -->
  <nav class="navbar  " style="background-color: #99C74E;">
    <a class="navbar-brand" href="#"></a>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 sticky-top ">

    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <!-- #logo container -->
      <a class="navbar-brand mt-md-4 mt-lg-0" href="#"><img width="50" height="50" src="./assets/logo/csp_logo_con.png"></a>
      <ul class="navbar-nav mr-auto mt-2  mt-lg-0">
        <li class="nav-item ">
          <a class="nav-link home" href="./">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link shop" href="shop.php">Shop</a>
        </li>
        <li class="nav-item" style="width: max-content;">
          <a class="nav-link book" href="singlebookingpage.php">Reserve a Ride</a>
        </li>
        <li class="nav-item" style="width:max-content">
          <a class="nav-link hireService" href="singlehiring.php">Hire Services</a>
        </li>
        <li class="nav-item" style="width: max-content;">
          <a class="nav-link payBill" href="paybills.php">Pay Bills</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link complain" href="complain.php">Complain</a>
        </li>
        <li class="nav-item d-lg-none">
          <a class="nav-link cart" href="cart.php">Cart</a>
        </li>
      </ul>
      <!--Start btn Check  -->
      <div class="d-flex justify-content-between">
        <div class="mr-3 pt-1">

          <a class="nav-link d-none d-lg-block" id="cartBtn" style="color: #D3D3D3;" data-toggle="tooltip" title="Cart" href="cart.php"><i class="fa fa-shopping-cart " aria-hidden="true"></i></a>
        </div>
        <div class="mr-4">

          <div class="dropdown pt-2">
            <a href="#" class="nav-link d-none d-lg-block dropdown-toggle fa fa-bell" id="notifyBtn" data-toggle="dropdown" data-toggle="tooltip" title="Notifications" id="notificationBtn" style="color: #d3d3d3;"><span class="badge badge-pill  badge-danger count ml-1"></span></a>
            <div class="dropdown-menu   d-xs-none  dropdown-menu-right scrollbarStyle mt-4 " id="notifyDropDown" style="width: 350px; background-color: white; max-height: 493px; border-radius: 10px; box-shadow: 0 0 40px rgba(0, 0, 0, 0.4);">



            </div>
          </div>
        </div>
        <div class="dropdown ">
          <a href="#" class="btn btn-secondary pt-2 dropdown-toggle" id="userInfo" role="button" data-toggle="dropdown" data-target="userInfo" aria-haspopup="true" aria-expanded="false" style="background-color: #9fd702">


            <?php $q = "SELECT * FROM user WHERE user_id='$userId' ";
            $data = mysqli_query($conn, $q);
            while ($row = $data->fetch_assoc()) { ?>
              <img class="rounded-circle mr-1" src="images/avatar.jpg" alt="Avatar" height="30" width="30" />
              <?php echo $row['name']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right d-xs-none bg-dark mt-2" style="width: 350px; height: 270px; border-radius: 10px; box-shadow: 0 0 40px rgba(0, 0, 0, 0.4);">
            <div class="dropdown-item d-flex flex-column align-content-center align-items-center bg-light py-3" style="height: 200px">
              <h5 class="arial"><?php echo $row['name'] ?> </h5>
              <h6 class="mb-auto">
                <span class="font-weight-normal"><?php echo $row['email'] ?></span>
              </h6>
              <img class="rounded-circle" src="images/avatar.jpg" alt="Avatar" width="80" height="80" />
            </div>
          <?php }
          ?>


          <div class="dropdown-item d-flex flex-row bg-dark align-content-center" style="padding-top: 10px">
            <a href="profile.php" class="btn btn-secondary mr-auto">Profile</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
          </div>
          </div>
        </div>


      </div>


      <!-- end btn Check -->

      <!--Start Button header right corner -->
      <!-- 
      <div class="navbar-custom-menu ">

        <ul class="nav navbar-nav ">
          User Account Menu
          <li class="dropdown user user-menu" id="avataaar2">
            Menu Toggle Button
            <div></div>
            <a href="#" class="dropdown-toggle btn btn-info " style="background-color: transparent; border: 0px; color: black; margin-left: 21%; max-height: 100%;" id="avataaar1" data-toggle="dropdown">
              The user image in the navbar
              //<?php

                //$q = "SELECT * FROM user WHERE user_id='$userId' ";
                //$data = mysqli_query($conn, $q);
                //while ($row = $data->fetch_assoc()) { 
                ?>
                <img style="min-width: 50px; min-height: 50px; max-height: 50px; max-width: 50px; border-radius: 50px; " src="images/avatar.jpg" class="user-image" alt="User Image">
                hidden-xs hides the username on small devices so only the image appears.
                <span class="hidden-xs"><?php// echo $row['name'] ?></span>
            </a>
            <ul class="dropdown-menu  " style="background-color:#e6e6fa; margin-left: -72px;">
              The user image in the menu


              <li class="user-header" style="margin-left: 3px;">
                <p style="display: flex; flex-direction: column; align-items: center;">
                  <span class="hidden-xs"><?php //echo $row['name'] 
                                          ?></span>
                  <small> <?php// echo $row['email'] ?></small>
                </p>

              </li>

            <?php //} 
            ?>
            <li class="user-footer" style="display: inline-flex;">
              <div class="pull-left col-md-12 pb-2" style="display: flex; flex-direction: row; justify-content: space-around;">
                <div class=" col-md-6">
                  <a href="profile.php">
                    <input type="button" class="btn btn-default btn-flat pl-0 pr-0 pv-2" style="font-size: 14px; border-color: black; background-color: lightsteelblue; min-width: 85px;max-width: 85px;" value="View Profle">
                  </a>
                </div>
                <div class="col-md-6 ">
                  <a href="logout.php">
                    <input type="button" class="btn btn-default btn-flat pl-0 pr-0 pv-2" style="font-size: 14px; border-color: black; background-color: lightsteelblue; min-width: 85px;max-width: 85px;" value="Log out">
                  </a>
                </div>

              </div>
            </li>
            </ul>
          </li>
          Control Sidebar Toggle Button -->
      <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
      <!-- </ul>
      </div> -->

      <!-- <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        
        <li class="nav-item" style="display:inline-flex;">
          <?php if (isset($_SESSION['auth'])) {

            echo '<a style="padding-right: 25px;" class="nav-link" href=""><span class="fa fa-user"></span></a>';
            echo '<a class="nav-link" href="logout.php"><span class="fa fa-power-off"></span></a>';
          } else {
            echo '<a class="nav-link" href="login.php"><span class="fa fa-user"></span></a>';
          } ?>
            
        </li>
      </ul> -->
    </div>
    <button class=" navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa fa-bars" aria-hidden="true"></i></span>
    </button>
  </nav>
  <script>
    $(document).ready(function() {


      function load_unseen_notification(view = '') {
        $.ajax({
          url: "fetchNotification.php",
          method: "post",
          data: {
            view: view
          },
          dataType: "json",
          success: function(data) {

            if (data.notification != '<h5 class="dropdown-header" style="color: red">No Notification</h5>') {
              data.notification = '<h5 class="dropdown-header" id="notifyHeader">Notifications</h5> <div class="dropdown-divider border"></div>' + data.notification;
            }
            $('#notifyDropDown').html(data.notification);
            if (data.unseen_notification > 0) {

              $('.count').html(data.unseen_notification);


            }

          }

        });

      }

      function update_order_notification(view = 'order') {
        $.ajax({
          url: "addOrderNotification.php",
          method: "post",
          data: {
            view: view
          },
          dataType: "text",
          success: function(data) {
            result = data;

          }
        })

      }

      function update_complain_notification(view = 'complain') {
        $.ajax({
          url: "addComplainNotification.php",
          method: "post",
          data: {
            view: view
          },
          dataType: "text",
          success: function(data) {
            result = data;

          }
        })

      }

      function update_service_notification(view = 'hire') {
        $.ajax({
          url: "addServiceNotification.php",
          method: "post",
          data: {
            view: view
          },
          dataType: "text",
          success: function(data) {
            result = data;

          }
        })

      }

      function update_reserve_notification(view = 'reserve') {
        $.ajax({
          url: "addReserveNotification.php",
          method: "post",
          data: {
            view: view
          },
          dataType: "text",
          success: function(data) {
            result = data;

          }
        })

      }
      $(document).on('click', '#notifyBtn', function() {
        $('.count').html("");
        load_unseen_notification("yes");
      })

      setInterval(function() {

        update_order_notification();
      }, 2000);


      setInterval(function() {

        update_complain_notification();
      }, 2000);

      setInterval(function() {

        update_service_notification();
      }, 2000);
      setInterval(function() {

        update_reserve_notification();
      }, 2000);
      setInterval(function() {

        load_unseen_notification();
      }, 2000);




      $('#notifyBtn').click(function() {
        $('#notifyDropDown').slideToggle(50);
      });

      // $('.nav-link').click(function() {
      //   $('.home').addClass('active');
      // });
      // $('.nav-link').click(function() {
      //   $('.shop').addClass('active');
      // });
      // $('.nav-link').click(function() {
      //   $('.book').addClass('active');
      // });
      // $('.nav-link').click(function() {
      //   $('.hireService').addClass('active');
      // });
      // $('.nav-link').click(function() {
      //   $('.payBill').addClass('active');
      // });
    });
  </script>

</body>

</html>