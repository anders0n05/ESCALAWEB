// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");
		
        $(this).addClass("activetr");
		
        $(this).parent('tr').find('[name="check[]"]').prop('checked',true);
		
		
		$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	inLoco = parseInt($(this).val());
			
			var inLocoArr = $(this).val().split(';');
			
			
			
			for (var i = 0, len = inLoco.length; i < len; i++) {
				var status = inLocoArr[0];
				var inLocoHandle = inLocoArr[1];
			}
			var status = inLocoArr[0];
			var inLocoHandle = inLocoArr[1];
		
			$('#adicionarDespesa').removeClass('display');
		   }
		
    });
	
	})
	
	$('#reqtablenewMobile tr').dblclick(function () {
        $('#reqtablenewMobile tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		
		
		$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	inLoco = parseInt($(this).val());
			
			var inLocoArr = $(this).val().split(';');
			
			
			
			for (var i = 0, len = inLoco.length; i < len; i++) {
				var status = inLocoArr[0];
				var inLocoHandle = inLocoArr[1];
			}
			var status = inLocoArr[0];
			var inLocoHandle = inLocoArr[1];
		
			$('#adicionarDespesaMobile').removeClass('display');
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
function clickdowninLoco() {
    $('#inLoco').autocomplete('option', 'minLength', 0);
    $('#inLoco').autocomplete('search', $('#inLoco').val());
};
function clickdownDespesa() {
    $('#despesa').autocomplete('option', 'minLength', 0);
    $('#despesa').autocomplete('search', $('#despesa').val());
};

$(document).ready(function() {

  $('button#adicionarDespesa').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
         if ($(this).is(':checked')){
        	inLocoCheck = parseInt($(this).val());
			
			var inLocoArr = $(this).val().split(';');
			
			for (var i = 0, len = inLocoCheck.length; i < len; i++) {
				var status = inLocoArr[0];
				var handle = inLocoArr[1];
			}
			
			var status = inLocoArr[0];
			var handle = inLocoArr[1];
   			
			 window.location.href = 'InserirDespesaInLoco.php?handle='+handle+'&referencia=AtendimentoInLoco';
		 }
		 
	});
  });
  
  $('button#adicionarDespesaMobile').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
         if ($(this).is(':checked')){
        	inLocoCheck = parseInt($(this).val());
			
			var inLocoArr = $(this).val().split(';');
			
			for (var i = 0, len = inLocoCheck.length; i < len; i++) {
				var status = inLocoArr[0];
				var handle = inLocoArr[1];
			}
			
			var status = inLocoArr[0];
			var handle = inLocoArr[1];
   			
			 window.location.href = 'InserirDespesaInLoco.php?handle='+handle+'&referencia=AtendimentoInLoco';
		 }
		 
	});
  });
});

$(document).ready(function() {

  $('#editarDespesa').click(function() {
	  
     //Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked'))
        inLoco = parseInt($(this).val());
    })
      
    bootbox.confirm("Você deseja alterar a despesa da inLoco "+inLoco+"?", function(result) {
      //alert("Confirm result: " + result);
	  if(result == true){
	  	window.location.href='../operacional/AlterarDespesaInLoco.php?numeroinLoco='+inLoco;
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

$('#tecnico').multiselect({
    columns: 1,
    search: true
});

$('#cliente').multiselect({
    columns: 1,
    search: true
});

$('#filial').multiselect({
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
