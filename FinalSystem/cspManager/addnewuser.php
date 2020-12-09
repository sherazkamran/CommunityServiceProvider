<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

<?php
include 'header.php';
if ($_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "Shop Manager") {
    echo '<script type="text/javascript">';
    echo "alert('Access not allowed')";
    echo "</script>";
    header("Location: index.php");
} else {
    include 'um_sidebar.php';
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
    $email = $_POST['txtEmail'];

    $password = $_POST['txtPassword'];
    $cnic = $_POST['txtCnic'];
    $phase = $_POST['txtPhase'];
    $street = $_POST['txtStreet'];
    $house = $_POST['txtHouse'];
    $contact = $_POST['txtContact'];



    $query = "INSERT into user (name,email,password,cnic,phase,streetNo,houseNo,contactNo) values ('$name','$email','$password','$cnic','$phase', '$street', '$house','$contact');";

    if (mysqli_query($conn, $query)) {
        $success = "Added successfuly ";
    } else {
        echo 'Something wents wrong';
    }
}
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New User
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
                        <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Add User</label></center>
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
                        <span class="form-group-addon"><b>Email</b></span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="email" name="txtEmail" placeholder="Email" required="required" class="form-control">
                        </div>
                        <span class="form-group-addon">Password</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="password" name="txtPassword" class="form-control" placeholder="Password" required="required">
                        </div>
                        <span class="form-group-addon">CNIC</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="txtCnic" class="form-control" placeholder="CNIC" required="required">
                        </div>
                        <span class="form-group-addon">Phase</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="txtPhase" class="form-control" placeholder="Phase" required="required">
                        </div>
                        <span class="form-group-addon">Street#</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="txtStreet" class="form-control" placeholder="Street#" required="required">
                        </div>
                        <span class="form-group-addon">House#</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="txtHouse" class="form-control" placeholder="House#" required="required">
                        </div>
                        <span class="form-group-addon">Contact#</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="txtContact" class="form-control" placeholder="Contact#" required="required">
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