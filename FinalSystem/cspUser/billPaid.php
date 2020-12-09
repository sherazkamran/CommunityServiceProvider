<?php include("header.php");

if (isset($_POST['submit'])) {
    $bill_id = $_POST['billIIDD'];
    $dateOfCard = $_POST['dateOfCard'];
    $codeOfCard = $_POST['codeOfCard'];
    $numOfCard = $_POST['numOfCard'];
    $nameOfCard = $_POST['nameOfCard'];




    $query = "SELECT * from bills WHERE bill_id= '$bill_id'";
    $run = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($run)) {
        $existingStatus = $row['status'];
        $dateOfCard = $_POST['dateOfCard'];
        $codeOfCard = $_POST['codeOfCard'];
        $numOfCard = $_POST['numOfCard'];
        $nameOfCard = $_POST['nameOfCard'];
        if (!empty($dateOfCard) && !empty($codeOfCard) && !empty($numOfCard) && !empty($nameOfCard)) {
            $dateOfCard = new DateTime($dateOfCard);
            $date =  date("Y-m-d");
            $date = new DateTime($date);
            if ($row['status'] == "Unpaid" && $row['status'] != "Paid") {
                if ($date < $dateOfCard) {
                    $query2 = "UPDATE bills SET status='Paid' WHERE bill_id='$bill_id'";
                    $run2 = mysqli_query($conn, $query2);
                    if ($run2) {
                        echo "<script>window.alert(' Bill Paid. Thank you for the payment.')</script>";
                        echo '<script> window.location = "paybills.php";</script>';
                    }
                } else {
                    echo "<script>window.alert('Card Expired! Cannot Pay Bill. Contact authorities...')</script>";
                    echo '<script>window.location = "paybills.php";</script>';
                }
            } else {
                echo "<script>window.alert('Already Paid!')</script>";
                echo '<script>window.location = "paybills.php";</script>';
            }
        } else {
            echo "<script>window.alert('Provide complete data.')</script>";
            echo '<script>window.location = "paybills.php";</script>';
        }
    }
}
