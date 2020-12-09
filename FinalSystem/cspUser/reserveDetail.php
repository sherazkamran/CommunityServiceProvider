<?php
include("header.php");
include("connection.php");

if (isset($_POST['confirmRes'])) {

    $userid = $_SESSION['auth'];
    $endTime = $_POST['endTime'];
    $location = $_POST['location'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $startDate = $_POST['startDate'];
    $carid = $_POST['carid'];
    $driver = $_POST['driver'];

    $charges_per_hour = 0;
    $charges = 0;
    $total = 0;
    $carID = 0;
    if (!empty($endTime) && !empty($location) && !empty($endDate) && !empty($startTime) && !empty($startDate) && !empty($carid) && !empty($driver)) {

        $from_D = $startDate;
        $to_D = $endDate;
        $from_T = $startTime;
        $to_T = $endTime;

        $origin_d = new DateTime($from_D);
        $target_d = new DateTime($to_D);

        $origin_t = new DateTime($from_T);
        $target_t = new DateTime($to_T);

        $since_start = $origin_d->diff($target_d);
        $day_hour =   $since_start->d * 24;

        $since_start = $origin_t->diff($target_t);
        $time_hour = $since_start->h;

        $explodedFrom = explode(':', $from_T);
        $explodedTo = explode(':', $to_T);

        $t1 = (int) $explodedFrom[0];
        $t2 = (int) $explodedTo[0];

        if ($t1  > $t2) {
            $day_hour = $day_hour - $time_hour;
        } else {
            $day_hour = $day_hour + $time_hour;
        }

        $total = $day_hour;

        date_default_timezone_set("Asia/Karachi");
        $t_d =  date('Y:m:d H:i:s');
        $t_d_d = new DateTime($t_d);

        $from_T = " " . $from_T . ":00";
        $origin_check = $from_D . $from_T;
        $origin_check_a = new DateTime($origin_check);

        $since_start = $t_d_d->diff($origin_check_a);
        $ur =   $since_start->h;
        $ur_ur =   $since_start->d * 24;

        $meet2 = $ur + $ur_ur;
        if ($total > 168) {
            echo "<script>window.alert('Reservation excedes limit. Reservation allowed for under 7 days only!');</script>";
            echo '<script>window.location = "singlebookingpage.php";</script>';
        } else  if ($meet2 > 24) {
            echo "<script>window.alert('Reservation can be made 1 day prior only!');</script>";
            echo '<script>window.location = "singlebookingpage.php";</script>';
        } else if ($total <= 0) {
            echo "<script>window.alert('Invalid Entries!');</script>";
            echo '<script>window.location = "singlebookingpage.php";</script>';
        } else if ($total > 0) {

            $q100 = "SELECT * from car WHERE car_id='$carid'";
            $run100 = mysqli_query($conn, $q100);
            while ($row100 = mysqli_fetch_assoc($run100)) {
                $charges_per_hour = (int) $row100['charges_per_hour'];
            }
            $charges = $charges_per_hour * $total;
        }

        $sqli  = "Insert into temp_res(endTime,endDate,startTime,startDate,location,carid,driver,userid,charges) values('$endTime','$endDate','$startTime','$startDate','$location','$carid','$driver','$userid','$charges')";
        $sql_run = mysqli_query($conn, $sqli);
        if ($sql_run) {
?>

            <div class="card-body">
                <form>
                    <table class="table striped">
                        <thead class="title text-center">
                            <h2 class="title text-center">Reservation Overview </h2>
                        </thead>

                        <tr>
                            <th>Vehicle Number</th>
                            <th>Model</th>
                            <th>Vehicle Capacity(People)</th>
                            <th>Pickup Location</th>
                            <th>With Driver</th>
                        </tr>


                        <?php

                        $q101 = " SELECT * from temp_res WHERE userid ='$userid'";
                        $run101 = mysqli_query($conn, $q101);
                        while ($row101 = mysqli_fetch_assoc($run101)) {
                            $carID = $row101['carid'];

                            $q102 = "SELECT * from car WHERE car_id='$carID'";
                            $run102 = mysqli_query($conn, $q102);
                            while ($row102 = mysqli_fetch_assoc($run102)) {

                                $carName = $row102['model'];
                                $carNumber = $row102['carNo'];
                                $carCapacity = $row102['capacity'];

                                $p_location = $row101['location'];
                                $v_driver = $row101['driver'];
                                $start_Date = $row101['startDate'];
                                $start_Time = $row101['startTime'];
                                $end_Date = $row101['endDate'];
                                $end_Time = $row101['endTime'];


                        ?>
                                <tr>
                                    <td><input class="form-control" type="text" name="v_num" value="<?php echo $carNumber ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" type="text" name="v_name" value="<?php echo $carName ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" type="text" name="v_capacity" value="<?php echo $carCapacity ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" type="text" name="p_location" value="<?php echo $p_location ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" type="text" name="v_driver" value="<?php echo $v_driver ?>" style="width:80%;" disabled></td>
                                </tr>
                                <tr>
                                    <th>Date from</th>
                                    <th>Time From</th>
                                    <th>Date To </th>
                                    <th>Time To</th>
                                    <th>Total Charges</th>

                                </tr>
                                <tr>
                                    <td><input class="form-control" name="s_date" value="<?php echo $start_Date ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" name="s_time" value="<?php echo $start_Time ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" name="e_date" value="<?php echo $end_Date ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" name="e_time" value="<?php echo $end_Time ?>" style="width:80%;" disabled></td>
                                    <td><input class="form-control" type="number" name="r_charges" value="<?php echo $charges ?>" style="width:80%;" disabled></td>
                                </tr>

                        <?php
                            }
                        }
                        ?>

                        <tr>
                            <th></th>
                            <th></th>
                            <td>
                                <a href="confirmReserved.php?IIIDDD=<?php echo  $carID  ?>" class="form-control btn btn-info" style="width:80%; background-color: #6FB856;">Confirm</a>
                            </td>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
                </form>
            </div>


        <?php

        }
    } else {
        echo "<script>window.alert('Provide Required Information!');</script>";
        echo '<script>window.location = "singlebookingpage.php";</script>';
    }
} else if (isset($_POST['submitDet'])) {
    $idCar = $_POST['carid'];
    if (!empty($idCar)) { ?>
        <div class="container my-4 py-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Following are the details of Vehicle.</h3>
                </div>
                <div class="card-body">
                    <table class="table striped">
                        <tr>
                            <th>Model</th>
                            <th>Capacity</th>
                            <th>Availability</th>
                            <th>Car No</th>
                            <th>Car Color</th>
                        </tr>
                        <?php
                        $query = "SELECT * from car WHERE car_id='$idCar'";
                        $run = mysqli_query($conn, $query);
                        if ($row = mysqli_fetch_assoc($run)) { ?>
                            <tr>
                                <td><input type="text" name="v-name" value="<?php echo $row['model'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="number" name="v-capacity" value="<?php echo $row['capacity'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="text" name="v-avail" value="<?php echo $row['availability'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="text" name="v-num" value="<?php echo $row['carNo'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="text" name="v-color" value="<?php echo $row['color'] ?>" style="width:80%;" class="form-control" disabled></td>
                            </tr>
                            <?php}?>
                    </table>
                </div>
            </div>
        </div>
<?php  } else {
                            echo "<script>window.alert('Select a vehicle first!');</script>";
                            echo '<script>window.location = "singlebookingpage.php";</script>';
                        }
                    } else {
                        echo "<script>window.alert('Select a vehicle first!');</script>";
                        echo '<script>window.location = "singlebookingpage.php";</script>';
                    }
                } ?>