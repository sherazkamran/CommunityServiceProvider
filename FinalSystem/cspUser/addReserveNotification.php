<?php
ob_start();
session_start();
include("connection.php");
if ($_POST['view'] == 'reserve') {

    $current_user_id = $_SESSION['auth'];
    $current_user_name =
        explode(" ", $_SESSION['name']);
    $image_path = 'assets/images/reserve_Notify.png';
    $PendingTitle = 'Your Booking Request is in Pending';
    $ConfirmedTitle = 'Your Booking Request is Confirmed';
    $CompletedTitle = 'Thank You for Travelling with us!';
    $CancelledTitle = 'Your Booking Request is Cancelled!';



    $getQuery = "SELECT * from reservation where user_id='$current_user_id' && reserve_notificationStatus=0 ORDER BY reserve_id DESC";
    $result = mysqli_query($conn, $getQuery);



    $bool = '';
    if (mysqli_num_rows($result) > 0) {
        $update_query2 = "UPDATE reservation SET reserve_notificationStatus=1 WHERE user_id='$current_user_id' && reserve_notificationStatus=0";
        mysqli_query($conn, $update_query2);
        while ($row = mysqli_fetch_array($result)) {
            $trackingSubTitle = 'Tracking ID: ' . $row['res_code'];


            if ($row['status'] == 'Pending') {

                $Pending = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$PendingTitle', '$trackingSubTitle', '$image_path', 'reserve', '$Pending')";
                mysqli_query($conn, $insertQuery);
            } else if ($row['status'] == 'Confirmed') {
                $Confirmed = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$ConfirmedTitle', '$trackingSubTitle', '$image_path', 'reserve', '$Confirmed')";
                mysqli_query($conn, $insertQuery);
            } else if ($row['status'] == 'Completed') {
                $Completed = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$CompletedTitle', '$trackingSubTitle', '$image_path', 'reserve', '$Completed')";
                mysqli_query($conn, $insertQuery);
            } else
             if ($row['status'] == 'Cancelled') {
                $Cancelled = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$CancelledTitle', '$trackingSubTitle', '$image_path', 'reserve', '$Cancelled')";
                mysqli_query($conn, $insertQuery);
            } else {
                echo 'Null';
            }
        }
    } else {
        echo 'No Data';
    }
}
