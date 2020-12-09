<?php include("header.php"); ?>



<center>
    <!-- carousal satart -->


    <div class="pb-4">
        <img src="./assets/banners/bill_banner2.png" alt="Pay Bills Banner" width=100% />
    </div>

</center>
<!-- carousal end -->

<!-- cold for slider & products end -->




<div class="container col-md-12">
    <div class="">
        <div class="col-md-6 offset-md-3 mb-4 py-5  rounded border shadow-lg">
            <div class="booking-form">
                <div class="form-header d-flex align-items-center justify-content-center mx-3 pt-1 mb-4" style="background-color: #383A40; color: white; height: 80px;">
                    <h1><b>PAY YOUR BILLS</b></h1>
                </div>
                <div class=" form-group">
                    <div class="col-sm-12">

                        <form action="billDetails.php" method="POST">
                            <div class="form-group">
                                <span class="form-label ml-2" style="font-weight: bold;"> Bill ID</span>
                                <input class="form-control" name="billId" type="number" min="0" placeholder="Enter Bill ID">
                            </div>
                            <div class="form-btn d-flex justify-content-center mt-5">
                                <input type="submit" name="submit" class="form-control btn btn-info" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" value="Fetch Details">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>