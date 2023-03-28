<?php
include 'conn.php';
include 'get_pedidos.php';
session_start();
$num_pedido = htmlspecialchars($_REQUEST['num_pedido']);
$cod_cliente = htmlspecialchars($_REQUEST['cod_cliente']);
$cond_pag = htmlspecialchars($_REQUEST['cond_pag']);
$observacao = htmlspecialchars($_REQUEST['observacao']);



$sql = "update pedido set cod_cliente='$cod_cliente',cond_pag='$cond_pag',observacao='$observacao' where num_pedido=$num_pedido";
$result = mysqli_query($conn, $sql);
if ($result){
	echo json_encode(array(
		'num_pedido' => $num_pedido,
		'cod_cliente' => $cod_cliente,
		'cond_pag' => $cond_pag,
		'observacao' => $observacao
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>