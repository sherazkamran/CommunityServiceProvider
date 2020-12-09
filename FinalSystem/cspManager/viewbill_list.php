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

		if ($_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'billingmanager_sidebar.php';
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
					VIEW BILLS
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class=" bg-info" style="padding:40px;">
					<table id="table_id" class="display">
						<thead>
							<tr>
								<th>ID</th>
								<th>Month</th>
								<th>Consumer</th>
								<th>Contact#</th>
								<th>Address</th>
								<th>Status</th>
								<th>View</th>
								<th>Edit</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$q = "SELECT * from bills;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>
									<td><?php echo $row['bill_id']; ?></td>
									<td><?php echo $row['month']; ?></td>
									<!-- fetching user name and contact start -->
									<?php
									$user_id = $row['user_id'];
									$cname = "SELECT * FROM user where user_id='$user_id' ";
									$crun = mysqli_query($conn, $cname);
									if (mysqli_num_rows($crun) > 0) {
										$userfetch = mysqli_fetch_array($crun);
									?>
										<td><?php echo $userfetch['name']; ?></td>
										<td><?php echo $userfetch['contactNo']; ?></td>
										<td>House# <?php echo $userfetch['houseNo']; ?>, Street <?php echo $userfetch['streetNo'] ?>, Phase <?php echo $userfetch['phase'] ?></td>
									<?php } ?>
									<td><?php echo $row['status']; ?></td>
									<td><a href="viewbill.php?view=<?php echo $row['bill_id'] ?>"><i style="padding-left: 26%;" class="fa fa-eye" aria-hidden="true"></i></a> </td>

									<td><a href="editbill.php?bill_id=<?php echo $row['bill_id'] ?>"><i style="padding-left: 26%;" class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>

								<?php } ?>
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
					//"scrollX": true
				});
			});
		</script>
	</body>

	</html>