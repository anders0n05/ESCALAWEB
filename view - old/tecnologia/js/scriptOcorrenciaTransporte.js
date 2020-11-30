// seleciona radio ao clicar em <tr>
$(document).ready(function () {
   $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");
		
        $(this).addClass("activetr");
		
        $(this).parent('tr').find('[name="check[]"]').prop('checked',true);
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			
			var ocorrenciaArr = $(this).val().split('-');
			
			//alert(ocorrenciaArr);
			
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[0];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
		
			//alert(ocorrenciaStatus);
		$('#visualizarOcorrencia').removeClass('display');
		
		if (ocorrenciaStatus == '1'){
			//Botoes grid
			$('#liberarOcorrencia').removeClass('display');
			$('#excluirOcorrencia').removeClass('display');
			
			$('#voltarOcorrencia').addClass('display');
			$('#cancelarOcorrencia').addClass('display');
		}
		else if (ocorrenciaStatus == '2'){
			//Botoes grid
			 $('#liberarOcorrencia').removeClass('display');
			 $('#cancelarOcorrencia').removeClass('display');
			 
			 $('#liberarOcorrencia').addClass('display');
			 $('#voltarOcorrencia').addClass('display');
			 $('#excluirOcorrencia').addClass('display');
		}
		else if (ocorrenciaStatus == '3'){
			//Botoes grid
			 $('#voltarOcorrencia').removeClass('display');
			 
			 $('#liberarOcorrencia').addClass('display');
			 $('#cancelarOcorrencia').addClass('display');
			 $('#excluirOcorrencia').addClass('display');
		}		
		else if (ocorrenciaStatus == '6'){
			//Botoes grid
			$('#voltarOcorrencia').removeClass('display');
			 
			 $('#liberarOcorrencia').addClass('display');
			 $('#cancelarOcorrencia').addClass('display');
			 $('#excluirOcorrencia').addClass('display');
		}
		else if (ocorrenciaStatus == '7'){
			//Botoes grid
			$('#voltarOcorrencia').removeClass('display');
			 
			 $('#liberarOcorrencia').addClass('display');
			 $('#cancelarOcorrencia').addClass('display');
			 $('#excluirOcorrencia').addClass('display');
		}
		
		  }
		   })
    }
	
	);
	
	
	
	$('#reqtablenewMobile tr').dblclick(function () {
        $('#reqtablenewMobile tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			
			var ocorrenciaArr = $(this).val().split('-');
			
			//alert(ocorrenciaArr);
			
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[0];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
		
			//alert(ocorrenciaStatus);
		$('#visualizarOcorrenciaMobile').removeClass('display');
		
		if (ocorrenciaStatus == '1'){
			//Botoes grid
			$('#liberarOcorrenciaMobile').removeClass('display');
			$('#excluirOcorrenciaMobile').removeClass('display');
			
			$('#voltarOcorrenciaMobile').addClass('display');
			$('#cancelarOcorrenciaMobile').addClass('display');
		}
		else if (ocorrenciaStatus == '2'){
			//Botoes grid
			 $('#liberarOcorrenciaMobile').removeClass('display');
			 $('#cancelarOcorrenciaMobile').removeClass('display');
			 
			 $('#liberarOcorrenciaMobile').addClass('display');
			 $('#voltarOcorrenciaMobile').addClass('display');
			 $('#excluirOcorrenciaMobile').addClass('display');
		}
		else if (ocorrenciaStatus == '3'){
			//Botoes grid
			 $('#voltarOcorrenciaMobile').removeClass('display');
			 
			 $('#liberarOcorrenciaMobile').addClass('display');
			 $('#cancelarOcorrenciaMobile').addClass('display');
			 $('#excluirOcorrenciaMobile').addClass('display');
		}		
		else if (ocorrenciaStatus == '6'){
			//Botoes grid
			$('#voltarOcorrenciaMobile').removeClass('display');
			 
			 $('#liberarOcorrenciaMobile').addClass('display');
			 $('#cancelarOcorrenciaMobile').addClass('display');
			 $('#excluirOcorrenciaMobile').addClass('display');
		}
		else if (ocorrenciaStatus == '7'){
			//Botoes grid
			$('#voltarOcorrenciaMobile').removeClass('display');
			 
			 $('#liberarOcorrenciaMobile').addClass('display');
			 $('#cancelarOcorrenciaMobile').addClass('display');
			 $('#excluirOcorrenciaMobile').addClass('display');
		}
		
		  }
		   })
    }
	
	);
	
	$('#inserirOcorrenciaMobile').click(function(){
		window.location.href='InserirOcorrenciaTransporte.php?referencia=OcorrenciaTransporte';	
	})
});

