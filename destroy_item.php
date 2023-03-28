<?php
session_start();
$permissao = $_SESSION['id_nivel_permissao'];

$num_pedido = htmlspecialchars($_REQUEST['num_pedido']);
$num_seq_item = htmlspecialchars($_REQUEST['num_seq_item']);
include 'conn.php';
if($permissao <= 2){
	$sql = "delete from item_pedido where num_pedido='$num_pedido' and num_seq_item = $num_seq_item";
	$result = mysqli_query($conn, $sql);
	if ($result){
		echo json_encode(array('success'=>true));
	} else {
		echo json_encode(array('errorMsg'=>'Some errors occured.'));
	}
}
else {
	echo json_encode(array('errorMsg'=>'Sem permissão.'));
}
?>