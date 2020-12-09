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
	        <section class="content-header">
	            <h1>
	                Cars
	            </h1>

	        </section>

	        <!-- Main content -->
	        <section class="content container-fluid">

	            <div class="container">
	                <?php
                    if (isset($_GET['confirm'])) {
                        $complain_id = $_GET['confirm'];

                        $sql = "UPDATE complain set status='Addressed', complain_notificationStatus=0 where complain_id='$complain_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script>alert("Complain Addressed!")</script>';
                            echo '<script> window.location = "./viewcomplainlist.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }

                    if (isset($_GET['cancel'])) {
                        $complain_id = $_GET['cancel'];


                        $sql = "UPDATE complain set status='Discharged', complain_notificationStatus=0 where complain_id='$complain_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script>alert("Complain Discharged!")</script>';
                            echo '<script> window.location = "./viewcomplainlist.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }
                    if (isset($_GET['inProcessing'])) {
                        $complain_id = $_GET['inProcessing'];


                        $sql = "UPDATE complain set status='In-Processing', complain_notificationStatus=0 where complain_id='$complain_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script>alert("Complain under Investigation!")</script>';
                            echo '<script> window.location = "./viewcomplainlist.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }
                    ?>
	            </div>
	</body>

	</html>