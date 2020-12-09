<?php
ob_start();
session_start();
include("connection.php");
if ($_POST['view'] == 'complain') {

    $current_user_id = $_SESSION['auth'];
    $current_user_name =
        explode(" ", $_SESSION['name']);
    $image_path = 'assets/images/reserve_Notify.png';
    $PendingTitle = 'Your Complaint is in Pending';
    $processTitle = 'Your Complaint is in Process';
    $addressedTitle = 'Your Complaint is Addressed';
    $dischargeTitle = 'Your Complaint is Discharged';



    $getQuery = "SELECT * from complain where user_id='$current_user_id' && complain_notificationStatus=0 ORDER BY complain_id DESC";
    $result = mysqli_query($conn, $getQuery);



    $bool = '';
    if (mysqli_num_rows($result) > 0) {
        $update_query2 = "UPDATE complain SET complain_notificationStatus=1 WHERE user_id='$current_user_id' && complain_notificationStatus=0";
        mysqli_query($conn, $update_query2);
        while ($row = mysqli_fetch_array($result)) {
            $trackingSubTitle = 'Tracking ID: ' . $row['trcode'];


            if ($row['status'] == 'pending') {

                $PendingComplain = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$PendingTitle', '$trackingSubTitle', '$image_path', 'complain', '$PendingComplain')";
                mysqli_query($conn, $insertQuery);
            } else if ($row['status'] == 'In-Processing') {
                $ProcessedComplain = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$ProcessTitle', '$trackingSubTitle', '$image_path', 'complain', '$processedComplain')";
                mysqli_query($conn, $insertQuery);
            } else if ($row['tatus'] == 'Addressed') {
                $AddressedComplain = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$addressedTitle', '$trackingSubTitle', '$image_path', 'complain', '$AddressedComplain')";
                mysqli_query($conn, $insertQuery);
            } else if ($row['status'] == 'Discharged') {
                $DischargeComplain = $row['status'];
                $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$dischargeTitle', '$trackingSubTitle', '$image_path', 'complain', '$DischargeComplain')";
                mysqli_query($conn, $insertQuery);
            } else {
                echo 'Null';
            }
        }
    } else {
        echo 'No Data';
    }
}
