//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/administracao/retornaEmpresaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#empresa").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/administracao/retornaFilialFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#filial").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/administracao/retornaOrigemFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#origem").append("<option value='" + value.HANDLE + ';' + value.DESCRICAO +"'>" + value.DESCRICAO + "</option>");
	});
});

$.getJSON("../../controller/administracao/retornaAlcadaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#alcada").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});


});