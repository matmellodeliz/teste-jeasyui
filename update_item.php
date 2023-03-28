<?php
include 'conn.php';
include 'get_itens.php';
session_start();
$num_pedido = htmlspecialchars($_REQUEST['num_pedido']);
$num_seq_item = htmlspecialchars($_REQUEST['num_seq_item']);
$den_item = htmlspecialchars($_REQUEST['den_item']);
$qtd_solicitada = htmlspecialchars($_REQUEST['qtd_solicitada']);

$sql = "update item_pedido as ip set ip.cod_item = (
	SELECT i.cod_item FROM item AS i 
	WHERE i.den_item = '$den_item'
), qtd_solicitada = $qtd_solicitada where num_seq_item= $num_seq_item and num_pedido = $num_pedido";
$result = mysqli_query($conn, $sql);
if ($result){
	echo json_encode(array(
    'num_pedido' => $num_pedido,
    'num_seq_item' => $num_seq_item,
		'cod_item' => $cod_item,
		'qtd_solicitada' => $qtd_solicitada,
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>