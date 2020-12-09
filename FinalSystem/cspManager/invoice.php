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
  
if(isset($_POST['save']))  
{  
$name=$_POST['name'];  
$location=$_POST['location'];  

 
for($i = 0; $i<count($_POST['productname']); $i++)  
{  
mysqli_query($conn,"INSERT INTO tbl_orderdetail  
SET   
bill_id = '5',  
name = '{$_POST['productname'][$i]}',  
quantity = '{$_POST['quantity'][$i]}',  
price = '{$_POST['price'][$i]}',  
 
amount = '{$_POST['amount'][$i]}'");   






} 
mysqli_query($conn,"update bill set total= '{$_POST['txtTotal']}' where id=$order_id  ");  
}   
  include 'footer.php' ?>
  
    
  
    <head>  
        <title>Invoice</title>  
         
    </head>  
    <scriptsrc="//code.jquery.com/jquery-1.12.0.min.js">  
        </script>  
        <scriptsrc="//code.jquery.com/jquery-migrate-1.2.1.min.js">  
            </script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  
          <div class="content-wrapper">
             <!-- Content Header (Page header) -->
              <section class="content-header">
                  <h1>
                 Custom Order
                    
                  </h1>
               
                </section>

           <!-- Main content -->
 <section class="content container">

<div class="col-md-3">
  
</div>

<div class="col-md-6 "> <div class="box box-success">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Student Info</h3> -->
            </div>
            <!-- /.box-header -->
           
           
            <div class="box-body ">
                <form action="" method="POST">  
                    <div class="box box-primary">  
                        <div class="box-header">  
                            <h3 class="box-title">Invoice </h3>  
                        </div>  
                        <div class="box-body">  
                           <span class="form-group-addon">Customer Id</span>
                 
      
                
                    
                     

<?php 
                    $q = "select * from bill where id=$order_id;";
                    $result = mysqli_query($conn,$q);
                  ?>
                 
                    <?php
                   while ($row = $result->fetch_array()) {?>
                  <p> <?php  echo $row['customer_id'];      ?>
                     
                      

                    <?php }
                    ?>
                             
                        </div>  
                        <input type="submit" style="margin-top: 10px;" class="btn btn-primary" name="save" value="Save Record">  
                    </div><br/>  
                    <table class="table table-bordered table-hover">  
                        <thead>  
                            <th>No</th>  
                            <th>Name</th>  
                            <th>Quantity</th>  
                            <th>Price</th>  
                         
                            <th>Total Amount</th>  
                            <th><input type="button" value="+" id="add" class="btn btn-success"></th>  
                        </thead>  
                        <tbody class="detail">  
                            <tr>  
                                <td class="no">1</td>  
                                <td><input type="text" class="form-control productname" name="productname[]"></td>  
                                <td><input type="text" class="form-control quantity" name="quantity[]"></td>  
                                <td><input type="text" class="form-control price" name="price[]"></td>  
                                
                                <td><input type="text" class="form-control amount" name="amount[]"></td>  
                                <td><a href="#" class="remove" class="btn btn-danger">Delete</td>  
</tr>  
</tbody>  
<tfoot>  
<th>Total</th>  
<th></th>  
<th></th>  
<th></th>  
  
<th ><input type="text" class="total form-control" name="txtTotal" value="0" readonly="">    <b></b></th> 

</tfoot>  
  
</table>  
</form>  
</body>  
</html>  


<script type="text/javascript">  
$(function()  
{  
$('#add').click(function()  
{  
addnewrow();  
});  
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();  
});  
$('body').delegate('.quantity,.price','keyup',function()  
{  
var tr=$(this).parent().parent();  
var qty=tr.find('.quantity').val();  
var price=tr.find('.price').val();  
  
//var dis=tr.find('.discount').val();  
var amt =(qty * price)-(qty * price *0)/100;  
tr.find('.amount').val(amt);  
total();  
});  
});  
function total()  
{  
var t=0;  
$('.amount').each(function(i,e)   
{  
var amt =$(this).val()-0;  
t+=amt;  
});  
$('.total').val(t);  
}  
function addnewrow()   
{  
var n=($('.detail tr').length-0)+1;  
var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+  
'<td><input type="text" class="form-control productname" name="productname[]"></td>'+  
'<td><input type="text" class="form-control quantity" name="quantity[]"></td>'+  
'<td><input type="text" class="form-control price" name="price[]"></td>'+  
  
'<td><input type="text" class="form-control amount" name="amount[]"></td>'+  
'<td><a href="#" class="remove">Delete</td>'+  
'</tr>';  
$('.detail').append(tr);   
}  
</script>