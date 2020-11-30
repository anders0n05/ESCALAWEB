$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");

        $(this).addClass("activetr");

        $(this).parent('tr').find('[name="check[]"]').prop('checked', true);

        $('input:radio').each(function () {
            if ($(this).is(':checked')) {
                $('#OcorrenciaCargaDescarga').removeClass('display');
                $('#verObsCargaDescarga').removeClass('display');
            }
        });
    });

    $('#reqtablenewMobile td').dblclick(function () {
        $('#reqtablenewMobile td').removeClass("activetr");

        $(this).addClass("activetr");

        $(this).parent('tr').find('[name="check[]"]').prop('checked', true);

        $('input:radio').each(function () {
            //Verifica qual está selecionado
            if ($(this).is(':checked')) {
                programacaoCheck = parseInt($(this).val());

                $('#OcorrenciaCargaDescargaMobile').removeClass('display');
                $('#VerObsCargaDescargaMobile').removeClass('display');
            }
        });
    });
});

function verObsCargaDescargaFun() {
    $(this).find('[name="check[]"]').prop('checked', true);
    //Executa Loop entre todas as radio buttons com o name de check 
    $('input:radio').each(function () {
        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            programacaoCheck = parseInt($(this).val());

            var programacaoArr = $(this).val().split('-');
            for (var i = 0, len = programacaoCheck.length; i < len; i++) {

                var programacaoHandleRadio = programacaoArr[0];
            }

            var programacaoHandleRadio = programacaoArr[1];

            //envio ajax para recuperar a observação da carga e descarga
            jQuery.ajax({
                type: "POST",
                url: "../../controller/operacional/BaixarCargaDescargaRecuperaObs.php?h=" + programacaoHandleRadio,
                success: function (data) {
                    var json = $.parseJSON(data);
                    if (json.retorno > '') {
                        $('#verObsModal').modal('show');
                        $('#verObsModalConteudo').html(json.retorno);
                    }
                }
            });
            return false;
        }
    });
}

function OcorrenciaCargaDescargaFun() {
    $(this).find('[name="check[]"]').prop('checked', true);

    //Executa Loop entre todas as radio buttons com o name de check 
    $('input:radio').each(function () {
        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            programacaoCheck = parseInt($(this).val());

            var programacaoArr = $(this).val().split('-');
            for (var i = 0, len = programacaoCheck.length; i < len; i++) {

                var programacaoHandleRadio = programacaoArr[0];
            }

            var programacaoHandleRadio = programacaoArr[1];
            //alert(programacaoHandleRadio);
            $('#carregamento').val(programacaoHandleRadio);
            $('#BaixarModal').modal('show');
        }
    });
}

//***Define Multiselect
function multiselection() {

    $('#pedido').multiselect({
        columns: 1,
        search: true
    });

}

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

function limpaform() {
    $('input').val('');

    $('option').removeAttr('selected');
    $('button#btnMultiselect').text("   ").attr({ title: "Limpou" });
}

function clickdownTipoVeiculo() {
    $('#tipoVeiculo').autocomplete('option', 'minLength', 0);
    $('#tipoVeiculo').autocomplete('search', $('#tipoVeiculo').val());
}
;

function clickdownTipoOcorrencia() {
    $('#tipoOcorrencia').autocomplete('option', 'minLength', 0);
    $('#tipoOcorrencia').autocomplete('search', $('#tipoOcorrencia').val());
}
;

function clickdownProgDoca() {
    $('#progDoca').autocomplete('option', 'minLength', 0);
    $('#progDoca').autocomplete('search', $('#progDoca').val());

}
;

function clickdownUfVeiculo() {
    $('#ufVeiculo').autocomplete('option', 'minLength', 0);
    $('#ufVeiculo').autocomplete('search', $('#ufVeiculo').val());
}
;
function clickdownConteiner() {
    $('#conteiner').autocomplete('option', 'minLength', 0);
    $('#conteiner').autocomplete('search', $('#conteiner').val());
}
;
function clickdownTipoEquipamento() {
    $('#tipoEquipamento').autocomplete('option', 'minLength', 0);
    $('#tipoEquipamento').autocomplete('search', $('#tipoEquipamento').val());
}
;
function clickdownCodigoISO() {
    $('#codigoISO').autocomplete('option', 'minLength', 0);
    $('#codigoISO').autocomplete('search', $('#codigoISO').val());
}
;

function clickdownPropriedadeVeiculo() {
    $('#propriedadeVeiculo').autocomplete('option', 'minLength', 0);
    $('#propriedadeVeiculo').autocomplete('search', $('#propriedadeVeiculo').val());
}
;

function clickdownTransportadora() {
    $('#transportadora').autocomplete('option', 'minLength', 0);
    $('#transportadora').autocomplete('search', $('#transportadora').val());
}

// Recupera Tipo
$(document).ready(function () {

    $.getJSON('../../controller/operacional/retornaTransportadoraFiltro.php?search=', {ajax: 'true'}, function (data) {

        $('#transportadora').autocomplete(
                {
                    select: function (event, ui) {
                        $("#transportadoraHandle").val(ui.item.id);
                    },
                    minLength: 0,
                    source: data
                });
    });

    $('#inserirConteiner').click(function () {
        $('#inserirConteinerModal').modal('show');
    });

    jQuery('#formModalInserirConteiner').submit(function () {
        $('#loader').removeAttr('style');

        //console.log('teste');
        var dados = jQuery(this).serialize();
        //console.log(dados);
        jQuery.ajax({
            type: "POST",
            url: "../../controller/operacional/InserirConteinerProgramacaoCargaDescarcaController.php",
            //dataType : 'json', 
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {

                var json = jQuery.parseJSON(data);

                //console.log(json);

                $('#retornoModal').modal('show');
                $('#retornoModal-body').html(json.retorno);

                $('#conteiner').val(json.conteiner);
                $('#conteinerHandle').val(json.conteinerHandle);

                $('#retornoModalOk').click(function () {
                    $('#inserirConteinerModal').modal('toggle');
                });

                $('#loader').css('display', 'none');
            }
        });
        return false;
    });
});