$(document).ready(function () {
    $('#reqtableAnexo tr').click(function () {
        $('#reqtableAnexo tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		   //$('#adicionarOcorrencia').removeAttr("hidden");
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaAnexoCheck = parseInt($(this).val());
			
			var ocorrenciaAnexoArr = $(this).val().split('-');
			
			//alert(ocorrenciaArr);
			
			for (var i = 0, len = ocorrenciaAnexoCheck.length; i < len; i++) {
				var anexoHandle = ocorrenciaAnexoArr[0];
				var ocorrenciaHandle = ocorrenciaAnexoArr[0];
			}
			
			var anexoHandle = ocorrenciaAnexoArr[0];
			var ocorrenciaHandle = ocorrenciaAnexoArr[1];
		
			//alert(ocorrenciaStatus);
		$('#visualizarAnexo').removeAttr("disabled");
		$('#removerAnexo').removeAttr("disabled");
		
		$('#visualizarAnexo').click(function(){
			
			
			
			$('#loader').removeAttr( 'style' );
			
		   /*$.blockUI({ css: { 
					border: 'none', 
					padding: '10px',
					backgroundColor: 'transparent', 
					'-webkit-border-radius': '0px', 
					'-moz-border-radius': '0px',
					opacity: 1,
					color: '#fff'
			} }); 
	 
			setTimeout($.unblockUI, 9999*5);*/
				
		  		
			window.location.href = '../../controller/operacional/VisualizarOcorrenciaTransporteAnexoController.php?ocorrencia='+ocorrenciaHandle+'&anexo='+anexoHandle;
			
		});
		
		$('#removerAnexo').click(function(){
		
		$('#loader').removeAttr( 'style' );
		
	   /*$.blockUI({ css: { 
				border: 'none', 
				padding: '10px',
				backgroundColor: 'transparent', 
				'-webkit-border-radius': '0px', 
				'-moz-border-radius': '0px',
				opacity: 1,
				color: '#fff'
        } }); 
 
        setTimeout($.unblockUI, 9999*5);*/
		
		  		
			window.location.href = '../../controller/operacional/RemoverOcorrenciaTransporteAnexoController.php?ocorrencia='+ocorrenciaHandle+'&anexo='+anexoHandle;
			
		});
		  }
		   })
    }
	
	);
});



// Recupera Filial
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaFilial.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#filial').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#filialHandle").val(ui.item.HANDLE)
		}
   });
    });
});

// Recupera Tipo
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaTipo.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#tipoOcorrencia').autocomplete({ 
			 source: data,
			 minLength: 0,
			 select: function(event, ui) {
				 $("#tipoOcorrenciaHandle").val(ui.item.id)
				 $("#acao").val(ui.item.ACAO);
				 $("#acaoHandle").val(ui.item.ACAOHANDLE);
				 $("#acao").prop("disabled", "disabled");
				 
		}
   });
   
    });
	

});


// Recupera regraBaixa
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaRegraBaixa.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#regraBaixa').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#regraBaixaHandle").val(ui.item.id)


			 }
   });
   
    });
	
});

// Recupera tipoOperacao
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaTipoOperacao.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#tipoOperacao').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#tipoHandle").val(ui.item.id)
				 
		}
   });
   
    });
	


});

// Recupera InserirOcorrenciaTransporteRecuperaDocumentoTransporte.php
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaDocumentoTransporte.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#documentoTransporte').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#documentoTransporteHandle").val(ui.item.id)
				 $("#romaneioItem").val(ui.item.ROMANEIOITEM)
		}
   });
   
    });
	


});
/*
// Recupera Ação
$(document).ready(function() {
	
	var tipoAcao  = document.getElementById('tipoAcao').value;
	
	$.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaAcao.php?{tipo='+tipoAcao+'}', function(data){
		
		 $('#acao').autocomplete(
		 {
			 select: function(event, ui) {
				$("#acaoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data
			
		 });
    });
	
});

*/

