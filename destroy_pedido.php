<?php
session_start();
$num_pedido = htmlspecialchars($_REQUEST['num_pedido']);

include 'conn.php';

$delete_pedido = "delete from pedido where num_pedido= $num_pedido";
$delete_itens_pedido = "delete from item_pedido where num_pedido= $num_pedido" ;
$result_pedido = mysqli_query($conn, $delete_pedido);
$result_itens = mysqli_query($conn, $delete_itens_pedido);
if ($result_pedido && $result_itens){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>