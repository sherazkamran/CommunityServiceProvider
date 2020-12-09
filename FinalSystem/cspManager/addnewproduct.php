<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

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








<!--  <style type="text/css">
     
    .w3-card{
      background: #fff;
      margin-left: auto;
      margin-right: auto;
      
      width: 400px;
      margin-top: 100px;
      border-radius: 20px;
      border: 5px solid #188;
       

    }
    
  </style>
 -->
<?php
$formatError = "";
$success  = "";
$failed = "";
if (isset($_POST['btnSubmit'])) {
    $name = $_POST['txtName'];
    $description = $_POST['txtDescription'];

    $price = $_POST['txtPrice'];
    $prodcat_id = $_POST['txtCategoty'];


    $filename = $_FILES['chooseimage']['name'];
    $dest = "images/" . time() . basename($filename);
    $size = $_FILES['chooseimage']['size'];
    $tempname = $_FILES['chooseimage']['tmp_name'];
    $fulname = explode(".", $filename);
    $extension = $fulname[1];

    if ($extension == "JPG" || $extension == "PNG" || $extension == "png" || $extension == "GIF" || $extension == "JPEG" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "jpeg") {
        move_uploaded_file($tempname, $dest);
        $query = "INSERT into product (name,description,price,prodcat_id,image) values ('$name','$description','$price','$prodcat_id','$dest');";

        if (mysqli_query($conn, $query)) {
            $success = "Added successfuly ";
        } else {
            echo 'Something wents wrong';
        }
    } else {
        $formatError = "Wrong image format";
    }
}
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Item
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container">

        <div class="col-md-3">

        </div>

        <div class="col-md-6 ">
            <div class="box box-success">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Student Info</h3> -->
                </div>
                <!-- /.box-header -->


                <div class="box-body ">
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Add New Product</label></center>
                        <center>
                            <p style="color: green; font-size: 15px;"><b><?php echo $success; ?></b></p>
                        </center>
                        <center>
                            <p style="color: red; font-size: 15px;"><b><?php echo $failed; ?></b></p>
                        </center>
                        <span class="form-group-addon">Name</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="txtName" class="form-control" placeholder="Name" required="required">
                        </div>
                        <span class="form-group-addon"><b>Product Description</b></span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <TEXTAREA rows="13" name="txtDescription" class="form-control" placeholder="Description" required="required"></TEXTAREA>
                        </div>
                        <span class="form-group-addon">Price</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="Number" name="txtPrice" class="form-control" placeholder="Price" required="required">
                        </div>

                        <div class="form-group">
                            <span class="form-group-addon">Category</span>


                            <select class="form-control" name="txtCategoty" required="required">
                                <option value="">Select Category</option>


                                <?php
                                $q = "SELECT * from product_category;";
                                $result = mysqli_query($conn, $q);
                                ?>

                                <?php
                                while ($row = $result->fetch_array()) { ?>
                                    <option value=" <?php echo $row['prodcat_id'] ?>"><?php echo $row['name'] ?></option>



                                <?php }
                                ?>
                            </select>
                        </div>

                        <input type="file" name="chooseimage" class="btn btn-primary" style="margin-top: 10px;">
                        <p style="color: red;"><b><?php echo $formatError; ?></b></p>




                        <center><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Done</button>


                        </center>


                    </form>
                </div>



                <!-- /.box-body -->
            </div>
        </div>


        <div class="col-md-3">

        </div>
    </section>
    <!-- /.content -->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
include 'footer.php';
?>