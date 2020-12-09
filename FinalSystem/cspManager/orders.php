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
			include 'shopmanager_sidebar.php';
		}
		if ($_SESSION['type'] == "Service Manager") {
			include 'pm_sidebar.php';
		}



		?>
	</head>

	<body>
		<?php
		include("connection.php");
		if (isset($_POST['btnRemove'])) {
			$car_id = $_POST['carId'];

			$query = "DELETE from car where car_id = '$car_id';";
			if (mysqli_query($conn, $query)) {
				echo '<script type="text/javascript">';
				echo "alert('Removed')";
				echo "</script>";
			} else {
				echo '<script type="text/javascript">';
				echo "alert('Something wents Wrong')";
				echo "</script>";
			}
		}
		?>
		<div class="content-wrapper">
			<div style="display: flex; flex-direction:column ; align-items: center; justify-content: center">
				<!-- Content Header (Page header) -->
				<section class="content-header text-center ">
					<h1 style="margin-top:5%;">
						VIEW ORDERS
					</h1>

				</section>

				<!-- Main content -->
				<section class="content container-fluid" style=" display: flex; justify-content: center; align-items:center;">

					<div class="bg-info" style="padding: 40px;">
						<table id="table_id" class="display">
							<thead>
								<tr>
									<th>Sr #</th>
									<th>User_ID</th>
									<th>User Name</th>
									<th>Order Status</th>
									<th>Date</th>
									<th>Order_ID</th>
									<th>Delivered at</th>
									<th>View</th>
									<th>Update Status</th>

								</tr>
							</thead>
							<tbody>
								<?php
								// $q = "SELECT placed_order.order_id, placed_order.total_amount,placed_order.issue_date,placed_order.issue_time,placed_order.status, user.name, user.email,user.contactNo
								// FROM placed_order
								// INNER JOIN user ON placed_order.user_id = user.user_id;";
								?>
								<?php
								$u_n;
								$i = 1;
								$q = "SELECT * from ordered_items ORDER BY unique_id DESC";
								$abcTest;
								$z = 0;

								$result = mysqli_query($conn, $q);
								while ($row = $result->fetch_array()) {
									if ($z == 0) {
										$z = $z + 1;
										$abcTest = $row['order_id'];
										$nnnmmm = $row['user_id'];
										$qq = "SELECT name from user WHERE user_id= '$nnnmmm'";
										$res = mysqli_query($conn, $qq);
										$row1 = mysqli_fetch_array($res);
										if (mysqli_num_rows($res) > 0) {
											$u_n = $row1['name'];
										}

								?>
										<tr>

											<td><?php echo $i ?></td>
											<td><?php echo $row['user_id'] ?></td>
											<td><?php echo $u_n ?></td>
											<td><?php echo $row['order_status']; ?></td>
											<td><?php echo $row['date_time']; ?></td>
											<td><?php echo $row['order_id']; ?></td>
											<td><?php echo $row['address']; ?></td>
											<td><a href="orderdetails.php?order_id=<?php echo $row['order_id'] ?>"><i style="padding-left: 20%;" class="fa fa-eye" aria-hidden="true"></i></a> </td>
											<td><a href="editorderstatus.php?order_id=<?php echo $row['order_id'] ?>"><i style="padding-left: 12%;" class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>
										</tr>
										<?php	} else {
										if ($abcTest == $row['order_id']) {
										} else {

											$i++;
											$abcTest = $row['order_id'];
											$uu_iidd = $row['user_id'];
											$qq = "SELECT name from user WHERE user_id= '$uu_iidd'";
											$res = mysqli_query($conn, $qq);
											$row1 = mysqli_fetch_array($res);
											if (mysqli_num_rows($res) > 0) {
												$u_n = $row1['name'];
											}
										?>
											<tr>
												<td><?php echo $i ?></td>
												<td><?php echo $row['user_id']; ?></td>
												<td><?php echo $u_n ?></td>
												<td><?php echo $row['order_status']; ?></td>
												<td><?php echo $row['date_time']; ?></td>
												<td><?php echo $row['order_id']; ?></td>
												<td><?php echo $row['address']; ?></td>
												<td><a href="orderdetails.php?order_id=<?php echo $row['order_id'] ?>"><i style="padding-left: 20%;" class="fa fa-eye" aria-hidden="true"></i></a> </td>
												<td><a href="editorderstatus.php?order_id=<?php echo $row['order_id'] ?>"><i style="padding-left: 12%;" class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>
											</tr>



									<?php
										}
									}

									?>
								<?php } ?>

							</tbody>



						</table>
						<!-- <center>
						<td><a href="" style="background-color:#357CA5; color:white; padding:1%; border-radius:10px;"> Edit Status<i style="padding-left:2%; " class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>
					</center> -->



					</div>
				</section>
			</div>

			<?php
			include 'footer.php';
			?>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				$('#table_id').DataTable({
					//	"scrollX": true
				});
			});
		</script>
	</body>

	</html>