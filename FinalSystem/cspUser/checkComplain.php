<?php include("header.php");

if (isset($_POST['submitTrCode']) && !empty($_POST['submitTrCode'])) {
    $tr_code = $_POST['txtComplainCode'];
?>

    <div class="card-body">


        <?php


        $q102 = "SELECT * from complain WHERE trcode='$tr_code' ";
        $run102 = mysqli_query($conn, $q102);
        if (mysqli_num_rows($run102) > 0) {
            while ($row102 = mysqli_fetch_assoc($run102)) { ?>

                <center>

                    <div class="form-group">
                        <div class="col-sm-6 text-left">

                            <div class="form-group">
                                <span class="form-label " style="font-weight: bold;" disabled>Type of Complaint:</span>
                                <input class="form-control" type="text" name="typ" disabled value="<?php echo $row102['type'] ?>">
                            </div>
                            <div class="form-group">
                                <span class="form-label text-left" style="font-weight: bold;" disabled>Subject of Complaint:</span>
                                <input class="form-control" disabled type="text" name="sbj" value="<?php echo $row102['subject'] ?>">
                            </div>
                            <div class="form-group">
                                <span class="form-label text-left" style="font-weight: bold;" disabled>Description:</span>
                                <textarea class="form-control txtAreaComplaint" disabled rows="10" name="des"><?php echo $row102['detail'] ?> </textarea>
                            </div>
                            <div class="form-group">
                                <span class="form-label text-left" style="font-weight: bold;" disabled>Status of Complaint:</span>
                                <input class="form-control" disabled type="text" name="sta" value="<?php echo $row102['status'] ?>">
                            </div>
                            <div class="form-group">
                                <span class="form-label text-left" style="font-weight: bold;" disabled>Complaint Submission Time:</span>
                                <input class="form-control" disabled name="tim" value="<?php echo $row102['comp_time'] ?>">
                            </div>
                            <div class="form-group">
                                <span class="form-label text-left" style="font-weight: bold;" disabled>Complaint Submission Date:</span>
                                <input class="form-control" disabled name="dat" value="<?php echo $row102['comp_date'] ?>">
                            </div>

                </center>


        <?php    }
        } else {
            echo "<script>window.alert('Invalid TR-Code or complain does not exist.')</script>";
            echo '<script> window.location = "complain.php";</script>';
        }

        ?>


    </div>


<?php
} else {
    $u_n_m = "";
    $userID = $_SESSION['auth'];
    $q = "SELECT name from user WHERE user_id='$userID'";
    $rn = mysqli_query($conn, $q);
    $rw = mysqli_fetch_array($rn);
    $u_n_m = $rw['name'];
?>

    <center>
        <form action="checkComplain.php" method="POST">

            <div class="form-group col-md-3 mt-5 ">
                <span class="form-group-addon " style="font-size: 18px;font-weight: bold;font-style: normal;"><?php echo $u_n_m ?>'s Complaints</span>
                <select class="form-control mt-3" name="txtComplainCode" required="required">
                    <option value="" disabled selected>Select Complain Code:</option>

                    <?php


                    $query = "SELECT * from complain WHERE user_id='$userID'";
                    $run = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($run)) {
                    ?>

                        <option value="<?php echo $row['trcode'] ?>"><?php echo $row['trcode'] ?></option>
                    <?php
                    } ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <input type="submit" name="submitTrCode" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" class="btn btn-info btn-md" value="View Details">
            </div>
        </form>
    </center>
<?php } ?>