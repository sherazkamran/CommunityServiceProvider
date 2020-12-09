<html>
<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<?php
	include 'header.php';
	  if($_SESSION['type']!="admin")
{
  echo '<script type="text/javascript">';
          echo "alert('Access not allowed')";
          echo "</script>";
   header ("Location: index.php");
}

    if($_SESSION['type']=="deo")
{
  include 'deo_sidebar.php';
 
}
  if($_SESSION['type']=="admin")
{
  include 'admin_sidebar.php';
 
}
  if($_SESSION['type']=="pm")
{
  include 'pm_sidebar.php';
 
}
  ?>
	<?php
  if (isset($_POST['btnRemove'])) {
    $userId = $_POST['txtId'];

    $query = "delete from customer where id = '$userId';";
    if (mysqli_query($conn,$query)) {
      echo '<script type="text/javascript">';
      echo "alert('Removed')";
      echo "</script>";
    }else {
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
        Customers 
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
	<div class="container">
		 
		<center><h1>Customers</h1><a class="btn btn-success"   href="addcustomer.php" style="width: 100px; margin-top: 10px;">Add new Customer</a></center>
		<?php
			$q = "select * from customer;";
			$result = mysqli_query($conn,$q);
			while ($row = $result->fetch_array()) {?>
		<div class="row" id="myrow" style="background: #fff; margin-top: 10px; border-left: 2px solid #a19;">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<p style="color: #a17; font-size: 40px; vertical-align: middle; padding: 10px;text-transform: capitalize;"><b><?php echo $row['name'] ?></b></p>
					
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<p style="color: #188; "><b>Customer Id : </b>  <?php echo $row['id'] ?></p>	
				<p style="color: #188; "><b>Phone Number: </b> <?php echo $row['phone'] ?></p>
			 
				<p style="color: #188; "><b>Address : </b>  <?php echo $row['address'] ?></p>

			

			</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<p style="color: #188; "><b>Email : </b>  <?php echo $row['email'] ?></p>
				<p style="color: black; "><b>Status: </b>  <?php echo $row['status'] ?></p>
				 
				 
			</div>
			<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6">
				<a class="btn btn-info" href="edit_customer.php?customer_id=<?php echo $row['id'] ?>" style="width: 100px; margin-top: 10px;">Edit</a>
				<form action="" method="POST" onSubmit="return confirm('Are you sure you want to delete this user?')">
				<input type="hidden" name="txtId" value="<?php echo($row['id'])?>">
				<button name="btnRemove" class="btn btn-danger" style="width: 100px; margin-top: 10px;">Remove</button>
			</form>		
			</div>
			<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6">
				<a class="btn btn-primary" href="wallet.php?customer_id=<?php echo $row['id'] ?>" style=" margin: 10px;">Transaction History</a>
				 	<a class="btn btn-success" href="manage_wallet.php?customer_id=<?php echo $row['id'] ?>" style=" margin-left:  10px;">Manage Wallet</a>	
			</div>
		</div>
	<?php }?>
	</div>
 
 </section>
    <!-- /.content -->
</div>
<?php
 include 'footer.php';
 ?>