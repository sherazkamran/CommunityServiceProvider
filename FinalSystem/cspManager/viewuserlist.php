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

		if (isset($_GET['user_id'])) {
			$user_id = $_GET['user_id'];
			$q1 = "SELECT user_id from bills where user_id='$user_id";
			$run1 = mysqli_query($conn, $q1);
			if ($run1) {
				$row1 = mysqli_fetch_array($run1);
				if ($row1['user_id'] == $user_id) {
					$q2 = "DELETE from bills where user_id=$user_id";
					$run2 = mysqli_query($conn, $q2);
				}
			}
			$q1 = "SELECT user_id from hired_service where user_id='$user_id";
			$run1 = mysqli_query($conn, $q1);
			if ($run1) {
				$row1 = mysqli_fetch_array($run1);
				if ($row1['user_id'] == $user_id) {
					$q2 = "DELETE from hired_service where user_id=$user_id";
					$run2 = mysqli_query($conn, $q2);
				}
			}
			$q1 = "SELECT user_id from reservation where user_id='$user_id";
			$run1 = mysqli_query($conn, $q1);
			if ($run1) {
				$row1 = mysqli_fetch_array($run1);
				if ($row1['user_id'] == $user_id) {
					$q2 = "DELETE from reservation where user_id=$user_id";
					$run2 = mysqli_query($conn, $q2);
				}
			}
			$q1 = "SELECT user_id from placed_order where user_id='$user_id";
			$run1 = mysqli_query($conn, $q1);
			if ($run1) {
				$row1 = mysqli_fetch_array($run1);
				if ($row1['user_id'] == $user_id) {
					$q2 = "DELETE from placed_order where user_id=$user_id";
					$run2 = mysqli_query($conn, $q2);
				}
			}
			// $q1 = "SELECT user_id from complain where user_id='$user_id";
			// $run1 = mysqli_query($conn, $q1);
			// if ($run1) {
			//     $row1 = mysqli_fetch_array($run1);
			//     if ($row1['user_id'] == $user_id) {
			//         $q2 = "DELETE from complain where user_id=$user_id";
			//         $run2 = mysqli_query($conn, $q2);
			//     }
			// }
			$query = "DELETE from user where user_id = '$user_id'";
			if (mysqli_query($conn, $query)) {
				echo '<script type="text/javascript">';
				echo "alert('Removed')";
				echo "</script>";
			} else {
				echo '<script type="text/javascript">';
				echo "alert('Something wents Wrong $user_id')";
				echo "</script>";
			}
		}


		?>
		<div class="content-wrapper">
			<div style="display: flex; flex-direction:column ; align-items: center; justify-content: center">


				<!-- Content Header (Page header) -->
				<section class="content-header text-center ">
					<h1 style="margin-top:5%;">
						<b>VIEW USERS</b>
					</h1>

				</section>

				<!-- Main content -->
				<section class="content">

					<div class="bg-info" style="padding:40px;">
						<table id="table_id" class="display">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Password</th>
									<th>CNIC</th>
									<th>Contact#</th>
									<th>Phase</th>
									<th>Street#</th>
									<th>House#</th>
									<th>Status</th>
									<th>Confirm</th>
									<th>Cancel</th>
									<th>Edit</th>
									<th>Delete</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$q = "SELECT * from user;";
								$result = mysqli_query($conn, $q);
								while ($row = $result->fetch_array()) { ?>

									<tr>

										<td><?php echo $row['user_id']; ?></td>
										<td><?php echo $row['name']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['password']; ?></td>
										<td><?php echo $row['cnic']; ?></td>
										<td><?php echo $row['contactNo']; ?></td>
										<td><?php echo $row['phase']; ?></td>
										<td><?php echo $row['streetNo']; ?></td>
										<td><?php echo $row['houseNo']; ?></td>
										<td><?php echo $row['status']; ?></td>

										<td><a href="usedit.php?confirm=<?php echo $row['user_id'] ?>"><i style="padding-left: 12%;" class="fa fa-check" aria-placeholder="true"></i></a> </td>
										<td><a href="usedit.php?cancel=<?php echo $row['user_id'] ?>"><i style="padding-left: 12%;" class="fa fa-times" aria-placeholder="true"></i></a> </td>
										<td><a href="edituser.php?user_id=<?php echo $row['user_id'] ?>"><i class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>
										<td><a onclick="alert('Are you sure you want to dete this service? Proceed')" style="color: red" href="viewuserlist.php?user_id=<?php echo $row['user_id'] ?>"><i style="padding-left: 12%;" class="fa fa-trash" aria-placeholder="true"></i></a> </td>


									<?php } ?>
							</tbody>
						</table>

					</div>
					<?php
					include 'footer.php';
					?>
				</section>
			</div>
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