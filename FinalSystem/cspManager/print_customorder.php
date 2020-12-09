<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="print.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
<script type="text/javascript">
  
  window.onload = function() { window.print(); }
  
</script>
 
<div id="invoice" >
<?php 
  include 'connection.php'; 
 $order_id = $_GET['orderid'];
 ?> 
  
     
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://Iconnect.com">
                           <h1>iConnect</h1>
                            </a>
                    </div>
                    <div class="col company-details">
                        
                        <div>Major Tahir Road</div>
                        <div>+923123456789</div>
                        <div>company@example.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">

                      <?php
                $query = "select * from bill INNER JOIN customer on bill.customer_id=customer.id where bill.id='$order_id';";
                  $result=mysqli_query($conn,$query);
                    $row = $result->fetch_array();{?>
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $row['name'] ?></h2>
                        <div class="address"><?php echo $row['address'] ?></div>
                                                <div class="address"><?php echo $row['phone'] ?></div>
                    </div>

                        
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE NO: <?php echo $order_id ?></h1>
                        <div class="invoice-id">Date of Invoice: <?php echo $row['date'] ?></div>
                          <?php }
                 ?>
                     
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th class="text-left">Item Name</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody><?php
                      $q = "select * from tbl_orderdetail


 where bill_id='$order_id';";
      $result = mysqli_query($conn,$q);
      while ($row = $result->fetch_array()){?>
                        <tr>
                            <td class="no"> </td>
                            <td class="text-left"><h3>
                                 <?php echo $row['name'] ?>
                                </h3>
                               
                            </td>
                            <td class="qty"><?php echo $row['quantity'] ?></td>
                            <td class="unit"><?php echo $row['price'] ?></td>
                            
                            <td class="total"><?php echo $row['amount']  ?></td>
                        </tr>
                         <?php }
                 ?>
                       
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2"> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2"> </td>
                            <td> </td>
                        </tr>
                        <tr><?php
                $query = "select * from bill where id='$order_id';";
                  $result=mysqli_query($conn,$query);
                    $row = $result->fetch_array();{?>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                           <td class="qty"><?php echo $row['total'] ?></td>
                        </tr>  <?php }
                 ?>
                     
                    </tfoot>
                </table>
                
                <div class="thanks">Thank you!</div>
                 
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
         
    </div>
</div>
<script type="text/javascript"> $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });</script>