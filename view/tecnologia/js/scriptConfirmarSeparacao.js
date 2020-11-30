// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew tr').click(function () {
        $('#reqtablenew tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		   //$('#adicionarConfirmarSeparacao').removeAttr("hidden");
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ConfirmarSeparacaoCheck = parseInt($(this).val());
			
			var ConfirmarSeparacaoArr = $(this).val().split('-');
			
			//alert(ConfirmarSeparacaoArr);
			
			for (var i = 0, len = ConfirmarSeparacaoCheck.length; i < len; i++) {
				var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[0];
			}
			
			var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[1];
		
			//alert(ConfirmarSeparacaoStatus);
		$('#visualizarConfirmarSeparacao').removeClass('display');
		
		if (ConfirmarSeparacaoStatus == '1'){
			//Botoes grid
			$('#liberarConfirmarSeparacao').removeClass('display');
			$('#excluirConfirmarSeparacao').removeClass('display');
			
			$('#voltarConfirmarSeparacao').addClass('display');
			$('#cancelarConfirmarSeparacao').addClass('display');
		}
		else if (ConfirmarSeparacaoStatus == '2'){
			//Botoes grid
			 $('#voltarConfirmarSeparacao').removeClass('display');
			 
			 $('#liberarConfirmarSeparacao').addClass('display');
			 $('#cancelarConfirmarSeparacao').addClass('display');
			 $('#excluirConfirmarSeparacao').addClass('display');
		}
		else if (ConfirmarSeparacaoStatus == '3'){
			//Botoes grid
			 $('#voltarConfirmarSeparacao').removeClass('display');
			 
			 $('#liberarConfirmarSeparacao').addClass('display');
			 $('#cancelarConfirmarSeparacao').addClass('display');
			 $('#excluirConfirmarSeparacao').addClass('display');
		}
		else if (ConfirmarSeparacaoStatus == '4'){
			//Botoes grid
			$('#liberarConfirmarSeparacao').removeClass('display');
			$('#cancelarConfirmarSeparacao').removeClass('display');
			
			$('#voltarConfirmarSeparacao').addClass('display');
			$('#excluirConfirmarSeparacao').addClass('display');
		}
		else if (ConfirmarSeparacaoStatus == '5'){
			//Botoes grid
			$('#voltarConfirmarSeparacao').removeClass('display');
			
			$('#cancelarConfirmarSeparacao').addClass('display');
			$('#liberarConfirmarSeparacao').addClass('display');
			$('#excluirConfirmarSeparacao').addClass('display');
		}		
		else if (ConfirmarSeparacaoStatus == '6'){
			//Botoes grid
			$('#voltarConfirmarSeparacao').addClass('display');
			$('#liberarConfirmarSeparacao').addClass('display');
			$('#cancelarConfirmarSeparacao').addClass('display');
			$('#excluirConfirmarSeparacao').addClass('display');
		}
		else if (ConfirmarSeparacaoStatus == '7'){
			//Botoes grid
			$('#voltarConfirmarSeparacao').removeClass('display');
			
			$('#liberarConfirmarSeparacao').addClass('display');
			$('#cancelarConfirmarSeparacao').addClass('display');
			$('#excluirConfirmarSeparacao').addClass('display');
		}
		
		  }
		   })
    }
	
	);
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
        	ConfirmarSeparacaoAnexoCheck = parseInt($(this).val());
			
			var ConfirmarSeparacaoAnexoArr = $(this).val().split('-');
			
			//alert(ConfirmarSeparacaoArr);
			
			for (var i = 0, len = ConfirmarSeparacaoAnexoCheck.length; i < len; i++) {
				var anexoHandle = ConfirmarSeparacaoAnexoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoAnexoArr[0];
			}
			
			var anexoHandle = ConfirmarSeparacaoAnexoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoAnexoArr[1];
		
			//alert(ConfirmarSeparacaoStatus);
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
		
		  		
			window.location.href = '../../controller/operacional/VisualizarConfirmarSeparacaoAnexoController.php?ConfirmarSeparacao='+ConfirmarSeparacaoHandle+'&anexo='+anexoHandle;
			
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
		
		  		
			window.location.href = '../../controller/operacional/RemoverConfirmarSeparacaoAnexoController.php?ConfirmarSeparacao='+ConfirmarSeparacaoHandle+'&anexo='+anexoHandle;
			
		});
		
		  }
		   })
    }
	
	);
});


