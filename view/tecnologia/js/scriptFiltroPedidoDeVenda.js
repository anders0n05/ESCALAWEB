//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/comercial/retornaSituacaoPedidoDeVenda.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#situacao").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/comercial/retornaClientePedidoDeVendaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#cliente").append("<option value='" + value.HANDLE + ';' + value.APELIDO +"'>" + value.APELIDO + "</option>");
	});
});

$.getJSON("../../controller/comercial/retornaFilialPedidoDeVendaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#filial").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/comercial/retornaTransportadorPedidoDeVendaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#transportador").append("<option value='" + value.HANDLE + ';' + value.APELIDO +"'>" + value.APELIDO + "</option>");
	});
});

});