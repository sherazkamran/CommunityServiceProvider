<?php
require 'cspUserAndroidConnection.php';
extract($_POST);
if ($function == 'login') {
	// and status='active'
	$eee = $email;
	$ppp = $password;
	$sql = "select * from user where email='$eee' and password='$ppp' ";
	if ($result = mysqli_query($conn, $sql)) {
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			echo $row['user_id'];
		} else {
			echo "failed";
		}
	} else {
		echo "failed";
	}
} else if ($function == 'newUser') {
	$temp = "";
	$sql = "insert into user (name, email, password, cnic, phase, streetNo, houseNo,fulladdress, contactNo, status) values ('$name', '$email', '$password', '$cnic', '$phase', '$streetNo', '$houseNo','$temp' ,'$contactNo', '$status')";
	if (mysqli_query($conn, $sql)) {
		echo "added";
	} else {
		echo mysqli_error($conn);
	}
} else if ($function == "getGroceryProducts") {
	$sql = "select * from product where prodcat_id='5'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Cannot Complete Task!";
	}
} else if ($function == "getHAProducts") {
	$sql = "select * from product where prodcat_id='8'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Cannot Complete Task!";
	}
} else if ($function == "getSGProducts") {
	$sql = "select * from product where prodcat_id='6'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Cannot Complete Task!";
	}
} else if ($function == "getFVProducts") {
	$sql = "select * from product where prodcat_id='1'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Cannot Complete Task!";
	}
} else if ($function == "getFFProducts") {
	$sql = "select * from product where prodcat_id='7'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Cannot Complete Task!";
	}
} else if ($function == "checkRandom") {

	echo '<script>window.alert("Loooooooook " ' . $randomToCheck . ' "removed from Cart.")  </script>';
	$sql = "select * from place_order where order_id='$randomToCheck'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo "exists";
	} else {
		echo "not";
	}
} else if ($function == "addOrder") {

	$sql = "select * from place_order where order_id='$ord_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$ord_id = rand(10, 100000);
	}
	$orderID = $ord_id;
	// echo '<script>window.alert("Loooooooook " '. $ord_id .' "removed from Cart.")  </script>';


	$sql = "insert into place_order (user_id, product_name, product_price, product_qty, product_sum, order_id, order_status,date_time,address ) values ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_sum_price', '$orderID', '$order_status','$ord_date_time','$ord_del_add')";
	if (mysqli_query($conn, $sql)) {
		echo "added";
	} else {
		echo mysqli_error($conn);
	}
} else if ($function == "placeServiceRequest") {
	$user_ID = (int) $str_u_id;
	$unique_s_ID = (int) $str_unique_id;
	// $req_date =  strtotime('y-m-d',$str_h_date);
	// $req_time = strtotime('h:i:s',$str_h_time);
	$service_ID;

	$sql = "select * from hired_service where unique_service_id='$unique_s_ID'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$unique_s_ID = rand(10, 100000);
	}

	$sql2 = "select * from service where name='$str_srv_type'";
	$result2 = mysqli_query($conn, $sql2);
	if (mysqli_num_rows($result2) > 0) {
		while ($row2 = mysqli_fetch_assoc($result2)) {
			$service_ID = $row2['service_id'];
		}
	}

	//$sun =  "-----------------------	" . $service_ID . "----------".$str_h_date."---------" . $unique_s_ID . "	---------".$str_h_time."-------   ";

	$sql3 = "insert into hired_service (status, user_id, service_id, request_time, request_date, location, description,unique_service_id )values ('$str_status', '$user_ID', '$service_ID', '$str_h_time', '$str_h_date', '$str_address', '$str_desc','$unique_s_ID')";
	if (mysqli_query($conn, $sql3)) {
		echo "added";
	} else {
		echo mysqli_error($conn);
	}
} else if ($function == "getOrderId") {
	$sql = "select * from place_order where user_id='$id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "failed";
	}
} else if ($function == "getOrderItems") {

	$ext_order_ID = $order_and_time;
	$explodeDate = explode(' ', $ext_order_ID);
	$orderId = (int) $explodeDate[0];



	$sql = "select * from place_order where order_id='$orderId'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "failed";
	}
} else if ($function == "getServices") {
	$sql = "select * from service";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$json = json_encode($data);
		echo $json;
	} else {
		echo "failed";
	}
} else if ($function == "getHiredServicesList") {

	$to_Name = "";
	$to_unq_serv_ID = "";

	$sql = "select * from hired_service where user_id ='$id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {

			$serv_id = $row['service_id'];

			$sql2 = "select * from service where service_id = '$serv_id'";
			$result2 = mysqli_query($conn, $sql2);
			if (mysqli_num_rows($result2) > 0) {
				while ($row2 = mysqli_fetch_assoc($result2)) {
					$to_Name = $row2['name'];
				}
			}
			$to_unq_serv_ID = $row['unique_service_id'];
			$ser_name_date_time = ["n_m_e" => "$to_Name", "unq_s_id" => "$to_unq_serv_ID",];
			array_push($data, $ser_name_date_time);
		}
		$json = json_encode($data);
		echo $json;
	} else {

		echo "fail";
	}
} else if ($function == "getServiceDetails") {
	$to_Date = "";
	$to_Time = "";
	$to_location = "";
	$to_desc = "";
	$to_status = "";
	$to_unq_serv_ID = "";

	$extract_Serv_ID = $service_id_name;
	$explodeServID = explode(' ', $extract_Serv_ID);
	$unique_serv_ID = (int) $explodeServID[0];

	$sql = "select * from hired_service where unique_service_id ='$unique_serv_ID'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {

			$to_Date =  $row['request_date'];
			$to_Time = $row['request_time'];
			$to_location = $row['location'];
			$to_desc = $row['description'];
			$to_status = $row['status'];
			$to_unq_serv_ID = $row['unique_service_id'];

			// $to_unq_serv_ID = $row['unique_service_id'];
			// $ser_name_date_time = ["n_m_e" => "$to_Name", "unq_s_id" => "$to_unq_serv_ID",];
			// $ser_name_date_time = $to_Name, $to_Date  + $to_Time + $to_location + $to_desc + $to_status + $to_unq_serv_ID;

			$ser_name_date_time = ["to_Date" => "$to_Date", "to_Time" => "$to_Time", "to_location" => "$to_location", "to_desc" => "$to_desc", "to_status" => "$to_status", "to_unq_serv_ID" => "$to_unq_serv_ID",];
			array_push($data, $ser_name_date_time);
		}
		$json = json_encode($data);
		echo $json;
	} else {

		echo "fail";
	}
} else if ($function == "placeComplaintRequest") {

	//str_type	, str_subject	,  	str_desc 	, str_status, 	str_u_id,	str_unq_id,	str_c_time 	,str_c_date

	//$sun =  "-----------------------	" . $service_ID . "----------".$str_h_date."---------" . $unique_s_ID . "	---------".$str_h_time."-------   ";

	$sql3 = "insert into complain (type, subject, detail ,status, user_id, trcode, comp_time , comp_date)values ('$str_type', '$str_subject', '$str_desc', '$str_status', '$str_u_id', '$str_unq_id', '$str_c_time','$str_c_date')";
	if (mysqli_query($conn, $sql3)) {
		echo "added";
	} else {
		echo mysqli_error($conn);
	}
} else if ($function == "getBillDetails") {
	$image = "";
	$month = "";
	$status = "";

	$sql = "SELECT * from bills WHERE bill_id = '$billID'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$image = $row['image'];
			$month = $row['month'];
			$status = $row['status'];


			$ser_name_date_time = ["image" => "$image", "month" => "$month", "status" => "$status", "bid" => "$billID",];
			array_push($data, $ser_name_date_time);
		}
		$json = json_encode($data);
		$sun =  "----- " . $billID . " ----- " . $userID . " ----- " . $image . " ---- " . $month . " --- " . "	---- " . $status . " ---";

		echo $json . $sun;
	} else {
		echo "failed";
	}
}
