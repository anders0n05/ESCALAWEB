// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {
        //$('#reqtablenew td').removeClass("activetr");
	
		if($(this).hasClass("activetr")){
        	$(this).removeClass("activetr");
			$(this).parent('tr').find('[name="check[]"]').prop('checked',false);
		}
		else{
			$(this).addClass("activetr");
			$(this).parent('tr').find('[name="check[]"]').prop('checked',true);
		}
		
        $(this).parent('tr').find('[name="check[]"]').prop('checked',true);
		
		$('input:checkbox').each(function() {
    	//Verifica qual está selecionado
		
        if ($(this).is(':checked')){
			
        	AprovacaoHandle = parseInt($(this).val());
			
			//alert(AprovacaoHandle);
			
			$('#aprovar').removeClass('display');
			$('#recusar').removeClass('display');
			
			//alert(AprovacaoHandle);
		}  
    })
	})
	
$('#reqtablenewMobile tr').dblclick(function () {
        //$('#reqtablenew tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked',true);
		
		$('input:checkbox').each(function() {
    	//Verifica qual está selecionado
        if ($(this).is(':checked')){
        	Pessoa = parseInt($(this).val());
			
			var PessoaArr = $(this).val().split(';');
			
			for (var i = 0, len = Pessoa.length; i < len; i++) {
				var status = PessoaArr[0];
				var PessoaHandle = PessoaArr[1];
			}
			var status = PessoaArr[0];
			var PessoaHandle = PessoaArr[1];
		
			$('#aprovarMobile').removeClass('display');
			$('#recusarMobile').removeClass('display');
		   }
    });
	
	})
});

function groupBy(items,propertyName)
{
    var result = [];
    $.each(items, function(index, item) {
       if ($.inArray(item[propertyName], result)==-1) {
          result.push(item[propertyName]);
       }
    });
    return result;
}
/*
function RecusarValor(){
	document.getElementById('acao').value = '';
	document.getElementById('acao').value = 'recusar';
}
function AprovarValor(){
	document.getElementById('acao').value = '';
	document.getElementById('acao').value = 'aprovar';
}
*/

function Aprovar(){
	document.getElementById('aprovacaoForm').action = '../../controller/administracao/Aprovar.php?ref=Aprovacao';
	document.getElementById('aprovacaoForm').submit();
}
function Recusar(){
	document.getElementById('aprovacaoForm').action = '../../controller/administracao/Recusar.php?ref=Aprovacao';
	document.getElementById('aprovacaoForm').submit();
}

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

//***Define Multiselect
function multiselection(){

$('#empresa').multiselect({
    columns: 1,
    search: true
});

$('#filial').multiselect({
    columns: 1,
    search: true
});

$('#origem').multiselect({
    columns: 1,
    search: true
});

$('#alcada').multiselect({
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
