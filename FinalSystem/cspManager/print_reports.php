<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="print.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script type="text/javascript">
  
  window.onload = function() { window.print(); }
  
</script>
<!--Author      : @arboshiki-->
<div id="invoice" >
<?php 
  include 'connection.php'; 
 $dateTo = $_GET['dateTo'];
 $dateFrom = $_GET['dateFrom'];

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

                     
                        
                         
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">Sale Report : </h1>
                        <div class="invoice-id">From <?php echo $dateFrom ?> To <?php echo $dateTo ; ?></div>
                         
                
                     
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>

                        <tr>
                             
                            <th class="text-left">Item Name</th>
                             <th class="text-center">Bill Id</th>
                            <th class="text-center">Date</th>
                             
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Purchase Price</th>
                             <th class="text-center">Total</th>
                        </tr>
                    </thead>
                  <?php
              $q = "SELECT bill.date,bill.status,bill_item.item_id,bill_item.bill_id, bill_item.purchase_price,bill_item.quantity,bill_item.price, item.name
FROM ((bill
INNER JOIN bill_item ON bill.id = bill_item.bill_id)
INNER JOIN item ON item.id=bill_item.item_id)
 where (bill.date>'$dateFrom' or bill.date='$dateFrom') and (bill.date<'$dateTo' or bill.date='$dateTo');";
                  $result=mysqli_query($conn,$q);
                 while ($row = $result->fetch_array()){?>
  <tbody> 




                        

                        <tr>
                            
                            <td class="text-left"> <span style="text-transform: capitalize;">
                                 <?php echo $row['name'] ?>
                                </span>
                               
                            </td>
                            <td class="text-center qty"><?php echo $row['bill_id'] ?></td>
                                 <td class="text-center qty"><?php echo $row['date'] ?></td>
                            <td class="text-center unit"><?php echo $row['quantity'] ?></td>
                            <td class="text-center unit"><?php echo $row['price'] ?></td>
                             <td class="text-center unit"><?php echo $row['purchase_price'] ?></td>
                            <td class="total text-center"><?php echo $row['price']*$row['quantity'] ?></td>
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
                        <tr>  
                    </tfoot>
                </table>
                
                
                 
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