<?php include("header.php");

if (isset($_GET['view'])) {
    $car_id = $_GET['view'];

    echo "<script>window.alert('Following are the $car_id details!!!')</script>";
?>


<?php
}
?>

<div class="container my-4 py-4">
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title">Following are the details of Vehicle.</h3>
        </div>
        <div class="card-body">
            <table class="table striped">
                <tr>
                    <th>Vehicle</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Persons</th>
                </tr>

                <tr>
                    <td>Cultus</td>
                    <td>2/2/2020</td>
                    <td>3/2/2020</td>
                    <td>4</td>
                </tr>
            </table>
        </div>

        <p class="text-center">
            Note: To cancle booking please contact us before start date, otherwise bill be added to your utility bill.
            To change pickup location please contact also.
        </p>


    </div>
</div>

<?php include("footer.php"); ?>