// Recupera Motivo Atraso
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaMotivoAtraso.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#motivoAtraso').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#motivoAtrasoHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Responsável
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaResponsavel.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#responsavel').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#responsavelHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Documento
$(document).ready(function() {
	
    $.getJSON('../../controller/operacional/InserirOcorrenciaTransporteRecuperaDocumento.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#documento').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#documentoHandle").val(ui.item.id)
		}     
   });
    });
});

function clickdownFilial() {
    $('#filial').autocomplete('option', 'minLength', 0);
    $('#filial').autocomplete('search', $('#filial').val());
};
function clickdownTipoOcorrencia() {
    $('#tipoOcorrencia').autocomplete('option', 'minLength', 0);
    $('#tipoOcorrencia').autocomplete('search', $('#tipoOcorrencia').val());
	
};
function clickdownregraBaixa() {
    $('#regraBaixa').autocomplete('option', 'minLength', 0);
    $('#regraBaixa').autocomplete('search', $('#regraBaixa').val());
};
function clickdowndocumentoTransporte() {
    $('#documentoTransporte').autocomplete('option', 'minLength', 0);
    $('#documentoTransporte').autocomplete('search', $('#documentoTransporte').val());
};
function clickdowntipoOperacao() {
    $('#tipoOperacao').autocomplete('option', 'minLength', 0);
    $('#tipoOperacao').autocomplete('search', $('#tipoOperacao').val());
};
function clickdownAcao() {
	$('#acao').autocomplete('option', 'minLength', 0);
    $('#acao').autocomplete('search', $('#acao').val());
};

function clickdownMotivoAtraso() {
    $('#motivoAtraso').autocomplete('option', 'minLength', 0);
    $('#motivoAtraso').autocomplete('search', $('#motivoAtraso').val());
};
function clickdownResponsavel() {
    $('#responsavel').autocomplete('option', 'minLength', 0);
    $('#responsavel').autocomplete('search', $('#responsavel').val());
};
function clickdownDocumento() {
    $('#documento').autocomplete('option', 'minLength', 0);
    $('#documento').autocomplete('search', $('#documento').val());
};


//limpar campos
function limparcampos(){
	document.getElementById("OcorrenciaTransporte").reset();	
}

// Visualiza anexo enviado
var loadFile = function(event) {
var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};

function preview_image() 
{
	
	$('#loader').removeAttr( 'style' );
	
   /*$.blockUI({ css: { 
            border: 'none', 
            padding: '10px',
            backgroundColor: 'transparent', 
            '-webkit-border-radius': '0px', 
            '-moz-border-radius': '0px',
            opacity: 1,
            color: '#fff'
        } }); 
 
        setTimeout($.unblockUI, 9999*5);*/
		
		
// Obtém a data/hora atual
var data = new Date();

// Guarda cada pedaço em uma variável
var dia     = data.getDate();           // 1-31
if (dia< 10) {
    dia  = "0" + dia;
}
var dia_sem = data.getDay();            // 0-6 (zero=domingo)
var mes     = data.getMonth();          // 0-11 (zero=janeiro)
if (mes < 10) {
    mes  = "0" + mes;
}
var ano2    = data.getYear();           // 2 dígitos
var ano4    = data.getFullYear();       // 4 dígitos
var hora    = data.getHours();          // 0-23
if (hora < 10) {
    hora  = "0" + hora;
}
var min     = data.getMinutes();        // 0-59
if (min < 10) {
    min  = "0" + min;
}
var seg     = data.getSeconds();        // 0-59
if (seg < 10) {
    seg  = "0" + seg;
}
var mseg    = data.getMilliseconds();   // 0-999
var tz      = data.getTimezoneOffset(); // em minutos

// Formata a data e a hora (note o mês + 1)
var str_data = dia + '/' + mes + '/' + ano4;
var str_hora = hora + ':' + min + ':' + seg;


 var total_file=document.getElementById("image_src").files.length;
 for(var i=0;i<total_file;i++)
 {
	 //input.files[i].name
	 //URL.createObjectURL(event.target.files[i])
	 var nome = event.target.files[i].name.split('.');
	$('#image_preview').append('<tr><td>' + nome[0] + '</td><td width="10%">' + str_data + ' ' + str_hora + '</tr>'); 
 }

 document.getElementById("InserirAnexoForm").submit();
}



