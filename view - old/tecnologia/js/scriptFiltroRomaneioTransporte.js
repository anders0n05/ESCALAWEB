//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/operacional/retornaFilialFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#filial").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaDestinatarioFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#destinatario").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaRomaneioFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#romaneio").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaViagemFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#viagem").append("<option value='" + value.HANDLE + ';' + value.NUMERO +"'>" + value.NUMERO + "</option>");
	});
});

});