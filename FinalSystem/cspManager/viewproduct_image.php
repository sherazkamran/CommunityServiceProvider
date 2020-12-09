<?php
include('connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $q = "SELECT * from product where product_id='$product_id'";
    $run = mysqli_query($conn, $q);
    if ($run) {
        $row = mysqli_fetch_array($run);
        $filename = $row['image'];
        if ($filename != null) {
            $fullname = explode(".", $filename);
            $extension = $fullname[1];
            $handle = fopen($filename, "rb");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            header("content-type: image/$extension");
            echo $contents;
        } else {

            echo "<script>alert('No Image Found!')</script>";
            echo "<script>window.location.replace('./viewproductlist.php');</script>";
        }
    } else {
        echo "<script>alert('query failed!')</script>";
        echo "<script>window.location.replace('./viewproductlist.php');</script>";
    }
}
