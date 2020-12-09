<?php
    // $query = "SELECT * from placed_order where order_id='$order_id'";
    // $result = mysqli_query($conn, $query);
    // $row = $result->fetch_array(); {
       ?>
      </td>
      </td>
      </td>
      </tr>
      <tr>
        <th style="padding: 10px;">Grand Total</th>
        <td></td>
        <td></td>
        <td></td>
        <th><?php// echo $row['total_amount']; ?></th>
        <th></th>

      </tr>


      </table>
      <!--      </form> -->
    <?php //}
    ?>





  </div>
  <!-- /.box-body -->
  </div>
  <center>

    <?php
    if ($row['status'] == 'processing') {
      $class = 'hidden';
      $classB = 'btn btn-danger';
      $classA = 'btn btn-danger';

      $classC = 'form-control';
    }
    if ($row['status'] == 'pending') {
      $classA = 'hidden';
      $classB = 'btn btn-danger';
      $class = 'btn btn-danger';
      $classC = 'form-control';
    }
    if ($row['status'] == 'cancelled') {
      $classA = 'hidden';
      $classB = 'hidden';
      $class = 'hidden';
      $classC = 'hidden';
    }
    if ($row['status'] == 'delivered' && $_SESSION['type'] != "Shop Manager") {
      $classA = 'hidden';
      $classB = 'hidden';
      $class = 'hidden';
      $classC = 'hidden';
    }

    if (isset($_POST['btnProcess'])) {

      $sql = "UPDATE placed_order set status='processing' where order_id =$order_id;";

      if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">';
        echo "alert('Bill Status Updated')";
        header("Location: process_orders.php");
        echo "</script>";
      } else {
        echo '<script type="text/javascript">';
        echo "alert('Something Went Wrong')";
        echo "</script>";
      }
    }
    if (isset($_POST['btnComplete'])) {

      $sql = "UPDATE placed_order set status='delivered' where order_id =$order_id;";

      if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">';
        echo "alert('Bill Status Updated')";
        header("Location: com_orders.php");
        echo "</script>";
      } else {
        echo '<script type="text/javascript">';
        echo "alert('Something Went Wrong')";
        echo "</script>";
      }
    }
    if (isset($_POST['btnCancell'])) {

      $Reason = $_POST['txtReason'];
      $sql = "UPDATE placed_order set status='cancelled',reason='$Reason' where order_id =$order_id;";

      if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">';
        echo "alert('Bill Status Updated')";
        header("Location: cancelled_orders.php");
        echo "</script>";
      } else {
        echo '<script type="text/javascript">';
        echo "alert('Something Went Wrong')";
        echo "</script>";
      }
    }




    ?>

    <b>Current Status : </b>
    <span style="text-transform: capitalize; color: red;"><?php

                                                          echo $row['status'];


                                                          ?>
    </span>

    <form onSubmit="return confirm('Order Will be Sent to Processing! Proceed?')" action="" method="post">
      <button name="btnProcess" class="<?php echo $class; ?>" type="submit" style="margin:10px;">Send to Processing</button></form>
    <form onSubmit="return confirm('Order Will be Marked as Delivered! Proceed?')" action="" method="post">
      <button name="btnComplete" class="<?php echo $classA; ?>" type="submit" style="margin:10px;">Mark As Delivered</button></form>
    <form onSubmit="return confirm('Order Will be Cancelled! Proceed?')" action="" method="post">
      <div class="form-group"> <input type="text" name="txtReason" class="<?php echo $classC; ?>" placeholder="Reason for Cancellation" required="">
        <button name="btnCancell" class="<?php echo $classB; ?>" type="submit" style="margin:10px;">Cancell Order </button>
    </form>
    </form>
    </div>
  </center>

  </section>
  <!-- /.content -->

  </div>
  <!-- /End Table -->