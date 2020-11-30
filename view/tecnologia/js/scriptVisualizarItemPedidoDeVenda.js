// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew tr').click(function () {
        $('#reqtablenew tr').removeClass("activetr");
        $(this).addClass("activetr");
		$('button.botaoItems').removeAttr('disabled');
		
        $(this).find('[name="check[]"]').prop('checked',true);
		   //$('#adicionarPedido').removeAttr("hidden");
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
			
        	PedidoCheck = parseInt($(this).val());
			
			var PedidoArr = $(this).val().split(';');
			
			//alert(PedidoArr);
			
			for (var i = 0, len = PedidoCheck.length; i < len; i++) {
				var PedidoStatus = PedidoArr[0];
				var PedidoHandle = PedidoArr[1];
			}
			
			var PedidoStatus = PedidoArr[0];
			var PedidoHandle = PedidoArr[1];
			
			
		}
	})
	});
});

$(document).ready(function () {
    $('#reqtableAnexo tr').click(function () {
        $('#reqtableAnexo tr').removeClass("activetr");
        $(this).addClass("activetr");
		$('button.botaoAnexo').removeAttr('disabled');
        $(this).find('[name="check[]"]').prop('checked',true);
		   //$('#adicionarOcorrencia').removeAttr("hidden");
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PedidoAnexoCheck = parseInt($(this).val());
			
			var PedidoAnexoArr = $(this).val().split('-');
			
			//alert(PedidoArr);
			
			for (var i = 0, len = PedidoAnexoCheck.length; i < len; i++) {
				var anexoHandle = PedidoAnexoArr[0];
				var PedidoHandle = PedidoAnexoArr[1];
			}
			
			var anexoHandle = PedidoAnexoArr[0];
			var PedidoHandle = PedidoAnexoArr[1];
		
			//alert(PedidoStatus);
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
		
		  		
			window.location.href = '../../controller/comercial/VisualizarAnexoDespesaPedidoAnexoController.php?handle='+PedidoHandle+'&anexo='+anexoHandle+'&referencia=DespesaPedido';
			
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
		
		  		
			window.location.href = '../../controller/comercial/RemoverDespesaPedidoAnexoController.php?referencia=VisualizarDespesaPedido&handle='+PedidoHandle+'&anexo='+anexoHandle;
			
		});
		
		  }
		   })
    }
	
	);
	
	
	$('#GravarItemPedido').click(function(){
		$('.modal').modal('hide');
		$('#loader').removeAttr( 'style' );
		document.getElementById('FormItemPedido').submit();	
	});
		
	$('#GravarItemPedido').click(function(){
		$('.modal').modal('hide');
		$('#loader').removeAttr( 'style' );	
		document.getElementById('FormItemPedido').submit();	
			
	});
});


// Recupera Tipo
$(document).ready(function() {
	
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



$('#produto').focus(function() {
    $('#produto').autocomplete('option', 'minLength', 0);
    $('#produto').autocomplete('search', $('#produto').val());
});
$('#almoxarifado').focus(function() {
    $('#almoxarifado').autocomplete('option', 'minLength', 0);
    $('#almoxarifado').autocomplete('search', $('#almoxarifado').val());
});


    var tabelaHandle = $('#tabelaHandle').val();
	var listaHandle = $('#listaHandle').val();
	
    $.getJSON('../../controller/comercial/InserirItemPedidoDeVendaRecuperaProduto.php?lista='+listaHandle+'&tabela='+tabelaHandle, function(data){
		
         var dados = [];
		 var handle = [];

		 $('#produto').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				
				 $("#produtoHandle").val(ui.item.id);
				 $("#unidade").val(ui.item.UNIDADE);
				 $("#unidadeHandle").val(ui.item.UNIDADEHANDLE);
				 $("#informacaoTecnica").val(ui.item.INFORMACAOTECNICA);
				 
				 	 var tabelaHandle = $('#tabelaHandle').val();
					 var listaHandle = $('#listaHandle').val();
				 
				 buscavalorunitario(tabelaHandle, listaHandle, ui.item.id);
			 },
			 autoFocus: true
   });
   
    });
	

function buscavalorunitario(tabela,lista, itemhandle){
	
	var url = "../../controller/comercial/InserirItemPedidoDeVendaRecuperaValorUnitario.php?tabela="+tabela+"&lista="+lista+"&item="+itemhandle;
			
    $.getJSON(url , function(data){
		if(data.length > 0){
			$.each(data, function() {
				var ValorUnitario = number_format(this.value, '10', ',', '.');
        		$('#ValorUnitario').val(ValorUnitario);
    		});
		}
		else{
			$('#ValorUnitario').val('0,00');
		}	   
	});
}

   var url = "../../controller/comercial/InserirItemPedidoDeVendaRecuperaAlmoxarifado.php";
			
    $.getJSON(url , function(data){
         var dados = [];
		 var handle = [];

		 $('#almoxarifado').autocomplete({ 
		 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#almoxarifadoHandle").val(ui.item.id);
			 },
			 autoFocus: true
		 });
	});

	
});


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

