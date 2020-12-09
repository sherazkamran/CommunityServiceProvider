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



    $bill_id = $_GET['bill_id'];
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
    include 'connection.php';
    $formatError = "";
    $success  = "";
    $failed = "";
    if (isset($_POST['btnSubmit'])) {

        $bill_id = $_POST['bill_id'];
        $month = $_POST['txtMonth'];
        $status = $_POST['txtStatus'];
        $filename = $_FILES['chooseimage']['name'];
        $dest = "images/" . time() . basename($filename);
        $size = $_FILES['chooseimage']['size'];
        $tempname = $_FILES['chooseimage']['tmp_name'];
        $fulname = explode(".", $filename);
        $extension = $fulname[1];

        if ($extension == "JPG" || $extension == "PNG" || $extension == "GIF" || $extension == "JPEG" || $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "jpeg") {
            move_uploaded_file($tempname, $dest);

            $query = "UPDATE bills set bill_id='$bill_id',month='$month', status='$status', image='$dest' where bill_id='$bill_id';  ";

            if (mysqli_query($conn, $query)) {
                $success = "Updated successfuly ";
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
              Edit Bill Details
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
                    $query = "SELECT * from bills where bill_id='$bill_id';";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) == 0) { ?>

                  <?php }
                    ?>
                  <?php
                    while ($row = $result->fetch_array()) {
                    ?>

                      <div class="box-body ">
                          <form role="form" action="" method="post" enctype="multipart/form-data">
                              <center><label id="ddiv" style="font-size: 40px; font-family: Calibri; margin-top: 20px;">Edit Bill</label></center>
                              <center>
                                  <p style="color: green; font-size: 15px;"><b><?php echo $success; ?></b></p>
                              </center>
                              <center>
                                  <p style="color: red; font-size: 15px;"><b><?php echo $failed; ?></b></p>
                              </center>
                              <span class="form-group-addon">Bill ID</span>
                              <div class="form-group" style="margin-bottom: 20px;  ">

                                  <input type="text" name="bill_id" class="form-control" value="<?php echo $row['bill_id'] ?>" placeholder="Bill ID" required="required">
                              </div>





                              <span class="form-group-addon">Month</span>
                              <div class="form-group">
                                  <select class="form-control" name="txtMonth" required="required">
                                      <option value=" <?php echo $row['month'] ?>"><?php echo $row['month'] ?></option>
                                      <option value=" January"> January</option>
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
                              <span class="form-group-addon">Status</span>

                              <div class="form-group">
                                  <select class="form-control" name="txtStatus" required="required">
                                      <option value=" <?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                                      <option value="Unpaid">Unpaid</option>
                                      <option value="Paid">Paid</option>
                                  </select>
                              </div>

                              <span class="form-group-addon">Bill Image</span>

                              <div class="form-group">
                                  <input type="file" name="chooseimage" class="btn btn-primary" style="margin-top: 10px;">
                                  <p style="color: red;"><b><?php echo $formatError; ?></b></p>

                              </div>



                      </div>




                      <center><button class="btn btn-success btn-lg" style="margin: 30px;" name="btnSubmit">Save</button>


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