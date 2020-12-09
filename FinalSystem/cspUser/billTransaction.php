<?php include("header.php");

if (isset($_GET['view'])) {
    $bill_id = $_GET['view'];

?>

    <div class="transactionBill">

        <div class="transactionForm ">
            <center>
                <div class="transactionDiv text-left my-5 col-md-6 rounded border shadow-lg">
                    <form action="billPaid.php" method="POST">
                        <div class="form-group">
                            <div class="col-sm-12 ">

                                <div class="form-group mt-3">
                                    <span class="form-label">Name</span>
                                    <input class="form-control" name="nameOfCard" type="text" placeholder="Enter Name on Card here">
                                </div>
                                <div class="form-group">
                                    <span class="form-label">Credit Card Number</span>
                                    <input class="form-control" name="numOfCard" type="integer" placeholder="Enter credit card number here">
                                </div>

                                <div class="just row ml-3">
                                    <div class="form-group ml-5 m-3">
                                        <span class="form-label">CV code</span>
                                        <input class="form-control" type="integer" name="codeOfCard" placeholder="Enter Security Code here">
                                    </div>

                                    <div class="form-group ml-5 pl-4 m-3">

                                        <span class="form-label">Expiry Date </span>
                                        <input class="form-control" name="dateOfCard" type="date" placeholder="Enter Expiry Date here">

                                    </div>
                                    <div class="form-group ml-5 pl-4 m-3" hidden>


                                        <input class="form-control" name="billIIDD" value="<?php echo $bill_id ?>" hidden>

                                    </div>
                                </div>
                                <div class="form-btn" style="display: flex; justify-content: center;">
                                    <input type="submit" name="submit" class="form-control btn btn-info" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" value="Pay Now">
                                </div>

                    </form>
                </div>
            </center>
        </div>
    </div>



<?php
}

?>