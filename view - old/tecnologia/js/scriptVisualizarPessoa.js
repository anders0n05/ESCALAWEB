$(document).ready(function () {
	
$('#visualizarItemPessoa').click(function(){
	var checkItem = $('#checkItem').val().split(';');
	var handleItem = checkItem[0];
	var handlePessoa = checkItem[1];
	window.location.href = '../../view/cadastro/VisualizarItemPessoa.php?item='+handleItem+'&Pessoa='+handlePessoa;
})

	
	
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
        	PessoaAnexoCheck = parseInt($(this).val());
			
			var PessoaAnexoArr = $(this).val().split('-');
			
			//alert(PessoaArr);
			
			for (var i = 0, len = PessoaAnexoCheck.length; i < len; i++) {
				var anexoHandle = PessoaAnexoArr[0];
				var PessoaHandle = PessoaAnexoArr[1];
			}
			
			var anexoHandle = PessoaAnexoArr[0];
			var PessoaHandle = PessoaAnexoArr[1];
		
			//alert(PessoaStatus);
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
		
		  		
			window.location.href = '../../controller/cadastro/VisualizarAnexoDespesaPessoaAnexoController.php?handle='+PessoaHandle+'&anexo='+anexoHandle+'&referencia=DespesaPessoa';
			
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
		
		  		
			window.location.href = '../../controller/cadastro/RemoverDespesaPessoaAnexoController.php?referencia=VisualizarDespesaPessoa&handle='+PessoaHandle+'&anexo='+anexoHandle;
			
		});
		
		  }
		   })
    }
	
	);
	
	
	$("#ehSemNumero").click(function(){
	$("#ehSemNumero").each(function(){
		if ($(this).is(':checked')){
			$("#numeroEndereco").attr('disabled', 'disabled');
			$("#numeroEndereco").val('S/N');
		}
		else{
			$("#numeroEndereco").removeAttr('disabled');
			$("#numeroEndereco").val('');
		}
	});
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


$('#tipo').focus(function() {
    $('#tipo').autocomplete('option', 'minLength', 0);
    $('#tipo').autocomplete('search', $('#tipo').val());
});
$('#ramoAtividade').focus(function() {
    $('#ramoAtividade').autocomplete('option', 'minLength', 0);
    $('#ramoAtividade').autocomplete('search', $('#ramoAtividade').val());
});
$('#setorAtividade').focus(function() {
    $('#setorAtividade').autocomplete('option', 'minLength', 0);
    $('#setorAtividade').autocomplete('search', $('#setorAtividade').val());
});
$('#CondicaoPagamento').focus(function() {
    $('#CondicaoPagamento').autocomplete('option', 'minLength', 0);
    $('#CondicaoPagamento').autocomplete('search', $('#CondicaoPagamento').val());
});
$('#FormaPagamento').focus(function() {
    $('#FormaPagamento').autocomplete('option', 'minLength', 0);
    $('#FormaPagamento').autocomplete('search', $('#FormaPagamento').val());
});
$('#categoriaAtividade').focus(function() {
    $('#categoriaAtividade').autocomplete('option', 'minLength', 0);
    $('#categoriaAtividade').autocomplete('search', $('#categoriaAtividade').val());
});
$('#grupoEmpresarial').focus(function() {
    $('#grupoEmpresarial').autocomplete('option', 'minLength', 0);
    $('#grupoEmpresarial').autocomplete('search', $('#grupoEmpresarial').val());
});
$('#naturalidade').focus(function() {
    $('#naturalidade').autocomplete('option', 'minLength', 0);
    $('#naturalidade').autocomplete('search', $('#naturalidade').val());
});
$('#estadoCivil').focus(function() {
    $('#estadoCivil').autocomplete('option', 'minLength', 0);
    $('#estadoCivil').autocomplete('search', $('#estadoCivil').val());
});
$('#sexo').focus(function() {
    $('#sexo').autocomplete('option', 'minLength', 0);
    $('#sexo').autocomplete('search', $('#sexo').val());
});
$('#escolaridade').focus(function() {
    $('#escolaridade').autocomplete('option', 'minLength', 0);
    $('#escolaridade').autocomplete('search', $('#escolaridade').val());
});
$('#cep').focus(function() {
    $('#cep').autocomplete('option', 'minLength', 0);
    $('#cep').autocomplete('search', $('#cep').val());
});

    $.getJSON('../../controller/cadastro/InserirPessoaRecuperaTipo.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#tipo').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#tipoHandle").val(ui.item.id);
				 var tipoHandle = ui.item.id;
				 
				 if(tipoHandle == '1'){ // fisica
					 $('#fisica-tab').parent('li').removeClass('display');
					 $('#juridica-tab').parent('li').addClass('display');
					 $('#tituloCnpjCpf').html('CPF');
				 }
				 else if(tipoHandle == '2'){// jurídica
					 $('#juridica-tab').parent('li').removeClass('display');
					 $('#fisica-tab').parent('li').addClass('display');
					 $('#tituloCnpjCpf').html('CNPJ');
				 }
				 else if(tipoHandle == '3'){// fisica do exterior
					 $('#fisica-tab').parent('li').addClass('display');
					 $('#juridica-tab').parent('li').addClass('display');
					 $('#tituloCnpjCpf').html('Identificação');
				 }
				 else if(tipoHandle == '4'){// jurídica do exterior
					 $('#fisica-tab').parent('li').addClass('display');
					 $('#juridica-tab').parent('li').addClass('display');
					 $('#tituloCnpjCpf').html('Identificação');
				 }
			 },
			 autoFocus: true
   });
   
    });
	

	
	var url = "../../controller/cadastro/InserirPessoaRecuperaRamoAtividade.php";
			
    $.getJSON(url , function(data){
         var dados = [];
		 var handle = [];

		 $('#ramoAtividade').autocomplete({
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#ramoAtividadeHandle").val(ui.item.id);
				 buscaSetorAtividade(ui.item.id);
			 },
			 autoFocus: true
		 });
	});
	
