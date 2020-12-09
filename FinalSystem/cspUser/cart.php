<?php include("header.php");
include("connection.php"); ?>



<?php
$isRemoved = false;
$isAdded = false;
$isExisting = false;
if (isset($_POST['addToC'])) {
    $pid =  $_POST['id'];
    $pname = $_POST['name'];
    $pprice = $_POST['price'];
    $pqty = $_POST['qty'];

    $temp = 0;


    $query = "SELECT * from cart ";
    $run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($run)) {
        if ($pid == $row['product_id']) {
            $temp++;
        }
    }

    if ($temp != 0) {
        // Already existing... 
        echo '<script>
        window.alert("Already added to cart...")
        window.location.href = "shop.php";
        </script>';
    } else {

        $sp = $pqty * $pprice;
        $sql = "INSERT INTO cart(product_quantity,product_price,product_id,product_name, sum_price) VALUES('$pqty','$pprice','$pid','$pname','$sp')";

        if (mysqli_query($conn, $sql)) {
            // Successfully inserted...

            echo '<script>window.location.href = "shop.php";</script>';
        } else {
            echo '<script>window.alert("Check your connection with database.")
            window.location.href = "shop.php";
            </script>';
        }
    }
} else if (isset($_POST['justViewCart'])) {
    header("location:cart.php");
} else if (isset($_POST['justCheckout'])) {

    header("location:cart.php");
} else {
} ?>


<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">

            <table class="table striped">
                <thead class="thead thead-dark">

                    <tr>
                        <th>Sr#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <form class="range-field" action="checkout.php" method="post">

                    <?php
                    $srno = 0;
                    $query = "SELECT * from cart ";
                    $run3 = mysqli_query($conn, $query);
                    $sumTotal = 0;
                    while ($row = mysqli_fetch_assoc($run3)) {
                        $srno++;
                        $sumPrice = 0;
                        $qntty = $row['product_quantity'];
                        $prc = $row['product_price'];
                        $sumPrice = $prc * $qntty;
                        $sumTotal = $sumTotal + $sumPrice;
                    ?>
                        <tbody>

                            <tr>
                                <td><?php echo $srno ?></td>
                                <td><input type="text" name="p-name" value="<?php echo $row['product_name'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="number" name="p-price" value="<?php echo $row['product_price'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="number" min="1" name="p-qty" disabled value="<?php echo $row['product_quantity'] ?>" style="width:80%;" class="form-control"></td>
                                <td><input type="number" name="p-sum-price" value="<?php echo $sumPrice ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><a href="cart.php?id=<?php echo $row['cart_item_id'] ?>">Delete</a></td>
                            </tr>


                        <?php } ?>

                        <tr>
                            <th>ADDRESS:</th>
                            <td><input type="text" name="d_location" style="width:140%;" placeholder="Mention delivery address here!" class="form-control pl-1"></td>
                            <td></td>


                            <th>Total Price:</th>

                            <th><input type="number" name="sumTotal" style="width:80%;" value="<?php echo $sumTotal ?>" class="form-control" disabled></th>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="submitLocation" class="btn btn-info form-control " style="width:80%;background-color: #6FB856;" value="Checkout"></td>
                            <th></th>
                            <td>
                                <a href="G.php" style="width:80%;background-color: #6FB856;" class="btn btn-info form-control">Shop More</a>
                            </td>
                            <th></th>
                            <th></th>
                        </tr>
                        </tbody>
                </form>
            </table>
        </div>
    </div>

    <?php
    if (isset($_GET['id'])) {
        $del = $_GET['id'];
        $sql_del = "DELETE FROM cart where cart_item_id='$del' ";
        if (mysqli_query($conn, $sql_del)) {
            echo '<script>window.alert("Item removed from Cart.")
            window.location.href = "cart.php";
            </script>';
        }
    }

    ?>