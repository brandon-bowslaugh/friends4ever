<?php
include_once('db_connect.php');
$email = $_POST['email'];
$sql = "SELECT * FROM userdata WHERE email='$email'";
$query = mysqli_query($conn, $query);
$rows = mysqli_num_rows($query);
if($rows==0){
	echo true;
	exit();
} else {
	echo false;
	exit();
}

?>