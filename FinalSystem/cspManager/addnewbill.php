<head>

    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

    <?php
    include 'header.php';
    if ($_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
        echo '<script type="text/javascript">';
        echo "alert('Access not allowed')";
        echo "</script>";
        header("Location: index.php");
    } else {
        include 'billingmanager_sidebar.php';
    }
    ?>


    <title>Add New Bill</title>
</head>
<?php
include('connection.php');
$formatError = "";
$success  = "";
$failed = "";
if (isset($_POST['btnSubmit'])) {
    $bill_id = $_POST['bill_id'];
    $status = $_POST['txtStatus'];
    $month = $_POST['txtMonth'];
    $customer = $_POST['user_id'];
    $filename = $_FILES['chooseimage']['name'];
    $dest = "images/" . time() . basename($filename);
    $size = $_FILES['chooseimage']['size'];
    $tempname = $_FILES['chooseimage']['tmp_name'];
    $fulname = explode(".", $filename);
    $extension = $fulname[1];

    if ($extension == "JPG" || $extension == "PNG" || $extension == "GIF" || $extension == "JPEG" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "jpeg") {
        move_uploaded_file($tempname, $dest);
        $q = "INSERT into bills (bill_id,image,status,month,user_id) values ('$bill_id','$dest','$status', '$month','$customer');";
        $run = mysqli_query($conn, $q);
        // $error = mysqli_error($conn);
        // echo "<script>alert('$error')</script>";

        if ($run) {
            $success = "Added successfuly ";

            header("Location: viewbill_list.php");
        } else {
            //            echo "<script>alert(' $month')</script>";
            $formatError = 'Something wents wrong';
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
            Add Bill
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container">

        <div class="col-md-3">

        </div>

        <div class="col-md-6 ">
            <div class="box box-success">
                <div class="box-header with-border">

                </div>
                <!-- /.box-header -->


                <div class="box-body ">
                    <form style="padding-left: 10px; padding-right: 10px;" method="POST" action="" enctype="multipart/form-data">
                        <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Add New Bill</label></center>
                        <center>
                            <p style="color: green; font-size: 15px;"><b><?php echo $success; ?></b></p>
                        </center>
                        <center>
                            <p style="color: red; font-size: 15px;"><b><?php echo $failed; ?></b></p>
                        </center>
                        <span class="form-group-addon">Bill ID</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="bill_id" class="form-control" placeholder="Bill ID" required="required">
                        </div>
                        <span class="form-group-addon">Consumer ID</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <input type="text" name="user_id" class="form-control" placeholder="Consumer ID" required="required">
                        </div>
                        <span class="form-group-addon">Month</span>
                        <div class="form-group" style="margin-bottom: 20px; ">

                            <select class="form-control" name="txtMonth">
                                <option value="January"> January</option>
                                <option value="February"> February</option>
                                <option value="March"> March</option>
                                <option value="April"> April</option>
                                <option value="May"> May</option>
                                <option value="June"> June</option>
                                <option value="July"> July</option>
                                <option value="August"> August</option>
                                <option value="September"> September</option>
                                <option value="October"> October</option>
                                <option value="November"> November</option>
                                <option value="December"> December</option>

                            </select>

                        </div>
                        <span class="form-group-addon">Payment Status</span>


                        <div class="form-group" style="margin-bottom:  20px; ">
                            <select class="form-control" name="txtStatus">
                                <option value="Unpaid"> Unpaid</option>
                                <option value="Paid"> Paid</option>


                            </select>


                        </div>
                        <span class="form-group-addon">Bill Image</span>
                        <input type="file" name="chooseimage" class="btn btn-primary" style="margin-top: 10px;">
                        <p style="color: red;"><b><?php echo $formatError; ?></b></p>




                        <center>
                            <input type="submit" value="Done" class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">


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