$("#btnImage_src").click(function(){
        $(this).next().trigger('click');
});

function submitOcorrenciaTransporteForm(){
	document.getElementById('OcorrenciaTransporte').submit();	
}

//script modal ocorrencia viagem
function ExcluirOcorrenciaTransporte(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			
			var ocorrenciaArr = $(this).val().split('-');
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[1];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
			
			//alert(ocorrenciaHandle);
						
			window.location.href='../../controller/operacional/ExcluirOcorrenciaTransporteController.php?ref=OcorrenciaTransporte&ocorrenciaHandle='+ocorrenciaHandle;
			
	}
		 
})
}

function VoltarOcorrenciaTransporte(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			
			var ocorrenciaArr = $(this).val().split('-');
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[1];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
						
			window.location.href='../../controller/operacional/VoltarOcorrenciaTransporteController.php?ref=OcorrenciaTransporte&ocorrenciaHandle='+ocorrenciaHandle;
			
	}
		 
})
}

function LiberarOcorrenciaTransporte(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			
			var ocorrenciaArr = $(this).val().split('-');
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[1];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
						
			window.location.href='../../controller/operacional/LiberarOcorrenciaTransporteController.php?ref=OcorrenciaTransporte&ocorrenciaHandle='+ocorrenciaHandle;
			
	}
		 
})
}

function CancelarOcorrenciaTransporte(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			
			var ocorrenciaArr = $(this).val().split('-');
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[1];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
			var motivo = document.getElementById('motivo').value;
			
			window.location.href='../../controller/operacional/CancelarOcorrenciaTransporteController.php?ref=OcorrenciaTransporte&ocorrenciaHandle='+ocorrenciaHandle+'&motivo='+motivo;
			
	}
		 
})
}

function VisualizarOcorrenciaTransporte(){
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ocorrenciaCheck = parseInt($(this).val());
			//alert(ocorrenciaCheck);
			var ocorrenciaArr = $(this).val().split('-');
			for (var i = 0, len = ocorrenciaCheck.length; i < len; i++) {
				var ocorrenciaStatus = ocorrenciaArr[0];
				var ocorrenciaHandle = ocorrenciaArr[1];
			}
			
			var ocorrenciaStatus = ocorrenciaArr[0];
			var ocorrenciaHandle = ocorrenciaArr[1];
			var motivo = document.getElementById('motivo').value;
			
			window.location.href='../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='+ocorrenciaHandle+'&referencia=OcorrenciaTransporte';
			
	}
		 
})
}

//***Define Multiselect
function multiselection(){
	
$('#filial').multiselect({
    columns: 1,
    search: true
});

$('#tipo').multiselect({
    columns: 1,
    search: true
});

$('#regraBaixa').multiselect({
    columns: 1,
    search: true
});

$('#tipoOperacao').multiselect({
    columns: 1,
    search: true
});

$('#acao').multiselect({
    columns: 1,
    search: true
});

$('#documento').multiselect({
    columns: 1,
    search: true
});

}

//aguarde...
// invoke blockUI as needed -->
$(document).on('click', '#sim', function() {
	
	
	$('.modal').modal('hide');
	$('#loader').removeAttr( 'style' );
	
   /*$.blockUI({ css: { 
            border: 'none', 
            padding: '10px',
            backgroundColor: 'transparent', 
            '-webkit-border-radius': '0px', 
            '-moz-border-radius': '0px',
            opacity: 1,
            color: '#fff'
        } }); 
 
        setTimeout($.unblockUI, 9999*5);*/
		
});

