<?php
include("header.php");
include("connection.php");

if (isset($_POST['submitRes'])) {

    $time = $_POST['time'];
    $date =  date('Y-m-d');

    $location = $_POST['location'];
    $carid = $_POST['carid'];
    $userid = $_SESSION['auth'];

    $check = "SELECT * from car WHERE car_id='$carid'";
    $checkexe = mysqli_query($conn, $check);
    $row = mysqli_fetch_array($checkexe);
    if ($row['availability'] == "No") {
        echo "<script>window.alert('Vehicle you chose is not available.');</script>";
        echo '<script>window.location = "singlebookingpage.php";</script>';
    } else if ($row['availability'] == "Yes") {
        if (!empty($time)) {
            if (!empty($location)) {
                $sql = "INSERT INTO reservation(status,user_id,car_id,pickupTime,pickup_date,pickupLocation) VALUES('PENDING','$userid','$carid','$time', '$date','$location')";
                $run = mysqli_query($conn, $sql);
                if ($run) {

?>
                    <div class="container my-4 py-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3 class="card-title">Your Reservation has been made!</h3>
                                <h6 class="card-title">Following are some details.</h6>

                            </div>
                            <div class="card-body">
                                <table class="table striped">
                                    <tr>
                                        <th>Vehicle Reserved</th>
                                        <th>Rservation Time</th>
                                        <th>Capacity</th>
                                    </tr>


                                    <tr>
                                        <td>Cultus</td>
                                        <td>2/2/2020</td>
                                        <td>3</td>
                                    </tr>
                                    </tr>
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
        <?php    } else {
                    echo "<script>window.alert('Cannot reserve! Try again later.');</script>";
                    echo '<script>window.location = "singlebookingpage.php";</script>';
                }
            } else {
                echo "<script>window.alert('Provide complete and/or valid data. i.e. location.');</script>";
                echo '<script>window.location = "singlebookingpage.php";</script>';
            }
        } else {
            echo "<script>window.alert('Provide complete and/or valid data. i.e. time.');</script>";
            echo '<script>window.location = "singlebookingpage.php";</script>';
        }
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
                                <td><input name="p-name" value="<?php echo $row2['model'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input type="number" name="p-price" value="<?php echo $row2['capacity'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input name="p-price" value="<?php echo $row2['availability'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input name="p-price" value="<?php echo $row2['carNo'] ?>" style="width:80%;" class="form-control" disabled></td>
                                <td><input name="p-price" value="<?php echo $row2['color'] ?>" style="width:80%;" class="form-control" disabled></td>
                            </tr>
                            <?php}?>
                    </table>
                </div>


            </div>
        </div>


<?php  } else {
                            echo "<script>window.alert('Select a car first!');</script>";
                            echo '<script>window.location = "singlebookingpage.php";</script>';
                        }
                    } else {
                        echo "<script>window.alert('POST not recognized!');</script>";
                        echo '<script>window.location = "singlebookingpage.php";</script>';
                    }
                }
?>