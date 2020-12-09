<?php include("header.php");
?>

<!-- carousal satart -->

<style>
  .image:hover {
    opacity: 0.8;
  }
</style>

<!-- The slideshow -->

<div class="">
  <div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators" style="color: black;">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
      <li data-target="#demo" data-slide-to="3"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./assets/banners/home_banner.png" alt="Home Banner" width="100%">
      </div>
      <div class="carousel-item">
        <img src="./assets/banners/shop_banner.png" alt="Home Banner" width="100%">
      </div>
      <div class="carousel-item">
        <img src="./assets/banners/car_banner.png" alt="Home Banner" width="100%">
      </div>
      <div class="carousel-item">
        <img src="./assets/banners/service_banner.png" alt="Home Banner" width="100%">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>

</div>




<!-- services section using bootstrap4 card -->
<div id="">
  <div class="container my-5">

  </div>



  <!-- Our Brand clothe brand Section -->
  <div class="container my-5">




    <div class="shadow-lg" style="background-color: #ffffff;">
      <h3 class="title text-center py-4" style="background-color: #383A40; color: #ffffff"><i class="fa fa-concierge-bell mr-2" style="color: orange;"></i> OUR SERVICES</h3>
      <div class="card-columns ">
        <div class="card text-center">
          <a href="G.php"><img class="card-img-top image" src="../cspManager/images/grocery.jpg" alt="Card image" style="width:100%;height:200px;"></a>
          <div class="card-body">
            <h4 class="card-title">GENERAL STORES</h4>
            <p class="card-text">All the products displayed in the application are obtained from the Stores existing in the Community.</p>
          </div>
        </div>

        <div class="card text-center">
          <a href="VF.php"><img class="card-img-top image" src="../cspManager/images/fruits.jpg" alt="Card image" style="width:100%;height:200px;"></a>
          <div class="card-body">
            <h4 class="card-title">FRUIT MARKET</h4>
            <p class="card-text">All the products displayed in the application are obtained from the Stores existing in the Community.</p>
          </div>
        </div>


        <div class="card text-center">
          <a href="FF.php"> <img class="card-img-top image" src="../cspManager/images/fast_food.jpg" alt="Card image" style="width:100%;height:200px;"></a>
          <div class="card-body">
            <h4 class="card-title">FAST FOOD ZONE</h4>
            <p class="card-text">All the products displayed in the application are obtained from the Stores existing in the Community.</p>
          </div>
        </div>

      </div>


      <!-- Food Brand -->

      <div class="card-columns">
        <div class="card text-center">
          <img class="card-img-top" src="../cspManager/images/vegetables.jpg" alt="Card image" style="width:100%;height:200px;">
          <div class="card-body">
            <h4 class="card-title">VEGETABLE MARKET</h4>
            <p class="card-text">All the products displayed in the application are obtained from the Stores existing in the Community.</p>
          </div>
        </div>

        <div class="card text-center">
          <img class="card-img-top" src="../cspManager/images/garments.jpg" alt="Card image" style="width:100%;height:200px;">
          <div class="card-body">
            <h4 class="card-title">GARMENT STORES</h4>
            <p class="card-text">All the products displayed in the application are obtained from the markets existing in the Community.</p>
          </div>
        </div>


        <div class="card text-center">
          <img class="card-img-top" src="../cspManager/images/meat.jpg" alt="Card image" style="width:100%;height:200px;">
          <div class="card-body">
            <h4 class="card-title">MEAT MARKET</h4>
            <p class="card-text">All the products displayed in the application are obtained from the markets existing in the Community.</p>
          </div>
        </div>

      </div>
    </div>
    <center>
      <h4 style="margin-top: 25px;">And Much More...</h4>
    </center>



  </div>

  <div class="container my-5">

  </div>

  <?php include("footer.php"); ?>