function buscaSetorAtividade(ramoAtividadeHandle){
	$('#setorAtividade').removeAttr('disabled');
	$('#setorAtividade').val('');
	$('#setorAtividadeHandle').val('');
	//console.log(ramoAtividadeHandle);
	
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaSetorAtividade.php?ramoAtividadeHandle='+ramoAtividadeHandle, function(data){
		
		 $('#setorAtividade').autocomplete(
		 {
			 select: function(event, ui) {
				$("#setorAtividadeHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
		 });
    });
}

	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaFormaPagamento.php', function(data){
		
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
	
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaCondicaoPagamento.php', function(data){
		
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
	
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaCategoriaAtividade.php', function(data){
		
		 $('#categoriaAtividade').autocomplete(
		 {
			 select: function(event, ui) {
				$("#categoriaAtividadeHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });
	
	
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaGrupoEmpresarial.php', function(data){
		
		 $('#grupoEmpresarial').autocomplete(
		 {
			 select: function(event, ui) {
				$("#grupoEmpresarialHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
			
		 });
    });

	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaNaturalidade.php', function(data){
		
		 $('#naturalidade').autocomplete(
		 {
			 select: function(event, ui) {
				$("#naturalidadeHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
		 });
    });

	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaEstadoCivil.php', function(data){
		
		 $('#estadoCivil').autocomplete(
		 {
			 select: function(event, ui) {
				$("#estadoCivilHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
		 });
    });
 
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaSexo.php', function(data){
		
		 $('#sexo').autocomplete(
		 {
			 select: function(event, ui) {
				$("#sexoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
		 });
    });
	
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaEscolaridade.php', function(data){
		
		 $('#escolaridade').autocomplete(
		 {
			 select: function(event, ui) {
				$("#escolaridadeHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data,
			 autoFocus: true
		 });
    });
	
	$.getJSON('../../controller/cadastro/InserirPessoaRecuperaCep.php', function(data){
		
		 $('#cep').autocomplete(
		 {
			 select: function(event, ui) {
				$("#cepHandle").val(ui.item.id);
				$("#logradouro").val(ui.item.LOGRADOURO);
				$("#municipio").val(ui.item.MUNICIPIO);
				$("#municipioHandle").val(ui.item.MUNICIPIOHANDLE);
				$("#estado").val(ui.item.ESTADO);
				$("#estadoHandle").val(ui.item.ESTADOHANDLE);
				$("#bairro").val(ui.item.BAIRRO);
				$("#bairroHandle").val(ui.item.BAIRROHANDLE);
				$("#tipoLogradouro").val(ui.item.TIPOLOGRADOURO);
				$("#tipoLogradouroHandle").val(ui.item.TIPOLOGRADOUROHANDLE);
				$("#estado").val(ui.item.ESTADO);
				$("#estadoHandle").val(ui.item.ESTADOHANDLE);
				$("#pais").val(ui.item.PAIS);
				$("#paisHandle").val(ui.item.PAISHANDLE);
			 },
			 minLength: 0,
			 source: data,
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
	document.getElementById("Pessoa").reset();	
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



function submitPessoaForm(){
	//var teste = document.getElementById('Pessoa').value;
	//alert(teste);
	document.getElementById('Pessoa').submit();	
}


//script modal Pessoa viagem
function ExcluirDespesaPessoa(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPessoa').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var PessoaStatus = PessoaArr[0];
				var PessoaHandle = PessoaArr[0];
			}
			
			var PessoaStatus = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
						
			window.location.href='../../controller/cadastro/ExcluirDespesaPessoaController.php?referencia=DespesaPessoa&handle='+PessoaHandle;
			
	}
		 
})
}

function VoltarDespesaPessoa(){

$(this).find('[name="check[]"]').prop('checked',true);

	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
		
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var PessoaStatus = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			
			var PessoaStatus = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
			
					
			window.location.href='../../controller/cadastro/VoltarDespesaPessoaController.php?referencia=DespesaPessoa&handle='+PessoaHandle;
			
	}
		 
})
}

function LiberarDespesaPessoa(){
	
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPessoa').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var PessoaStatus = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			
			var PessoaStatus = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
						
			window.location.href='../../controller/cadastro/LiberarDespesaPessoaController.php?referencia=DespesaPessoa&handle='+PessoaHandle;
			
	}
		 
})
}

