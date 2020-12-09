<?php
include('connection.php');

if (isset($_GET['view'])) {
    $bill_id = $_GET['view'];
    $q = "SELECT * from bills where bill_id='$bill_id'";
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

            echo "<script>alert('No Bill Found!')</script>";
            echo "<script>window.location.replace('./viewbill_list.php');</script>";
        }
    } else {
        echo "<script>alert('query failed!')</script>";
        echo "<script>window.location.replace('./viewbill_list.php');</script>";
    }
}
