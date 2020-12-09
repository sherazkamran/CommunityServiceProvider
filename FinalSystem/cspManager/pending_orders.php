<html>

<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php
  include 'header.php';
  if ($_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
    echo '<script type="text/javascript">';
    echo "alert('Access not allowed')";
    echo "</script>";
    header("Location: index.php");
  } else {
    include 'shopmanager_sidebar.php';
  }
  ?>
  <style type="text/css">
    .tablink {
      background-color: green;
      color: white;
      margin: 10px;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 30px 10px 30px;
      font-size: 25px;
      width: 25%;

    }

    .tablink:hover {
      background-color: red;
      color: white;
    }
  </style>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Shop Manager
        <small>Orders</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <center><a class="tablink" style="background-color: red" href="pending_orders.php">Pending</a>
        <a class="tablink" href="process_orders.php">Processing</a>
        <a class="tablink" href="com_orders.php">Delivered</a>
        <a class="tablink" href="cancelled_orders.php">Cancelled</a>
      </center>
      <div class="box" style="margin-top: 15px;">
        <div class="box-header">
          <h3 class="box-title">Orders</h3>

        </div>

        <center>
          <div class="box-header">
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
              <p style="   text-transform: capitalize; "><b>Order ID</b></p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
              <p style="   text-transform: capitalize; "><b>Customer Name</b></p>
            </div>
            <div class="col-lg-2   col-md-4 col-sm-4 col-xs-4">
              <p style="   text-transform: capitalize; "><b>Total Amount</b></p>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
              <p style="   text-transform: capitalize; "><b>Time</b></p>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p style="   text-transform: capitalize; "><b>Date</b></p>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p style="   text-transform: capitalize; "><b>Customer Contact</b></p>

            </div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
              <p style="   text-transform: capitalize; "><b>Status</b></p>

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <!-- <form method="post" action="query.php"> -->

            <table class="table table-hover">

              <?php
              $q = "SELECT placed_order.order_id, placed_order.total_amount,placed_order.issue_date,placed_order.issue_time,placed_order.status, user.name, user.email,user.contactNo
FROM placed_order
INNER JOIN user ON placed_order.user_id = user.user_id WHERE placed_order.status='Pending';";
              $result = mysqli_query($conn, $q);
              while ($row = $result->fetch_array()) { ?>
                <div class="row" id="myrow" style="background: #fff; margin: 0px;">
                  <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2	">
                    <p style="color: #a17; font-size: 14px;"><b><?php echo $row['order_id'] ?></b></p>

                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">



                    <p style="color: Red;text-transform: capitalize;"> <?php echo $row['name'] ?></p>

                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">


                    <p style="color: #188; "> <?php echo $row['total_amount'] ?></p>
                  </div>
                  <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                    <p style="color: black; "> <?php echo $row['issue_time'] ?></p>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
                    <p style="color: black; "> <?php echo $row['issue_date'] ?></p>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
                    <p style="color: #188; "> <?php echo $row['contactNo'] ?></p>
                  </div>
                  <div class="col-lg-1 col-md-4 col-sm-4 col-xs-4">
                    <p style="color: #188; text-transform: capitalize;"> <?php echo $row['status'] ?></p>
                  </div>
        </center>
        <center>
          <div class="col-lg-1 col-md-4 col-sm-4 col-xs-2">
            <a class="btn btn-info" href="orderdetails.php?order_id=<?php echo $row['order_id'] ?>" style="width: 100px; margin-top: 10px;">View</a>



          </div>
        </center>
      </div>
      <div style="width: 100%; height: 5px; background: #eee;"></div>
    <?php } ?>
  </div>

  </section>
  <!-- /.content -->
  </div>
  <?php
  include 'footer.php';
  ?>