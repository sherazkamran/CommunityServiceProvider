<?php include("header.php");
include 'connection.php';
?>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->


<head>
    <meta charset="utf-8">


    <!-- bootstrap css file cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- font awesome cdn link -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <!-- custom stylesheet -->

    <!-- <link rel="stylesheet" href="./css/style.css"> -->
</head>



<?php
$user_id = $_SESSION['auth'];
$query = "SELECT * from user where user_id= $user_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

?>




    <div class="container bootstrap snippet">

        <div class="row">

            <div class="col-md-12 mt-5" style="font-size: 5px;">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <form class="form" action="#" method="post" id="editProfileForm">
                            <div class="forFlex col-md-12" style="display:flex; flex-direction: column;  font-family:arial;">
                                <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
                                    <div class="form-group ">


                                        <div class="col-md-12">
                                            <label for="name">
                                                <h4>Name</h4>
                                            </label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <label for="contactNo">
                                                <h4>Contact Number</h4>
                                            </label>
                                            <input type="text" class="form-control" name="contactNo" id="contactNo" value="<?php echo $row['contactNo'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <label for="password">
                                                <h4>Current Password</h4>
                                            </label>
                                            <input type="password" class="form-control" name="current_pswd" id="password" placeholder="Current Password" title="Enter current password...">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <label for="password">
                                                <h4>New Password</h4>
                                            </label>
                                            <input type="password" class="form-control" name="new_pswd" id="password" placeholder="New Password..." title="Enter new password...">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <label for="password2">
                                                <h4>Verify New Password</h4>
                                            </label>
                                            <input type="password" class="form-control" name="confirm_pswd" id="password2" placeholder="Confirm New Password..." title="Enter new password again to verify...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12  mt-2 mb-3 " style="display: flex; justify-content: center;">
                                    <br>
                                    <button class="btn btn-lg btn-success  mt-2 mr-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" type="submit" name="save">Save</button>
                                    <a href="profile.php" class="btn btn-lg btn-success  mt-2 ml-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;">Back</a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!--/tab-pane-->
                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
<?php

} else {
    echo "<script>alert('No Users exists!')</script>";
}

if (isset($_POST['save'])) {
    $var = isset($_POST['save']);

    echo "<script>alert('Hahahahahha $var')</script>";
    $name = $_POST['name'];
    $contactNo = $_POST['contactNo'];
    $current_pswd = $_POST['current_pswd'];
    $new_pswd = $_POST['new_pswd'];
    $confirm_pswd = $_POST['confirm_pswd'];

    if ($current_pswd != $row['password']) {
        echo "<script>alert('Wrong Current Password! Try Again.')</script>";
        echo "<script>windows.location('editProfile.php')</script>";
    } else
    if ($confirm_pswd != $new_pswd) {
        echo "<script>alert('Confirm Password Did not match New Password! Try Again.')</script>";
        echo "<script>windows.location('editProfile.php')</script>";
    } else {

        $query2 = "UPDATE user SET name= '$name', contactNo='$contactNo', password='$new_pswd' where user_id='$user_id'";
        if (mysqli_query($conn, $query2)) {
            echo "<script>alert('Profile Updated Successfully!');
            window.location('profile.php');</script>";
        }
    }
}
?>
<!--/row-->


<?php include("footer.php"); ?>