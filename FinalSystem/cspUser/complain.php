<?php include("header.php"); ?>


<div class="transactionBill">
    <div class="pb-4">
        <img src="assets/banners/complain_banner2.png" alt="Service Banner" width="100%">
    </div>

    <div class="transactionForm ">
        <center>
            <div class="transactionDiv text-left mb-4 py-5  col-lg-6 rounded border shadow-lg">
                <div class="booking-form">
                    <div class="form-header d-flex align-items-center justify-content-center pt-1 mx-3 mb-4" style="background-color: #383A40; color: white; height: 80px;">
                        <h1><b>COMPLAINT FORM</b></h1>
                    </div>
                    <form action=" complainSubmission.php" method="POST">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <span class="form-label"><b>Select Complain Category</b></span>
                                            <select class="form-control" name="complain">
                                                <option>Unethical Behaviour of Servicemen</option>
                                                <option>Damage to Public/Community Property</option>
                                                <option>Un-satisfactory/Low Quality Service</option>
                                                <option>Noise</option>
                                                <option>Theft</option>
                                                <option>Forced Entry</option>
                                                <option>Disturbance</option>
                                                <option>Street Racing</option>
                                                <option>Suspicious Activity</option>
                                                <option>Other</option>
                                            </select>
                                            <span class="select-arrow"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="form-label"><b>Subject of Complaint</b></span>
                                    <input class="form-control" type="text" placeholder="Enter Subject/Label of certain complaint" name="subject">
                                </div>
                                <div class="form-group">
                                    <span class="form-label"><b>Detailed Description</b></span>
                                    <textarea class="form-control txtAreaComplaint" rows="15" placeholder="Describe your complaint here." name="desc"></textarea>
                                </div>
                                <input type="number" value="<?php echo rand(10, 100000); ?>" name="cid" hidden>
                                <div class="row d-flex justify-content-center mt-5">

                                    <input type="submit" name="submit" value="Submit Complaint" class="col-5 form-control btn btn-info mr-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#52944D ;">



                                    <a href="checkComplain.php" class="col-5 d-flex align-items-center justify-content-center form-control btn btn-info ml-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;">Check Status </a>

                                </div>


                    </form>
                </div>

            </div>
        </center>
    </div>
</div>

<?php
include("footer.php"); ?>