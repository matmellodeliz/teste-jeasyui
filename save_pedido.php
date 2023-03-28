<?php
session_start();
$cod_cliente = htmlspecialchars($_REQUEST['cod_cliente']);
$cond_pag = htmlspecialchars($_REQUEST['cond_pag']);
$observacao = htmlspecialchars($_REQUEST['observacao']);
include 'conn.php';
	$num_pedido = "select (IFNULL(MAX(num_pedido), 0)+1) prox_num_pedido FROM pedido pedido1";
	$prox_num_pedido = mysqli_query($conn, $num_pedido);
	$row_prox_num_pedido = mysqli_fetch_object($prox_num_pedido);
	$sql = "insert into pedido(num_pedido, cod_cliente, cond_pag, observacao) VALUES ('".$row_prox_num_pedido->prox_num_pedido."', '$cod_cliente', '$cond_pag', '$observacao')";
	$result = mysqli_query($conn, $sql);
	if ($result){
		echo json_encode(array(
			'num_pedido' => $row_prox_num_pedido->prox_num_pedido,
			'cod_cliente' => $cod_cliente,
			'cond_pag' => $cond_pag,
			'observacao' => $observacao
		));
	} else {
		echo json_encode(array('errorMsg'=>'Some errors occured.'));
	}
?>