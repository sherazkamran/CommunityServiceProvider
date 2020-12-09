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

		if ($_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'shopmanager_sidebar.php';
		}

		?>
	</head>

	<body>
		<?php
		include("connection.php");

		if (isset($_GET['product_id'])) {
			$product_id = $_GET['product_id'];

			$query = "DELETE from product where product_id = '$product_id'";
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
			<!-- Content Header (Page header) -->
			<section class="content-header text-center ">
				<h1 style="margin-top:5%;">
					VIEW PRODUCTS
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class="bg-info" style="padding:40px;">
					<table id="table_id" class="table table-responsive">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Description</th>
								<th>Unit_Price</th>
								<th>View</th>
								<th>Edit</th>
								<th>Delete</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$q = "SELECT * from product;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>

									<td><?php echo $row['product_id']; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td style="width:75%; max-lines: 5;"><?php echo $row['description']; ?></td>
									<td><?php echo $row['price']; ?></td>

									<td><a href="viewproduct_image.php?product_id=<?php echo $row['product_id'] ?>"><i style="padding-left: 12%;" class="fa fa-eye" aria-placeholder="true"></i></a> </td>
									<td><a href="editproduct.php?product_id=<?php echo $row['product_id'] ?>"><i style="padding-left: 12%;" class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>
									<td><a onclick="alert('Are you sure you want to dete this service? Proceed')" style="color: red" href="viewproductlist.php?product_id=<?php echo $row['product_id'] ?>"><i style="padding-left: 12%;" class="fa fa-trash" aria-placeholder="true"></i></a> </td>


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
					// "scrollX": true
				});
			});
		</script>
	</body>

	</html>