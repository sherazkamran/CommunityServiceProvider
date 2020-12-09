<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="print.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script type="text/javascript">
    window.onload = function() {
        window.print();
    }
</script>

<div id="invoice">
    <?php
    include 'connection.php';
    $order_id = $_GET['order_id'];
    ?>


    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12  company-details">
                        <center>
                            <div style="font-weight: bolder;font-size:xx-large;  color: #3989C6;">CSPM</div>
                            <div style="color: #3989C6;">Community Service Provider and Manager,</div>
                            <div style="color: #3989C6;">Comsian Residential Colony,</div>
                            <div style="color: #3989C6;"> Attock City.</div>
                            <div style="color: #3989C6;">+923345736729</div>
                            <div style="color: #3989C6;">codepub@gmail.com</div>
                        </center>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <?php
                    $o_i_d;
                    $u_n_m;
                    ?>
                    <div class="col invoice-to">

                        <?php
                        $query = "SELECT * from ordered_items where order_id='$order_id'";
                        $result = mysqli_query($conn, $query);
                        $row = $result->fetch_array(); {
                            $userid = $row['user_id'];
                            $o_i_d = $order_id;
                        ?>
                            <div class="col invoice-to">
                                <div class="text-gray-light">INVOICE TO:</div>

                                <?php
                                $user_fetch = "SELECT name from user where user_id='$userid'";
                                $userrun =  mysqli_query($conn, $user_fetch);
                                $usershow = mysqli_fetch_array($userrun);
                                if (mysqli_num_rows($userrun) > 0) {
                                    $u_n_m = $usershow['name'];
                                ?>
                                    <h2 class="to"><?php echo $usershow['name'] ?></h2>
                                <?php } ?>
                            </div>


                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">ORDER NO: <?php echo $row['order_id'] ?></h1>
                        <div class="invoice-id">Date of Order Placement: <?php echo $row['date_time'] ?></div>
                    <?php }
                    ?>

                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>

                        <tr>
                            <th class="text-center">SR #</th>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody><?php
                            $i = 1;
                            $total = 0;

                            $q = "SELECT * from ordered_items where order_id='$order_id';";
                            $result = mysqli_query($conn, $q);
                            while ($row = $result->fetch_array()) { ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="text-center"><?php echo $row['product_name'] ?></td>
                                <td class="text-center"><?php echo $row['product_qty'] ?></td>
                                <td class="text-center"><?php echo $row['product_price'] ?></td>
                                <td class="text-center"><?php echo $row['product_sum'] ?></td>
                            </tr>

                        <?php $total = $total + $row['product_sum'];
                            }
                        ?>
                    </tbody>


                </table>
                <center>
                    <div>
                        <span style="font-size: x-large;font-weight: bolder;font-style: italic; color: #3989C6; margin-right: 25px;">GRAND TOTAL</span>
                        <span></span>
                        <span style="font-size: large;font-weight: bold;font-style: italic; color: #3989C6;"><?php echo $total ?></span>
                    </div>
                </center>



            </main>
            <footer>
                Invoice is generated on a computer and is valid without the signature and seal & Thank you for shopping form here.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>

    </div>
</div>
<script type="text/javascript">
    $('#printInvoice').click(function() {
        Popup($('.invoice')[0].outerHTML);

        function Popup(data) {
            window.print();
            return true;
        }
    });
</script>