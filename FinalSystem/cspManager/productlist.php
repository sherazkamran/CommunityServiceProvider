	<html>

	<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<?php
		/*session_start();
 $get_id=$_SESSION['login_id'];
 if ($_SESSION['login_id']=0) {
 	echo "<script type='text/javascript'>alert('error');</script>";
 	header('Location:index.php');

 }*/
		include 'header.php';
		if ($_SESSION['type'] == "Booking Manager" || $_SESSION['type'] == "Service Manager" || $_SESSION['type'] == "Billing Manager" || $_SESSION['type'] == "Complain Manager" || $_SESSION['type'] == "User Manager") {
			echo '<script type="text/javascript">';
			echo "alert('Access not allowed')";
			echo "</script>";
			header("Location: index.php");
		} else {
			include 'shopmanager_sidebar.php';
		}



		?>
	</head>
	<?php
	if (isset($_POST['btnRemove'])) {
		$product_id = $_POST['product_id'];

		$query = "DELETE from product where product_id = '$product_id';";
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
		<section class="content-header">
			<h1>
				Products
			</h1>

		</section>

		<!-- Main content -->
		<section class="content container-fluid">

			<div class="container">

				<center>
					<h1>Products</h1>
					<?php
					$q = "SELECT * from product;";
					$result = mysqli_query($conn, $q);
					while ($row = $result->fetch_array()) { ?>
						<div class="row" id="myrow" style="background: #fff; margin-top: 10px; border-left: 2px solid #a19;">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
								<img src="<?php echo $row['image'] ?>" class="img-responsive">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<p style="color: #a17; font-size: 20px;"><b><?php echo $row['name'] ?></b></p>
								<p style="color: #188; "><b>Price: </b> <?php echo $row['price'] ?></p>


							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
								<p style="color: #188; "><b>Description : </b> <?php echo $row['description'] ?></p>
							</div>


							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
								<a class="btn btn-info" href="editproduct.php?product_id=<?php echo $row['product_id'] ?>" style="width: 100px; margin-top: 10px;">Edit</a>

							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
								<form action="" method="POST">
									<button class="btn btn-info" name="btnRemove" style="width: 100px; margin-top: 10px;">Delete</button>
									<input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>"></input>


								</form>


							</div>

						</div>
						<div style="width: 100%; height: 5px; background: #eee;"></div>
					<?php } ?>
			</div>
			<?php
			include 'footer.php';
			?>
		</section>
	</div>

	</html>