$(document).on('click', '#GravarOcorrenciaTransporte', function() {
	
	
	$('.modal').modal('hide');
	$('#loader').removeAttr( 'style' );
	
   /*$.blockUI({ css: { 
            border: 'none', 
            padding: '10px',
            backgroundColor: 'transparent', 
            '-webkit-border-radius': '0px', 
            '-moz-border-radius': '0px',
            opacity: 1,
            color: '#fff'
        } }); 
 
        setTimeout($.unblockUI, 9999*5);*/
		
		
		document.getElementById('OcorrenciaTransporte').submit();	
		
});

$(document).on('click', '#GravarOcorrenciaTransporteMobile', function() {
	
	
	$('.modal').modal('hide');
	$('#loader').removeAttr( 'style' );
	
   /*$.blockUI({ css: { 
            border: 'none', 
            padding: '10px',
            backgroundColor: 'transparent', 
            '-webkit-border-radius': '0px', 
            '-moz-border-radius': '0px',
            opacity: 1,
            color: '#fff'
        } }); 
 
        setTimeout($.unblockUI, 9999*5);*/
		
		
		document.getElementById('OcorrenciaTransporte').submit();	
		
});

/**
 * Vertically center Bootstrap 3 modals so they aren't always stuck at the top
 */
$(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        
        // Dividing by two centers the modal exactly, but dividing by three 
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
});


function limpaform(){
	$('input[type=datetime-local]').valueAsDate = '0000-00-00 00:00';
	$('option').removeAttr('selected');
	$('button#btnMultiselect').text("   ").attr({
			title:"Limpou"
});

}




$(document).ready(function(){
$("#OcorrenciaTransporte :text").add('#data').add('#obs').add('#dataChegada').add('#dataEntrada').add('#dataSaida').focus(function() {
    var valor = $(this).val();
	
$("#OcorrenciaTransporte :text").add('#data').add('#obs').add('#dataChegada').add('#dataEntrada').add('#dataSaida').blur(function() {

var editou = $('#editou').val();
var referencia = $('#referencia').val();

if(editou === 'S'){

}
else{
  	if($(this).val() === valor){
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = "<a href='OcorrenciaTransporte.php'><button id='showLeftPushVoltarForm'><i class='glyphicon glyphicon-menu-left'></i></button></a>";
		$('#editou').val("N");
		$('#GravarOcorrenciaTransporte').addClass('display');
		$('button[name="GravarOcorrenciaTransporte"]').addClass('display');
		$('#Limpar').addClass('display');
		
		$('#GravarOcorrenciaTransporteMobile').addClass('display');
		$('button[name="GravarOcorrenciaTransporteMobile"]').addClass('display');
		$('#LimparMobile').addClass('display');
		
		$('#excluirOcorrencia').removeClass('display');
		$('#liberarOcorrencia').removeClass('display');
		$('#voltarOcorrencia').removeClass('display');
		$('#cancelarOcorrencia').removeClass('display');
		
		$('#excluirOcorrenciaMobile').removeClass('display');
		$('#liberarOcorrenciaMobile').removeClass('display');
		$('#voltarOcorrenciaMobile').removeClass('display');
		$('#cancelarOcorrenciaMobile').removeClass('display');
	}
	else{
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = "<button id='showLeftPushVoltarForm' data-toggle='modal' data-target='#VoltarModal'><i class='glyphicon glyphicon-menu-left'></i></button>";
		$('#editou').val("S");
		$('#GravarOcorrenciaTransporte').removeClass('display');
		$('button[name="GravarOcorrenciaTransporte"]').removeClass('display');
		$('#Limpar').removeClass('display');
		
		$('#GravarOcorrenciaTransporteMobile').removeClass('display');
		$('button[name="GravarOcorrenciaTransporteMobile"]').removeClass('display');
		$('#LimparMobile').removeClass('display');
		
		$('#excluirOcorrencia').addClass('display');
		$('#liberarOcorrencia').addClass('display');
		$('#voltarOcorrencia').addClass('display');
		$('#cancelarOcorrencia').addClass('display');
		
		$('#excluirOcorrenciaMobile').addClass('display');
		$('#liberarOcorrenciaMobile').addClass('display');
		$('#voltarOcorrenciaMobile').addClass('display');
		$('#cancelarOcorrenciaMobile').addClass('display');
	}
	
}
});
});
});