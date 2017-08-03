<?php

	/*include_once('../login/session.php');
	if($user_id == NULL){
		echo 'FAILED';
		exit();
	}*/
	error_reporting(E_ALL);
	ini_set("display_errors",1);

	$code = $_POST['code'];
	
	$data = array(
				'client_id' => 'e8930e161868409797f0b3f4b19665d2', 
				'client_secret' => 'a46acad930d14ff1ae5c901e3ad21731', 
				'grant_type' => 'authorization_code', 
				'redirect_uri' => 
				'http://theforge.me/friends4ever/splash.html', 
				'code' => $code
			);

	$handle = curl_init("https://api.instagram.com/oauth/access_token");
	curl_setopt($handle, CURLOPT_POST, true);
	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($handle);


	$finalOutput = rtrim($output, "\0");;
	$vars = json_decode($finalOutput, true);

	$token = $vars["access_token"];
	$username = $vars["user"]["username"];
	$name = $vars["user"]["full_name"];
	$insta_id = $vars["user"]["id"];
	$pic_url = $vars["user"]["profile_picture"];

	echo $pic_url;
	//$username = $vars["user"]["username"]

	//echo $token
	//$token = var_export($vars["access_token"]);
	//$userData = var_export($vars["user"]);

	//echo $userData

?>