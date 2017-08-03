<?php

include_once('../login/session.php');

$account_id = $_POST['account_id'];
$token = $_POST['token'];
$insta_id = $_POST['insta_id'];


$sql = "UPDATE account SET token='$token', insta_id='$insta_id' WHERE id=$account_id";
$query = mysqli_query($conn, $sql);


echo TRUE;

?>