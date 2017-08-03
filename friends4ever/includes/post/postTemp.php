<?php
include_once('../login/session.php');
if($user_id == NULL){
	echo 'FAILED';
	exit();
}
$user = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$sql = "SELECT * FROM user_account WHERE user_id = $user_id AND account_id=0";
$query = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($query);
if($num_rows == 0){
	echo 'TEMP';
	exit();
}
if($user == '' || $user == NULL || $password == '' || $password == NULL){
	echo 'TEMP';
	exit();
}
$sql = "INSERT INTO temp_link(user_id, username, password) VALUES($user_id, '$user', '$password')";
if($query = mysqli_query($conn, $sql)){
	echo 'success';
} else {
	echo 'TEMP';
	exit();
}


?>