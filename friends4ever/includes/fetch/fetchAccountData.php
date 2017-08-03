<?php

class user{
	public $paid;
	public $username;
	public $name;
	public $insta_id;
	public $paid_until;
	public $requests;
}

class empty_user{
	public $slot;
}

$user_array=[];
$button;
include_once('../login/session.php');
if($user_id == NULL){
	echo 'FAILED';
	exit();
}
$date = date('Y-m-d');
$sql = "SELECT `account`.`id`,
				`account`.`username`, 
				`account`.`name`,
				`account`.`pic_url`,
				`subscription`.`paid_until` 

		FROM `account`, 
			 `userdata`, 
			 `user_account`, 
			 `subscription`

		WHERE `userdata`.`id`=$user_id
		AND   `user_account`.`user_id`=`userdata`.`id`
		AND   `user_account`.`account_id`=`account`.`id`
		AND   `subscription`.`account_id`=`account`.`id`
		AND   `subscription`.`user_id` = `userdata`.`id`";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
$i = 0;
if($num > 0){
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		//$thisUrl = "https://api.instagram.com/v1/users/self/requested-by?access_token=" . $row['token'];
		
		
		/*$fp = fopen($thisUrl, 'r');
		if (!$fp) {
    		$reqCount = -1;
  		} else {

  			$response = stream_get_contents($fp);
			$reqCount = count(json_decode($response));

		}
		fclose();*/
		$account_id=$row['id'];
		$pic_url=$row['pic_url'];
		$username=$row['username'];
		$name=$row['name'];
		
		
		$paid_until=$row['paid_until'];
		$user = new user;
 		if($date > $paid_until && $i != 1) {
			include('../pay/payagain.php');
			$button=pay_again($account_id);
			$i=1;

		}
		if($date < $paid_until){
			$paid='true';	
			$user->paid = $paid;
		} else {
			$user->paid = $button;
		}
		

		
		
		$user->username = $username;
		$user->name = $name;
		$user->pic_url = $pic_url;
		$user->paid_until = $paid_until;

		array_push($user_array, $user);      

	}
}
$sql = "SELECT COUNT(*) FROM subscription WHERE user_id=$user_id AND account_id=0";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
$slots = $row[0];
if($slots > 0){
	$slots = 1;
} else {
	include('../pay/buttoncreate.php');
	$slots = button_create($user_id);

}

$empty_user = new empty_user;
$empty_user->slot = $slots;

array_push($user_array, $empty_user);

echo json_encode($user_array);
exit();
?>