function calcularValor(){
	
	var total = getMoney('quantidade') * getMoney('ValorUnitario');
	var ValorUnitario = getMoney('ValorUnitario');
	
		
	if (Number.isNaN(total)){
            total  = 0; // zerando caso seja NaN
	}
	
	if (Number.isNaN(getMoney('ValorUnitario'))){
            getElement('ValorUnitario').val(0); // zerando caso seja NaN
	}
	
    id('ValorTotal').value = number_format(total, 2, ',', '.');
	id('ValorUnitario').value = number_format(ValorUnitario, 2, ',', '.');
	
	var totalReembolsoFinal = getMoney('ValorTotal') * getMoney('percentualReembolso') / 100;
	if (Number.isNaN(totalReembolsoFinal)){
            totalReembolsoFinal = 0; // zerando caso seja NaN
	}
	
	
	id('totalReembolso').value = number_format(totalReembolsoFinal , 2, ',', '.');
}

function calcularPercentual(){
	
	var total = getMoney('quantidade') * getMoney('ValorUnitario');
	var ValorUnitario = getMoney('ValorUnitario');
	var totalReembolsoFinal = getMoney('ValorTotal') * getMoney('percentualReembolso') / 100;
		
	if (Number.isNaN(totalReembolsoFinal)){
            totalReembolsoFinal = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(total)){
            total  = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(totalReembolsoFinal)){
            totalReembolsoFinal = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(getMoney('ValorUnitario'))){
            getElement('ValorUnitario').val(0); // zerando caso seja NaN
	}
	
    id('ValorTotal').value = number_format(total, 2, ',', '.');
	id('ValorUnitario').value = number_format(ValorUnitario, 2, ',', '.');
	id('totalReembolso').value = number_format(totalReembolsoFinal , 2, ',', '.');
}

function calcularInverso(){
	
	//var totalInverso = getMoney('ValorTotal') / (getMoney('quantidade'));
	var quantidade = getMoney('quantidade');
	var ValorTotal = getMoney('quantidade') * getMoney('ValorUnitario');
	
	if (Number.isNaN(ValorTotal)){
            ValorTotal = 0; // zerando caso seja NaN
	}
	
    //id('ValorUnitario').value = number_format(totalInverso, 4, ',', '.');
	id('ValorTotal').value = number_format(ValorTotal , 2, ',', '.');
	
}



//limpar campos
function limparcampos(){
	document.getElementById("FormItemPedido").reset();	
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



function submitPedidoForm(){
	//var teste = document.getElementById('Pedido').value;
	//alert(teste);
	document.getElementById('Pedido').submit();	
}


//script modal Pedido viagem
function ExcluirDespesaPedido(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPedido').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PedidoCheck = parseInt($(this).val());
			
			var PedidoArr = $(this).val().split(';');
			for (var i = 0, len = PedidoCheck.length; i < len; i++) {
				var PedidoStatus = PedidoArr[0];
				var PedidoHandle = PedidoArr[0];
			}
			
			var PedidoStatus = PedidoArr[0];
			var PedidoHandle = PedidoArr[1];
						
			window.location.href='../../controller/comercial/ExcluirDespesaPedidoController.php?referencia=DespesaPedido&handle='+PedidoHandle;
			
	}
		 
})
}

function VoltarDespesaPedido(){

$(this).find('[name="check[]"]').prop('checked',true);

	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
		
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PedidoCheck = parseInt($(this).val());
			
			var PedidoArr = $(this).val().split(';');
			for (var i = 0, len = PedidoCheck.length; i < len; i++) {
				var PedidoStatus = PedidoArr[0];
				var PedidoHandle = PedidoArr[1];
			}
			
			var PedidoStatus = PedidoArr[0];
			var PedidoHandle = PedidoArr[1];
			
					
			window.location.href='../../controller/comercial/VoltarDespesaPedidoController.php?referencia=DespesaPedido&handle='+PedidoHandle;
			
	}
		 
})
}

function LiberarDespesaPedido(){
	
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPedido').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PedidoCheck = parseInt($(this).val());
			
			var PedidoArr = $(this).val().split(';');
			for (var i = 0, len = PedidoCheck.length; i < len; i++) {
				var PedidoStatus = PedidoArr[0];
				var PedidoHandle = PedidoArr[1];
			}
			
			var PedidoStatus = PedidoArr[0];
			var PedidoHandle = PedidoArr[1];
						
			window.location.href='../../controller/comercial/LiberarDespesaPedidoController.php?referencia=DespesaPedido&handle='+PedidoHandle;
			
	}
		 
})
}

