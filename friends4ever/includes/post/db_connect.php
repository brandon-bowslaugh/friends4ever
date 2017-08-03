<?php

$servername = "theforge.me";
$u = "zhakzon";
$p = "b19731973";
$db = "friends4ever";

// Create connection
$conn = new mysqli($servername, $u, $p, $db);

// Check connection
if ($conn->connect_error) {
	echo 'failed to connect';
    die("Connection failed: " . $conn->connect_error);
}


?>