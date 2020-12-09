<?php include("header.php");
include("connection.php"); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">




      <?php
      $u_id = $_SESSION['auth'];
      $q = "SELECT name from user WHERE user_id='$u_id'";
      $rn = mysqli_query($conn, $q);
      $rw = mysqli_fetch_array($rn);
      $u_n_m = $rw['name'];



      $sumTotal = 0;
      $orderiidd = 0;
      $orderiiiddd = 0;
      $check3 = 0;
      $order_status = "";
      $orderTime = "";

      ?>
      <center>

        <table class="table striped">
          <tr>
            <td></td>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sum-Price</th>
            <td></td>
          </tr>

          <form class="range-field" action="" method="post">


            <?php
            if (isset($_POST['submit'])) {
              $orderID = $_POST['txtOrderId'];

              if (!empty($orderID)) {
                if ($orderID != "Select Order ID") {
                  $sumTotal = 0;

                  $qqq = "SELECT * from ordered_items WHERE order_id ='$orderID'";
                  $resulted = mysqli_query($conn, $qqq);
                  while ($row2 = mysqli_fetch_assoc($resulted)) {

                    $orderTime = $row2['date_time'];
                    $sumPrice = $row2['product_sum'];
                    $order_status = $row2['order_status'];
                    $sumTotal = $sumTotal + $sumPrice;

            ?>

                    <tr>
                      <td></td>
                      <td><input type="text" name="p-name" value="<?php echo $row2['product_name'] ?>" style="width:80%;" class="form-control" disabled></td>
                      <td><input type="number" name="p-price" value="<?php echo $row2['product_price'] ?>" style="width:80%;" class="form-control" disabled></td>
                      <td><input type="number" min="1" name="p-qty" disabled value="<?php echo $row2['product_qty'] ?>" style="width:80%;" class="form-control"></td>
                      <td><input type="number" name="p-sum-price" value="<?php echo $row2['product_sum'] ?>" style="width:80%;" class="form-control" disabled></td>
                      <td></td>
                      <!-- <td><input type="submit" class="btn btn-info form-control  " style="width:100%;" name="remFrmCrt" value="Remove"></td> -->
                    </tr>

            <?php     }
                }
              } else {
                echo 'Please select the value.';
              }
            }
            ?>
            <tr>
              <td></td>
              <th>Order Time:</th>
              <th><input name="orderTime" style="width:80%;" value="<?php echo $orderTime ?>" class="form-control" disabled></th>
              <th>Total Price:</th>
              <th><input type="number" name="sumTotal" style="width:80%;" value="<?php echo $sumTotal ?>" class="form-control" disabled></th>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <th>Status:</th>
              <th><input name="sumTotal" style="width:80%;" value="<?php echo $order_status ?>" class="form-control" disabled></th>
              <td></td>
              <td></td>
            </tr>
          </form>
        </table>

      </center>



    </div>
  </div>