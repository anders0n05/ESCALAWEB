//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/servicedesk/retornaSituacaoInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#situacao").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/servicedesk/retornaTecnicoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#tecnico").append("<option value='" + value.HANDLE + ';' + value.LOGIN +"'>" + value.LOGIN + "</option>");
	});
});

$.getJSON("../../controller/servicedesk/retornaClienteInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#cliente").append("<option value='" + value.HANDLE + ';' + value.APELIDO +"'>" + value.APELIDO + "</option>");
	});
});

$.getJSON("../../controller/servicedesk/retornaFilialInLocoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#filial").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

});