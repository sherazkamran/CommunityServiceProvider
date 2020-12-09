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

  $order_id = $_GET['order_id'];
  ?>



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders
      </h1>

    </section>



    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box" id="bill">
        <div class="box-header">
          <a class="btn btn-primary" type="submit" href="print_template.php?order_id=<?php echo $order_id ?>">Print</a>
          <div style="float: right;">
            <p><b>Order ID : </b><?php echo $order_id; ?></p>
            <p></p>
          </div>

        </div>
        <div class="box-header">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <p style="   text-transform: capitalize; text-align:center;"><b>Sr # </b></p>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <p style="   text-transform: capitalize; text-align:center;"><b>Product Name</b></p>
          </div>


          <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
            <p style="   text-transform: capitalize; text-align:center;"><b>Quantity</b></p>
          </div>
          <div class="col-lg-2   col-md-4 col-sm-4 col-xs-4">
            <p style="   text-transform: capitalize; text-align:center;"><b>Unit Price</b></p>

          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <p style="   text-transform: capitalize; text-align:center;"><b>Sum Product Price</b></p>

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <!-- <form method="post" action="query.php"> -->

          <table class="table table-hover">



            <?php
            // $q = "SELECT cart.cart_item_id, cart.total_price,cart.quantity, product.name, product.price,product.description
            // FROM cart
            // INNER JOIN product ON cart.product_id = product.product_id where cart.order_id='$order_id';";
            ?>
            <?php
            $i = 1;

            $q = "SELECT * from ordered_items where order_id= '$order_id'";
            $total = 0;
            $result = mysqli_query($conn, $q);
            while ($row = mysqli_fetch_array($result)) {
              $total += $row['product_sum'];

            ?>

              <div class="row" id="myrow" style="background: #fff; margin: 0px; ">
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <p style="  text-align:center; "><b><?php echo $i++ ?></b></p>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <p style="color: #a17; text-align:center; "><b><?php echo $row['product_name'] ?></b></p>
              </div>

              <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
                <p style="color: #188;text-align:center; "><b> </b> <?php echo $row['product_qty'] ?></p>
              </div>
              <div class="col-lg-2   col-md-4 col-sm-4 col-xs-4">
                <p style="color: #188; text-align:center;"> <?php echo $row['product_price'] ?></p>

              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <p style="color: #188; text-align:center;"> <?php echo $row['product_sum'] ?></p>
              </div>



        </div>

      </div>
    <?php } ?>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
      <p style="color: #188; text-align:center;"> <?php echo "Total Charges: " .  $total; ?></p>

    </div>
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <?php
    include 'footer.php';
    ?>