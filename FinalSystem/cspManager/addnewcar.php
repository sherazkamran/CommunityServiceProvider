  <html>

  <head>



    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    Latest compiled and minified CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <?php
    include 'header.php';
    // if ($_SESSION['type'] == "pm") {
    //   echo '<script type="text/javascript">';
    //   echo "alert('Access not allowed')";
    //   echo "</script>";
    //   header("Location: index.php");
    // }
    // if ($_SESSION['type'] == "deo") {
    //   include 'deo_sidebar.php';
    // }
    // if ($_SESSION['type'] == "admin") {
    //   include 'admin_sidebar.php';
    // }
    // if ($_SESSION['type'] == "pm") {
    //   include 'pm_sidebar.php';
    // } else {
    include 'bm_sidebar.php';

    ?>


  </head>





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
  include 'connection.php';
  $formatError = "";
  $success  = "";
  $failed = "";
  if (isset($_POST['btnSubmit'])) {
    $model = $_POST['txtModel'];
    $carNo = $_POST['txtCarNo'];
    $capacity = $_POST['txtCapacity'];
    $color = $_POST['txtColor'];
    $chargesPH = $_POST['txtcharges'];
    $availability = $_POST['txtAvailability'];


    $query = "INSERT into car (model,capacity,availability,carNo,color,charges_per_hour) values ('$model','$capacity','$availability','$carNo','$color', '$chargesPH');";

    if (mysqli_query($conn, $query)) {
      $success = "Added successfuly ";
    } else {
      $failed = 'Something wents wrong';
    }
  }
  ?>



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Car
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
              <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Add New Car</label></center>
              <center>
                <p style="color: green; font-size: 15px;"><b><?php echo $success; ?></b></p>
              </center>
              <center>
                <p style="color: red; font-size: 15px;"><b><?php echo $failed; ?></b></p>
              </center>
              <span class="form-group-addon">Model</span>
              <div class="form-group" style="margin-bottom: 20px; ">

                <input type="text" name="txtModel" class="form-control" placeholder="Model" required="required">
              </div>
              <span class="form-group-addon">Car Number</span>
              <div class="form-group" style="margin-bottom: 20px; ">

                <input type="text" name="txtCarNo" class="form-control" placeholder="Car#" required="required">
              </div>
              <span class="form-group-addon"><b>Seating Capacity</b></span>
              <div class="form-group" style="margin-bottom: 20px; ">

                <input type="number" name="txtCapacity" placeholder="0" class="form-control" required="required">
              </div>
              <span class="form-group-addon">Availability</span>
              <select class="form-control" name="txtAvailability" required="required"style="margin-bottom: 20px;">
                <option value="">Choose Availability</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
              <span class="form-group-addon"><b>Colour</b></span>
              <div class="form-group" style="margin-bottom: 20px; ">

                <input type="text" name="txtColor" placeholder="Enter vehicle colour here..." class="form-control" required="required">
              </div>
              <span class="form-group-addon"><b>Charges Per Hour</b></span>
              <div class="form-group" style="margin-bottom: 20px; ">

                <input type="number" name="txtcharges" placeholder="0" class="form-control" required="required">
              </div>
          </div>




          <center><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Add</button>


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

  </html>