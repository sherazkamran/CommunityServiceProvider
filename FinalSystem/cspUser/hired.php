<?php include("header.php");






if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $service = $_POST['service'];
    $desc = $_POST['description'];
    $location = $_POST['location'];
    $userid = $_SESSION['auth'];

    $hiredService = "";



    $check = "SELECT * from service WHERE service_id='$service'";
    $run = mysqli_query($conn, $check);
    $row = mysqli_fetch_array($run);


    if ($row['availability'] == "No") {
        echo "<script>window.alert(' Servicemen not available! Consult again after sometime.')</script>";
        echo '<script> window.location = "singlehiring.php";</script>';
    } else if ($row['availability'] == "Yes") {
        if (!empty($service) && !empty($location) && !empty($desc)) {




            $uniqueId = rand(100, 1000000);
            $q99 = "SELECT unique_service_id from hired_service WHERE unique_service_id='$uniqueId'";
            $run99 = mysqli_query($conn, $q99);
            if (mysqli_num_rows($run99) > 0) {
                $uniqueId = rand(100, 1000000);
            }


            $time = date('H:i:s');
            $date = date('Y:m:d');

            $send = "insert into hired_service(status,user_id,service_id ,request_time, request_date ,location, description,unique_service_id)  values('Pending','$userid','$service', '$time','$date', '$location', '$desc','$uniqueId')";
            $run = mysqli_query($conn, $send);
            if ($run) {
                $q103 = "SELECT * from service WHERE service_id='$service' ";
                $run103 = mysqli_query($conn, $q103);
                while ($row103 = mysqli_fetch_array($run103)) {
                    $hiredService = $row103['name'];
                }
                $update = "UPDATE service SET availability='No' where service_id='$service'";
                $exe = mysqli_query($conn, $update);
?>
                <div class="container my-4 py-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <span class="form-group-addon " style="font-size: 18px;font-weight: bold;font-style: normal;">You have successfully availed services of a professional <?php echo $hiredService ?>! </span>
                        </div>
                        <div class="card-footer text-left">
                            <h4 class="title text-center">Important Instructions</h4>
                            <p class="text-center">
                                *This service is provided inside the community premesis only.
                            </p>
                            <p class="text-center">
                                *Provide address explicitly in case of any location(inside Community Premesis) other than home.
                            </p>
                            <p class="text-center">
                                *Avoid un-necessary requests so that the people in need can avail the service.
                            </p>
                            <p class="text-center">
                                *You have hired the Right Person for the job. We serve the way you deserve.
                            </p>
                            <p class="text-center">
                                *Your request for service is recieved and will be entertained soon.
                            </p>
                        </div>
                    </div>
                </div>
                </div>

    <?php

            } else {
                echo "<script>window.alert(' Cannot process the request. Please try again later.')</script>";
                echo '<script> window.location = "singlehiring.php";</script>';
            }
        } else {
            echo "<script>window.alert('Provide the required details!')</script>";
            echo '<script> window.location = "singlehiring.php";</script>';
        }
    }
} else if (isset($_POST['submitServiceHistory'])  && !empty($_POST['submitServiceHistory'])) {
    $serv_id = 0;
    $serv_name = "";
    $userid = $_SESSION['auth'];
    ?>
    <center>
        <?php $uniq_id = 0; ?>
        <form action="viewServiceHistory.php" method="POST">
            <div class="form-group col-md-3 mt-5">
                <span class="form-group-addon" style="font-size: 18px;font-weight: bold;font-style: normal;">Your availed Services</span>
                <select class="form-control mt-3" name="uniqueServiceID" required="required">


                    <?php
                    $query = "SELECT * from hired_service WHERE user_id='$userid'";
                    $run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($run) > 0) {
                        while ($row = mysqli_fetch_assoc($run)) {
                            $serv_id = $row['service_id'];
                            $uniq_id = $row['unique_service_id'];
                            $query2 = "SELECT * from service WHERE service_id= '$serv_id'";
                            $run2 = mysqli_query($conn, $query2);
                            while ($row2 = mysqli_fetch_assoc($run2)) {
                                $serv_name = $row2['name'];
                    ?>

                                <option value="<?php echo $uniq_id ?>"><?php echo $uniq_id ?>-<?php echo $serv_name ?></option>
                    <?php    }
                        }
                    } else {
                        echo "<script>window.alert('No services availed!')</script>";
                        echo '<script> window.location = "singlehiring.php";</script>';
                    }

                    ?>
                </select>

            </div>

            <div class="form-group col-md-3">
                <input type="submit" name="submitHistory" class="btn btn-info btn-md" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" value="View History">
            </div>
        </form>
    </center>
<?php
} ?>