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
        	romaneioCheck = parseInt($(this).val());
			
			var romaneioArr = $(this).val().split('-');
			
			//alert(romaneioArr);
			
			for (var i = 0, len = romaneioCheck.length; i < len; i++) {
				var romaneioStatus = romaneioArr[0];
				var romaneioHandle = romaneioArr[0];
			}
			
			var romaneioStatus = romaneioArr[0];
			var romaneioHandle = romaneioArr[1];
		
			//alert(romaneioStatus);
		$('#baixarRomaneio').removeClass('display');
				
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
        	romaneioCheck = parseInt($(this).val());
			
			var romaneioArr = $(this).val().split('-');
			
			//alert(romaneioArr);
			
			for (var i = 0, len = romaneioCheck.length; i < len; i++) {
				var romaneioStatus = romaneioArr[0];
				var romaneioHandle = romaneioArr[0];
			}
			
			var romaneioStatus = romaneioArr[0];
			var romaneioHandle = romaneioArr[1];
		
			//alert(romaneioStatus);
		$('#baixarRomaneioMobile').removeClass('display');
				
		  }
		   })
    }
	
	);
});


function BaixarRomaneioTransporte(){
$(this).find('[name="check[]"]').prop('checked',true);
//$('#adicionarOcorrencia').removeAttr("hidden");
	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	romaneioCheck = parseInt($(this).val());
			
			var romaneioArr = $(this).val().split('-');
			for (var i = 0, len = romaneioCheck.length; i < len; i++) {
				var romaneioStatus = romaneioArr[0];
				var romaneioHandle = romaneioArr[0];
			}
			
			var romaneioStatus = romaneioArr[0];
			var romaneioHandle = romaneioArr[1];
			
			window.location.href='../../view/operacional/InserirOcorrenciaTransporte.php?romaneio='+romaneioHandle+'&referencia=RomaneioTransporte';
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

$('#romaneio').multiselect({
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
