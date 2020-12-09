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
 
 $order_id = $_GET['orderid'];

 
  $formatError = "";
  $success  ="";
  $failed ="";
    
  ?>
	
 

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"><div style="float: right;  "> <form method="post">			<label>Date From</label>
              	<input type="date" name="dateFrom" required="">
              	<label>Date To</label>
              	<input type="date" name="dateTo" required=""  >
              	<button type="submit" name="searchByDate">Search</button>
              </form>
     </div>
      <h1>
       Report

      </h1>
      
    </section>

   

    <!-- Main content -->
    <section class="content container-fluid" >
<div class="box"  id="bill">
            <div class="box-header">
<?php
// testing



//testing



if (isset($_POST['searchByDate'])) {
      $dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];

        ?>              
              <div style="float: right;"><p>   <b>Date: From </b><?php echo $dateFrom." To ".$dateTo; ?></p>
                <p></p></div>
 <a  class="btn btn-primary" type="submit" href="print_reports.php?dateFrom=<?php echo $dateFrom?>&&dateTo=<?php echo $dateTo?>">Print</a></center>
            </div>
            <div class="box-header">
              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
        <p style="   text-transform: capitalize; text-align: center; "><b>Item ID</b></p>  
      </div>
             <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
        <p style="   text-transform: capitalize; text-align: center;"><b>Bill Id</b></p>  
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4"> 
         <p style="   text-transform: capitalize; text-align: center;"><b>Date</b></p>  
      </div>
      <div class="col-lg-3   col-md-4 col-sm-4 col-xs-4">
         <p style="   text-transform: capitalize;text-align: center; "><b>Quantity</b></p>  
         
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize; text-align: center;"><b>Unit Price</b></p>   
        
      </div>
      <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize;text-align: center; "><b>Purchase Price</b></p>   
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize;text-align: center; "><b>Total</b></p>   
        
      </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
             <!-- <form method="post" action="query.php"> -->
            
              <table class="table table-hover" >
                

         
         <?php
    

                 $q = "SELECT bill.date,bill.status,bill_item.item_id,bill_item.purchase_price,bill_item.bill_id, bill_item.quantity,bill_item.price
FROM bill
INNER JOIN bill_item ON bill.id = bill_item.bill_id where (bill.date>'$dateFrom' or bill.date='$dateFrom') and (bill.date<'$dateTo' or bill.date='$dateTo');";
			if(mysqli_query($conn,$q))
			{
				$result = mysqli_query($conn,$q);
				while ($row = $result->fetch_array()){?>
                 
    <div class="row" id="myrow" style="background: #fff; margin: 0px; ">    
      </div>
      <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #a17; text-align: center;"><b><?php echo $row['item_id'] ?></b></p>  
      </div>
      <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #a17; text-align: center;"><b><?php echo $row['bill_id'] ?></b></p>  
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4"> 
        <p style="color: #188;text-align: center; "><b>  </b> <?php echo $row['date'] ?></p> 
      </div>
      <div class="col-lg-3   col-md-4 col-sm-4 col-xs-4">
          <p style="color: #188;text-align: center; "> <?php echo $row['quantity'] ?></p>
         
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #188;text-align: center; "> <?php echo $row['price'] ?></p>
        
      </div>
       <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #188;text-align: center; "> <?php echo $row['purchase_price'] ?></p>
        
      </div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #188; text-align: center;"> <?php echo $row['price']*$row['quantity'] ?></p>
        
      </div>
    </div>
 
</div>
                          <?php }

                      }
                      }
                      else{
                      	echo mysqli_error($conn);
                      }
                 ?>
         

            </div>
            <!-- /.box-body -->
          </div><center>

             
</span>



 </section>
    <!-- /.content -->
 
  </div>
  <!-- /End Table -->
<?php
 include 'footer.php';
 ?>