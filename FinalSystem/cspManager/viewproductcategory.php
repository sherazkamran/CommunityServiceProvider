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

		if (isset($_GET['prodcat_id'])) {
			$product_id = $_GET['prodcat_id'];
			$q1 = "SELECT prodcat_id from product where prodcat_id='$prodcat_id";
			$run1 = mysqli_query($conn, $q1);
			if ($run1) {
				$row1 = mysqli_fetch_array($run1);
				if ($row1['prodcat_id'] == $prodcat_id) {
					$q2 = "DELETE from product where prodcat_id=$prodcat_id";
					$run2 = mysqli_query($conn, $q2);
				}
			}
			$query = "DELETE from product_category where prodcat_id = '$prodcat_id'";
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
					VIEW CATEGORIES
				</h1>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">

				<div class=" bg-info" style="padding:40px;">
					<table id="table_id" class="display ">
						<thead>
							<tr>
								<th>Name</th>
								<th>Status</th>
								<th>Edit</th>
								<th>Delete</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$q = "SELECT * from product_category;";
							$result = mysqli_query($conn, $q);
							while ($row = $result->fetch_array()) { ?>

								<tr>


									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><a href="editproductcategory.php?prodcat_id=<?php echo $row['prodcat_id'] ?>"><i style="padding-left: 12%;" class="fa fa-pencil-square-o" aria-placeholder="true"></i></a> </td>
									<td><a onclick="alert('Are you sure you want to dete this service? Proceed')" style="color: red" href="viewproductcategory.php?prodcat_id=<?php echo $row['prodcat_id'] ?>"><i style="padding-left: 12%;" class="fa fa-trash" aria-placeholder="true"></i></a> </td>


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