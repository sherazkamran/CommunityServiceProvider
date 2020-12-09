<?php
ob_start();
session_start();
include('connection.php');
$output1 = '';
$output2 = '';

$tempQuery = "SELECT * from product_category where prodcat_id='1'";
$tempRun = mysqli_query($conn, $tempQuery);
$cat_stat;
while ($tempRow = $tempRun->fetch_array()) {
    $cat_stat = $tempRow['status'];
}
if ($cat_stat == 'Active') {


    $query = "SELECT * from product where prodcat_id='1'";
    $run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($run)) {
        $path = "../cspManager/" . $row['image'];
        $output1 .= '<div class="card  text-center  ml-3 my-3 " style="max-height: 260px;min-height:260px; max-width:185px;min-width:185px ;display: flex; justify-content: center; align-items:center;">
                        <img class="card-img-top zoom" src="' . $path . '" alt="Card image" style=" max-height: 150px;min-height:150px; max-width:175px;min-width:175px">
                        <div class="card-body">
                            <h6 class="card-title">' . $row['name'] . '</h6>
<a href="singleproductpage.php?view=' . $row['product_id'] . '" style="background-color: #52944D; color: white; width: 100px;" class="btn btn-primary btn-sm">View</a>
</div>
</div>';
    };
    $output2 = '<h5><i class="fa fa-carrot mr-2 ml-1"> </i>FRUITS & VEGETABLES</h5>';
} else {
    $output2 = '<h5>No Item Available</h5>';
}

$data = array(
    'item' => $output1,
    'categoryTitle' => $output2
);
echo json_encode($data);
