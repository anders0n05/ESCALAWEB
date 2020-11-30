// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");
		
        $(this).addClass("activetr");
		
        $(this).parent('tr').find('[name="check[]"]').prop('checked',true);
		
		
		$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	viagem = parseInt($(this).val());
			
			var viagemArr = $(this).val().split(';');
			
			//alert(despesaArr);
			
			for (var i = 0, len = viagem.length; i < len; i++) {
				var numero = viagemArr[0];
				var viagemHandle = viagemArr[1];
				var EHDESPESA = viagemArr[2];
			}
			var numero = viagemArr[0];
			var viagemHandle = viagemArr[1];
			var EHDESPESA = viagemArr[2];
			var viagemStatus = viagemArr[3];
		/*		
		alert(numero);
		alert(viagemHandle);
		alert(EHDESPESA);
		*/
		
		if((EHDESPESA == 'S') && (viagemStatus != '6') && (viagemStatus != '7')){
			$('#adicionarDespesa').removeClass('display');
		}
		else{
			$('#adicionarDespesa').addClass('display');
		}

		   }
		
    })
	
	})
	
	
	$('#reqtablenewMobile tr').dblclick(function () {
        $('#reqtablenewMobile tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		
		
		$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	viagem = parseInt($(this).val());
			
			var viagemArr = $(this).val().split(';');
			
			//alert(despesaArr);
			
			for (var i = 0, len = viagem.length; i < len; i++) {
				var numero = viagemArr[0];
				var viagemHandle = viagemArr[1];
				var EHDESPESA = viagemArr[2];
			}
			var numero = viagemArr[0];
			var viagemHandle = viagemArr[1];
			var EHDESPESA = viagemArr[2];
			var viagemStatus = viagemArr[3];
		/*		
		alert(numero);
		alert(viagemHandle);
		alert(EHDESPESA);
		*/
		
		if((EHDESPESA == 'S') && (viagemStatus != '6') && (viagemStatus != '7')){
			$('#adicionarDespesaMobile').removeClass('display');
		}
		else{
			$('#adicionarDespesaMobile').addClass('display');
		}

		   }
		
    })
	
	})
});

// Recupera Tipo
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirDespesaViagemRecuperaTipo.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#tipo').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				 $("#tipoHandle").val(ui.item.id)
		}     
   });
    });
});

// Recupera Status tabela OP_STATUSVIAGEMDESPESA
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirDespesaViagemRecuperaStatus.php', function(data){
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
    $.getJSON('../../controller/operacional/InserirDespesaViagemRecuperaViagem.php', function(data){
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


//Recupera Despesa
$(document).ready(function() {
	// Captura o retorno do retornaCliente.php
    $.getJSON('../../controller/operacional/InserirDespesaViagemRecuperaDespesa.php', function(data){
         var dados = [];
		 var handle = [];

		 $('#despesa').autocomplete({ 
			 source: data, 
			 minLength: 0,
			 select: function(event, ui) {
				$("#despesaHandle").val(ui.item.id)
			
		}     
   });
    });
});


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
function clickdownDespesa() {
    $('#despesa').autocomplete('option', 'minLength', 0);
    $('#despesa').autocomplete('search', $('#despesa').val());
};

$(document).ready(function() {

  $('#adicionarDespesa').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
         if ($(this).is(':checked')){
        	viagemCheck = parseInt($(this).val());
			
			var viagemArr = $(this).val().split(';');
			
			//alert(despesaArr);
			
			for (var i = 0, len = viagemCheck.length; i < len; i++) {
				var numero = viagemArr[0];
				var handle = viagemArr[0];
			}
			
			var numero = viagemArr[0];
			var handle = viagemArr[1];
   			
			 window.location.href = 'InserirDespesaViagem.php?numero='+numero+'&handle='+handle+'&referencia=Viagem';
		 }
		 
  });
	})
	
	$('#adicionarDespesaMobile').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
         if ($(this).is(':checked')){
        	viagemCheck = parseInt($(this).val());
			
			var viagemArr = $(this).val().split(';');
			
			//alert(despesaArr);
			
			for (var i = 0, len = viagemCheck.length; i < len; i++) {
				var numero = viagemArr[0];
				var handle = viagemArr[0];
			}
			
			var numero = viagemArr[0];
			var handle = viagemArr[1];
   			
			 window.location.href = 'InserirDespesaViagem.php?numero='+numero+'&handle='+handle+'&referencia=Viagem';
		 }
		 
  });
	})
});

$(document).ready(function() {

  $('#editarDespesa').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked'))
        viagem = parseInt($(this).val());
    })
      
    bootbox.confirm("Você deseja alterar a despesa da viagem "+viagem+"?", function(result) {
      //alert("Confirm result: " + result);
	  if(result == true){
	  	window.location.href='../operacional/AlterarDespesaViagem.php?numeroViagem='+viagem;
	  }
    });
  });
});

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

$('#despesa').multiselect({
    columns: 1,
    search: true
});

$('#tipo').multiselect({
    columns: 1,
    search: true
});

}


function limpaform(){
	$('input[type=datetime-local]').valueAsDate = '0000-00-00 00:00';
	$('option').removeAttr('selected');
	$('button#btnMultiselect').text("   ").attr({
			title:"Limpou"
});

}