function CancelarDespesaPessoa(){

$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPessoa').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var PessoaStatus = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			
			var PessoaStatus = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
			var motivo = document.getElementById('motivo').value;
			
			window.location.href='../../controller/cadastro/CancelarDespesaPessoaController.php?referencia=DespesaPessoa&handle='+PessoaHandle+'&motivo='+motivo;
			
	}
		 
})
}

function VisualizarPessoa(){
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarPessoa').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			//alert(PessoaCheck);
			var PessoaArr = $(this).val().split(';');
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var PessoaStatus = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			
			var PessoaStatus = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
			window.location.href='../../view/cadastro/VisualizarDespesaPessoa.php?handle='+PessoaHandle+'&referencia=DespesaPessoa';
			
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

$('#Pessoa').multiselect({
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

$(document).on('click', '#GravarPessoa', function() {
	
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
		
		document.getElementById('Pessoa').submit();	
		
});
$(document).on('click', '#GravarPessoaMobile', function() {
	
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
		
		document.getElementById('Pessoa').submit();	
		
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
$("#Pessoa :text").add('#data').add('#obs').focus(function() {
    var valor = $(this).val();
	
$("#Pessoa :text").add('#data').add('#obs').blur(function() {

var editou = $('#editou').val();
if(editou === 'S'){

}
else{
  	if($(this).val() === valor){
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = " <a href='Pessoa.php'><button id='showLeftPushVoltarForm'><i class='glyphicon glyphicon-menu-left'></i></button></a> ";
		$('#editou').val("N");
		$('#GravarPessoa').addClass('display');
		$('button[name="GravarPessoa"]').addClass('display');
		$('#Limpar').addClass('display');
		$('#GravarPessoaMobile').addClass('display');
		$('button[name="GravarPessoaMobile"]').addClass('display');
		$('#LimparMobile').addClass('display');
		$('#inserirItem').removeAttr('disabled');
	}
	else{
		document.getElementById('toggle').innerHTML = "";
		document.getElementById('toggle').innerHTML = " <button id='showLeftPushVoltarForm' data-toggle='modal' data-target='#VoltarModal'><i class='glyphicon glyphicon-menu-left'></i></button> ";
		$('#editou').val("S");
		$('#GravarPessoa').removeClass('display');
		$('button[name="GravarPessoa"]').removeClass('display');
		$('#Limpar').removeClass('display');
		$('#GravarPessoaMobile').removeClass('display');
		$('button[name="GravarPessoaMobile"]').removeClass('display');
		$('#LimparMobile').removeClass('display');
		
		$('#inserirItem').attr('disabled', 'true');
		$('#visualizarItemPessoa').attr('disabled', 'true');
		$('#excluirItemPessoa').attr('disabled', 'true');
		
		
		$('#excluirPessoa').addClass('display');
		$('#liberarPessoa').addClass('display');
		$('#voltarPessoa').addClass('display');
		$('#cancelarPessoa').addClass('display');
		
		$('#excluirPessoaMobile').addClass('display');
		$('#liberarPessoaMobile').addClass('display');
		$('#voltarPessoaMobile').addClass('display');
		$('#cancelarPessoaMobile').addClass('display');
	}
}
});
});
});



function VoltarPessoa(){

var handlePessoa = $('#handlePessoa').val();

	window.location.href='../../controller/cadastro/WebServicePessoaController.php?metodo=Voltar&referencia=VisualizarPessoa&handle='+handlePessoa;
	
}

function LiberarPessoa(){
var handlePessoa = $('#handlePessoa').val();

	window.location.href='../../controller/cadastro/WebServicePessoaController.php?metodo=Liberar&referencia=VisualizarPessoa&handle='+handlePessoa;
	
}

function ExcluirPessoa(){
var handlePessoa = $('#handlePessoa').val();

	window.location.href='../../controller/cadastro/WebServicePessoaController.php?metodo=Excluir&referencia=VisualizarPessoa&handle='+handlePessoa;
	
}

function CancelarPessoa(){
var motivo = $('#motivo').val();
var handlePessoa = $('#handlePessoa').val();

	window.location.href='../../controller/cadastro/WebServicePessoaController.php?metodo=Cancelar&referencia=VisualizarPessoa&handle='+handlePessoa+'&motivo='+motivo;
	
}