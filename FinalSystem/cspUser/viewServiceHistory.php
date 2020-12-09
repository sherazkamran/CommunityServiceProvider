<?php
include("header.php");
include("connection.php");
if (isset($_POST['submitHistory']) && !empty($_POST['submitHistory'])) {

    $serviceId = 0;
    $userId = $_SESSION['auth'];
    $unq_ID = $_POST['uniqueServiceID'];
    $nameOfService = "";

?>


    <div class="card-body">
        <table class="table striped">
            <tr>
                <th>Service</th>
                <th>Request Time</th>
                <th>Request Date</th>
                <th>Location</th>
                <th>Description</th>
                <th>Status</th>
                <th>Service ID</th>

            </tr>

            <?php

            $q109 = "SELECT service_id from hired_service where unique_service_id= '$unq_ID' ";
            $run109 = mysqli_query($conn, $q109);
            while ($row109 = mysqli_fetch_assoc($run109)) {
                $serviceId = $row109['service_id'];
            }



            $q101 = "SELECT * from service WHERE service_id='$serviceId'";
            $run101 = mysqli_query($conn, $q101);
            while ($row101 = mysqli_fetch_assoc($run101)) {
                $nameOfService = $row101['name'];
            }
            $q102 = "SELECT * from hired_service WHERE user_id='$userId' and unique_service_id='$unq_ID'";
            $run102 = mysqli_query($conn, $q102);
            while ($row102 = mysqli_fetch_assoc($run102)) { ?>

                <tr>

                    <td><input type="text" name="s_name" value="<?php echo $nameOfService ?>" style="width:80%;" class="form-control" disabled></td>
                    <td><input name="s_time" value="<?php echo $row102['request_time'] ?>" style="width:80%;" class="form-control" disabled></td>
                    <td><input name="s_date" value="<?php echo $row102['request_date'] ?>" style="width:80%;" class="form-control" disabled></td>
                    <td><input type="text" name="s_location" value="<?php echo $row102['location'] ?>" style="width:80%;" class="form-control" disabled></td>
                    <td><input type="text" name="s_desc" value="<?php echo $row102['description'] ?>" style="width:80%;" class="form-control" disabled></td>
                    <td><input type="text" name="s_status" value="<?php echo $row102['status'] ?>" style="width:80%;" class="form-control" disabled></td>
                    <td><input type="number" name="s_serv_id" value="<?php echo $row102['unique_service_id'] ?>" style="width:80%;" class="form-control" disabled></td>


                </tr>


            <?php    }
            ?>

        </table>
    </div>
<?php    } else {
    echo "<script>window.alert('Cannot fetch! a problem encountered!')</script>";
}
?>