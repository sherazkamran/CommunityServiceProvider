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

		if ($_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'servicemanager_sidebar.php';
		}

		?>
	</head>

	<body>
		<?php
		include("connection.php");


		?>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header text-center ">
				<h1 style="margin-top:5%;">
					VIEW HIRING REQUESTS
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class="bg-info" style="padding:40px;">
					<table id="table_id" class="display">
						<thead>
							<tr>
								<th>Sr#</th>
								<th>Customer</th>
								<th>Contact#</th>
								<th>Location</th>
								<th>Service</th>
								<th>Rerquest Date</th>
								<th>Request Time</th>
								<th>Description</th>
								<th>Track Code</th>
								<th>Status</th>
								<th>Confirm</th>
								<th>Cancel</th>


							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$q = "SELECT * from hired_service;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>
									<!-- fetching user name and contact start -->
									<?php
									$user_id = $row['user_id'];
									$cname = "SELECT * FROM user where user_id='$user_id' ";
									$crun = mysqli_query($conn, $cname);
									if (mysqli_num_rows($crun) > 0) {
										$userfetch = mysqli_fetch_array($crun);
									?>
										<td><?php echo $i ?></td>
										<td><?php echo $userfetch['name']; ?></td>
										<td><?php echo $userfetch['contactNo']; ?></td>
									<?php } ?>
									<td><?php echo $row['location']; ?></td>
									<?php

									$service_id = $row['service_id'];
									$q = "SELECT name from service where service_id='$service_id'";
									$run = mysqli_query($conn, $q);
									if (mysqli_num_rows($run) > 0) {
										$servicefetch = mysqli_fetch_array($run);



									?>

										<td><?php echo $servicefetch['name']; ?></td>
									<?php } ?>

									<td><?php echo $row['request_date']; ?></td>
									<td><?php echo $row['request_time']; ?></td>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $row['unique_service_id']; ?></td>
									<td><?php echo $row['status']; ?></td>

									<td><a href="hsedit.php?confirm=<?php echo $row['hired_service_id'] ?>"><i style="margin-left: 25%;" class="fa fa-check" aria-hidden="true"></i></a> </td>
									<td><a href="hsedit.php?cancel=<?php echo $row['hired_service_id'] ?>"><i style="margin-left: 25%;" class="fa fa-times" aria-hidden="true"></i></a> </td>

									<?php	$i++;
								 } ?>
						</tbody>
					</table>

				</div>
				<?php
				include 'footer.php';
				?>
			</section>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				$('#table_id').DataTable({
					"scrollX": true
				});
			});
		</script>
	</body>

	</html>