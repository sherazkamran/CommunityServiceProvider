<?php include("header.php");




if (isset($_POST['submitLocation'])) {
    $loc = $_POST['d_location'];

    $address = "";
    $uid = $_SESSION['auth'];

    if (!empty($loc)) {
        $address = $loc;


?>

        <div class="container my-4 py-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Order Details</h3>
                </div>
                <div class="card-body">
                    <table class="table striped">

                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sum-Price</th>
                        </tr>


                        <?php $sumTotal = 0;

                        date_default_timezone_set("Asia/Karachi");
                        $date = date('Y:m:d H:i:s');
                        $dayOfWeek = date("l");
                        $currentDate = $date;

                        $query_checkout = "SELECT * from cart";
                        $run = mysqli_query($conn, $query_checkout);
                        if (mysqli_num_rows($run) > 0) {
                            $oid = rand(100, 100000);
                            $q99 = "SELECT order_id from placed_orders WHERE order_id='$oid'";
                            $run99 = mysqli_query($conn, $q99);
                            if (mysqli_num_rows($run99) > 0) {
                                $oid = rand(10, 100000);
                            }
                            $insertQuery = "INSERT into placed_orders (order_id, checkout_time, delivery_address, user_id ) values ('$oid', '$currentDate', '$address','$uid')";
                            if (mysqli_query($conn, $insertQuery)) {


                                while ($row = mysqli_fetch_assoc($run)) {
                                    $pname = $row['product_name'];
                                    $pprice = $row['product_price'];
                                    $pqty =  $row['product_quantity'];
                                    $psum =  $row['sum_price'];
                                    $odst = "pending";

                        ?>
                                    <tr>
                                        <?php $sumTotal = $sumTotal +  $row['sum_price']; ?>
                                        <td><input type="text" name="p-name" value="<?php echo $row['product_name'] ?>" style="width:80%;" class="form-control" disabled></td>
                                        <td><input type="number" name="p-price" value="<?php echo $row['product_price'] ?>" style="width:80%;" class="form-control" disabled></td>
                                        <td><input type="number" name="p-qty" value="<?php echo $row['product_quantity'] ?>" style="width:80%;" class="form-control" disabled></td>
                                        <td><input type="number" name="p-sum-price" value="<?php echo $row['sum_price'] ?>" style="width:80%;" class="form-control" disabled></td>
                                        <?php

                                        $sqli  = "Insert into ordered_items(user_id,product_name,product_price,product_qty,product_sum,order_id,order_status, date_time, address) values('$uid','$pname','$pprice','$pqty','$psum','$oid','$odst', '$currentDate', '$address')";
                                        if (mysqli_query($conn, $sqli)) {
                                        } else {
                                            echo '<script>window.alert("Cannot checkout!")</script>';
                                        }

                                        ?>

                                    </tr>
                        <?php   }
                            } else {
                                echo '<script>window.alert("Error: Order Not Placed. Try Again")</script>';
                                echo '<script> window.location = "G.php";</script>';
                            }

                            $qEmptyCart = "DELETE from cart";
                            mysqli_query($conn, $qEmptyCart);
                        } else {
                            echo '<script>window.alert("Cart is Empty! Cannot checkout.")</script>';
                            echo '<script> window.location = "G.php";</script>';
                        }
                        ?>
                        <tr>

                            <td></td>
                            <th>Total Amount</th>
                            <td><?php echo $sumTotal ?> </td>
                            <td></td>

                        </tr>
                    </table>
                </div>
                <div class="card-footer">

                    <?php $userId = $_SESSION['auth'];
                    $query = "SELECT  name,contactNo,fulladdress  from user WHERE user_id = '$userId' ";
                    $runQinfo =  mysqli_query($conn, $query);
                    if (mysqli_num_rows($runQinfo) > 0) {
                        while ($row = mysqli_fetch_assoc($runQinfo)) {
                    ?>
                            <h4 class="title text-center">Your personal Information</h4>


                            <p class="text-center">
                                Name: <?php echo $row['name'] ?>
                            </p>
                            <p class="text-center">
                                Contact: <?php echo $row['contactNo'] ?>
                            </p>
                            <p class="text-center">
                                Address: <?php echo $address ?>
                            </p>
                    <?php    }
                    } else {
                        echo '<script>window.alert($nsf)</script>';
                    }
                    ?>




                </div>
            </div>
        </div>

<?php


    } else {
        echo '<script>window.alert("Provide destination address!.")</script>';
        echo '<script> window.location = "cart.php";</script>';
    }
} else {
    echo '<script>window.alert(" Empty! Cannot .")</script>';
}
?>
<?php include("footer.php"); ?>