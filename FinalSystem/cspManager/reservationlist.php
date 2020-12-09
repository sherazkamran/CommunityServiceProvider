<?php
include 'header.php';
if ($_SESSION['type'] == "pm") {
  echo '<script type="text/javascript">';
  echo "alert('Access not allowed')";
  echo "</script>";
  header("Location: index.php");
}

if ($_SESSION['type'] == "Booking Manager") {
  include 'bm_sidebar.php';
}
if ($_SESSION['type'] == "admin") {
  include 'admin_sidebar.php';
}
if ($_SESSION['type'] == "pm") {
  include 'pm_sidebar.php';
}
?>
<!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
 -->

<title>View Reservation Requests</title>







<?php
$formatError = "";
$success  = "";
$failed = "";
if (isset($_POST['btnSubmit'])) {
  $name = $_POST['txtName'];


  $status = $_POST['txtStatus'];
  $filename = $_FILES['chooseimage']['name'];
  $dest = "images/" . time() . basename($filename);
  $size = $_FILES['chooseimage']['size'];
  $tempname = $_FILES['chooseimage']['tmp_name'];
  $fulname = explode(".", $filename);
  $extension = $fulname[1];

  if ($extension == "JPG" || $extension == "PNG" || $extension == "GIF" || $extension == "JPEG" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "jpeg") {
    move_uploaded_file($tempname, $dest);
    $query = "insert into category (name,image,status) values ('$name','$dest','$status');";

    if (mysqli_query($conn, $query)) {
      $success = "Added successfuly ";

      header("Location: list_cat.php");
    } else {
      $formatError = 'Something wents wrong';
    }
  } else {
    $formatError = "Wrong image format";
  }
}
?>

</head>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Reservations
    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <div class="row">
      <form action="" class="form-inline">
        <div class="form-group">
          <label for="selectstatus">Select Status:</label>
          <select class="form-control" id="selectstatus">
            <option>Pending</option>
            <option>Confirmed</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" class="searchCarName" id="myInput" onkeyup="myFunction()" placeholder="Search Car Name">
        </div>
      </form>



    </div>
  </section>
  <section class="content container">


    <div class=" ">
      <div class="">
        <div class="">
          <!-- <h3 class="box-title">Student Info</h3> -->
        </div>
        <!-- /.box-header -->


        <div class=" ">

          <table class="table table-hover table-bordered">
            <tr style="background: whitesmoke">
              <th>
                Customer
              </th>
              <th>
                Contact#
              </th>
              <th>
                Car
              </th>
              <th>
                Pickup Location
              </th>
              <th>
                Pickup Time
              </th>
              <th>
                Destination
              </th>

              <th>
                Status
              </th>
            </tr>

            <?php
            $query = "SELECT user.name, user.contactNo, car.name, reservation.pickupLocation, reservation.pickupTIme, reservation.destination, reservation.status from reservation INNER JOIN user ON reservation.user_id_id=user.user_id INNER JOIN car ON reservation.car_id=car.car_id";

            $data = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($data)) {
              $customername = $row['user.name'];
              $contactno = $row['user.contactNo'];
              $car = $row['car.name'];
              $pickuplocation = $row['reserve.pickupLocation'];
              $pickuptime = $row['reserve.pickupTime'];
              $destinatiop = $row['reserve.destination'];
              $status = $row['reservation.status'];
            }
            ?>

            <tr>
              <td align="center">
                <?= $customername; ?>
              </td>
              <td align="center">
                <?= $contactno; ?>
              </td>
              <td align="center">
                <?= $car; ?>
              </td>
              <td align="center">
                <?= $pickuplocation; ?>
              </td>
              <td align="center">
                <?= $pickuptime; ?>
              </td>
              <td align="center">
                <?= $destinatiop; ?>
              </td>
              <td align="center">
                <?= $status; ?>
              </td>
            </tr>


          </table>
          <!-- <form style="padding-left: 10px; padding-right: 10px;" method="POST" action="" enctype="multipart/form-data">
            <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Add New Category</label></center>
            <center>
              <p style="color: green; font-size: 15px;"><b><?php// echo $success; ?></b></p>
            </center>
            <center>
              <p style="color: red; font-size: 15px;"><b><?php //echo $failed; ?></b></p>
            </center>
            <span class="form-group-addon">Name</span>
            <div class="form-group" style="margin-bottom: 20px; ">

              <input type="text" name="txtName" class="form-control" placeholder="Name" required="required">
            </div>

            <span class="form-group-addon"><b>Category Status</b></span>


            <div class="form-group" style="margin-bottom:  20px; ">
              <select class="form-control" name="txtStatus">
                <option value="Active"> Active</option>
                <option value="De-Active"> De-Active</option>

              </select>


            </div>
            <span class="form-group-addon">Image</span>
            <input type="file" name="chooseimage" class="btn btn-primary" style="margin-top: 10px;">
            <p style="color: red;"><b><?php //echo $formatError; ?></b></p>




            <center><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Done</button>


            </center>


          </form> -->
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