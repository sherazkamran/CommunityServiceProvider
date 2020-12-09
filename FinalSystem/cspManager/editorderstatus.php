 <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

 <?php
    include 'header.php';
    ob_start();
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




 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Edit Order Status
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

                    $existingStatus = "";
                    $newStatus = "";
                    $query = "SELECT * from ordered_items where order_id='$order_id'";
                    $result = mysqli_query($conn, $query);
                    while ($row = $result->fetch_array()) {
                        $existingStatus = $row['order_status'];
                    }

                    // if ($existingStatus=='Delivered'){
                    //     $
                    // }
                    ?>

                 <div class="box-body ">
                     <form action="" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <span class="form-group-addon" style="font-size: 20px;font-weight: bolder;font-style: normal;">Status</span>
                             <select class="form-control" name="txtStatus" required="required">
                                 <option value="" disabled selected>Set Status</option>
                                 <option value="Pending">Pending</option>
                                 <option value="Processed">Process</option>
                                 <option value="onDelivery">onDelivery</option>
                                 <option value="Delivered">Delivered</option>
                                 <option value="Cancelled">Cancelled</option>
                             </select>
                         </div>
                         <center><input type="submit" class="btn btn-success btn-lg" name="Submit"></center>
                     </form>
                     <?php
                        if (isset($_POST['txtStatus'])) {
                            if (!empty($_POST['txtStatus'])) {
                                $selected = $_POST['txtStatus'];
                                $q = "UPDATE placed_orders SET order_status = '$selected', notificationStatus=0 WHERE order_id = '$order_id'";
                                $q2 = "UPDATE ordered_items SET order_status = '$selected' WHERE order_id = '$order_id'";
                                $result = mysqli_query($conn, $q);
                                $result2 = mysqli_query($conn, $q2);
                                if ($result && $result2) {
                                    echo 'Status Updated Successfully! ';
                                    //   window.location.href = "http://www.w3schools.com";
                                    echo '<script>window.location = "orders.php";</script>';
                                }
                            } else {
                                echo 'Please select the value.';
                            }
                        }
                        ?>
                     <!-- ///////////////////////<a href="updatestatus.php?order_id="><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Update</button></a>//////////////////// -->



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