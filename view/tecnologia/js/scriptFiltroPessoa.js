//***Consulta ajax valores filtros modals
$(document).ready(function() {
$.getJSON("../../controller/cadastro/retornaTipoPessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#tipo").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/cadastro/retornaPaisPessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#pais").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

$.getJSON("../../controller/cadastro/retornaEstadoPessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#estado").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});
$.getJSON("../../controller/cadastro/retornaMunicipioPessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#municipio").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});
$.getJSON("../../controller/cadastro/retornaSetorAtividadePessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#setorAtividade").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});
$.getJSON("../../controller/cadastro/retornaRamoAtividadePessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#ramoAtividade").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});
$.getJSON("../../controller/cadastro/retornaCategoriaAtividadePessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#categoriaAtividade").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});
$.getJSON("../../controller/cadastro/retornaGrupoEmpresarialPessoaFiltro.php", function(return_data){
	$.each(return_data.data, function(key,value){
		$("#grupoEmpresarial").append("<option value='" + value.HANDLE + ';' + value.NOME +"'>" + value.NOME + "</option>");
	});
});

});