// Recupera Tipo
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaTipo.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#tipo').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#tipoHandle").val(ui.item.id)
				 //alert(ui.item.EHGERARDOCUMENTOFORNECEDOR);
		}
   });
   
    });
	

});


// Recupera ConfirmarSeparacao
$(document).ready(function() {
	
	// Captura o retorno do retornaCliente.php
	$.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaConfirmarSeparacao.php?teste=s', function(data){
		
		 $('#ConfirmarSeparacao').autocomplete(
		 {
			 select: function(event, ui) {
				$("#ConfirmarSeparacaoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data
			
		 });
    });
	
});


// Recupera Status tabela OP_STATUSVIAGEMDESPESA
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaStatus.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#situacao').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#situacaoHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Viagem
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaViagem.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#viagem').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#viagemHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Fornecedor
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaFornecedor.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#fornecedor').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#fornecedorHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Forma de pagamento
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaFormaPagamento.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#FormaPagamento').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#FormaPagamentoHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Condição de pagamento
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirConfirmarSeparacaoRecuperaCondicaoPagamento.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#CondicaoPagamento').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#CondicaoPagamentoHandle").val(ui.item.id)
		}     
   });
    });
});


//Calculo dos valores pelo id do input
/*
function id( el ){
	return document.getElementById( el );
}

function getMoney( el ){
	var money = id( el ).value.replace( ',', '.' );
    return parseFloat( money );
}

function getElement( el ){
    return $('#' + el);
}

function calcular(){
	var total = (getMoney('quantidade') * getMoney('ValorUnitario').toFixed(4));
	if (Number.isNaN(total)){
            total  = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(getMoney('ValorUnitario'))){
            getElement('ValorUnitario').val(0); // zerando caso seja NaN
	}
    id('ValorTotal').value = total.toFixed(2);
	id('ValorUnitario').value = getMoney('ValorUnitario').toFixed(4);
}

function calcularInverso(){
	var totalInverso = getMoney('ValorTotal') / (getMoney('quantidade').toFixed(4));
	if (Number.isNaN(totalInverso)){
    	totalInverso  = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(getMoney('quantidade'))){
            getElement('quantidade').val(0); // zerando caso seja NaN
	}
    id('ValorUnitario').value = totalInverso.toFixed(4);
	id('quantidade').value = getMoney('quantidade').toFixed(4);
}


*/

function limpavalor(){
	var ValorUnitario = document.getElementById('ValorUnitario').value;
	if(ValorUnitario == '0,0000'){
		document.getElementById('ValorUnitario').value = null;
	}
}


// formato os numeros para moeda com ponto depois virgula
function number_format (number, decimals, dec_point, thousands_sep) { 
number = (number + '').replace(',', '').replace(' ', ''); 
var n = !isFinite(+number) ? 0 : +number, 
prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), 
sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep, dec = (typeof dec_point === 'undefined') ? ',' : dec_point, 
s = '', 
toFixedFix = function (n, prec) { 
var k = Math.pow(10, prec); 
return '' + Math.round(n * k) / k; }; 
// Fix for IE parseFloat(0.55).toFixed(0) = 0; 
s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.'); 
if (s[0].length > 3) { 
s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep); } 
if ((s[1] || '').length < prec) { 
s[1] = s[1] || ''; 
s[1] += new Array(prec - s[1].length + 1).join('0'); 
} 
return s.join(dec); 
} 

function id( el ){
	return document.getElementById( el );
}

function getMoney( el ){
	var money = id( el ).value.replace(',','.');
    return parseFloat( money );
}


function getElement( el ){
    return $('#' + el);
}

