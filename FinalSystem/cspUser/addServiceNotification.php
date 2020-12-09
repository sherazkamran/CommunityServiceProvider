<?php
ob_start();
session_start();
include("connection.php");
if ($_POST['view'] == 'hire') {

    $current_user_id = $_SESSION['auth'];
    $current_user_name =
        explode(" ", $_SESSION['name']);



    $getQuery = "SELECT * from hired_service where user_id='$current_user_id' && service_notificationStatus=0 ORDER BY hired_service_id DESC";
    $result = mysqli_query($conn, $getQuery);



    $image_path = 'assets/images/reserve_Notify.png';
    $bool = '';
    if (mysqli_num_rows($result) > 0) {


        $update_query2 = "UPDATE hired_service SET service_notificationStatus=1 WHERE user_id='$current_user_id' && service_notificationStatus=0";
        mysqli_query($conn, $update_query2);
        while ($row = mysqli_fetch_array($result)) {
            $trackingSubTitle = 'Tracking ID: ' . $row['unique_service_id'];
            $service_id = $row['service_id'];
            $fetchQ = "SELECT * from service where service_id=$service_id";
            $runQ = mysqli_query($conn, $fetchQ);
            if ($runQ) {
                $fetchName = mysqli_fetch_array($runQ);
                $PendingTitle = 'Your Request for ' . $fetchName['name'] . ' is Pending';
                $ConfirmedTitle = 'Your Request for ' . $fetchName['name'] . ' is Confirmed';
                $CancelledTitle = 'Your Request for ' . $fetchName['name'] . ' is Cancelled';

                if ($row['status'] == 'Pending') {

                    $Pending = $row['status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$PendingTitle', '$trackingSubTitle', '$image_path', 'service', '$Pending')";
                    mysqli_query($conn, $insertQuery);
                } else if ($row['status'] == 'confirmed') {
                    $Confirmed = $row['status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$ConfirmedTitle', '$trackingSubTitle', '$image_path', 'service', '$Confirmed')";
                    mysqli_query($conn, $insertQuery);
                } else if ($row['status'] == 'cancelled') {
                    $Cancelled = $row['status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$CancelledTitle', '$trackingSubTitle', '$image_path', 'service', '$Cancelled')";
                    mysqli_query($conn, $insertQuery);
                } else {
                    echo 'Null';
                }
            }
        }
    } else {
        echo 'No Data';
    }
}
