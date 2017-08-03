<?php
include_once("../db_connect.php");
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is empty";
	}
	else
	{
		// Define $username and $password
		$email=mysqli_real_escape_string($conn, $_POST['username']);
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter

		// To protect MySQL injection for Security purpose
		//$email = stripslashes($email);
		//$password = stripslashes($password);
		//$email = $email;
		//$password = mysqli_real_escape_string($password);
		// Selecting Database
		$sql = "select * from userdata where password='$password' AND email='$email'";
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($query);

		if ($rows > 0) {
			$_SESSION['login_user']=$email; // Initializing Session
			
		
		} else {
			$error = "FAILED";
			echo $error;
			exit();
		}
	
	}

?>