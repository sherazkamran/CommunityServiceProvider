<?php include("header.php");
include 'connection.php';


?>
<link rel="stylesheet" href="css/animate.css">
<style>
    .active {
        background-color: #A6CB5B !important;
        border: none;
    }
</style>


<div class="container-fluid ">
    <div class="row d-flex justify-content-center">
        <div class="">
            <img src="./assets/banners/shop_banner2.png" alt="Home Banner" width="100%">
        </div>

        <!-- Products/ items div start -->
        <div class="col-12 col-xl-2 mt-3">
            <div class="list-group border shadow-lg ">
                <a class="list-group-item list-group-item-action disabled" style="background-color: #383A40; color:white;"><i class="fa fa-bars"></i> CATEGORIES</a>
                <a href="#" id="viewG" class="list-group-item list-group-item-action  small"><i class="fa fa-shopping-basket"></i> GROCERIES</a>
                <a href="#" id="viewVF" class="list-group-item list-group-item-action small"><i class="fa fa-carrot"></i> FRUITS & VEGETABLES</a>
                <a href="#" id="viewSG" class="list-group-item list-group-item-action small"><i class="fa fa-tshirt"></i> SHOES & GARMENTS</a>
                <a href="#" id="viewHA" class="list-group-item list-group-item-action small"><i class="fa fa-blender-phone"></i> HOME APPLIANCES</a>
                <a href="#" id="viewFF" class="list-group-item list-group-item-action small"><i class="fa fa-pizza-slice"></i> FAST FOOD</a>
            </div>

        </div>
        <div class="col-12 col-xl-8 my-3 border shadow-lg">


            <!-- <div class="pl-2 pt-2 border d-flex flex-row align-items-center  justify-content-start justify-content-xl-center" id="categoryTitle" style="color: white; background-color: #383A40; height: 42px; ">

            </div> -->
            <!-- products row start -->
            <div class=" ml-4">
                <div class=" my-3 text-center">
                    <div class="row text-center" id="itemContainer">

                    </div>


                </div>

                <!-- End of theDiv2 -->


                <!-- #product end -->
            </div>
        </div>
        <!-- row end -->
    </div>

</div>
<!-- container flud end -->
<?php include("footer.php"); ?>
<script>
    $(document).ready(function() {
        $('#viewG').addClass("active");

        $.ajax({
            type: "GET",
            url: "getG.php",
            dataType: "json",
            success: function(response) {
                if (response.categoryTitle == '<h5>No Item Available</h5>') {
                    $('#categoryTitle').html(response.categoryTitle);
                } else {
                    $('#categoryTitle').html(response.categoryTitle);

                    $("#itemContainer").html(response.item);
                }
            }
        });
        $('#viewG').on("click", function(event) {
            event.preventDefault();
            $('#viewSG').removeClass("active");
            $('#viewFF').removeClass("active");
            $('#viewVF').removeClass("active");
            $('#viewHA').removeClass("active");
            $('#viewG').addClass("active");
            $.ajax({
                type: "GET",
                url: "getG.php",
                dataType: "json",
                success: function(response) {

                    $('#categoryTitle').html(response.categoryTitle);

                    $("#itemContainer").html(response.item);

                }
            })
        });

        $('#viewVF').on("click", function(event) {
            event.preventDefault();
            $('#viewSG').removeClass("active");
            $('#viewFF').removeClass("active");
            $('#viewG').removeClass("active");
            $('#viewHA').removeClass("active");
            $('#viewVF').addClass("active");
            $.ajax({
                type: "GET",
                url: "getVF.php",
                dataType: "json",
                success: function(response) {

                    $('#categoryTitle').html(response.categoryTitle);

                    $("#itemContainer").html(response.item);

                }
            })
        });
        $('#viewFF').on("click", function(event) {
            event.preventDefault();
            $('#viewSG').removeClass("active");
            $('#viewVF').removeClass("active");
            $('#viewG').removeClass("active");
            $('#viewHA').removeClass("active");
            $('#viewFF').addClass("active");
            $.ajax({
                type: "GET",
                url: "getFF.php",
                dataType: "json",
                success: function(response) {

                    $('#categoryTitle').html(response.categoryTitle);

                    $("#itemContainer").html(response.item);

                }
            })
        });
        $('#viewHA').on("click", function(event) {
            event.preventDefault();
            $('#viewSG').removeClass("active");
            $('#viewVF').removeClass("active");
            $('#viewG').removeClass("active");
            $('#viewFF').removeClass("active");
            $('#viewHA').addClass("active");
            $.ajax({
                type: "GET",
                url: "getHA.php",
                dataType: "json",
                success: function(response) {

                    $('#categoryTitle').html(response.categoryTitle);

                    $("#itemContainer").html(response.item);

                }
            })
        });
        $('#viewSG').on("click", function(event) {
            event.preventDefault();
            $('#viewFF').removeClass("active");
            $('#viewVF').removeClass("active");
            $('#viewG').removeClass("active");
            $('#viewHA').removeClass("active");
            $('#viewSG').addClass("active");
            $.ajax({
                type: "GET",
                url: "getSG.php",
                dataType: "json",
                success: function(response) {

                    $('#categoryTitle').html(response.categoryTitle);

                    $("#itemContainer").html(response.item);

                }
            })
        })
    });
</script>