<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hire Service - CSP</title>
</head>

<body>
	<div>
		<div>
			<div class="container col-md-12 ">

				<div class="row d-flex flex-column align-content-center align-items-center">

					<div class="pb-4">
						<img src="assets/banners/service_banner2.png" alt="Service Banner" width="100%">
					</div>
					<div class="col-lg-6  mb-4 py-5   rounded border shadow-lg">
						<div class="booking-form">
							<div class="form-header d-flex align-items-center justify-content-center pt-1 mx-3 mb-4" style="background-color: #383A40; color: white; height: 80px;"">
					<h1><b>HIRE A PROFESSIONAL</b></h1>
				</div>
				<form action=" hired.php" method="POST">
								<div class="form-group">
									<div class="col-sm-12">

										<div class="row" style="justify-content: center;">
											<div class="col-sm-12">
												<div class="form-group text-left ">
													<span class="form-label "><b>Profession</b></span>
													<select class="form-control" name="service">


														<?php
														$service_id = 0;
														$queryGV = "SELECT * from service";
														$runGV = mysqli_query($conn, $queryGV);
														while ($row = mysqli_fetch_assoc($runGV)) {
															$carid = $row['car_id']; ?>

															<option value="<?php echo $row['service_id']; ?>"><?php echo $row['name']; ?></option>
														<?php

														}

														?>
													</select>
													<span class="select-arrow"></span>
												</div>
												<div class="form-group text-left ">
													<span class="form-label text-left" style="font-weight: bold;">Address</span>
													<input type="text" name="location" class="form-control" placeholder="Mention address of location(inside Community Premesis) explicitly."></textarea>
												</div>
												<div class="form-group text-left">
													<span class="form-label text-left" style="font-weight: bold;">Description</span>
													<textarea class="form-control" placeholder="Describe the problem breifly." name="description" id="" cols="30" rows="10"></textarea>
												</div>
											</div>

										</div>


										<div class="row d-flex justify-content-center mt-5">
											<input type="submit" name="submitServiceHistory" class="col-5 form-control btn btn-info mr-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#52944D ;" value="Services History">
											<input type="submit" name="submit" class="col-5 form-control btn btn-info ml-3" style="min-width: 150px;max-width:200px; height:50px; border-radius: 5px; background-color:#6FB856 ;" value="Hire Now">
										</div>

										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

</body>

</html>
<?php
include("footer.php"); ?>