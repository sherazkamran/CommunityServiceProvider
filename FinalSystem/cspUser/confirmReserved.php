<?php
include("header.php");


if (isset($_GET['IIIDDD'])) {

    $v_id = $_GET['IIIDDD'];

    $userid = $_SESSION['auth'];
    $res_code = 0;

    if (!empty($v_id)) {
        $check = "SELECT * from car WHERE car_id='$v_id'";
        $checkexe = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($checkexe);
        if ($row['availability'] == "No") {
            echo "<script>window.alert('Vehicle you chose is not available.');</script>";
            echo '<script>window.location = "singlebookingpage.php";</script>';
        } else if ($row['availability'] == "Yes") {

            $query = " SELECT * from temp_res WHERE carid='$v_id' ";
            $runQuery = mysqli_query($conn, $query);
            while ($rowData = mysqli_fetch_assoc($runQuery)) {

                $location = $rowData['location'];
                $s_date = $rowData['startDate'];
                $s_time = $rowData['startTime'];
                $e_date = $rowData['endDate'];
                $e_time = $rowData['endTime'];
                $v_driver = $rowData['driver'];
                $r_charges = $rowData['charges'];

                $res_code = rand(10, 100000);
                $q99 = "SELECT reserve_id from reservation WHERE res_code='$res_code'";
                $run99 = mysqli_query($conn, $q99);
                if (mysqli_num_rows($run99) > 0) {
                    $res_code = rand(10, 100000);
                }


                $userid = (int)$userid;
                $v_id = (int)$v_id;
                $location = (string)$location;
                $v_driver = (string)$v_driver;
                $r_charges = (int)$r_charges;

                $sql = "INSERT INTO reservation(status,user_id,car_id,location,res_code,start_date,start_time,end_date,end_time,with_driver,res_charges) VALUES('Pending','$userid','$v_id', '$location', '$res_code' , '$s_date','$s_time','$e_date',  '$e_time', '$v_driver', '$r_charges')";
                $run = mysqli_query($conn, $sql);
                if ($run) {

                    $query1 = "UPDATE car SET availability='No' WHERE car_id='$v_id'";
                    $run1 = mysqli_query($conn, $query1);

                    $query2 = "DELETE from temp_res";
                    $run2 = mysqli_query($conn, $query2);

?>
                    <div class="container my-4 py-4">
                        <div class="card">
                            <div class="card-header text-center">

                                <h3 class="card-title">Your Reservation has been made!</h3>
                                <h6 class="card-title">Following are some details.</h6>
                            </div>


                            <div class="card-body">
                                <table class="table striped">
                                    <?php
                                    $q101 = "SELECT * from reservation WHERE user_id='$userid' and car_id='$v_id' and  res_code='$res_code'";
                                    $run101 = mysqli_query($conn, $q101);
                                    while ($row101 = mysqli_fetch_assoc($run101)) {
                                        $idcar = $row101['car_id'];
                                        $q102 = "SELECT * from car WHERE car_id='$idcar' ";
                                        $run102 = mysqli_query($conn, $q102);
                                        while ($row102 = mysqli_fetch_assoc($run102)) {
                                    ?>


                                            <tr>
                                                <th>Vehicle Number</th>
                                                <th>Model</th>
                                                <th>Vehicle Capacity(People)</th>
                                                <th>Pickup Location</th>
                                                <th>With Driver</th>
                                            </tr>


                                            <tr>

                                                <td><input class="form-control" type="text" name="v_num" value="<?php echo $row102['carNo'] ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" type="text" name="v_name" value="<?php echo $row102['model'] ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" type="text" name="v_capacity" value="<?php echo $row102['capacity'] ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" type="text" name="p_location" value="<?php echo $row101['location'] ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" type="text" name="v_driver" value="<?php echo $row101['with_driver']  ?>" style="width:80%;" disabled></td>
                                            </tr>
                                            <tr>
                                                <th>Date from</th>
                                                <th>Time From</th>
                                                <th>Date To </th>
                                                <th>Time To</th>
                                                <th>Total Charges</th>

                                            </tr>
                                            <tr>
                                                <td><input class="form-control" name="s_date" value="<?php echo $row101['start_date']  ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" name="s_time" value="<?php echo $row101['start_time']  ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" name="e_date" value="<?php echo $row101['end_date']  ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" name="e_time" value="<?php echo $row101['end_time']  ?>" style="width:80%;" disabled></td>
                                                <td><input class="form-control" type="number" name="r_charges" value="<?php echo $row101['res_charges']  ?>" style="width:80%;" disabled></td>
                                            </tr>


                                    <?php    }
                                    }
                                    ?>

                                </table>
                            </div>

                            <div class="card-footer">
                                <h4 class="title text-center">Important Instructions</h4>
                                <p class="text-center">
                                    *To cancel reservation please contact us in under one hour of successful reservation, contrary to that fine may apply.
                                </p>
                                <p class="text-center">
                                    *Relaxation of being late is maximum 10 minutes, failing to which fine may apply.
                                </p>
                            </div>
                        </div>
                    </div>
<?php






                } else {
                    echo "<script>window.alert('Cannot reserve! Try again later.');</script>";
                    echo '<script>window.location = "singlebookingpage.php";</script>';
                }
                // } else {
                //     echo "<script>window.alert('Provide complete and/or valid data. i.e. location.');</script>";
                //     echo '<script>window.location = "singlebookingpage.php";</script>';
                // }
                // } else {
                //     echo "<script>window.alert('Provide complete and/or valid data. i.e. time.');</script>";
                //     echo '<script>window.location = "singlebookingpage.php";</script>';
                // }


            }
        } else {
            echo "<script>window.alert('Availiability of vehicle is not Yes ...');</script>";
            echo '<script>window.location = "singlebookingpage.php";</script>';
        }
    } else {
        echo "<script>window.alert('Error occured! Try again later...');</script>";
        echo '<script>window.location = "singlebookingpage.php";</script>';
    }
} else if (empty(isset($_GET['IIIDDD']))) {
    echo "<script>window.alert('Error occured! Try again later...');</script>";
    echo '<script>window.location = "singlebookingpage.php";</script>';
}


include("footer.php"); ?>