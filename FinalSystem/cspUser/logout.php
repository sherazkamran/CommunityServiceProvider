<?php
include("connection.php");

$qEmptyCart = "DELETE from cart";
$run = mysqli_query($conn, $qEmptyCart);
if ($run) {
    session_start();
    session_destroy();
    header('location:login.php');
}
