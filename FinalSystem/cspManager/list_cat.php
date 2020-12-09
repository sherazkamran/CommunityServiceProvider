	<html>
<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<?php
	include 'header.php';
	  if($_SESSION['type']=="pm")
{
  echo '<script type="text/javascript">';
          echo "alert('Access not allowed')";
          echo "</script>";
   header ("Location: index.php");
}
	/*session_start();
 $get_id=$_SESSION['login_id'];
 if ($_SESSION['login_id']=0) {
 	echo "<script type='text/javascript'>alert('error');</script>";
 	header('Location:index.php');

 }*/
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
</head>
	<?php
  if (isset($_POST['btnRemove'])) {
    $cat_id = $_POST['txtId'];

    $query = "delete from category where id = '$cat_id';";
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
       Categories 
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

	<div class="container">
		 
		<center><h1>Categories</h1>
		<?php
			$q = "select * from category;";
			$result = mysqli_query($conn,$q);
			while ($row = $result->fetch_array()) {?>
		<div class="row" id="myrow" style="background: #fff; margin-top: 10px; boracr-left: 2px solid #a19;">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<img src="<?php echo $row['image']?>" class="img-responsive">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<p style="color: #a17; font-size: 20px;padding: 30px;"><b><?php echo $row['name'] ?></b></p>
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<a class="btn btn-info" href="edit_cat.php?cat_id=<?php echo $row['id'] ?>" style="width: 100px; margin-top: 10px;">Edit</a>
				<form action="" method="POST" onSubmit="return confirm('All products in this categoery will be deleted.')">
				
				
			</form>	
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<p style="font-size: 24px; text-align: center;vertical-align: middle;"  >Current Status :    <?php echo $row['status']; ?>  </p>
			</div>
		</div>

		<div style="width: 100%; height: 5px; background: #eee;"></div>
	<?php }?>
	</div>
<?php
include 'footer.php';
?>
 </section>
</div>
</html>