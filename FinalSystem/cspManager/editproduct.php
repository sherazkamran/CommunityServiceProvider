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



    $product_id = $_GET['product_id'];
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

        if ($extension == "JPG" || $extension == "PNG" || $extension == "GIF" || $extension == "JPEG" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "jpeg") {
            move_uploaded_file($tempname, $dest);


            $query = "UPDATE product set name='$name',description='$description', price='$price',prodcat_id='$prodcat_id' where product_id='$product_id';  ";

            if (mysqli_query($conn, $query)) {
                $success = "Updated successfuly ";
            } else {
                echo 'Something went wrong';
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
             Edit Product
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
                 <?php
                    $query = "SELECT * from product where product_id='$product_id';";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) == 0) { ?>

                 <?php }
                    ?>
                 <?php
                    while ($row = $result->fetch_array()) {
                    ?>

                     <div class="box-body ">
                         <form role="form" action="" method="post" enctype="multipart/form-data">
                             <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Edit Product</label></center>
                             <center>
                                 <p style="color: green; font-size: 15px;"><b><?php echo $success; ?></b></p>
                             </center>
                             <center>
                                 <p style="color: red; font-size: 15px;"><b><?php echo $failed; ?></b></p>
                             </center>
                             <span class="form-group-addon">Name</span>
                             <div class="form-group" style="margin-bottom: 20px;  ">

                                 <input type="text" name="txtName" class="form-control" value="<?php echo $row['name'] ?>" placeholder="Name" required="required">
                             </div>
                             <span class="form-group-addon"><b>Product Description</b></span>
                             <div class="form-group" style="margin-bottom: 20px; ">

                                 <TEXTAREA rows="10" name="txtDescription" class="form-control" placeholder="Description" required="required"><?php echo $row['description'] ?></TEXTAREA>
                             </div>
                             <span class="form-group-addon">Price</span>
                             <div class="form-group" style="margin-bottom: 20px; ">

                                 <input type="Number" name="txtPrice" class="form-control" placeholder="Price" required="required" value="<?php echo $row['price'] ?>">
                             </div>
                             <?php
                                $cat_id = $row['prodcat_id'];
                                $cquery = "SELECT * from product_category where prodcat_id='$cat_id'";
                                if (mysqli_query($conn, $cquery)) {
                                    $cfetch = mysqli_fetch_array($cquery);
                                }
                                ?>
                             <div class="form-group">
                                 <span class="form-group-addon">Category</span>


                                 <select class="form-control" name="txtCategoty" required="required">

                                     <option value="<?php echo $cfetch['name'] ?>"><?php echo $cfetch['name'] ?></option>



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
                             <span class="form-group-addon">Add Image</span>

                             <div class="form-group">
                                 <input type="file" name="chooseimage" class="btn btn-primary" style="margin-top: 10px;">
                                 <p style="color: red;"><b><?php echo $formatError; ?></b></p>

                             </div>




                             <center><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Done</button>


                             </center>


                         </form>
                     </div>



                     <!-- /.box-body -->
             </div>
         </div>
     <?php }
        ?>

     <div class="col-md-3">

     </div>
     </section>
     <!-- /.content -->
 </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <?php
    include 'footer.php';
    ?>