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
 
  $customerId = $_GET['customer_id'];
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
       
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
   
    <center>
       <a class="tablink"  href="wallet.php?customer_id=<?php echo $customerId ?>">wallet</a>
      <a class="tablink"  style="background-color:  red" href="bills.php?customer_id=<?php echo $customerId ?>">Bills</a>
 
    </center>
 
<div class="box"  id="bill">
            <div class="box-header">
              <h3 class="box-title">Bill Details</h3><div style="float: right;"> 
                <p></p></div>

            </div>
            <div class="box-header">
             <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <p style="   text-transform: capitalize; "><b>Bill Total</b></p>  
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4"> 
         
      </div>
      <div class="col-lg-3   col-md-4 col-sm-4 col-xs-4">
           
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
         <p style="   text-transform: capitalize; "><b>Date</b></p>   
        
      </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
             <!-- <form method="post" action="query.php"> -->
            
              <table class="table table-hover" >
                
<?php
                 $q = "SELECT * FROM bill where customer_id=$customerId";
      $result = mysqli_query($conn,$q);
      while ($row = $result->fetch_array()){?>
                 
    <div class="row" id="myrow" style="background: #fff; margin: 0px; ">    
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #a17; "><b><?php echo $row['total'] ?></b></p>  
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4"> 
        <p style="color: #188; "><b>  </b> <?php echo $row['quantity'] ?></p> 
      </div>
      <div class="col-lg-3   col-md-4 col-sm-4 col-xs-4">
          <p style="color: #188; "> <?php echo $row['m_price'] ?></p>
         
      </div>
      <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
        <p style="color: #188; "> <?php echo $row['date'] ?></p>
        
      </div>
    </div>
 
</div>
                          <?php }
                 ?>
                      
 
                



            </div>
            <!-- /.box-body -->
          </div> 
 </section>
    <!-- /.content -->
 
  </div>
  <!-- /End Table -->
<?php
 include 'footer.php';
 ?>