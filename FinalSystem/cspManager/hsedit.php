	<html>

	<head>
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
	    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	    <?php
        // session_start();
        // $get_id = $_SESSION['login_id'];
        // if ($_get_id == 0) {
        // 	echo "<script type='text/javascript'>alert('error');</script>";
        // 	header('Location:orders.php');
        // }

        include("connection.php");
        ?>
	    // </head>

	<body>
	    <div class="content-wrapper">
	        <!-- Content Header (Page header) -->

	        <!-- Main content -->
	        <section class="content container-fluid">

	            <div class="container">
	                <?php
                    if (isset($_GET['confirm'])) {
                        $hired_service_id = $_GET['confirm'];

                        echo $hired_service_id;
                        $sql = "UPDATE hired_service set status='confirmed', service_notificationStatus=0 where hired_service_id='$hired_service_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script>alert("Request Confirmed!")</script>';
                            echo '<script> window.location = "./viewhiringrequest.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }

                    if (isset($_GET['cancel'])) {
                        $hired_service_id = $_GET['cancel'];


                        $sql = "UPDATE hired_service set status='cancelled', service_notificationStatus=0 where hired_service_id='$hired_service_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script>alert("Request Cancelled!")</script>';
                            echo '<script> window.location = "./viewhiringrequest.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }
                    ?>
	            </div>
	</body>

	</html>