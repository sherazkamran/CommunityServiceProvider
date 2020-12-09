<?php
include("header.php");
include("connection.php");
if (isset($_POST['submitHis'])) {

    $reservID = $_POST['resID']; ?>


    <div class="card-body">
        <table class="table striped">
            <?php
            $q101 = "SELECT * from reservation WHERE res_code='$reservID'";
            $run101 = mysqli_query($conn, $q101);
            while ($row101 = mysqli_fetch_assoc($run101)) {
                $idcar = $row101['car_id'];
                $q102 = "SELECT * from car WHERE car_id='$idcar' ";
                $run102 = mysqli_query($conn, $q102);
                while ($row102 = mysqli_fetch_assoc($run102)) { ?>


                    <tr>
                        <th>Vehicle Number</th>
                        <th>Model</th>
                        <th>Total Charges</th>
                        <th>Pickup Location</th>
                        <th>With Driver</th>
                    </tr>


                    <tr>

                        <td><input class="form-control" type="text" name="v_num" value="<?php echo $row102['carNo'] ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" type="text" name="v_name" value="<?php echo $row102['model'] ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" type="number" name="r_charges" value="<?php echo $row101['res_charges']  ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" type="text" name="p_location" value="<?php echo $row101['location'] ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" type="text" name="v_driver" value="<?php echo $row101['with_driver']  ?>" style="width:80%;" disabled></td>
                    </tr>
                    <tr>
                        <th>Date from</th>
                        <th>Time From</th>
                        <th>Date To </th>
                        <th>Time To</th>
                        <th>Reservation Status</th>

                    </tr>
                    <tr>
                        <td><input class="form-control" name="s_date" value="<?php echo $row101['start_date']  ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" name="s_time" value="<?php echo $row101['start_time']  ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" name="e_date" value="<?php echo $row101['end_date']  ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" name="e_time" value="<?php echo $row101['end_time']  ?>" style="width:80%;" disabled></td>
                        <td><input class="form-control" name="r_status" value="<?php echo $row101['status']  ?>" style="width:80%;" disabled></td>
                    </tr>



            <?php    }
            } ?>

        </table>
    </div>
<?php    }
?>