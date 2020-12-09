<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

<?php
include 'header.php';
if ($_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "User Manager") {
    echo '<script type="text/javascript">';
    echo "alert('Access not allowed')";
    echo "</script>";
    header("Location: index.php");
} else {
    include 'cm_sidebar.php';
}
?>

<?php

$complain_id = $_GET['view'];
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Complain
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container">

        <div class="col-md-3">

        </div>

        <div class="col-md-6 ">
            <div class="box box-success">


                <?php
                $q = "SELECT * from complain where complain_id=$complain_id";
                if ($run = mysqli_query($conn, $q)) {
                    $row = mysqli_fetch_array($run);



                ?>

                    <div class="box-body ">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div>
                                <label id="ddiv" style="font-size: 25px; font-family: Calibri; margin-top: 20px; padding-left:5%; padding-right: 5%; padding-top: 3%;"><b>Subject: </b><?php echo $row['subject'] ?></label>
                            </div>

                            <div>
                                <label style="font-size: 20px;font-family: Calibri; padding-left: 5%; padding-top: 3%;">Description: </label>
                            </div>

                            <div class=" form-group" style="margin-bottom: 20px; padding-left:5%; padding-right: 5%; ">

                                <textarea row="15" readonly style="font-size: 20px;font-family: Calibri; height: 450px; width: 465px; padding: 2%; margin-bottom: 5%;"><?php echo $row['detail'] ?>
                                </textarea>
                            </div>

                            <div class=" form-group" style="margin-bottom: 20px;  ">
                                <label style="font-size: 20px;font-family: Calibri; padding-left: 5%; padding-top: 3%;">Complain Date : <?php echo $row['comp_date'] ?></label>
                                <label style="font-size: 20px;font-family: Calibri; padding-left: 5%; padding-top: 3%;">Complain Time : <?php echo $row['comp_time'] ?></label>
                            </div>

                            </select>
                    </div>

                <?php } ?>




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