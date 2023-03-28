<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itens do pedido</title>
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.edatagrid.js"></script>
</head>
<body>
<a href="index.php">voltar</a>
<table id="tt" class="easyui-datagrid" style="width:600px;height:250px"
        url="" toolbar="#tb"
        title="Load Data" iconCls="icon-save"
        rownumbers="true" pagination="true">
    <thead>
        <tr>
            <th field="den_item" width="130">den_item</th>
            <th field="qtd_solicitada" data-options="formatter:function(value, row){ return new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 0 }).format(value);}" width="80">qtd_solicitada</th>
            <th field="valor" data-options="formatter:function(value, row){ return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL'}).format(value);}" width="80" align="right">valor</th>
            <th field="ipi" data-options="formatter:function(value, row){ return new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 0 }).format(value);}" width="80" align="right">ipi</th>
            <th field="pis_cofins" data-options="formatter:function(value, row){ return new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 0 }).format(value);}" width="80">pis_cofins</th>
            <th field="valor_total" data-options="formatter:function(value, row){ return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL'}).format(value);}" width="100" align="center">valor_total</th>
        </tr>
    </thead>
</table>

<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Novo item</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editPedido()">Editar pedido</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyPedido()">Remover pedido</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarItensDoPedido()">Editar itens do pedido</a>
	</div>
  <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
		<form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
			<h3>Info do item</h3>
			<div style="margin-bottom:10px">
				<input id='cc' name='cod_item' class='easyui-combobox' label="cod_item: " style='width:200px;' 
				data-options="valueField: 'cod_item',
        textField: 'den_item',
        url: 'get_itens.php',
        mode: 'local'">
			</div>
			<div style="margin-bottom:10px">
				<input name="qtn_solicitada" class="easyui-textbox" required="true" label="qtn_solicitada:" style="width:100%">
			</div>
			<div style="margin-bottom:10px">
			</form>
	</div>
<div id="tb" style="padding:3px">
    <span>den_item:</span>
    <input id="den_item" style="line-height:26px;border:1px solid #ccc">
    <span>qtd_solicitada:</span>
    <input id="qtd_solicitada" style="line-height:26px;border:1px solid #ccc"><br>
    <span>valor:</span>
    <input id="valor" style="line-height:26px;border:1px solid #ccc">
    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
</div>
<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveItem()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
</body>
<script>
  var url;
	var getSearch = 'get_itens_pedido.php' + window.location.search;
	document.getElementById('tt').setAttribute('url', getSearch);
  function doSearch(){
    $('#tt').datagrid('load',{
      den_item: $('#den_item').val(),
      qtd_solicitada: $('#qtd_solicitada').val(),
      valor: $('#valor').val()
    });
}
function newItem(){
			$('#dlg').dialog('open').dialog('center').dialog('setTitle','Novo Item');
			$('#fm').form('clear');
			url = 'save_item_pedido.php';
		}
    function saveItem(){
			$('#fm').form('submit',{
				url: url + window.location.search,
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
</script>
</html>