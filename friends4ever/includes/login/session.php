<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include_once('db_connect.php');

session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$sql = "select email, id from userdata WHERE email='$user_check' LIMIT 1"; // where email='$user_check'
$query=mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($query);
//$rows = mysqli_fetch_assoc($query);
$login = $row['email'];
$user_id = $row['id'];
if($login != $user_check || $user_id == NULL){
	
	echo 'FAILED';
	exit();

}
?>