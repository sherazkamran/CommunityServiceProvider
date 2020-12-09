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
  $prodcat_id = $_GET['prodcat_id'];
  ?>



 <title>Edit Category</title>







 <?php
  $formatError = "";
  $success  = "";
  $failed = "";
  if (isset($_POST['btnSubmit'])) {
    $name = $_POST['txtName'];
    $status = $_POST['txtStatus'];




    $query = "UPDATE product_category set name='$name', status='$status' where prodcat_id=$prodcat_id;";

    if (mysqli_query($conn, $query)) {
      $success = "Updated successfuly ";
    } else {
      $formatError = 'Something went wrong';
    }
  }
  ?>

 </head>

 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Edit Category
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
          $query = "SELECT * from product_category where prodcat_id='$prodcat_id';";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) == 0) { ?>

         <?php }
          ?>
         <?php
          while ($row = $result->fetch_array()) {
          ?>
           <div class="box-body ">
             <form style="padding-left: 10px; padding-right: 10px;" method="POST" action="" enctype="multipart/form-data">
               <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Edit Category</label></center>
               <center>
                 <p style="color: green; font-size: 15px;"><b><?php echo $success; ?></b></p>
               </center>
               <center>
                 <p style="color: red; font-size: 15px;"><b><?php echo $failed; ?></b></p>
               </center>
               <span class="form-group-addon">Name</span>
               <div class="form-group" style="margin-bottom: 20px; ">

                 <input type="text" name="txtName" class="form-control" placeholder="Name" required="required" value="<?php echo $row['name'] ?>">
               </div>

               <span class="form-group-addon"><b>Category Status</b></span>


               <div class="form-group" style="margin-bottom:  20px; ">
                 <select class="form-control" name="txtStatus">
                   <option value="Active"> Active</option>
                   <option value="De-Active"> De-Active</option>

                 </select>


               </div>






               <center><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Done</button>


               </center>


             </form>
           </div>
         <?php }
          ?>


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