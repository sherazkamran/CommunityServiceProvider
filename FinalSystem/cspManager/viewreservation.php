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

		if ($_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'bm_sidebar.php';
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
					VIEW RESERVATION LIST
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class="bg-info" style="padding:40px;">
					<table id="table_id" class="display">
						<thead>
							<tr>
								<th>Sr#</th>
								<th>Name</th>
								<th>Contact Number</th>
								<th>Status</th>
								<th>Vehicle Model</th>
								<th>Vehicle Number</th>
								<th>Pickup Location</th>
								<th>Reservation Code</th>
								<th>Date From</th>
								<th>Time From</th>
								<th>Date To</th>
								<th>Time To</th>
								<th>With Driver</th>
								<th>Total Charges</th>
								<th>Mark Confirmed</th>
								<th>Mark Completed</th>
								<th>Mark Canceled</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$q = "SELECT * from reservation;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>
									<!-- fetching user name and contact start -->
									<?php
									$user_id = $row['user_id'];
									$veh_id = $row['car_id'];
									$query2 = "SELECT * from car WHERE car_id= '$veh_id'";
									$run2 = mysqli_query($conn, $query2);
									while ($row2 = mysqli_fetch_assoc($run2)) {
										$v_model = $row2['model'];
										$v_number = $row2['carNo'];


										$cname = "SELECT * FROM user where user_id='$user_id' ";
										$crun = mysqli_query($conn, $cname);
										if (mysqli_num_rows($crun) > 0) {
											$userfetch = mysqli_fetch_array($crun);
									?>
											<td><?php echo $i ?></td>
											<td><?php echo $userfetch['name']; ?></td>
											<td><?php echo $userfetch['contactNo']; ?></td>
										<?php } ?>

										<td><?php echo $row['status']; ?></td>
										<td><?php echo $v_model ?></td>
										<td><?php echo $v_number ?></td>
										<td><?php echo $row['location']; ?></td>
										<td><?php echo $row['res_code']; ?></td>
										<td><?php echo $row['start_date']; ?></td>
										<td><?php echo $row['start_time']; ?></td>
										<td><?php echo $row['end_date']; ?></td>
										<td><?php echo $row['end_time']; ?></td>
										<td><?php echo $row['with_driver']; ?></td>
										<td><?php echo $row['res_charges']; ?></td>
										<td><a href="reedit.php?confirm=<?php echo $row['reserve_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></a> </td>
										<td><a href="reedit.php?complete=<?php echo $row['reserve_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></a> </td>
										<td><a href="reedit.php?cancel=<?php echo $row['reserve_id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a> </td>


								<?php
										$i++;
									}
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