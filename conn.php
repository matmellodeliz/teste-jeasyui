<?php
session_start();
$conn =  mysqli_connect("localhost", "root", "", "teste");
if (!$conn) {
	die('Could not connect');
}
mysqli_select_db($conn, 'teste');

?>