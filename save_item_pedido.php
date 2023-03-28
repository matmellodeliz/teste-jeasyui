<?php
session_start();
$num_pedido = htmlspecialchars($_REQUEST['num_pedido']);
$cod_item = htmlspecialchars($_REQUEST['den_item']);
$qtd_solicitada = htmlspecialchars($_REQUEST['qtd_solicitada']);
include 'conn.php';
	$sql = "insert into item_pedido(num_pedido, num_seq_item, cod_item, qtd_solicitada) VALUES ($num_pedido, (SELECT IFNULL(MAX(num_seq_item), 0)+1 FROM item_pedido i JOIN pedido ip ON i.num_pedido = $num_pedido), '$cod_item', '$qtd_solicitada')";
	$result = mysqli_query($conn, $sql);
	if ($result){
		echo json_encode(array(
			'num_pedido' => $num_pedido,
			'cod_item' => $cod_item,
			'qtd_solicitada' => $qtd_solicitada
		));
	} else {
		echo json_encode(array('errorMsg'=>'Some errors occured.'));
	}
?>