 <?php
  //session_start();

  ?>
 <!-- Left side column. contains the logo and sidebar -->

 <aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->

     <div class="user-panel">
       <div class="pull-left image">

         <img src="images/avatar.jpg" class="img-circle" alt="User Image">


       </div>

       <div class="pull-left info">
         <p>Booking Manager</p>

         <a href="logout.php"><span>Log Out</span></a>
         <!-- Status -->
       </div>
     </div>

     <!-- search form (Optional) -->
     <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
     <ul class="sidebar-menu" data-widget="tree">

       <li>
         <a href="addnewcar.php"> <i class="glyphicon glyphicon-plus"></i> <span>Add New Car</span>
         </a>
       </li>

       <li>
         <a href="viewcarlist.php"> <i class="glyphicon glyphicon-eye-open"></i> <span>View Car List</span>

         </a>
       </li>
       <li>
         <a href="viewreservation.php"> <i class="glyphicon glyphicon-eye-open"></i> <span>View Reservation Requests</span>
         </a>
       </li>




     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>