<?php
$token = "4231680639.e8930e1.ad383ec10dce41439a51e5e2f9836643";
$url = "https://api.instagram.com/v1/users/self/requested-by?access_token=" . $token;


$fp = fopen($url, 'r');
    if (!$fp) {
        echo 'problem with url first one';
        exit();
    }

$response = stream_get_contents($fp);
fclose();
$reqCount = count(json_decode($response));
for($i=0; $i<$reqCount; $i++){
	$vars = json_decode($response, true);
	$vardump = var_export($vars["data"][$i]['id'], true);
	$id = str_replace("'", "", $vardump);
	$url = "https://api.instagram.com/v1/users/" . $id . "/relationship?action=approve?access_token=" . $token;
	echo $url;
	exit();
	$fp = fopen($url, 'r');
    if (!$fp) {
        echo 'problem with url insta id';
        exit();
    }
	fclose();

}




?>