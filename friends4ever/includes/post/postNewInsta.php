<?php

include_once('../login/session.php');

//Still cant figure out why reporting is being no bueno
error_reporting(E_ALL);
ini_set("display_errors",1);

$code = $_POST['code'];
//data to request new user token
$data = array(
			'client_id' => 'e8930e161868409797f0b3f4b19665d2', 
			'client_secret' => 'a46acad930d14ff1ae5c901e3ad21731', 
			'grant_type' => 'authorization_code', 
			'redirect_uri' => 
			'http://theforge.me/friends4ever/splash.html', 
			'code' => $code
		);
//curl that shit. gimme tokens
$handle = curl_init("https://api.instagram.com/oauth/access_token");
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($handle);

//trim it up and export values. Kinda comes through in a mess
$finalOutput = rtrim($output, "\0");;
$vars = json_decode($finalOutput, true);

$token = $vars["access_token"];
$user_name = $vars["user"]["username"];
$name = $vars["user"]["full_name"];
$insta_id = $vars["user"]["id"];
$pic_url = $vars["user"]["profile_picture"];
$check = true;

//Start db inserts and such
/*$token = $_POST['token'];
$user_name = $_POST['user_name'];
$insta_id = $_POST['insta_id'];
$name = $_POST['name'];*/
$sql = "SELECT * FROM account WHERE name='$name' AND user_name='$user_name'";
$query = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($query);
if($numrows > 0){
	$check = false;
}

$sql = "SELECT COUNT(*) FROM subscription WHERE user_id=$user_id AND account_id=0";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
$slots = $row[0];

if($slots > 0 && $check){

	$sql = "INSERT INTO account(name, insta_id, token, username, pic_url) VALUES('$name', '$insta_id', '$token', '$user_name', '$pic_url')";
	$query = mysqli_query($conn, $sql);

	$sql = "SELECT id FROM account WHERE name='$name' AND insta_id='$insta_id' AND token='$token' AND username='$user_name'";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);
	$account_id = $row[0];

	$sql = "INSERT INTO user_account(user_id, account_id) VALUES($user_id, $account_id)";
	$query = mysqli_query($conn, $sql);

	$sql = "SELECT id FROM subscription WHERE user_id=$user_id AND account_id=0 LIMIT 1";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);
	$subscription_id=$row[0];

	$sql = "UPDATE subscription SET account_id=$account_id WHERE id=$subscription_id";
	$query = mysqli_query($conn, $sql);

	echo TRUE;
} else {
	echo FALSE;
}

?>