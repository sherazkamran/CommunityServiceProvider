	<html>

	<head>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
		<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
		<?php

		include 'header.php';

		if ($_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "User Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'cm_sidebar.php';
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
					VIEW USER COMPLAINTS
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class="   bg-info" style="padding:40px;">
					<table id="table_id" class="display">
						<thead>
							<tr>
								<th>Sr #</th>
								<th>Comp_ID</th>
								<th>User ID</th>
								<th>Contact Number</th>
								<th>Type</th>
								<th>Subject</th>
								<th>Status</th>
								<th>Tracking Code</th>
								<th>View Complain</th>
								<th>Mark Addressed</th>
								<th>Mark Cancelled</th>
								<th>Mark In-Processing</th>



							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$q = "SELECT * from complain;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $row['complain_id']; ?></td>
									<!-- fetching user name and contact start -->
									<?php
									$user_id = $row['user_id'];
									$cname = "SELECT * FROM user where user_id='$user_id' ";
									$crun = mysqli_query($conn, $cname);
									if (mysqli_num_rows($crun) > 0) {
										$userfetch = mysqli_fetch_array($crun);
									?>
										<td><?php echo $userfetch['user_id']; ?></td>
										<td><?php echo $userfetch['contactNo']; ?></td>

									<?php } ?>
									<td><?php echo $row['type']; ?></td>
									<td><?php echo $row['subject']; ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><?php echo $row['trcode']; ?></td>
									<td><a href="viewcomplain.php?view=<?php echo $row['complain_id'] ?>"><i style="margin-left: 25%;" class="fa fa-eye" aria-hidden="true"></i></a> </td>
									<td><a href="cmedit.php?confirm=<?php echo $row['complain_id'] ?>"><i style="margin-left: 25%;" class="fa fa-check" aria-hidden="true"></i></a> </td>
									<td><a href="cmedit.php?cancel=<?php echo $row['complain_id'] ?>"><i style="margin-left: 25%;" class="fa fa-times" aria-hidden="true"></i></a> </td>
									<td><a href="cmedit.php?inProcessing=<?php echo $row['complain_id'] ?>"><i style="margin-left: 25%;" class="fa fa-spinner" aria-hidden="true"></i></a> </td>
								<?php $i++;
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