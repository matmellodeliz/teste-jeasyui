<?php
	session_start();
  $num_pedido = $_REQUEST['num_pedido'];
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$den_item = $_POST['den_item'];
  $qtd_solicitada = $_POST['qtd_solicitada'];
  $valor = $_POST['valor'];
	$offset = ($page-1)*$rows;
	$result = array();
  
	include 'conn.php';
	
	$rs = mysqli_query($conn, "select count(*) from item_pedido where num_pedido = $num_pedido");
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	$query = "SELECT den_item, qtd_solicitada, valor, ipi, pis_cofins, qtd_solicitada*valor AS valor_total
	FROM item join item_pedido ON item.cod_item = item_pedido.cod_item 
	WHERE num_pedido = $num_pedido ";
	if(isset($den_item) && !empty($den_item) ){
		$query = $query . "AND UPPER(item.den_item) LIKE UPPER('%$den_item%') ";
	}
	if(isset($qtd_solicitada) && !empty($qtd_solicitada) ){
			$query .= $query . "AND item_pedido.qtd_solicitada = '$qtd_solicitada' ";
	}

	if(isset($valor) && !empty($valor) ){
		$query = $query . "AND item.valor = '$valor' ";
}
	$query = $query . " ORDER BY item.cod_item LIMIT $offset,$rows";
	$rs = mysqli_query($conn, $query);
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
?>