<?php
include_once('db_connect.php');

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
if($email == NULL || $email == ""){
	echo 'FAILED';
	exit();
}
if($password == NULL || $password == ""){
	echo 'FAILED';
	exit();
}

$sql = "SELECT * FROM userdata WHERE email='$email'";
$query=mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);
if($rows > 0){
	echo 'FAILED';
	exit();
}

$referal_link = "http://theforge.me/friends4ever/?r=";
$sql = "INSERT INTO userdata(email, password, referal_link) VALUES('$email', '$password', '$referal_link')";
$query = mysqli_query($conn, $sql);

$sql = "SELECT id FROM userdata WHERE email='$email'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
(string)$current_id = $row[0];
$referal_link .= $current_id;

$sql = "UPDATE userdata SET referal_link='$referal_link' WHERE email='$email'";
$query = mysqli_query($conn, $sql);

if(isset($_GET['r'])){

	$refer_id = $_GET['r'];
	$sql = "INSERT INTO referal(email) VALUES('$email')";
	$query = mysqli_query($conn, $sql);

	$sql = "SELECT id FROM referal WHERE email='$email'";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);
	$refered_id = $row[0];
	

	$sql = "INSERT INTO user_referal(user_id, referal_id) VALUES($refer_id, $refered_id)";
	$query = mysqli_query($conn, $sql);



}

exit();

?>