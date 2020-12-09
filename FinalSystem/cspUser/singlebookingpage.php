<?php include  "header.php"; ?>

<div class="container col-md-12">

	<div class="row">
		<div class="pb-4">
			<img src="assets/banners/car_banner2.png" alt="Car Banner" width="100%">
		</div>
	</div>



	<div class="container col-md-12">
		<div class="row d-flex justify-content-center">
			<div class="col-lg-6 mb-4 py-5  rounded border shadow-lg">
				<div class="booking-form">
					<div class="form-header d-flex align-items-center justify-content-center mx-3 pt-1 mb-4" style="background-color: #383A40; color: white; height: 80px;">
						<h1><b>BOOK A CAR</b></h1>
					</div>
					<form action="reserveDetail.php" method="POST">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="row ">
									<div class="col-sm-12">
										<div class="form-group">
											<span class="form-label"><b>Vehicles</b></span>
											<select class="form-control" name="carid">

												<option value="" disabled selected><b>Select Vehicle</b></option>
												<?php

												$query2 = "DELETE from temp_res ";
												$run2 = mysqli_query($conn, $query2);

												$queryGV = "SELECT * from car where availability = 'Yes'";
												$car_id = 0;
												$runGV = mysqli_query($conn, $queryGV);
												while ($row = mysqli_fetch_assoc($runGV)) {
													$car_id = $row['car_id'];
												?>
													<option value="<?php echo $car_id ?>"><?php echo $row['model'] . "   (" . $row['carNo'] . ")" ?></option>
												<?php
												}
												?>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<span class="form-label"><b>Start Date</b></span>
									<input class="form-control" name="startDate" type="date" data-date-end-date="0d" placeholder="Enter Reservation's Start Date">
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<span class="form-label"><b>Start Time(In 24:00 Hrs)</b></span>
											<select class="form-control" name="startTime">
												<option>01:00</option>
												<option>02:00</option>
												<option>03:00</option>
												<option>04:00</option>
												<option>05:00</option>
												<option>06:00</option>
												<option>07:00</option>
												<option>08:00</option>
												<option>09:00</option>
												<option>10:00</option>
												<option>11:00</option>
												<option>12:00</option>
												<option>13:00</option>
												<option>14:00</option>
												<option>15:00</option>
												<option>16:00</option>
												<option>17:00</option>
												<option>18:00</option>
												<option>19:00</option>
												<option>20:00</option>
												<option>21:00</option>
												<option>22:00</option>
												<option>23:00</option>
												<option>24:00</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<span class="form-label"><b>End Date</b></span>
									<input class="form-control" name="endDate" type="date" placeholder="Enter Reservation's End Date">
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<span class="form-label"><b>End Time(in 24 Hrs)</b></span>
											<select class="form-control" name="endTime">
												<option>01:00</option>
												<option>02:00</option>
												<option>03:00</option>
												<option>04:00</option>
												<option>05:00</option>
												<option>06:00</option>
												<option>07:00</option>
												<option>08:00</option>
												<option>09:00</option>
												<option>10:00</option>
												<option>11:00</option>
												<option>12:00</option>
												<option>13:00</option>
												<option>14:00</option>
												<option>15:00</option>
												<option>16:00</option>
												<option>17:00</option>
												<option>18:00</option>
												<option>19:00</option>
												<option>20:00</option>
												<option>21:00</option>
												<option>22:00</option>
												<option>23:00</option>
												<option>24:00</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<span class="form-label"><b>Pickup Location</b></span>
									<input class="form-control" name="location" type="text" placeholder="Enter Pickup Location">
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<span class="form-label"><b>With Driver?</b></span>
											<select class="form-control" name="driver">
												<option>Yes</option>
												<option>No</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>


								<div class="row d-flex justify-content-center mt-5">
									<input type="submit" class="col-5 col-xl-3 mr-1 mx-xl-4 form-control btn btn-info  " name="submitDet" value="Vehicle Details" style="background-color: #52944D; width: 150px; height:50px; border-radius: 5px;">
									<input type="submit" class="col-5 col-xl-3 mxl-1 mx-xl-4 form-control btn btn-info " name="confirmRes" value="Process Request" style="background-color: #6FB856; width: 150px; height:50px ; border-radius: 5px;">
									<a href="reservationHistory.php" class="col-10 col-xl-3 mt-1 mt-xl-0 mx-xl-4 d-flex align-items-center justify-content-center form-control btn btn-info " style="background-color: #52944D; width: 150px; height:50px; border-radius: 5px;">View History</a>
								</div>


							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
include("footer.php"); ?>