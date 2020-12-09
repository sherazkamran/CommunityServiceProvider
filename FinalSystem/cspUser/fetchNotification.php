<?php
ob_start();
session_start();
include 'connection.php';
$current_user_id = $_SESSION['auth'];
$current_user_name =
    explode(" ", $_SESSION['name']);
function _generateOutput($notification_image, $notification_title, $notification_subtitle, $current_user_name)
{
    return '<div class="dropdown-item row d-flex justify-content-start align-items-center" id="dropdown-item">
                <div class="col-md-2 mr-1">

                  <img class="" src="' . $notification_image . '" style="border-radius: 100%;" alt="icon" width="45" height="45">
                </div>
                <div class="col-md-6" style="max-width: 50px;">

                  <span class="font-weight-bold " style="font-size: 0.81em;">
                    ' . $notification_title . '
                  </span>
                  </br>
                  <span class="font-weight-lighter" style="font-size: 0.7em;">
                    ' . $notification_subtitle . '
                  </span>
                </div>
              </div>
              <div class="dropdown-divider border"></div>';
}

if (isset($_POST['view'])) {

    if ($_POST['view'] != '') {
        $update_query = "UPDATE notifications SET notification_status=1 WHERE notification_status=0";
        mysqli_query($conn, $update_query);
    }


    $output = '';
    $fetchQuery = "SELECT * from notifications ORDER BY notification_id DESC";
    $result3 = mysqli_query($conn, $fetchQuery);
    if (mysqli_num_rows($result3) > 0) {
        while ($row3 = mysqli_fetch_array($result3)) {
            $output .= _generateOutput($row3['notification_image'], $row3['notification_title'], $row3['notification_subtitle'], $current_user_name[0]);
        }
    } else {

        $output = '<h5 class="dropdown-header" style="color: red">No Notification</h5>';
    }
    $countQuery = "SELECT * from notifications where notification_status=0";
    $result4 = mysqli_query($conn, $countQuery);
    $count = mysqli_num_rows($result4);


    $data = array(
        'notification' => $output,
        'unseen_notification' => $count,
    );
    echo json_encode($data);
} else {
}