function CancelarDespesaPedido(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPedido').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PedidoCheck = parseInt($(this).val());
			
			var PedidoArr = $(this).val().split(';');
			for (var i = 0, len = PedidoCheck.length; i < len; i++) {
				var PedidoStatus = PedidoArr[0];
				var PedidoHandle = PedidoArr[1];
			}
			
			var PedidoStatus = PedidoArr[0];
			var PedidoHandle = PedidoArr[1];
			var motivo = document.getElementById('motivo').value;
			
			window.location.href='../../controller/comercial/CancelarDespesaPedidoController.php?referencia=DespesaPedido&handle='+PedidoHandle+'&motivo='+motivo;
			
	}
		 
})
}

function VisualizarPedido(){
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPedido').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PedidoCheck = parseInt($(this).val());
			//alert(PedidoCheck);
			var PedidoArr = $(this).val().split(';');
			for (var i = 0, len = PedidoCheck.length; i < len; i++) {
				var PedidoStatus = PedidoArr[0];
				var PedidoHandle = PedidoArr[1];
			}
			
			var PedidoStatus = PedidoArr[0];
			var PedidoHandle = PedidoArr[1];
			window.location.href='../../view/comercial/VisualizarDespesaPedido.php?handle='+PedidoHandle+'&referencia=DespesaPedido';
			
	}
		 
})
}




//***Define Multiselect
function multiselection(){
	
$('#situacao').multiselect({
    columns: 1,
    search: true
});

$('#despesa').multiselect({
    columns: 1,
    search: true
});

$('#Pedido').multiselect({
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
$(document).on('click', '#sim', function() {
	$('.modal').modal('hide');
	$('#loader').removeAttr( 'style' );	
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
$("#FormItemPedido :text").add('#data').add('#obs').add('#informacaoTecnica').focus(function() {
    var valor = $(this).val();
	
$("#FormItemPedido :text").add('#data').add('#obs').add('#informacaoTecnica').blur(function() {

var editou = $('#editou').val();
var referencia = $('#referencia').val();

if(editou === 'S'){
	
}
else{
  	if($(this).val() === valor){
		var handlePedidoDeVenda = document.getElementById('handlePedidoDeVenda').value();
		
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = "<a href='VisualizarPedidoDeVenda.php?handle="+handlePedidoDeVenda+"'><button id='showLeftPushVoltarForm'><i class='glyphicon glyphicon-menu-left'></i></button></a>";
		$('#editou').val("N");
		$('#GravarItemPedido').addClass('display');
		$('button[name="GravarItemPedido"]').addClass('display');
		$('#Limpar').addClass('display');
		
		$('#GravarItemPedidoMobile').addClass('display');
		$('button[name="GravarItemPedidoMobile"]').addClass('display');
		$('#LimparMobile').addClass('display');
		
	}
	else{
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = "<button id='showLeftPushVoltarForm' data-toggle='modal' data-target='#VoltarModal'><i class='glyphicon glyphicon-menu-left'></i></button>";
		$('#editou').val("S");
		$('#GravarItemPedido').removeClass('display');
		$('button[name="GravarItemPedido"]').removeClass('display');
		$('#Limpar').removeClass('display');
		
		$('#GravarItemPedidoMobile').removeClass('display');
		$('button[name="GravarItemPedidoMobile"]').removeClass('display');
		$('#LimparMobile').removeClass('display');
		
		$('#excluirPedido').addClass('display');
		$('#liberarPedido').addClass('display');
		$('#voltarPedido').addClass('display');
		$('#cancelarPedido').addClass('display');
		
		$('#excluirPedidoMobile').addClass('display');
		$('#liberarPedidoMobile').addClass('display');
		$('#voltarPedidoMobile').addClass('display');
		$('#cancelarPedidoMobile').addClass('display');
	}
	
}
});
});
});

function VoltarItemPedidoDeVenda(){

var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();
var handleItemPedidoDeVenda = $('#handleItemPedidoDeVenda').val();
var referencia = $('#referencia').val();

	window.location.href='../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Voltar&referencia='+referencia+'&handle='+handlePedidoDeVenda+'&handleItem='+handleItemPedidoDeVenda;
	
}

function LiberarItemPedidoDeVenda(){
var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();
var handleItemPedidoDeVenda = $('#handleItemPedidoDeVenda').val();
var referencia = $('#referencia').val();

	window.location.href='../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Liberar&referencia='+referencia+'&handle='+handlePedidoDeVenda+'&handleItem='+handleItemPedidoDeVenda;
	
}

function ExcluirItemPedidoDeVenda(){
var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();
var handleItemPedidoDeVenda = $('#handleItemPedidoDeVenda').val();
var referencia = $('#referencia').val();

	window.location.href='../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Excluir&referencia='+referencia+'&handle='+handlePedidoDeVenda+'&handleItem='+handleItemPedidoDeVenda;
	
}

function CancelarItemPedidoDeVenda(){
var motivo = $('#motivo').val();
var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();
var handleItemPedidoDeVenda = $('#handleItemPedidoDeVenda').val();
var referencia = $('#referencia').val();

	window.location.href='../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Cancelar&referencia='+referencia+'&handle='+handlePedidoDeVenda+'&motivo='+motivo+'&handleItem='+handleItemPedidoDeVenda;
	
}