<?php include("header.php"); ?>

<?php
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $complain = $_POST['complain'];
    $subject = $_POST['subject'];
    $desc = $_POST['desc'];
    $status = "pending";
    $trcode = $_POST['cid'];
    $uid = $_SESSION['auth'];

    if (!empty($subject) && !empty($complain) && !empty($desc) && !empty($status) && !empty($trcode)) {

        $time = date('H:i:s');
        $date = date('Y:m:d');



        $checkQ = "SELECT * from complain WHERE trcode='$trcode'";
        $checkRun = mysqli_query($conn, $checkQ);
        if (mysqli_num_rows($checkRun) > 0) {
            $trcode = rand(10, 100000);
        }




        $comp = "INSERT INTO complain(type,subject, detail, status, user_id, trcode, comp_time, comp_date) values('$complain','$subject','$desc','$status','$uid','$trcode' ,'$time' ,'$date')";
        $send  = mysqli_query($conn, $comp);
        if ($send) { ?>
            <div class="container my-4 py-4">
                <div class="card">
                    <div class="card-header text-center">
                        <span class="form-group-addon " style="font-size: 18px;font-weight: bold;font-style: normal;">Your complain is recieved. Appropriate action will be taken as soon as possible. </span>
                    </div>
                    <div class="card-footer text-left">
                        <h4 class="title text-center">Important Instructions</h4>
                        <p class="text-center">
                            *Information about the complainee is kept hidden.
                        </p>
                        <p class="text-center">
                            *Your comoplain will be processed according to standard procedure. This may take a while.
                        </p>
                        <p class="text-center">
                            *Complains which are based on false accusations or lies will result in penalties.
                        </p>
                        <p class="text-center">
                            *You can track the progress of your complain by searching ( <?php echo $trcode ?> )!.
                        </p>
                        <p class="text-center">
                            *Complains for the betterment of Community are encouraged. Thank you for your time.
                        </p>
                    </div>
                </div>
            </div>

<?php
        } else {
            echo "<script>window.alert('Cannot process the comlain yet! Try again later.')</script>";
        }
    } else {
        echo "<script>window.alert('Provide required details!')</script>";
        echo '<script> window.location = "complain.php";</script>';
    }
}
