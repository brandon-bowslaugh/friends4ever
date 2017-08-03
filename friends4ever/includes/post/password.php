<?php
/*

	Hi jake,
	This script takes 3-4 variables.
	option(int)		REQUIRED // option 1 for 'i forgot my password', option 2 for 'change password'
	email(string)	REQUIRED
	password(string) OPTIONAL, REQUIRED if option 2 is selected
	new_password(string) OPTIONAL, REQUIRED if option 2 is selected


*/
include_once('db_connect.php');
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$email = mysqli_real_escape_string($conn, $_POST['email']);
$option = mysqli_real_escape_string($conn, $_POST['option']);
$option = (int)$option;

$sql = "SELECT * FROM userdata WHERE email='$email'";
$query=mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);
if($rows>0){
	if($option == 1){ // OPTION 1 IS I FORGOT MY PASSWORD
		$temp_password = generateRandomString();
		$new_password = password_hash($temp_password, PASSWORD_DEFAULT);
		$sql = "UPDATE userdata SET password='$new_password' WHERE email='$email'";
		$query = mysqli_query($conn, $sql);
		$subject = "Friends4Ever Password Reset";
		$message = "Please use this password to login. Change your password upon logging in.     PASSWORD: " . $new_password;
		$header = "From: noreply@friends4ever.com";
		if(mail($email, $subject, $message, $header)){
			echo 'email sent';
			exit();
		} else {
			echo 'FAILED';
			exit(); 
		}
	} else if ($option == 2 && isset($_POST['password']) && isset($_POST['new_password'])) { // OPTION 2 IS I WANT TO CHANGE MY PASSWORD

		$new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		// make sure password meets our criteria if we so choose
		$sql = "UPDATE userdata SET password='$new_password' WHERE email='$email' AND password='$password'";
		$query=mysqli_query($conn, $sql);
		echo 'new password set';
		exit();

	} else {
		// YOU SHOULDNT BE HERE
		echo 'no option selected';
		exit();
	}

} else {
	echo 'FAILED'; // email doesnt exist in db
	exit();
}



exit();

?>