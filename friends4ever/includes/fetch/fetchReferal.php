<?php

class referal_info{
	public $referal_link;
	public $payout;
	public $allow_payout;
}

include_once('../login/session.php');
if($user_id == NULL){
	echo 'FAILED';
	exit();
}
$sql = "SELECT SUM(`referal`.`profit`) AS 'payout' 
		FROM `referal`, `user_referal`, `userdata` 
		WHERE `userdata`.`id`=$user_id 
		AND `user_referal`.`user_id`=`userdata`.`id` 
		AND `user_referal`.`referal_id`=`referal`.`id`";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);

$payout = $row[0];
$allow_payout = false;

if($payout > 49.99){
	$allow_payout = true;
}

$sql = "SELECT referal_link FROM userdata WHERE id=$user_id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
$referal_link = $row[0];

$referal_info = new referal_info;
$referal_info->referal_link = $referal_link;
$referal_info->payout = $payout;
$referal_info->allow_payout = $allow_payout;

echo json_encode($referal_info);
exit();
?>