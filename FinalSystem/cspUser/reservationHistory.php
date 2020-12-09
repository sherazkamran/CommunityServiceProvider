<?php
include("header.php");
include("connection.php");


$userid = $_SESSION['auth']; ?>
<div class="row d-flex justify-content-center">
    
    <div class="col-6 col-sm-5 col-md-4 col-lg-3">
        <form action="viewResHistory.php" method="POST" enctype="multipart/form-data">
        
            <div class="form-group mt-5">
                <span class="form-group-addon " style="font-size: 18px;font-weight: bold;font-style: normal;">Your Reservations</span>
                <select class="form-control mt-1" name="resID" required="required">
                    <option value="" disabled selected>Select Reservation ID</option>
    
                    <?php
    
                    $query = "SELECT * from reservation WHERE user_id='$userid'";
                    $run = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($run)) { ?>
                        <option value="<?php echo $row['res_code'] ?>"><?php echo $row['res_code'] ?></option>
                    <?php
                    } ?>
                </select>
            </div>
            <div class="form-group d-flex justify-content-center">
                <input type="submit" style="background-color: #99C74E;" class="btn btn-info btn-md" name="submitHis" value="View History">
            </div>
        </form>
    </div>

</div>