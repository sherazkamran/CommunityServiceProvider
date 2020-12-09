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
	?>
	
 

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders
      </h1>
     
    </section>

   

    <!-- Main content -->
    <section class="content container-fluid" >
<div class="box"  id="bill">
            <div class="box-header">
            <a  class="btn btn-primary" type="submit" href="print_template.php?orderid=<?php echo $order_id?>">Print</a><div style="float: right;"><p><b>Order Number : </b><?php echo $order_id; ?></p>
                <p></p></div>

            </div>
            <div class="box-header">
             <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <p style="   text-transform: capitalize; "><b>Item Name</b></p>  
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4"> 
         <p style="   text-transform: capitalize; "><b>Quantity</b></p>  
      </div>
      <div class="col-lg-3   col-md-4 col-sm-4 col-xs-4">
         <p style="   text-transform: capitalize; "><b>Unit Price</b></p>  
         
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize; "><b>Total Amount</b></p>   
        
      </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
             <!-- <form method="post" action="query.php"> -->
            
              <table class="table table-hover" >
                
<?php
                 $q = "SELECT bill_item.bill_id, bill_item.quantity, item.name,	item.m_price
FROM bill_item
INNER JOIN item ON bill_item.item_id = item.id where bill_item.bill_id='$order_id';";
			$result = mysqli_query($conn,$q);
			while ($row = $result->fetch_array()){?>
                 
    <div class="row" id="myrow" style="background: #fff; margin: 0px; ">    
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #a17; "><b><?php echo $row['name'] ?></b></p>  
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4"> 
        <p style="color: #188; "><b>  </b> <?php echo $row['quantity'] ?></p> 
      </div>
      <div class="col-lg-3   col-md-4 col-sm-4 col-xs-4">
          <p style="color: #188; "> <?php echo $row['m_price'] ?></p>
         
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #188; "> <?php echo $row['quantity']*$row['m_price'] ?></p>
        
      </div>
    </div>
 
</div>
                          <?php }
                 ?>
                      
<?php
               	$query = "select * from bill where id='$order_id';";
                  $result=mysqli_query($conn,$query);
                  	$row = $result->fetch_array();{?>
               </td></td></td></tr>
              <tr> 	<th style="padding: 10px;">Grand Total</th><td></td><td></td><td></td><th><?php echo$row['total']; ?></th><th></th>
                      
                      </tr>
                  
 
             </table>
       <!--      </form> -->
                 <?php }
                 ?>
                     
               	



            </div>
            <!-- /.box-body -->
          </div><center>

            <?php 
if($row['status']=='processing'){
    $class = 'hidden';
     $classB = 'btn btn-danger';
$classA='btn btn-danger';

} 
if($row['status']=='pending'){
   $classA = 'hidden';
   $classB = 'btn btn-danger';
   $class = 'btn btn-danger';
  

}  
if($row['status']=='cancelled'){
   $classA = 'hidden';
   $classB = 'hidden';
   $class = 'hidden';
} 
if($row['status']=='delivered' && $_SESSION['type']!="pm"){
   $classA = 'hidden';
   $classB = 'hidden';
   $class = 'hidden';
} 
       
       if (isset($_POST['btnProcess'])) {
             
          $sql = "update bill set status='processing' where id =$order_id;";

        if (mysqli_query($conn,$sql)) {
        echo '<script type="text/javascript">';
          echo "alert('Bill Status Updated')";
             echo "<script>window.location.href='process_order.php';</script>";
          echo "</script>";
        
          
        }else {
         echo '<script type="text/javascript">';
          echo "alert('Something Went Wrong')";
          echo "</script>";
        } 

      }  
      if (isset($_POST['btnComplete'])) {
             
          $sql = "update bill set status='delivered' where id =$order_id;";

        if (mysqli_query($conn,$sql)) {
        echo '<script type="text/javascript">';
          echo "alert('Bill Status Updated')";
           header ("Location: com_order.php");
          echo "</script>";
          
          
        }else {
         echo '<script type="text/javascript">';
          echo "alert('Something Went Wrong')";
          echo "</script>";
        } 

      }  
      if (isset($_POST['btnCancell'])) {
             
          $sql = "update bill set status='cancelled' where id =$order_id;";

        if (mysqli_query($conn,$sql)) {
        echo '<script type="text/javascript">';
          echo "alert('Bill Status Updated')";
           header ("Location: cancelled_order.php");
          echo "</script>";
          
          
        }else {
         echo '<script type="text/javascript">';
          echo "alert('Something Went Wrong')";
          echo "</script>";
        } 

      }     




             ?>
          
<b>Current Status : </b>
            <span style="text-transform: capitalize; color: red;" ><?php 

              echo $row['status'];


             ?>
</span>

 <form   onSubmit="return confirm('Order Will be Sent to Processing! Proceed?')" action="" method="post">
            <button name="btnProcess"  class="<?php echo $class; ?>"    type="submit" style="margin:10px;"  >Send to Processing</button></form>
             <form onSubmit="return confirm('Order Will be Marked as Delivered! Proceed?')" action="" method="post">
            <button name="btnComplete"  class="<?php echo $classA; ?>"    type="submit" style="margin:10px;"  >Mark As Delivered</button></form>
             <form onSubmit="return confirm('Order Will be Cancelled! Proceed?')" action="" method="post">
            <button  name="btnCancell" class="<?php echo $classB; ?>"   type="submit" style="margin:10px;"  >Cancell Order </button></form>
          </form></center>

 </section>
    <!-- /.content -->
 
  </div>
  <!-- /End Table -->
<?php
 include 'footer.php';
 ?>