function calcular(){
	
	var total = getMoney('quantidade') * getMoney('ValorUnitario');
	var ValorUnitario = getMoney('ValorUnitario');
	
	if (Number.isNaN(total)){
            total  = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(getMoney('ValorUnitario'))){
            getElement('ValorUnitario').val(0); // zerando caso seja NaN
	}
	
    id('ValorTotal').value = number_format(total, 2, ',', '.');
	id('ValorUnitario').value = number_format(ValorUnitario, 4, ',', '.');
}

function calcularInverso(){
	
	var totalInverso = getMoney('ValorTotal') / (getMoney('quantidade'));
	var quantidade = getMoney('quantidade');
	
	if (Number.isNaN(totalInverso)){
    	totalInverso  = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(getMoney('quantidade'))){
            getElement('quantidade').val('1,0000'); // zerando caso seja NaN
	}
    //id('ValorUnitario').value = number_format(totalInverso, 4, ',', '.');
	id('ValorUnitario').value = number_format(totalInverso, 4, ',', '.');
	id('quantidade').value = number_format(quantidade, 4, ',', '.');
	//id('quantidade').value = number_format(quantidade, 4, ',', '.');
	
	if (Number.isNaN(getMoney('quantidade'))){
		id('quantidade').value = number_format('1', 4, ',', '.');
	}
	if (Number.isNaN(getMoney('ValorUnitario'))){
		id('ValorUnitario').value = number_format('1', 4, ',', '.');
	}
}


function clickdownTipo() {
    $('#tipo').autocomplete('option', 'minLength', 0);
    $('#tipo').autocomplete('search', $('#tipo').val());
};
function clickdownStatus() {
    $('#situacao').autocomplete('option', 'minLength', 0);
    $('#situacao').autocomplete('search', $('#situacao').val());
};
function clickdownViagem() {
    $('#viagem').autocomplete('option', 'minLength', 0);
    $('#viagem').autocomplete('search', $('#viagem').val());
};

function clickdownConfirmarSeparacao() {
    
				/* var EHGERARDOCUMENTOFORNECEDOR  = document.getElementById('EHGERARDOCUMENTOFORNECEDOR').value;
				 var EHGERARDOCUMENTOMOTORISTA  = document.getElementById('EHGERARDOCUMENTOMOTORISTA').value;*/
					
				 //if(EHGERARDOCUMENTOFORNECEDOR == 'S'|| EHGERARDOCUMENTOMOTORISTA == 'S'){
					$('#ConfirmarSeparacao').autocomplete('option', 'minLength', 0);
					$('#ConfirmarSeparacao').autocomplete('search', $('#ConfirmarSeparacao').val());
					//alert(EHGERARDOCUMENTOFORNECEDOR);
					
				/*}
				else{
					$('#ConfirmarSeparacao').autocomplete('option', 'minLength', 99999999);
					alert(EHGERARDOCUMENTOFORNECEDOR);
				}*/
    
};

function clickdownFornecedor() {
    $('#fornecedor').autocomplete('option', 'minLength', 0);
    $('#fornecedor').autocomplete('search', $('#fornecedor').val());
};
function clickdownFormaPagamento() {
    $('#FormaPagamento').autocomplete('option', 'minLength', 0);
    $('#FormaPagamento').autocomplete('search', $('#FormaPagamento').val());
};
function clickdownCondicaoPagamento() {
    $('#CondicaoPagamento').autocomplete('option', 'minLength', 0);
    $('#CondicaoPagamento').autocomplete('search', $('#CondicaoPagamento').val());
};

//limpar campos
function limparcampos(){
	document.getElementById("ConfirmarSeparacao").reset();	
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



function submitConfirmarSeparacaoForm(){
	document.getElementById('ConfirmarSeparacao').submit();	
}


//script modal ConfirmarSeparacao viagem
function ExcluirConfirmarSeparacao(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarConfirmarSeparacao').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ConfirmarSeparacaoCheck = parseInt($(this).val());
			
			var ConfirmarSeparacaoArr = $(this).val().split('-');
			for (var i = 0, len = ConfirmarSeparacaoCheck.length; i < len; i++) {
				var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[0];
			}
			
			var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[1];
						
			window.location.href='../../controller/operacional/ExcluirConfirmarSeparacaoController.php?ref=ConfirmarSeparacao&ConfirmarSeparacaoHandle='+ConfirmarSeparacaoHandle;
			
	}
		 
})
}

