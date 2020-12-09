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

		if ($_SESSION['type'] == "Shop Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
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

		if (isset($_GET['delete'])) {
			$car_id = $_GET['delete'];
			$q1 = "SELECT car_id from reservation where car_id=$car_id";
			$run1 = mysqli_query($conn, $q1);
			if ($run1) {
				$row1 = mysqli_fetch_array($run1);
				if ($row1['car_id'] == $car_id) {
					$q2 = "DELETE from reservation where car_id=$car_id";
					$run2 = mysqli_query($conn, $q2);
				}
			}
			$query = "DELETE from car where car_id = '$car_id'";

			if (mysqli_query($conn, $query)) {
				echo '<script type="text/javascript">';
				echo "alert('Removed')";
				echo "</script>";
			} else {
				echo '<script type="text/javascript">';
				echo "alert('Something went Wrong')";
				echo "</script>";
			}
		}
		?>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header text-center ">
				<h1 style="margin-top:5%;">
					VIEW CARS
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class="bg-info" style="padding:40px;">
					<table id="table_id" class="display">
						<thead>
							<tr>
								<th>Sr#</th>
								<th>Model</th>
								<th>Car#</th>
								<th>S.Capacity</th>
								<th>Availability</th>
								<th>Charges-p/h</th>
								<th>Colour</th>
								<th>Edit</th>
								<th>Delete</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$q = "SELECT * from car;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $row['model']; ?></td>
									<td><?php echo $row['carNo']; ?></td>

									<td>
										<p style="padding-left: 20%;"><?php echo $row['capacity']; ?></p>
									</td>
									<td><i style="padding-left: 20%;"><?php echo $row['availability']; ?></i></td>
									<td><i style="padding-left: 20%;"><?php echo $row['charges_per_hour']; ?></i></td>
									<td><i style="padding-left: 20%;"><?php echo $row['color']; ?></i></td>
									<td><a href="editcar_details.php?edit=<?php echo $row['car_id'] ?>"><i style="padding-left: 20%;" class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
									<td><a href="viewcarlist.php?delete=<?php echo $row['car_id'] ?>"><i style="padding-left: 20%; color: red;" class="fa fa-trash" aria-hidden="true"></i></a> </td>



								<?php
								$i++;
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
					// "scrollX": true
				});
			});
		</script>
	</body>

	</html>