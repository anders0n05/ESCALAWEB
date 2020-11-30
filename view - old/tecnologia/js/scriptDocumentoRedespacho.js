// seleciona checkbox ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew tr').dblclick(function () {
        //$('#reqtablenew td').removeClass("activetr");
		var checkboxAnterior = $(this).find('[name="check[]"]');
		
		if (checkboxAnterior.is(':checked')){
			$(this).removeClass("activetr");
			$(this).find('[name="check[]"]').prop('checked',false);
		}
		else{
			$(this).addClass("activetr");
			$(this).find('[name="check[]"]').prop('checked',true);
		}
	
		var documentoHandle = $('#documentoHandle').val();
		$('#documentoHandle').val(documentoHandle+';'+$(this).find('[name="check[]"]').val());
        //console.log($(this).find('[name="check[]"]').val());
		 	
	//Executa Loop entre todas as checkbox buttons com o name de check 
	$('input:checkbox').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	var documentoCheck = parseInt($(this).val());
			
			var documentoArr = $(this).val().split('-');
			
			var documentoStatusRadio = documentoArr[0];
			var documentoHandleRadio = documentoArr[1];
			
			$('#BaixarDocumentoRedespacho').removeClass('display');
				
		}
		   })
    }
	
	);
	
	
	 
	$('#reqtablenewMobile tr').dblclick(function () {
        var checkboxAnterior = $(this).find('[name="check[]"]');
		
		if (checkboxAnterior.is(':checked')){
			$(this).removeClass("activetr");
			$(this).find('[name="check[]"]').prop('checked',false);
		}
		else{
			$(this).addClass("activetr");
			$(this).find('[name="check[]"]').prop('checked',true);
		}
		var documentoHandle = $('#documentoHandle').val();
		$('#documentoHandle').val(documentoHandle+';'+$(this).find('[name="check[]"]').val());
				 	
	//Executa Loop entre todas as checkbox buttons com o name de check 
	$('input:checkbox').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	documentoCheck = parseInt($(this).val());
			
			var documentoArr = $(this).val().split('-');
			
			//alert(documentoArr);
			
			for (var i = 0, len = documentoCheck.length; i < len; i++) {
				var documentoStatusRadio = documentoArr[0];
				var documentoHandleRadio = documentoArr[1];
			}
			
			var documentoStatusRadio = documentoArr[0];
			var documentoHandleRadio = documentoArr[1];
		
			//alert(documentoStatus);
		$('#BaixarDocumentoRedespachoMobile').removeClass('display');
				
		  }
		   })
    }
	
	);
});


function BaixarDocumentoRedespachoFun(){
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as checkbox buttons com o name de check 
	$('input:checkbox').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	documentoCheck = parseInt($(this).val());
			
			var documentoArr = $(this).val().split('-');
			for (var i = 0, len = documentoCheck.length; i < len; i++) {
				var documentoStatusRadio = documentoArr[0];
				var documentoHandleRadio = documentoArr[0];
			}
			
			var documentoStatusRadio = documentoArr[0];
			var documentoHandleRadio = documentoArr[1];
			
			$('#BaixarModal').modal('show');
	}
		 
})
}

//***Define Multiselect
function multiselection(){
	
$('#filial').multiselect({
    columns: 1,
    search: true
});

$('#destinatario').multiselect({
    columns: 1,
    search: true
});

$('#documento').multiselect({
    columns: 1,
    search: true
});

$('#viagem').multiselect({
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


function clickdownTipoOcorrencia() {
    $('#tipoOcorrencia').autocomplete('option', 'minLength', 0);
    $('#tipoOcorrencia').autocomplete('search', $('#tipoOcorrencia').val());
};
	
function clickdownMotivoAtraso() {
    $('#motivoAtraso').autocomplete('option', 'minLength', 0);
    $('#motivoAtraso').autocomplete('search', $('#motivoAtraso').val());
};
	
function clickdownResponsavel() {
    $('#responsavel').autocomplete('option', 'minLength', 0);
    $('#responsavel').autocomplete('search', $('#responsavel').val());
};

// Recupera Tipo
$(document).ready(function() {
	
	$.getJSON('../../controller/operacional/BaixarDocumentoRedespachoRecuperaTipo.php', function(data){
		
		 $('#tipoOcorrencia').autocomplete(
		 {
			 select: function(event, ui) {
				$("#tipoOcorrenciaHandle").val(ui.item.id);
				$("#acaoHandle").val(ui.item.HANDLEACAO);
			 },
			 minLength: 0,
			 source: data
			
		 });
    });
	
});
$(document).ready(function() {
	
	$.getJSON('../../controller/operacional/BaixarDocumentoRedespachoRecuperaMotivoAtraso.php', function(data){
		
		 $('#motivoAtraso').autocomplete(
		 {
			 select: function(event, ui) {
				$("#motivoAtrasoHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data
			
		 });
    });
	
});
$(document).ready(function() {
	
	$.getJSON('../../controller/operacional/BaixarDocumentoRedespachoRecuperaResponsavel.php', function(data){
		
		 $('#responsavel').autocomplete(
		 {
			 select: function(event, ui) {
				$("#responsavelHandle").val(ui.item.id);
			 },
			 minLength: 0,
			 source: data
			
		 });
    });
	
});