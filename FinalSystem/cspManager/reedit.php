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
        include 'header.php';

        if ($_SESSION['type'] == "deo") {
            echo '<script type="text/javascript">';
            echo "alert('Access not allowed')";
            echo "</script>";
            header("Location: index.php");
        }
        if ($_SESSION['type'] == "Booking Manager") {
            include 'bm_sidebar.php';
        }
        if ($_SESSION['type'] == "Shop Manager") {
            include 'admin_sidebar.php';
        }
        if ($_SESSION['type'] == "Service Manager") {
            include 'pm_sidebar.php';
        }



        ?>
	</head>

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
                        $reserve_id = $_GET['confirm'];

                        // echo $reserve_id;
                        $sql = "UPDATE reservation set status='Confirmed', reserve_notificationStatus=0 where reserve_id='$reserve_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script> window.location = "./viewreservation.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }
                    if (isset($_GET['complete'])) {
                        $reserve_id = $_GET['complete'];

                        // echo $reserve_id;
                        $sql = "UPDATE reservation set status='Completed', reserve_notificationStatus=0 where reserve_id='$reserve_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script> window.location = "./viewreservation.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }

                    if (isset($_GET['cancel'])) {
                        $reserve_id = $_GET['cancel'];

                        // echo $reserve_id;
                        $sql = "UPDATE reservation set status='Cancelled', reserve_notificationStatus=0 where reserve_id='$reserve_id'";
                        $run = mysqli_query($conn, $sql);
                        if ($run) {
                            echo '<script> window.location = "./viewreservation.php";</script>';
                        } else {
                            echo '<script>alert("Not successfull")</script>';
                        }
                    }
