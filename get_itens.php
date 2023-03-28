<?php
include 'conn.php';
session_start();
$rs = mysqli_query($conn, "select * from item");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);

?>