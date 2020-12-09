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

    <link rel="stylesheet" href="./css/login_style.css">


</head>

<body style="margin-top: -20px">


    <?php
    $user_id = $_SESSION['auth'];
    $query = "SELECT * from user where user_id= $user_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result)
    ?>


        <div class="container border my-5 shadow-lg">

            <div class="row">
                <div class="col-md-12 mt-5" style="justify-content: center;">
                    <div class="text-center py-3 profileBg mx-4">
                        <img src="images/avatar.jpg" class="avatar img-circle img-thumbnail " alt="avatar" style="border-radius: 100%;">
                    </div>
                    <br>
                </div>
                <div class="col-md-12 " style="font-size: 5px;">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <form class="form" action="##" method="post" id="registrationForm">
                                <div class="forFlex m-3" style="display: flex; justify-content: center; font-family:arial;">
                                    <div class="form-group col-md-5">
                                        <div class="form-group ">


                                            <div class="col-md-12">
                                                <label for="name">
                                                    <h4>Name</h4>
                                                </label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <label for="phaseNo">
                                                    <h4>CNIC</h4>
                                                </label>
                                                <input type="text" class="form-control" name="phaseNo" id="phaseNo" value="<?php echo $row['cnic'] ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <label for="phaseNo">
                                                    <h4>Street Number</h4>
                                                </label>
                                                <input type="text" class="form-control" name="phaseNo" id="phaseNo" value="<?php echo $row['streetNo'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <label for="houseNo">
                                                    <h4>Contact Number</h4>
                                                </label>
                                                <input type="email" class="form-control" name="houseNo" id="houseNo" value="<?php echo $row['contactNo'] ?>" disabled>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group col-md-5">
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <label for="email">
                                                    <h4>Email</h4>
                                                </label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="streetNo">
                                                    <h4>Phase Number</h4>
                                                </label>
                                                <input type="text" class="form-control" name="streetNo" id="streetNo" value="<?php echo $row['phase'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <label for="contactNo">
                                                    <h4>House Number</h4>
                                                </label>
                                                <input type="text" class="form-control" id="contactNo" value="<?php echo $row['houseNo'] ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <label for="status">
                                                    <h4>Status</h4>
                                                </label>
                                                <input type="text" class="form-control " name="password2" id="password2" value="<?php echo $row['status'] ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12  mt-2 mb-3 " style="display: flex; justify-content: center;">
                                        <br>

                                        <a href="editProfile.php" class="btn btn-lg btn-info mb-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;"> Edit Profile</a>

                                    </div>
                                </div>
                            </form>
                        <?php

                    } else {
                        echo "<script>alert('No Users exists!')</script>";
                    }

                        ?>
                        </div>
                        <!--/tab-pane-->
                    </div>
                    <!--/tab-pane-->
                </div>
                <!--/tab-content-->

            </div>
            <!--/col-9-->
        </div>
        <!--/row-->
</body>
<?php include("footer.php"); ?>