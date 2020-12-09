 <?php

    ob_start();
    session_start();
    include("connection.php");
    if ($_POST['view'] == 'order') {

        $current_user_id = $_SESSION['auth'];
        $current_user_name =
            explode(" ", $_SESSION['name']);
        $image_path = 'assets/images/reserve_Notify.png';
        $PendingTitle = 'Dear, ' . $current_user_name[0] . 'Your Order is in Pending';
        $processTitle = 'Dear, ' . $current_user_name[0] . 'Your Order is in Process';
        $onDeliveryTitle = 'Dear, ' . $current_user_name[0] . 'Your Order is On the Way';
        $cancelledTitle = 'Dear, ' . $current_user_name[0] . 'Your Order is Cancelled';
        $deliveredTitle = 'Dear, ' . $current_user_name[0] . 'Your Order is Delivered';



        $getQuery = "SELECT * from placed_orders where user_id='$current_user_id' && notificationStatus=0 ORDER BY unique_id DESC";
        $result = mysqli_query($conn, $getQuery);



        $bool = '';
        if (mysqli_num_rows($result) > 0) {
            $update_query2 = "UPDATE placed_orders SET notificationStatus=1 WHERE user_id='$current_user_id' && notificationStatus=0";
            mysqli_query($conn, $update_query2);
            while ($row = mysqli_fetch_array($result)) {
                $beforeDelSubTitle = 'Tracking ID: ' . $row['order_id'];
                $afterDelSubTitle = 'Thank you, Tracking ID: ' . $row['order_id'];

                if ($row['order_status'] == 'Pending') {

                    $PendingOrder = $row['order_status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$PendingTitle', '$beforeDelSubTitle', '$image_path', 'order', '$PendingOrder')";
                    mysqli_query($conn, $insertQuery);
                } else if ($row['order_status'] == 'Processed') {
                    $processOrder = $row['order_status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$processTitle', '$beforeDelSubTitle', '$image_path', 'order', '$processOrder')";
                    mysqli_query($conn, $insertQuery);
                } else if ($row['order_status'] == 'onDelivery') {
                    $onDeliveryOrder = $row['order_status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$onDeliveryTitle', '$beforeDelSubTitle', '$image_path', 'order', '$onDeliveryOrder')";
                    mysqli_query($conn, $insertQuery);
                } else if ($row['order_status'] == 'Delivered') {
                    $deliveredOrder = $row['order_status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$deliveredTitle', '$afterDelSubTitle', '$image_path', 'order', '$deliveredOrder')";
                    mysqli_query($conn, $insertQuery);
                } else if ($row['order_status'] == 'Cancelled') {
                    $cancelledOrder = $row['order_status'];
                    $insertQuery = "INSERT into notifications (notification_title, notification_subtitle, notification_image, notification_type, notification_subType) values ('$cancelledTitle', '$beforeDelSubTitle', '$image_path', 'order', '$cancelledOrder')";
                    mysqli_query($conn, $insertQuery);
                } else {
                    echo 'Null Value';
                }
            }
        } else {
            echo 'No Data';
        }
    }
    ?>