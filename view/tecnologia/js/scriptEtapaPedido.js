$(document).ready(function () {

    $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");

        $(this).addClass("activetr");

        $(this).parent('tr').find('[name="check[]"]').prop('checked', true);

        $('input:radio').each(function () {
            //Verifica qual está selecionado
            if ($(this).is(':checked')) {
                
                if (parseInt($(this).data('ref')) === 11) {
                    $('#botaoExecutar').removeClass('display');
                } else {
                    $('#botaoExecutar').addClass('display');
                }
            }
        });
    });
});

//aguarde...
// invoke blockUI as needed -->
$(document).on('click', '#sim', function () {
    $('.modal').modal('hide');
    $('#loader').removeAttr('style');
});

/**
 * Vertically center Bootstrap 3 modals so they aren't always stuck at the top
 */
$(function () {
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
    $(window).on('resize', function () {
        $('.modal:visible').each(reposition);
    });
});

function getHandleEtapaPedido() {
    var handle = 0;

    $(this).find('[name="check[]"]').prop('checked', true);

    $('input:radio').each(function () {
        if ($(this).is(':checked')) {
            handle = parseInt($(this).val());
        }
    });

    return handle;
}

function botaoExecutarOnClick() {    
    $('#modalExecutar').modal('show');
}

function executarOnClick() {    
    mostrarCarregando();
    
    jQuery.ajax({
        type: "POST",
        url: "../../controller/rastreamento/AjaxEtapaPedido.php",
        dataType: 'json',
        data: {
            metodo: 'ExecutarEtapaPedido',
            etapaPedido: getHandleEtapaPedido(),
            observacao: $('#observacao').val()
        },
        success: function (data) {
            if (!data.sucesso) {
                mostrarErro(data.mensagem);
                
                fecharCarregando();
            } else {
                $('#formEtapaPedidoFiltro').submit();
            }
        }
    });
}