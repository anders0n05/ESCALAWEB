// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew tr').click(function () {
        $('#reqtablenew tr').removeClass("activetr");
        $(this).addClass("activetr");
		
		$('button#visualizarItemPedido').removeAttr('disabled');
		$('button#excluirItemPedido').removeAttr('disabled');
		
        $(this).find('[name="check[]"]').prop('checked',true);
		   //$('#adicionarPedido').removeAttr("hidden");
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
			
        	ItemPedidoCheck = parseInt($(this).val());
			
			var ItemPedidoArr = $(this).val().split(';');
			
			//alert(PedidoArr);
			
			for (var i = 0, len = ItemPedidoCheck.length; i < len; i++) {
				var ItemPedidoHandle = ItemPedidoArr[0];
				var PedidoHandle = ItemPedidoArr[1];
				var ItemPedidoStatus = ItemPedidoArr[2];
			}
			
			var ItemPedidoHandle = ItemPedidoArr[0];
			var PedidoHandle = ItemPedidoArr[1];
			var ItemPedidoStatus = ItemPedidoArr[2];
			
			
			$('#excluirItemPedido').click(function(){
				
				$('.modal').modal('hide');
				$('#loader').removeAttr( 'style' );
				window.location.href = '../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Excluir&referencia=VisualizarPedidoDeVenda&handle='+PedidoHandle+'&handleItem='+ItemPedidoHandle;	
			});
			
			$('#liberarItemPedido').click(function(){
				$('.modal').modal('hide');
				$('#loader').removeAttr( 'style' );
				window.location.href = '../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Liberar&referencia=VisualizarPedidoDeVenda&handle='+PedidoHandle+'&handleItem='+ItemPedidoHandle;	
			});
			
			$('#cancelarItemPedido').click(function(){
				$('.modal').modal('hide');
				$('#loader').removeAttr( 'style' );
				var motivo = $('#motivo').val();
				window.location.href='../../controller/comercial/WebServiceItemPedidoDeVendaController.php?metodo=Cancelar&referencia=VisualizarPedidoDeVenda&handle='+PedidoHandle+'&motivo='+motivo+'&handleItem='+ItemPedidoHandle;
			});
			
			
			$('#visualizarItemPedido').click(function(){
				$('.modal').modal('hide');
				$('#loader').removeAttr( 'style' );			
				window.location.href = '../../view/comercial/VisualizarItemPedidoDeVenda.php?handleItem='+ItemPedidoHandle+'&handle='+PedidoHandle+'&referencia=VisualizarPedidoDeVenda';
			})
			
		}
	})
	});
	
	
	$('#reqtableAuditoria tr').click(function () {
        $('#reqtableAuditoria tr').removeClass("activetr");
        $(this).addClass("activetr");
		$('button#visualizarAuditoria').removeAttr('disabled');
		
        $(this).find('[name="check[]"]').prop('checked',true);
		   //$('#adicionarPedido').removeAttr("hidden");
		 	
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
			
        	/*AuditoriaCheck = parseInt($(this).val());
			
			var AuditoriaArr = $(this).val().split(';');*/
			
					
			//alert(PedidoStatus);
		
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
			window.location.href = '../../controller/comercial/VisualizarAnexoPedidoDeVendaController.php?handle='+PedidoHandle+'&anexo='+anexoHandle+'&referencia=VisualizarPedidoDeVenda';		
		});
		$('#removerAnexo').click(function(){
			$('#loader').removeAttr( 'style' );
			window.location.href = '../../controller/comercial/RemoverAnexoPedidoDeVendaController.php?referencia=VisualizarPedidoDeVenda&handle='+PedidoHandle+'&anexo='+anexoHandle;
		});
		
		  }
		   });
    }
	
	);
	
	
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



