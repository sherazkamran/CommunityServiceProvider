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



            $sumTotal;
            $orderiidd;
            $orderiiiddd;
            $check3 = 0;

            ?>
            <center>
                <form action="userorderdetails.php" method="POST">
                    <div class="form-group col-md-3 mt-5 ">
                        <span class="form-group-addon " style="font-size: 18px;font-weight: bold;font-style: normal;"><?php echo $u_n_m ?>'s Orders </span>
                        <select class="form-control mt-3" name="txtOrderId" required="required">
                            <option value="" disabled selected>Select Order ID</option>

                            <?php

                            $query = "SELECT * from placed_order WHERE user_id='$u_id'";
                            $run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($run)) {
                                if ($check3 == 0) {
                                    $check3++;
                                    $orderiidd = $row['order_id'] ?>

                                    <option value="<?php echo $row['order_id'] ?>"><?php echo $row['order_id'] ?>-<?php echo $row['order_status'] ?></option>
                                    <?php  } else {
                                    if ($orderiidd == $row['order_id']) {
                                    } else {
                                        $orderiidd = $row['order_id']; ?>
                                        <option value="<?php echo $row['order_id'] ?>"><?php echo $row['order_id'] ?>-<?php echo $row['order_status'] ?></option>
                            <?php    }
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="submit" name="submit" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px;" class="btn btn-info btn-md" value="View Details">
                    </div>
                </form>
            </center>



        </div>
    </div>