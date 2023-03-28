<?php
session_start();
if(!isset($_SESSION['id_nivel_permissao'])){
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Pedidos</title>
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	
</head>
<body>
	
	<h2>Pedidos</h2>
	<p>Gerencie seus pedidos.</p>
	
	<table id="dg" title="Pedidos" class="easyui-datagrid" style="width:700px;height:350px"
			url="get_pedidos.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="num_pedido" width="50">num_pedido</th>
            <th field="cod_cliente" width="50">cod_cliente</th>
            <th field="cond_pag" width="50">cond_pag</th>
            <th field="observacao" width="50">observacao</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newPedido()">Novo pedido</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editPedido()">Editar pedido</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyPedido()">Remover pedido</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarItensDoPedido()">Editar itens do pedido</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
		<form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
			<h3>Info dos pedidos</h3>
			<div style="margin-bottom:10px">
				<input id='cc' name='cod_cliente' class='easyui-combobox' label="cod_cliente: " style='width:200px;' 
				data-options="valueField: 'cod_cliente',
        textField: 'nom_cliente',
        url: 'get_clientes.php',
        mode: 'local'">
			</div>
			<div style="margin-bottom:10px">
				<input name="cond_pag" class="easyui-textbox" required="true" label="cond_pag:" style="width:100%">
			</div>
			<div style="margin-bottom:10px">
				<input name="observacao" class="easyui-textbox" required="true" label="observacao:" style="width:100%">
			</div>
			<div style="margin-bottom:10px"></div>
			</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="savePedido()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<a href="login.php">Voltar pra tela de login</a>
	<script type="text/javascript">
		var url;
		function newPedido(){
			$('#dlg').dialog('open').dialog('center').dialog('setTitle','Novo Pedido');
			$('#fm').form('clear');
			url = 'save_pedido.php';
		}
		function editPedido(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Pedido');
				$('#fm').form('load',row);
				url = 'update_pedido.php?num_pedido='+row.num_pedido;
			}
			
		}
		function savePedido(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
		function destroyPedido(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Deseja mesmo retirar o pedido?',function(r){
					if (r){
						$.post('destroy_pedido.php',{num_pedido:row.num_pedido},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
		function editarItensDoPedido(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#fm').form('load',row);
				url = 'itens_pedido.php?num_pedido='+row.num_pedido;
				window.location = url;
			}
		}
	</script>
</body>
</html>