<?php

class user{
	public $paid;
	public $username;
	public $name;
	public $insta_id;
	public $token;
	public $paid_until;
}

class empty_user{
	public $slot;
}

$user_array=[];

/*
//-------------------------------------------- COPY HERE ------------------------------------------------------------------
$paid=true;
$username='jacobapplications';
$name='ivoryTower';
$insta_id='4231680639';
$token='4231680639.e8930e1.ad383ec10dce41439a51e5e2f9836643';
$paid_until='2017-01-20';

$user = new user;

$user->paid = $paid;
$user->username = $username;
$user->name = $name;
$user->insta_id = $insta_id;
$user->token = $token;
$user->paid_until = $paid_until;

array_push($user_array, $user);

$paid=true;
$username='datboi';
$name='youknow';
$insta_id='4231680639';
$token='4231680639.e8930e1.ad383ec10dce41439a51e5e2f9836643';
$paid_until='2017-01-20';

$user = new user;

$user->paid = $paid;
$user->username = $username;
$user->name = $name;
$user->insta_id = $insta_id;
$user->token = $token;
$user->paid_until = $paid_until;

array_push($user_array, $user);
// --------------------------------------------- STOP COPY HERE ------------------------------------------------------------

$empty_user = new empty_user;

$empty_user->slot = 2;

array_push($user_array, $empty_user);



// dont copy after here, paste after here





// dont remove this
echo json_encode($user_array);
exit();
*/
// ---------------------------------------------------------------------------------------------------------------------------------------------------- REAL FUNCTIONALITY BELOW
//include_once('../login/session.php');

$rng = $_POST['rng'];
$sql = "SELECT user_id FROM login WHERE token='$rng'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
$user_id = $row[0];

$sql = "SELECT * FROM login WHERE token='$rng'";
$query = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);

if($rows == 0){
	echo 'FALSE';
	exit();
} else {
	include_once('theforge.me/friends4ever/includes/login/token_delete.php');
}

$date = new date('Y-m-d');
$sql = "SELECT `account`.`username`, 
				`account`.`name`, 
				`account`.`insta_id`, 
				`account`.`token`, 
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
if($num > 0){
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		$username=$row['username'];
		$name=$row['name'];
		$insta_id=$row['insta_id'];
		$token=$row['token'];
		$paid_until=$row['paid_until'];

		if($date > $paid_until){
			$paid=true;	
		} else {
			$paid=false;
		}
		

		$user = new user;

		$user->paid = $paid;
		$user->username = $username;
		$user->name = $name;
		$user->insta_id = $insta_id;
		$user->token = $token;
		$user->paid_until = $paid_until;

		array_push($user_array, $user);      
	}
}

$sql = "SELECT COUNT(*) FROM subscription WHERE user_id=$user_id AND account_id=0";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
$slots = $row[0];

$empty_user = new empty_user;
$empty_user->slot = $slots;

array_push($user_array, $empty_user);
echo 'its empty';
exit();
echo json_encode($user_array);
exit();
?>