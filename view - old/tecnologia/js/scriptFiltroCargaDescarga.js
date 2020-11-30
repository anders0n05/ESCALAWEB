//***Consulta ajax valores filtros modals
$(document).ready(function() {
	
	$.getJSON("../../controller/operacional/retornaTransportadoraFiltro.php", function(return_data){
		$.each(return_data.data, function(key,value){
			$("#transportadora").append("<option value='" + value.HANDLE + ";" + value.APELIDO +"'>" + value.APELIDO + "</option>");
		});
	});
});	
