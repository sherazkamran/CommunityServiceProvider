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
.tablink a.active { background-color:#bbb; }

  </style>

 

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders
      </h1>
     
    </section>

   

    <!-- Main content -->
    <section class="content container-fluid" >
      <center><a class="tablink" href="prescription.php?orderid=<?php echo $order_id ?>">Prescription</a>
      <a class="tablink" href="custom_orderdetails.php?orderid=<?php echo $order_id ?>">Invoice</a>
 
    </center>
<div class="box"  id="bill">
            <div class="box-header">
           <div style="float: right;"><p><b>Order Number : </b><?php echo $order_id; ?></p>
                <p></p></div>

            </div>
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
             <!-- <form method="post" action="query.php"> -->
            
              <table class="table table-hover" >
                
<?php
                 $q = "SELECT * from bill where    id='$order_id';";
			$result = mysqli_query($conn,$q);
			while ($row = $result->fetch_array()){?>
                 
    <div class="row" id="myrow" style="background: #fff; margin: 0px; ">    
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <img align="center" src="<?php echo $row['image'] ?>"> 
         <a class="btn btn-danger"  href="<?php echo $row['image'] ?>" >Print</a>
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

             

</span>

 </div></center>

 </section>
    <!-- /.content -->
 
  </div>
  <!-- /End Table -->
<?php
 include 'footer.php';
 ?>