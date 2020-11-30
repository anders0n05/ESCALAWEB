//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/operacional/retornaFilialFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#filial").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaAcaoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#acao").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaTipoOcorrenciaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#tipo").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/operacional/retornaDocumentoFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#documento").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

});