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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSP</title>
  <!-- bootstrap css file cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- font awesome cdn link -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
  <!-- custom stylesheet -->

  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <!-- #navbar start -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <!-- #logo container -->
      <a class="navbar-brand" href="#"><img src="./assets/logo/logo.png" style="width:100px;"></a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="G.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="singlebookingpage.php">Reserve a Ride</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="singlehiring.php">Hire Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paybills.php">Pay Bills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="complain.php">Complain</a>
        </li>
      </ul>





      <!-- <div  style="display: flex; justify-content: end;">

         <a class="nav-link" href="logout.php"><span class="fa fa-power-off"></span></a>
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
  </nav>