function VoltarConfirmarSeparacao(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarConfirmarSeparacao').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ConfirmarSeparacaoCheck = parseInt($(this).val());
			
			var ConfirmarSeparacaoArr = $(this).val().split('-');
			for (var i = 0, len = ConfirmarSeparacaoCheck.length; i < len; i++) {
				var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[0];
			}
			
			var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[1];
						
			window.location.href='../../controller/operacional/VoltarConfirmarSeparacaoController.php?ref=ConfirmarSeparacao&ConfirmarSeparacaoHandle='+ConfirmarSeparacaoHandle;
			
	}
		 
})
}

function LiberarConfirmarSeparacao(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarConfirmarSeparacao').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ConfirmarSeparacaoCheck = parseInt($(this).val());
			
			var ConfirmarSeparacaoArr = $(this).val().split('-');
			for (var i = 0, len = ConfirmarSeparacaoCheck.length; i < len; i++) {
				var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[0];
			}
			
			var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[1];
						
			window.location.href='../../controller/operacional/LiberarConfirmarSeparacaoController.php?ref=ConfirmarSeparacao&ConfirmarSeparacaoHandle='+ConfirmarSeparacaoHandle;
			
	}
		 
})
}

function CancelarConfirmarSeparacao(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarConfirmarSeparacao').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ConfirmarSeparacaoCheck = parseInt($(this).val());
			
			var ConfirmarSeparacaoArr = $(this).val().split('-');
			for (var i = 0, len = ConfirmarSeparacaoCheck.length; i < len; i++) {
				var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[0];
			}
			
			var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[1];
			var motivo = document.getElementById('motivo').value;
			
			window.location.href='../../controller/operacional/CancelarConfirmarSeparacaoController.php?ref=ConfirmarSeparacao&ConfirmarSeparacaoHandle='+ConfirmarSeparacaoHandle+'&motivo='+motivo;
			
	}
		 
})
}

function VisualizarConfirmarSeparacao(){
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarConfirmarSeparacao').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	ConfirmarSeparacaoCheck = parseInt($(this).val());
			//alert(ConfirmarSeparacaoCheck);
			var ConfirmarSeparacaoArr = $(this).val().split('-');
			for (var i = 0, len = ConfirmarSeparacaoCheck.length; i < len; i++) {
				var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
				var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[0];
			}
			
			var ConfirmarSeparacaoStatus = ConfirmarSeparacaoArr[0];
			var ConfirmarSeparacaoHandle = ConfirmarSeparacaoArr[1];
			var motivo = document.getElementById('motivo').value;
			
			window.location.href='../../view/operacional/VisualizarConfirmarSeparacao.php?ConfirmarSeparacao='+ConfirmarSeparacaoHandle+'&referencia=ConfirmarSeparacao';
			
	}
		 
})
}




//***Define Multiselect
function multiselection(){
	
$('#situacao').multiselect({
    columns: 1,
    search: true
});

$('#viagem').multiselect({
    columns: 1,
    search: true
});

$('#ConfirmarSeparacao').multiselect({
    columns: 1,
    search: true
});

$('#tipo').multiselect({
    columns: 1,
    search: true
});

}

// alinha texto do input à esquerda ao focar
$(function() {                  
  $(".inputClass").focus(function() {  
    $(this).removeClass("inputRight");      
  });
  $(".inputClass").blur(function() { 
    $(this).addClass("inputRight");  
  });
});



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

$(document).on('click', '#GravarConfirmarSeparacao', function() {
	
	
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
		
		
		document.getElementById('ConfirmarSeparacao').submit();	
		
});

$(document).on('click', '#GravarConfirmarSeparacaoMobile', function() {
	
	
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
		
		
		document.getElementById('ConfirmarSeparacao').submit();	
		
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
