<?php include("header.php");
include 'connection.php';
?>

<!-- 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


---- Include the above in your HEAD tag -------- -->

<head>
    <meta charset="utf-8">


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>


<div class="container bootstrap snippet">

    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar" style="border-radius: 100px;">
            </div>
            </hr><br>
        </div>
        <div class="col-sm-12">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <form class="form" action="##" method="post" id="registrationForm">
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="name">
                                    <h4>Name</h4>
                                </label>
                                <input type="text" class="form-control" name="name" id="name" title="Edit your Name...">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>Email</h4>
                                </label>
                                <input type="text" class="form-control" name="email" id="email" title="Edit your Email...">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phaseNo">
                                    <h4>Phase Number</h4>
                                </label>
                                <input type="text" class="form-control" name="phaseNo" id="phaseNo" title="Edit your Phase number...">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="streetNo">
                                    <h4>Street Number</h4>
                                </label>
                                <input type="text" class="form-control" name="streetNo" id="streetNo" title="Edit your Street Number...">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="houseNo">
                                    <h4>House Number</h4>
                                </label>
                                <input type="email" class="form-control" name="houseNo" id="houseNo" title="Edit your House Number...">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="contactNo">
                                    <h4>Contact Number</h4>
                                </label>
                                <input type="text" class="form-control" id="contactNo" title="Edit your Contact Number...">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password">
                                    <h4>New Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Type new password..." title="Enter new password...">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password2">
                                    <h4>Verify New Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Retype new password..." title="Enter new password again to verify...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12  mt-5 mb-5 " style="display: flex; justify-content: center;">
                                <br>
                                <button class="btn btn-lg btn-success m-5" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <button class="btn btn-lg m-5" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
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
<!--/row-->

<?php include("footer.php"); ?>