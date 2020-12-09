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

		if ($_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "Shop Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'um_sidebar.php';
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
					<b>VIEW ADMINS</b>
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class=" bg-info" style="padding:40px;">
					<table id="table_id" class="display">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Userame</th>
								<th>Password</th>
								<th>Edit</th>


							</tr>
						</thead>
						<tbody>
							<?php
							$q = "SELECT * from admin;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>

									<td><?php echo $row['admin_id']; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo $row['password']; ?></td>

									<td><a href="editadmin.php?admin_id=<?php echo $row['admin_id'] ?>"><i style="padding-left: 12%;" class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>


								<?php } ?>
						</tbody>
					</table>

				</div>
				<?php
				include 'footer.php';
				?>
			</section>
		</div>


		<script>
			$(document).ready(function() {
				$('#table_id').DataTable({
					// "scrollX": true
				});
			});


			// $(document).ready(function() {
			//     $('#table_id').DataTable();
			// });
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	</body>

	</html>