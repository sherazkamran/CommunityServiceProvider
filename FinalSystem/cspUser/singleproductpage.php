<?php include("header.php");
include 'connection.php';

$product_id = $_GET['view'];

$query = "SELECT * from product where product_id=$product_id";
$run = mysqli_query($conn, $query);
$row = mysqli_fetch_array($run);


if (isset($row)) {
}
?>

<div class="container mb-3">
    <div class="row my-5 py-5">
        <div class="col-md-5">

            <?php $path = "../cspManager/" . $row['image']; ?>
            <img src="<?php echo $path ?>" class="img-thumbnail" alt="" style="width:500px; height:400px;">
        </div>

        <div class="col-md-7 px-5">

            <h2 class="prodName"><?php echo $row['name'] ?></h2>
            <p class="prodDescription">
                <?php echo $row['description'] ?>
            </p>
            <h5 class="prodPrice py-3">Rs.
                <?php echo $row['price'] ?> /- Per 'Unit' defined in description.
            </h5>


            <form class="range-field" method="post" action="./cart.php">
                <input type="text" name="id" value="<?php echo $row['product_id'] ?>" hidden>
                <input type="text" name="name" value="<?php echo $row['name'] ?>" hidden>
                <input type="text" name="price" value="<?php echo $row['price'] ?>" hidden>

                <div class="form-group">
                    <label for="quantity">Quantity (units):</label>
                    <input type="number" value="1" min="1" class="form-control border" name="qty" style="width:50%; display:block;" />
                </div>
                <div class="row d-flex justify-content-start justify-content-xl-around form-group disabled ">
                    <div>
                        <input type="submit" class="form-control mr-3" style="background-color: #6FB856; color: white; width: 260px;" name="addToC" value="Add to Cart">
                    </div>

                    <div>
                        <a href="cart.php"><input type="submit" name="justViewCart" class="btn btn-info form-control" style="background-color: #99C74E;width: 260px;" value="View Cart"></a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<?php include("footer.php"); ?>




<!-- For Size variation small, medium,large -->

<!-- 
    <div class="form-group">
                    <label for="email">Size:</label>
                    <select name="variation" class="form-control span4" style="width:50%;">
                        <option value="small">Small</option>
                        <option value="small">Medium</option>
                        <option value="small">Large</option>
                    </select>
    </div>
 -->