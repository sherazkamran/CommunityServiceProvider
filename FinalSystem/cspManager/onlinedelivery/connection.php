<?php
$server = 'localhost';
$username = 'root';
$password='';
$dbName='od';

$conn = mysqli_connect($server,$username,$password,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
else
{
	//echo "Connected";
}
 
?>