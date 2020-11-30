//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/operacional/retornaSituacaoViagemFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#situacao").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaViagemFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#viagem").append("<option value='" + value.HANDLE + ';' + value.NUMERO +"'>" + value.NUMERO + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaTipoViagemFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#tipo").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaDespesaViagemFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#despesa").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

});