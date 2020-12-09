<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

<?php
include 'header.php';
if ($_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
    echo '<script type="text/javascript">';
    echo "alert('Access not allowed')";
    echo "</script>";
    header("Location: index.php");
} else {
    include 'servicemanager_sidebar.php';
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
    $avail = $_POST['newServiceAvailability'];

    $check = 0;

    $q2 = "SELECT * from service";
    $r2 = mysqli_query($conn, $q2);
    while ($row2 = mysqli_fetch_assoc($r2)) {
        if ($name == $row2['name']) {
            echo "<script>window.alert('Service already exists!');</script>";
            echo '<script>window.location = "viewservicelist.php";</script>';
            $check++;
        }
    }
    if ($check == 0) {
        $q = "INSERT into service (name, availability) values ('$name','$avail')";
        $run = mysqli_query($conn, $q);
        if ($run) {
            $success = "Added successfuly ";
        } else {
            $failed = 'Something went wrong';
        }
    }
}
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Hire Service
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
                        <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Add New Service</label></center>
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
                        <span class="form-group-addon">Availability</span>
                        <select class="form-control" name="newServiceAvailability" required="required">"
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                </div>




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