$('#filialPedidoDeVenda').focus(function() {
    $('#filialPedidoDeVenda').autocomplete('option', 'minLength', 0);
    $('#filialPedidoDeVenda').autocomplete('search', $('#filialPedidoDeVenda').val());
});
$('#tipo').focus(function() {
    $('#tipo').autocomplete('option', 'minLength', 0);
    $('#tipo').autocomplete('search', $('#tipo').val());
});
$('#cliente').focus(function() {
    $('#cliente').autocomplete('option', 'minLength', 0);
    $('#cliente').autocomplete('search', $('#cliente').val());
});
$('#vendedor').focus(function() {
    $('#vendedor').autocomplete('option', 'minLength', 0);
    $('#vendedor').autocomplete('search', $('#vendedor').val());
});
$('#CondicaoPagamento').focus(function() {
    $('#CondicaoPagamento').autocomplete('option', 'minLength', 0);
    $('#CondicaoPagamento').autocomplete('search', $('#CondicaoPagamento').val());
});
$('#FormaPagamento').focus(function() {
    $('#FormaPagamento').autocomplete('option', 'minLength', 0);
    $('#FormaPagamento').autocomplete('search', $('#FormaPagamento').val());
});
$('#ContaTesouraria').focus(function() {
    $('#ContaTesouraria').autocomplete('option', 'minLength', 0);
    $('#ContaTesouraria').autocomplete('search', $('#ContaTesouraria').val());
});
$('#naturezaOperacao').focus(function() {
    $('#naturezaOperacao').autocomplete('option', 'minLength', 0);
    $('#naturezaOperacao').autocomplete('search', $('#naturezaOperacao').val());
});
$('#frete').focus(function() {
    $('#frete').autocomplete('option', 'minLength', 0);
    $('#frete').autocomplete('search', $('#frete').val());
});
$('#transportador').focus(function() {
    $('#transportador').autocomplete('option', 'minLength', 0);
    $('#transportador').autocomplete('search', $('#transportador').val());
});
$('#tabela').focus(function() {
    $('#tabela').autocomplete('option', 'minLength', 0);
    $('#tabela').autocomplete('search', $('#tabela').val());
});
$('#lista').focus(function() {
    $('#lista').autocomplete('option', 'minLength', 0);
    $('#lista').autocomplete('search', $('#lista').val());
});


    $.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaTipo.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#tipo').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#tipoHandle").val(ui.item.id);
				 
			 },
			 autoFocus: true
   });
   
    });
	

	
	var url = "../../controller/comercial/InserirPedidoDeVendaRecuperaFilial.php";
			
    $.getJSON(url , function(data){
         var dados = [];
		 var handle = [];

		 $('#filialPedidoDeVenda').autocomplete({
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#filialPedidoDeVendaHandle").val(ui.item.id);
			 },
			 autoFocus: true
		 });
	});
   

	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaCliente.php', function(data){
		
		 $('#cliente').autocomplete(
		 {
			 select: function(event, ui) {
				$("#clienteHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaVendedor.php', function(data){
		
		 $('#vendedor').autocomplete(
		 {
			 select: function(event, ui) {
				$("#vendedorHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaCondicaoPagamento.php', function(data){
		
		 $('#CondicaoPagamento').autocomplete(
		 {
			 select: function(event, ui) {
				$("#CondicaoPagamentoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaFormaPagamento.php', function(data){
		
		 $('#FormaPagamento').autocomplete(
		 {
			 select: function(event, ui) {
				$("#FormaPagamentoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaContaTesouraria.php', function(data){
		
		 $('#ContaTesouraria').autocomplete(
		 {
			 select: function(event, ui) {
				$("#ContaTesourariaHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaNaturezaOperacao.php', function(data){
		
		 $('#naturezaOperacao').autocomplete(
		 {
			 select: function(event, ui) {
				$("#naturezaOperacaoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaFrete.php', function(data){
		
		 $('#frete').autocomplete(
		 {
			 select: function(event, ui) {
				$("#freteHandle").val(ui.item.id);
				
				if($("#freteHandle").val() == '4'){
					$('#transportador').attr('disabled', 'true');
					$('#transportador').val('');
					$('#transportador').removeClass('pulaCampoEnter');
					$("#transportadorHandle").val('');
				}
				else{
					$('#transportador').removeAttr('disabled');
					$('#transportador').addClass('pulaCampoEnter');
				}
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaTransportador.php', function(data){
		
		 $('#transportador').autocomplete(
		 {
			 select: function(event, ui) {
				$("#transportadorHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });

	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaTabela.php', function(data){
		
		 $('#tabela').autocomplete(
		 {
			 select: function(event, ui) {
				$("#tabelaHandle").val(ui.item.id);
				
				buscaLista(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
		 });
    });

function buscaLista(tabela){
	
	$.getJSON('../../controller/comercial/InserirPedidoDeVendaRecuperaLista.php?tabelaselecionada='+tabela, function(data){
		
		if(data.length > 0){
			$.each(data, function() {
        		$('#lista').val(this.value);
				$('#listaHandle').val(this.id);
    		});
		}
		else{
			$('#lista').val('');
			$('#listaHandle').val('');
		}	   
	});
}
 
	
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
	
	var totalInverso = getMoney('ValorTotal') / (getMoney('quantidade'));
	var quantidade = getMoney('quantidade');
	var totalReembolsoFinal = getMoney('ValorTotal') * getMoney('percentualReembolso') / 100;
	
	if (Number.isNaN(totalReembolsoFinal)){
            totalReembolsoFinal = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(totalInverso)){
    	totalInverso  = 0; // zerando caso seja NaN
	}
	if (Number.isNaN(getMoney('quantidade'))){
            getElement('quantidade').val('1,0000'); // zerando caso seja NaN
	}
    //id('ValorUnitario').value = number_format(totalInverso, 4, ',', '.');
	id('totalReembolso').value = number_format(totalReembolsoFinal , 2, ',', '.');
	id('ValorUnitario').value = number_format(totalInverso, 2, ',', '.');
	id('quantidade').value = number_format(quantidade, 2, ',', '.');
	
	//id('quantidade').value = number_format(quantidade, 4, ',', '.');
	
	if (Number.isNaN(getMoney('quantidade'))){
		id('quantidade').value = number_format('1', 2, ',', '.');
	}
	if (Number.isNaN(getMoney('ValorUnitario'))){
		id('ValorUnitario').value = number_format('1', 2, ',', '.');
	}
}



//limpar campos
function limparcampos(){
	document.getElementById("Pedido").reset();	
}

// Visualiza anexo enviado
var loadFile = function(event) {
var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};

function preview_image() {
	
	$('#loader').removeAttr( 'style' );
		
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
for(var i=0;i<total_file;i++){
	 //input.files[i].name
	 //URL.createObjectURL(event.target.files[i])
	 var nome = event.target.files[i].name.split('.');
	$('#image_preview').append('<tr><td>' + nome[0] + '</td><td width="10%">' + str_data + ' ' + str_hora + '</tr>'); 
}
 document.getElementById('AnexarPedidoDeVendaForm').submit();
}// end preview_image()


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

$(document).on('click', '#GravarPedido', function() {
	
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
		
		document.getElementById('Pedido').submit();	
		
});

$(document).on('click', '#GravarPedidoMobile', function() {
	
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
		
		document.getElementById('Pedido').submit();	
		
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
$("#Pedido :text").add('#data').add('#obs').add('#observacaoUsoInterno').focus(function() {
    var valor = $(this).val();
	
$("#Pedido :text").add('#data').add('#obs').blur(function() {

var editou = $('#editou').val();
if(editou === 'S'){

}
else{
  	if($(this).val() === valor){
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = " <a href='PedidoDeVenda.php'><button id='showLeftPushVoltarForm'><i class='glyphicon glyphicon-menu-left'></i></button></a> ";
		$('#editou').val("N");
		$('#GravarPedido').addClass('display');
		$('button[name="GravarPedido"]').addClass('display');
		$('#Limpar').addClass('display');
		
		$('#GravarPedidoMobile').addClass('display');
		$('button[name="GravarPedidoMobile"]').addClass('display');
		$('#LimparMobile').addClass('display');		
		
		$('#inserirItem').removeAttr('disabled');
	}
	else{
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = " <button id='showLeftPushVoltarForm' data-toggle='modal' data-target='#VoltarModal'><i class='glyphicon glyphicon-menu-left'></i></button> ";
		$('#editou').val("S");
		$('#GravarPedido').removeClass('display');
		$('button[name="GravarPedido"]').removeClass('display');
		$('#Limpar').removeClass('display');
		
		$('#GravarPedidoMobile').removeClass('display');
		$('button[name="GravarPedidoMobile"]').removeClass('display');
		$('#LimparMobile').removeClass('display');
		
		$('#inserirItem').attr('disabled', 'true');
		$('#visualizarItemPedido').attr('disabled', 'true');
		$('#excluirItemPedido').attr('disabled', 'true');
		
		
		$('#excluirItemPedido').attr('disabled', 'true');
		$('#liberarItemPedido').attr('disabled', 'true');
		$('#voltarItemPedido').attr('disabled', 'true');
		$('#cancelarItemPedido').attr('disabled', 'true');
		
		$('#excluirItemPedidoMobile').attr('disabled', 'true');
		$('#liberarItemPedidoMobile').attr('disabled', 'true');
		$('#voltarItemPedidoMobile').attr('disabled', 'true');
		$('#cancelarItemPedidoMobile').attr('disabled', 'true');
	}
}
});
});
});




function VoltarPedidoDeVenda(){

var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();

	window.location.href='../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Voltar&referencia=VisualizarPedidoDeVenda&handle='+handlePedidoDeVenda;
	
}

function LiberarPedidoDeVenda(){
var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();

	window.location.href='../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Liberar&referencia=VisualizarPedidoDeVenda&handle='+handlePedidoDeVenda;
	
}

function ExcluirPedidoDeVenda(){
var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();

	window.location.href='../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Excluir&referencia=VisualizarPedidoDeVenda&handle='+handlePedidoDeVenda;
	
}

function CancelarPedidoDeVenda(){
var motivo = $('#motivo').val();
var handlePedidoDeVenda = $('#handlePedidoDeVenda').val();

	window.location.href='../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Cancelar&referencia=VisualizarPedidoDeVenda&handle='+handlePedidoDeVenda+'&motivo='+motivo;
	
}