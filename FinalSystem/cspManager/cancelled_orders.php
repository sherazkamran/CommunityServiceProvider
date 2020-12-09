<html>
<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<?php
include 'header.php';
	  if($_SESSION['type']=="deo")
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
	<style type="text/css">
		.tablink {
  background-color: green;
  color: white;
 margin:10px;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 10px 30px 10px 30px;
  font-size: 25px;
  width: 25%;

}

.tablink:hover {
  background-color: red;
  color: white;
}

	</style>


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Orders
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
	 
		<center><a class="tablink" href="pending_orders.php" >Pending</a>
      <a class="tablink"  href="process_orders.php">Processing</a>
<a class="tablink"  href="pending_orders.php" >Delivered</a>
<a class="tablink"  href="cancelled_orders.php" style="background-color: red">Cancelled</a>
		</center>
<div class="box"  style="margin-top: 15px;">
            <div class="box-header">
              <h3 class="box-title">Orders</h3>

            </div>

	<center>	<div class="box-header">
             <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
        <p style="   text-transform: capitalize; "><b>Bill No</b></p>  
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4"> 
         <p style="   text-transform: capitalize; "><b>Customer Name</b></p>  
      </div>
      <div class="col-lg-2   col-md-4 col-sm-4 col-xs-4">
         <p style="   text-transform: capitalize; "><b>Total Bill</b></p>  
         
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize; "><b>Date</b></p>   
        
      </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize; "><b>Customer Phone</b></p>   
        
      </div>
        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize; "><b>Status</b></p>   
        
      </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
             <!-- <form method="post" action="query.php"> -->
            
              <table class="table table-hover" >
                
		<?php
			$q = "SELECT bill.id, bill.total,bill.date,bill.status,bill.reason, customer.name, customer.email,customer.phone
FROM bill
INNER JOIN customer ON bill.customer_id = customer.id WHERE bill.status='cancelled';";
			$result = mysqli_query($conn,$q);
			while ($row = $result->fetch_array()) {?>
		<div class="row" id="myrow" style="background: #fff; margin: 0px;">
			<div class="col-lg-1 col-md-2 col-sm-2 col-xs-2	">
				<p style="color: #a17; font-size: 14px;"><b><?php echo $row['id'] ?></b></p>
					
			</div>
			 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				
				
			 
				<p style="color: Red;text-transform: capitalize;">  <?php echo $row['name'] ?></p>

			</div>
			 <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4"> 

			
					<p style="color: #188; "> <?php echo $row['total'] ?></p>
					</div>
			 <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4"> 
				<p style="color: black; ">  <?php echo $row['date'] ?></p>
				 </div>
			 <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4"> 
				<p style="color: #188; ">  <?php echo $row['phone'] ?></p>
				</div>
			 <div class="col-lg-1 col-md-4 col-sm-4 col-xs-4"> 
				<p style="color: #188; text-transform: capitalize;">   <?php echo $row['status'] ?></p>
        <p style="color: #188; text-transform: capitalize;">   <?php echo $row['reason'] ?></p>
			</div>
		 </center>
			<center><div class="col-lg-1 col-md-4 col-sm-4 col-xs-2">
				<a class="btn btn-info" href="orderdetails.php?orderid=<?php echo $row['id'] ?>" style="width: 100px; margin-top: 10px;">View</a>
					<form action="" method="POST" onSubmit="return confirm('Are you sure you want to delete this User')">
				<input type="hidden" name="txtId" value="<?php echo($row['id'])?>">
				<!-- <button name="btnRemove" class="btn btn-danger" style="width: 100px; margin-top: 10px;">Remove</button> -->
			</form>	
				</div></center>
		</div>
		<div style="width: 100%; height: 5px; background: #eee;"></div>
	<?php }?>
		</div>
	 
	 </section>
	    <!-- /.content -->
	  </div>
<?php
 include 'footer.php';
 ?>