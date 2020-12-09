<?php include("header.php");
if (isset($_POST['submit'])) {
    $justID = $_POST['billId'];

    if (!empty($justID)) {
        $query = "SELECT * from bills where bill_id='$justID'";
        $run = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($run)) {
            $billID = $row['bill_id'];
            $month = $row['month'];
            $statuc = $row['status'];
            $uid = $row['user_id'];
            $img = $row['image'];
?>
            <div class="d-flex justify-content-center mt-5">
                <div class="card text-center mx-5 mb-5 col-md-6 shadow-lg" style="min-width: 680px;">
                    <form>

                        <div class="billImageDiv mt-5  " style="Height:850px !important">
                            <?php $path = "../cspManager/" . $img; ?>
                            <a href="<?php echo $path ?>"><img class="billImage" src="<?php echo $path ?>" style="height:100%;"></a>
                        </div>

                        <center>



                            <div class="card-body mt-3">
                                <div class="form-group  col-md-8 ">
                                    <div class="form-group text-left">
                                        <span class="form-label  " style="font-weight: bold;">Bill Month:</span>
                                        <input class="form-control  mb-4" name="statOfBill" value="<?php echo $month ?>" type="text" disabled>
                                        <span class="form-label text-left" style="font-weight: bold;">Bill Status:</span>
                                        <input class="form-control " name="statOfBill" value="<?php echo $statuc ?>" type="text" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control " name="description" value="<?php echo $statuc ?>" type="text" disabled hidden>
                                        <input class="form-control " name="idOfBill" value="<?php echo $billID ?>" type="text" disabled hidden>
                                    </div>

                                </div>

                            </div>
                        </center>
                        <center>
                            <?php if ($statuc == "Paid") {
                            ?>

                                <div class="form-btn col-md-4 mb-5">
                                    <input type="submit" class="btn btn-primary" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" value="Pay Now" disabled>
                                </div>


                            <?php } else { ?>
                                <div class="form-btn col-md-4 mb-5">
                                    <a href="billTransaction.php?view=<?php echo $billID ?>" class="d-flex align-items-center justify-content-center btn btn-info" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;">Pay Now</a>
                                </div>
                            <?php } ?>
                        </center>
                    </form>

                </div>

    <?php
        } else {
            echo "<script>window.alert('Invalid Bill ID.')</script>";

            echo '<script>window.location = "paybills.php";</script>';
        }
    } else {

        echo "<script>window.alert('Provide Bill ID.')</script>";
        echo '<script>window.location.href = "paybills.php"</script>';
    }
}
    ?>
            </div>