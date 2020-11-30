//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/servicedesk/retornaSituacaoDespesaInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#situacao").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/servicedesk/retornaInLocoDespesaInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#InLoco").append("<option value='" + value.HANDLE + ';' + value.ASSUNTOATENDIMENTO +"'>" + value.ASSUNTOATENDIMENTO + "</option>");
	});
});

$.getJSON("../../controller/servicedesk/retornaTipoDespesaInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#tipo").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/servicedesk/retornaDespesaDespesaInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#despesa").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

});