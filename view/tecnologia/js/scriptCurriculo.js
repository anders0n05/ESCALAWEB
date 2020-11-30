// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");
		
        $(this).addClass("activetr");
		
        $(this).parent('tr').find('[name="check[]"]').prop('checked',true);
		
		$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	Pessoa = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			
			for (var i = 0, len = Pessoa.length; i < len; i++) {
				var PessoaStatus = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			var PessoaStatus = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
		
			$('#visualizarCurriculo').removeClass('display');
		
			if (PessoaStatus == '1'){
				//Botoes grid
				$('#liberarPessoa').removeClass('display');
				$('#excluirPessoa').removeClass('display');
				
				$('#voltarPessoa').addClass('display');
				$('#cancelarPessoa').addClass('display');
			}
			else if (PessoaStatus == '2'){
				//Botoes grid 
				 $('#liberarPessoa').removeClass('display');
				 $('#cancelarPessoa').removeClass('display');
				 
				 $('#voltarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}
			else if (PessoaStatus == '3'){
				//Botoes grid
				 $('#voltarPessoa').removeClass('display');
				 
				 $('#liberarPessoa').addClass('display');
				 $('#cancelarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}
			else if (PessoaStatus == '4'){
				//Botoes grid
				 $('#voltarPessoa').removeClass('display');
				 
				 $('#liberarPessoa').addClass('display');
				 $('#cancelarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}
			else if (PessoaStatus == '5'){
				//Botoes grid
				 $('#voltarPessoa').removeClass('display');
				 
				 $('#liberarPessoa').addClass('display');
				 $('#cancelarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}		
			else if (PessoaStatus == '6'){
				
				//Botoes grid
				 $('#voltarPessoa').removeClass('display');
				 
				 $('#liberarPessoa').addClass('display');
				 $('#cancelarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}
			else if (PessoaStatus == '7'){
				
				//Botoes grid
				 $('#voltarPessoa').removeClass('display');
				 
				 $('#liberarPessoa').addClass('display');
				 $('#cancelarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}
			else if (PessoaStatus == '8'){
				
				//Botoes grid
				 $('#voltarPessoa').removeClass('display');
				 
				 $('#liberarPessoa').addClass('display');
				 $('#cancelarPessoa').addClass('display');
				 $('#excluirPessoa').addClass('display');
			}		
		   }//if is cheched this radio input
		
    });
	
	})
	
	$('#reqtablenewMobile tr').dblclick(function () {
        $('#reqtablenewMobile tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		
		
		$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	Pessoa = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			
			
			
			for (var i = 0, len = Pessoa.length; i < len; i++) {
				var status = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			var PessoaStatusMobile = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
		
	
			$('#visualizarCurriculoMobile').removeClass('display');
		
			if (PessoaStatusMobile == '1'){
				//Botoes grid
				$('#liberarPessoaMobile').removeClass('display');
				$('#excluirPessoaMobile').removeClass('display');
				
				$('#voltarPessoaMobile').addClass('display');
				$('#cancelarPessoaMobile').addClass('display');
			}
			else if (PessoaStatusMobile == '2'){
				//Botoes grid 
				 $('#liberarPessoaMobile').removeClass('display'); 
				 $('#cancelarPessoaMobile').removeClass('display');
				 
				 $('#voltarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}
			else if (PessoaStatusMobile == '3'){
				//Botoes grid
				 $('#voltarPessoaMobile').removeClass('display');
				 
				 $('#liberarPessoaMobile').addClass('display');
				 $('#cancelarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}
			else if (PessoaStatusMobile == '4'){
				//Botoes grid
				 $('#voltarPessoaMobile').removeClass('display');
				 
				 $('#liberarPessoaMobile').addClass('display');
				 $('#cancelarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}
			else if (PessoaStatusMobile == '5'){
				//Botoes grid
				 $('#voltarPessoaMobile').removeClass('display');
				 
				 $('#liberarPessoaMobile').addClass('display');
				 $('#cancelarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}		
			else if (PessoaStatusMobile == '6'){
				
				//Botoes grid
				 $('#voltarPessoaMobile').removeClass('display');
				 
				 $('#liberarPessoaMobile').addClass('display');
				 $('#cancelarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}
			else if (PessoaStatusMobile == '7'){
				
				//Botoes grid
				 $('#voltarPessoaMobile').removeClass('display');
				 
				 $('#liberarPessoaMobile').addClass('display');
				 $('#cancelarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}
			else if (PessoaStatusMobile == '8'){
				
				//Botoes grid
				 $('#voltarPessoaMobile').removeClass('display');
				 
				 $('#liberarPessoaMobile').addClass('display');
				 $('#cancelarPessoaMobile').addClass('display');
				 $('#excluirPessoaMobile').addClass('display');
			}
			
		   }
		
    });
	
	})
});


function clickdownTipo() {
    $('#tipo').autocomplete('option', 'minLength', 0);
    $('#tipo').autocomplete('search', $('#tipo').val());
};
function clickdownStatus() {
    $('#situacao').autocomplete('option', 'minLength', 0);
    $('#situacao').autocomplete('search', $('#situacao').val());
};
function clickdownPessoa() {
    $('#Pessoa').autocomplete('option', 'minLength', 0);
    $('#Pessoa').autocomplete('search', $('#Pessoa').val());
};
function clickdownPessoa() {
    $('#transportador').autocomplete('option', 'minLength', 0);
    $('#transportador').autocomplete('search', $('#transportador').val());
};

$(document).ready(function() {

 $('button#visualizarCurriculo').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
         if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var status = PessoaArr[0];
				var handle = PessoaArr[1];
			}
			
			var handle = PessoaArr[1];
   			
			 window.location.href = 'VisualizarCurriculo.php?handle='+handle;
			 //window.location.href = 'visualizarCurriculo.php?handle='+codigo;
		 }
		 
	});
 });

 $('button#visualizarCurriculoMobile').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
         if ($(this).is(':checked')){
        	PessoaCheck = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			
			for (var i = 0, len = PessoaCheck.length; i < len; i++) {
				var status = PessoaArr[0];
				var handle = PessoaArr[1];
				var codigo = PessoaArr[2];
			}
			
			var status = PessoaArr[0];
			var handle = PessoaArr[1];
			var codigo = PessoaArr[2];
   			
			 window.location.href = 'visualizarCurriculo.php?handle='+handle+'&codigo='+codigo;
		 }
		 
	});
});
  
   $('button#adicionarPessoa').click(function() {
		 window.location.href = 'InserirCurriculo.php';
   });
   $('button#adicionarPessoaMobile').click(function() {
		 window.location.href = 'InserirCurriculo.php';
   });
});

function limpaform(){
	$('input[type=datetime-local]').valueAsDate = '0000-00-00 00:00';
	$('option').removeAttr('selected');
	$('button#btnMultiselect').text("   ").attr({
			title:"Limpou"
});

}
