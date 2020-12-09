<?php
	require 'connection.php';
	extract($_POST);
	if($function=='login'){
		$sql = "select * from customer where email='$email' and password='$password' and status='active'";
		if($result = mysqli_query($conn, $sql)){
			if(mysqli_num_rows($result)>0)
			{
				$row = mysqli_fetch_assoc($result);
				echo $row['id'];
			}
			else{
				echo "failed";
			}
		}
		else{
			echo "failed";
		}
	}
	else if($function=='addOrder'){
		$done = 0;
			$sql = "insert into bill(customer_id,total) values ('$customer_id', '$total')";
			if(mysqli_query($conn,$sql)){
				$bill_id = mysqli_insert_id($conn);
				$bill_item_id = explode(",", $item_id);
				$bill_quantity = explode(",", $quantity);
				$bill_price = explode(",", $price);
				$purchase_price=explode(",",$purchase_price);
				for($i=0; $i<sizeOf($bill_item_id); $i++){
					$sql = "insert into bill_item(item_id, quantity, price, purchase_price,bill_id) values ('$bill_item_id[$i]', '$bill_quantity[$i]', '$bill_price[$i]', '$purchase_price[$i]','$bill_id')";
					if(mysqli_query($conn,$sql)){
						$done=1;
					}
				}
				if($done==1){
					echo "added";
				}
				else{
					$sql = "delete from bill where id='$bill_id'";
					mysqli_query($conn, $sql);
					echo mysqli_error($conn);
				}
			}
			else{
				echo mysqli_error($conn);
			}
	}
	else if($function=='addCategory'){
			$sql = "select * from category where name='$name'";
			$res = mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				echo 'failed';
			}
			else{
				$sql = "insert into category(name) values ('$name')";
				if(mysqli_query($conn,$sql))
				{
					echo "added";
				}
				else{
					echo "failed";
				}
			}
	}
	else if($function=='newUser'){
		$sql = "insert into customer (name, phone, email, password, address) values ('$name', '$phone', '$email', '$password', '$address')";
		if(mysqli_query($conn, $sql)){
			echo "added";
		}
		else{
			echo mysqli_error($conn);
		}
	}
	else if($function == "getCategory"){
		$sql = "select * from category where status='Active';";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result)){
				array_push($data, $row);
			}
			$json = json_encode($data);
			echo $json;
		}
		else{
			echo "false";
		}
	}
	else if($function == "getWallet"){
		$sql = "select * from wallet where customer_id='$customer_id'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result)){
				array_push($data, $row);
			}
			$json = json_encode($data);
			echo $json;
		}
		else{
			echo "false";
		}
	}
	else if($function == "getOrdersAmount"){
		$sql = "select * from bill where customer_id='$customer_id' and status='delivered'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result)){
				array_push($data, $row);
			}
			$json = json_encode($data);
			echo $json;
		}
		else{
			echo "false";
		}
	}
		else if($function == "getOrders"){
		$sql = "select * from bill where customer_id='$customer_id'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result)){
				array_push($data, $row);
			}
			$json = json_encode($data);
			echo $json;
		}
		else{
			echo "false";
		}
	}
	else if($function == "getBillDetail"){
		$sql = "select item.name, item.detail, item.image, bill_item.quantity, bill_item.price from bill_item INNER JOIN item on bill_item.item_id=item.id where bill_item.bill_id='$bill_id';";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result)){
				array_push($data, $row);
			}
			$json = json_encode($data);
			echo $json;
		}
		else{
			echo "false";
		}
	}
	else if($function == "getItems"){
		$sql = "select * from item where cat_id='$cat_id'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result)){
				array_push($data, $row);
			}
			$json = json_encode($data);
			echo $json;
		}
		else{
			echo "false";
		}
	}
	else if($function=="updateUser"){
		$sql = "update customer set status='$status' where id='$id'";
		if(mysqli_query($conn, $sql)){
			echo "added";
		}
		else{
			echo mysqli_error($conn);
		}
	}

	else if($function=="changePassword"){
		$sql = "update customer set password='$password' where id='$id'";
		if(mysqli_query($conn, $sql)){
			echo "added";
		}
		else{
			echo mysqli_error($conn);
		}
	}
		else if($function=="ForgetPassword"){
		$sql = "select * from customer where email='$email'";
		if($result = mysqli_query($conn, $sql)){
			if(mysqli_num_rows($result)>0)
			{
			    $row = mysqli_fetch_assoc($result);
			    $email=$row['email'];
			    $msg="Your password is ".$row['password']."";
			    $headers = 'From: noreply@iconnect.com' . "\r\n" .
    'Reply-To: noreply@iconnect.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
				$mailsent =	mail($email,"iCONNECT Password Recovery",$msg,$headers);
		          
            if($mailsent)
            {
            echo "sent";
            } else {
            echo mysqli_error($conn);
            }   
			}
			else{
				echo mysqli_error($conn);;
			}
		}
		else{
			echo mysqli_error($conn);;
		}
	}
	else if($function=="addItem")
	{
		$data = $image;
		$data = base64_decode($image);
		file_put_contents('C:/xampp/htdocs/onlinedelivery/items/'.$image_path, $data);
		$path = '/items/'.$image_path;
		$sql = "insert into item (name, price, detail,quantity, image, cat_id) values ('$name', '$price', '$detail','$quantity', '$path','$cat_id')";
		if(mysqli_query($conn, $sql)){
			echo "added";
		}
		else{
			echo mysqli_error();
		}
	}
		else if($function=="addMedOrder")
	{
		$data = $image;
		$data = base64_decode($image);
		file_put_contents('images/'.$image_path, $data);
		$path = '/images/'.$image_path;
		$sql = "insert into bill (customer_id,image) values ('$customer_id','$path')";
		if(mysqli_query($conn, $sql)){
			echo "added";
		}
		else{
			echo mysqli_error();
		}
	}
?>