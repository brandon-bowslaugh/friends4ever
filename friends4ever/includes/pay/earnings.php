<?php

class monz{
	public $jake_profit;
	public $brandon_profit;
}

	$date = date('Y-m-d H:i:s');
	
	$cad = $_POST['current_conversion'];
	$option = $_POST['option']; // option 1 is 24 hours, option 2 is 7 days, option 3 is last month, option 4 is alltime
	if($option == 1){
		$thirty = date('Y-m-d H:i:s', strtotime($date. ' - 1 days'));
	} else if($option == 2){
		$thirty = date('Y-m-d H:i:s', strtotime($date. ' - 7 days'));
	} else if($option == 3){
		$thirty = date('Y-m-d H:i:s', strtotime($date. ' - 30 days'));
	}
	include_once('../db_connect.php');
	if($option == 1 || $option == 2 || $option == 3){
		$sql = "SELECT SUM(amount) AS 'total' FROM profit WHERE date BETWEEN $date AND $thirty";
	} else {
		$sql = "SELECT SUM(amount) AS 'total' FROM profit";
	}
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);

	$profit = $row[0];

	$total = $profit * $cad * 0.85;

	$jake_total = $total * 0.7;
	$brandon_total = $total * 0.3;

	$monz = new monz;
	$monz->jake_profit = $jake_total;
	$monz->brandon_profit = $brandon_total;

	echo json_encode($monz);

?>