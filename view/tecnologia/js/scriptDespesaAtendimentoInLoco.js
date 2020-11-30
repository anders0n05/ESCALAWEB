// seleciona radio ao clicar em <tr>
$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {
        $('#reqtablenew td').removeClass("activetr");

        $(this).addClass("activetr");

        $(this).parent('tr').find('[name="check[]"]').prop('checked', true);

        //Executa Loop entre todas as Radio buttons com o name de check 
        $('input:radio').each(function () {
            //Verifica qual está selecionado
            if ($(this).is(':checked')) {
                InLocoCheck = parseInt($(this).val());

                var InLocoArr = $(this).val().split(';');

                //alert(InLocoArr);

                for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                    var InLocoStatus = InLocoArr[0];
                    var InLocoHandle = InLocoArr[1];
                }

                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[1];


                //alert(InLocoStatus);
                $('#visualizarInLoco').removeClass('display');

                if (InLocoStatus == '1') {
                    //Botoes grid
                    $('#liberarInLoco').removeClass('display');
                    $('#excluirInLoco').removeClass('display');

                    $('#voltarInLoco').addClass('display');
                    $('#cancelarInLoco').addClass('display');
                }
                else if (InLocoStatus == '2') {
                    //Botoes grid 
                    $('#liberarInLoco').removeClass('display');
                    $('#cancelarInLoco').removeClass('display');

                    $('#voltarInLoco').addClass('display');
                    $('#excluirInLoco').addClass('display');
                }
                else if (InLocoStatus == '3') {
                    //Botoes grid
                    $('#voltarInLoco').removeClass('display');

                    $('#liberarInLoco').addClass('display');
                    $('#cancelarInLoco').addClass('display');
                    $('#excluirInLoco').addClass('display');
                }
                else if (InLocoStatus == '4') {
                    //Botoes grid
                    $('#voltarInLoco').removeClass('display');

                    $('#liberarInLoco').addClass('display');
                    $('#cancelarInLoco').addClass('display');
                    $('#excluirInLoco').addClass('display');
                }
                else if (InLocoStatus == '5') {
                    //Botoes grid
                    $('#voltarInLoco').addClass('display');
                    $('#liberarInLoco').addClass('display');
                    $('#cancelarInLoco').addClass('display');
                    $('#excluirInLoco').addClass('display');
                }
                else if (InLocoStatus == '6') {

                    //Botoes grid
                    $('#voltarInLoco').removeClass('display');

                    $('#liberarInLoco').addClass('display');
                    $('#cancelarInLoco').addClass('display');
                    $('#excluirInLoco').addClass('display');
                }

            }
        })
    });

    $('#reqtablenewMobile tr').dblclick(function () {
        $('#reqtablenewMobile tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked', true);
        //Executa Loop entre todas as Radio buttons com o name de check 
        $('input:radio').each(function () {
            //Verifica qual está selecionado
            if ($(this).is(':checked')) {
                InLocoCheck = parseInt($(this).val());

                var InLocoArr = $(this).val().split(';');

                //alert(InLocoArr);

                for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                    var InLocoStatus = InLocoArr[0];
                    var InLocoHandle = InLocoArr[1];
                }

                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[1];



                //alert(InLocoStatus);
                $('#visualizarInLocoMobile').removeClass('display');

                if (InLocoStatus == '1') {
                    //Botoes grid
                    $('#liberarInLocoMobile').removeClass('display');
                    $('#excluirInLocoMobile').removeClass('display');

                    $('#voltarInLocoMobile').addClass('display');
                    $('#cancelarInLocoMobile').addClass('display');
                }
                else if (InLocoStatus == '2') {
                    //Botoes grid 
                    $('#liberarInLocoMobile').removeClass('display');
                    $('#cancelarInLocoMobile').removeClass('display');

                    $('#voltarInLocoMobile').addClass('display');
                    $('#excluirInLocoMobile').addClass('display');
                }
                else if (InLocoStatus == '3') {
                    //Botoes grid
                    $('#voltarInLocoMobile').removeClass('display');

                    $('#liberarInLocoMobile').addClass('display');
                    $('#cancelarInLocoMobile').addClass('display');
                    $('#excluirInLocoMobile').addClass('display');
                }
                else if (InLocoStatus == '4') {
                    //Botoes grid
                    $('#voltarInLocoMobile').removeClass('display');

                    $('#liberarInLocoMobile').addClass('display');
                    $('#cancelarInLocoMobile').addClass('display');
                    $('#excluirInLocoMobile').addClass('display');
                }
                else if (InLocoStatus == '5') {
                    //Botoes grid
                    $('#voltarInLocoMobile').addClass('display');
                    $('#liberarInLocoMobile').addClass('display');
                    $('#cancelarInLocoMobile').addClass('display');
                    $('#excluirInLocoMobile').addClass('display');
                }
                else if (InLocoStatus == '6') {

                    //Botoes grid
                    $('#voltarInLocoMobile').removeClass('display');

                    $('#liberarInLocoMobile').addClass('display');
                    $('#cancelarInLocoMobile').addClass('display');
                    $('#excluirInLocoMobile').addClass('display');
                }

            }
        })
    });

    $('#inserirDespesaMobile').click(function () {
        window.location.href = 'InserirDespesaInLoco.php?referencia=DespesaAtendimentoInloco';
    })

});

$(document).ready(function () {
    $('#reqtableAnexo tr').click(function () {
        $('#reqtableAnexo tr').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).find('[name="check[]"]').prop('checked', true);
        //$('#adicionarOcorrencia').removeAttr("hidden");

        //Executa Loop entre todas as Radio buttons com o name de check 
        $('input:radio').each(function () {
            //Verifica qual está selecionado
            if ($(this).is(':checked')) {
                InLocoAnexoCheck = parseInt($(this).val());

                var InLocoAnexoArr = $(this).val().split('-');

                //alert(InLocoArr);

                for (var i = 0, len = InLocoAnexoCheck.length; i < len; i++) {
                    var anexoHandle = InLocoAnexoArr[0];
                    var InLocoHandle = InLocoAnexoArr[1];
                }

                var anexoHandle = InLocoAnexoArr[0];
                var InLocoHandle = InLocoAnexoArr[1];

                //alert(InLocoStatus);
                $('#visualizarAnexo').removeAttr("disabled");
                $('#removerAnexo').removeAttr("disabled");

                $('#visualizarAnexo').click(function () {
                    $('#loader').removeAttr('style');
                    window.location.href = '../../controller/servicedesk/VisualizarAnexoDespesaInLocoAnexoController.php?handle=' + InLocoHandle + '&anexo=' + anexoHandle + '&referencia=DespesaAtendimentoInLoco';
                });
                $('#removerAnexo').click(function () {
                    $('#loader').removeAttr('style');
                    window.location.href = '../../controller/servicedesk/RemoverDespesaInLocoAnexoController.php?referencia=VisualizarDespesaInLoco&handle=' + InLocoHandle + '&anexo=' + anexoHandle;
                });

            }
        });
    }

    );
});


// Recupera Tipo
$(document).ready(function () {

// formato os numeros para moeda com ponto depois virgula
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep, dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
// Fix for IE parseFloat(0.55).toFixed(0) = 0; 
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }



    $('#tipo').click(function () {
        $('#tipo').autocomplete('option', 'minLength', 0);
        $('#tipo').autocomplete('search', $('#tipo').val());
    });
    $('#despesa').click(function () {
        $('#despesa').autocomplete('option', 'minLength', 0);
        $('#despesa').autocomplete('search', $('#despesa').val());
    });
    $('#inLoco').click(function () {
        $('#inLoco').autocomplete('option', 'minLength', 0);
        $('#inLoco').autocomplete('search', $('#inLoco').val());
    });

    $.getJSON('../../controller/servicedesk/InserirAtendimentoInLocoRecuperaTipo.php', function (data) {
        var dados = [];
        var handle = [];

        $('#tipo').autocomplete({
            source: data,
            minLength: 0,
            select: function (event, ui) {
                $("#tipoHandle").val(ui.item.id);

                var EHALTERAPERCENTUAL = ui.item.EHALTERAPERCENTUAL;
                var PERCENTUALREEMBOLSO = ui.item.PERCENTUALREEMBOLSO;
                var VALORREEMBOLSO = ui.item.VALORREEMBOLSO;
                var DESPESAHANDLE = ui.item.DESPESAHANDLE;
                var DESPESA = ui.item.DESPESA;

                if (DESPESA > '') {
                    $('#despesa').val(DESPESA);
                    $("#despesaHandle").val(DESPESAHANDLE);
                }
                else {
                    $('#despesa').val('');
                    $("#despesaHandle").val('');
                }

                $('#percentualReembolso').attr('disabled');

                $('#percentualReembolso').val(number_format(PERCENTUALREEMBOLSO, 2, ',', '.'));
                $('#totalReembolso').val(number_format(VALORREEMBOLSO, 2, ',', '.'));


                if (EHALTERAPERCENTUAL === 'S') {
                    //alert('permite');
                    $('#percentualReembolso').removeAttr('disabled');
                }
                else {
                    //alert('nao permite');
                    $('#percentualReembolso').attr('disabled', 'true');
                }

            }
        });

    });


});

// Recupera Despesa
$(document).ready(function () {

    $('#despesa').focus(function () {
        var tiposelecionado = $("#tipoHandle").val();
        //alert(tiposelecionado);

        var url = "../../controller/servicedesk/InserirAtendimentoInLocoRecuperaDespesa.php?tiposelecionado=" + tiposelecionado;



        $.getJSON(url, function (data) {
            var dados = [];
            var handle = [];

            $('#despesa').autocomplete({
                source: data,
                minLength: 0,
                select: function (event, ui) {
                    $("#despesaHandle").val(ui.item.id)
                }
            });
        });

    });

});


// Recupera InLoco
$(document).ready(function () {


    $.getJSON('../../controller/servicedesk/InserirAtendimentoInLocoRecuperaInLoco.php?teste=s', function (data) {

        $('#inLoco').autocomplete(
                {
                    select: function (event, ui) {
                        $("#inLocoHandle").val(ui.item.id);
                    },
                    minLength: 0,
                    source: data

                });
    });

});


function limpavalor() {
    var ValorUnitario = document.getElementById('ValorUnitario').value;
    if (ValorUnitario == '0,0000') {
        document.getElementById('ValorUnitario').value = null;
    }
}


// formato os numeros para moeda com ponto depois virgula
function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep, dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
// Fix for IE parseFloat(0.55).toFixed(0) = 0; 
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function id(el) {
    return document.getElementById(el);
}

function getMoney(el) {
    var money = id(el).value.replace(',', '.');
    return parseFloat(money);
}


function getElement(el) {
    return $('#' + el);
}

function calcularValor() {

    var total = getMoney('quantidade') * getMoney('ValorUnitario');
    var ValorUnitario = getMoney('ValorUnitario');


    if (Number.isNaN(total)) {
        total = 0; // zerando caso seja NaN
    }

    if (Number.isNaN(getMoney('ValorUnitario'))) {
        getElement('ValorUnitario').val(0); // zerando caso seja NaN
    }

    id('ValorTotal').value = number_format(total, 2, ',', '.');
    id('ValorUnitario').value = number_format(ValorUnitario, 2, ',', '.');

    var totalReembolsoFinal = getMoney('ValorTotal') * getMoney('percentualReembolso') / 100;
    if (Number.isNaN(totalReembolsoFinal)) {
        totalReembolsoFinal = 0; // zerando caso seja NaN
    }


    id('totalReembolso').value = number_format(totalReembolsoFinal, 2, ',', '.');
}

function calcularPercentual() {

    var total = getMoney('quantidade') * getMoney('ValorUnitario');
    var ValorUnitario = getMoney('ValorUnitario');
    var totalReembolsoFinal = getMoney('ValorTotal') * getMoney('percentualReembolso') / 100;

    if (Number.isNaN(totalReembolsoFinal)) {
        totalReembolsoFinal = 0; // zerando caso seja NaN
    }
    if (Number.isNaN(total)) {
        total = 0; // zerando caso seja NaN
    }
    if (Number.isNaN(totalReembolsoFinal)) {
        totalReembolsoFinal = 0; // zerando caso seja NaN
    }
    if (Number.isNaN(getMoney('ValorUnitario'))) {
        getElement('ValorUnitario').val(0); // zerando caso seja NaN
    }

    id('ValorTotal').value = number_format(total, 2, ',', '.');
    id('ValorUnitario').value = number_format(ValorUnitario, 2, ',', '.');
    id('totalReembolso').value = number_format(totalReembolsoFinal, 2, ',', '.');
}

function calcularInverso() {

    var totalInverso = getMoney('ValorTotal') / (getMoney('quantidade'));
    var quantidade = getMoney('quantidade');
    var totalReembolsoFinal = getMoney('ValorTotal') * getMoney('percentualReembolso') / 100;

    if (Number.isNaN(totalReembolsoFinal)) {
        totalReembolsoFinal = 0; // zerando caso seja NaN
    }
    if (Number.isNaN(totalInverso)) {
        totalInverso = 0; // zerando caso seja NaN
    }
    if (Number.isNaN(getMoney('quantidade'))) {
        getElement('quantidade').val('1,0000'); // zerando caso seja NaN
    }
    //id('ValorUnitario').value = number_format(totalInverso, 4, ',', '.');
    id('totalReembolso').value = number_format(totalReembolsoFinal, 2, ',', '.');
    id('ValorUnitario').value = number_format(totalInverso, 2, ',', '.');
    id('quantidade').value = number_format(quantidade, 2, ',', '.');

    //id('quantidade').value = number_format(quantidade, 4, ',', '.');

    if (Number.isNaN(getMoney('quantidade'))) {
        id('quantidade').value = number_format('1', 2, ',', '.');
    }
    if (Number.isNaN(getMoney('ValorUnitario'))) {
        id('ValorUnitario').value = number_format('1', 2, ',', '.');
    }
}



//limpar campos
function limparcampos() {
    document.getElementById("AtendimentoInLoco").reset();
}

// Visualiza anexo enviado
var loadFile = function (event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};

function preview_image()
{


    $('#loader').removeAttr('style');

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
    var dia = data.getDate();           // 1-31
    if (dia < 10) {
        dia = "0" + dia;
    }
    var dia_sem = data.getDay();            // 0-6 (zero=domingo)
    var mes = data.getMonth();          // 0-11 (zero=janeiro)
    if (mes < 10) {
        mes = "0" + mes;
    }
    var ano2 = data.getYear();           // 2 dígitos
    var ano4 = data.getFullYear();       // 4 dígitos
    var hora = data.getHours();          // 0-23
    if (hora < 10) {
        hora = "0" + hora;
    }
    var min = data.getMinutes();        // 0-59
    if (min < 10) {
        min = "0" + min;
    }
    var seg = data.getSeconds();        // 0-59
    if (seg < 10) {
        seg = "0" + seg;
    }
    var mseg = data.getMilliseconds();   // 0-999
    var tz = data.getTimezoneOffset(); // em minutos

// Formata a data e a hora (note o mês + 1)
    var str_data = dia + '/' + mes + '/' + ano4;
    var str_hora = hora + ':' + min + ':' + seg;


    var total_file = document.getElementById("image_src").files.length;
    for (var i = 0; i < total_file; i++)
    {
        //input.files[i].name
        //URL.createObjectURL(event.target.files[i])
        var nome = event.target.files[i].name.split('.');
        $('#image_preview').append('<tr><td>' + nome[0] + '</td><td width="10%">' + str_data + ' ' + str_hora + '</tr>');
    }

    document.getElementById("InserirAnexoForm").submit();
}


$("#btnImage_src").click(function () {
    $(this).next().trigger('click');
});



function submitAtendimentoInLocoForm() {
    //var teste = document.getElementById('inLoco').value;
    //alert(teste);
    document.getElementById('AtendimentoInLoco').submit();
}


//script modal InLoco viagem
function ExcluirDespesaInLoco() {

    $(this).find('[name="check[]"]').prop('checked', true);
//$('#adicionarInLoco').removeAttr("hidden");
    //Executa Loop entre todas as Radio buttons com o name de check 
    $('input:radio').each(function () {
        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            InLocoCheck = parseInt($(this).val());

            var InLocoArr = $(this).val().split(';');
            for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[0];
            }

            var InLocoStatus = InLocoArr[0];
            var InLocoHandle = InLocoArr[1];

            window.location.href = '../../controller/servicedesk/ExcluirDespesaInLocoController.php?referencia=DespesaAtendimentoInLoco&handle=' + InLocoHandle;

        }

    })
}

function VoltarDespesaInLoco() {

    $(this).find('[name="check[]"]').prop('checked', true);

    //Executa Loop entre todas as Radio buttons com o name de check 
    $('input:radio').each(function () {

        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            InLocoCheck = parseInt($(this).val());

            var InLocoArr = $(this).val().split(';');
            for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[1];
            }

            var InLocoStatus = InLocoArr[0];
            var InLocoHandle = InLocoArr[1];


            window.location.href = '../../controller/servicedesk/VoltarDespesaInLocoController.php?referencia=DespesaAtendimentoInLoco&handle=' + InLocoHandle;

        }

    })
}

function LiberarDespesaInLoco() {

    $(this).find('[name="check[]"]').prop('checked', true);
//$('#adicionarInLoco').removeAttr("hidden");
    //Executa Loop entre todas as Radio buttons com o name de check 
    $('input:radio').each(function () {
        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            InLocoCheck = parseInt($(this).val());

            var InLocoArr = $(this).val().split(';');
            for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[1];
            }

            var InLocoStatus = InLocoArr[0];
            var InLocoHandle = InLocoArr[1];

            window.location.href = '../../controller/servicedesk/LiberarDespesaInLocoController.php?referencia=DespesaAtendimentoInLoco&handle=' + InLocoHandle;

        }

    })
}

function CancelarDespesaInLoco() {

    $(this).find('[name="check[]"]').prop('checked', true);
//$('#adicionarInLoco').removeAttr("hidden");
    //Executa Loop entre todas as Radio buttons com o name de check 
    $('input:radio').each(function () {
        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            InLocoCheck = parseInt($(this).val());

            var InLocoArr = $(this).val().split(';');
            for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[1];
            }

            var InLocoStatus = InLocoArr[0];
            var InLocoHandle = InLocoArr[1];
            var motivo = document.getElementById('motivo').value;

            window.location.href = '../../controller/servicedesk/CancelarDespesaInLocoController.php?referencia=DespesaAtendimentoInLoco&handle=' + InLocoHandle + '&motivo=' + motivo;

        }

    })
}

function VisualizarAtendimentoInLoco() {
    $(this).find('[name="check[]"]').prop('checked', true);
//$('#adicionarInLoco').removeAttr("hidden");
    //Executa Loop entre todas as Radio buttons com o name de check 
    $('input:radio').each(function () {
        //Verifica qual está selecionado
        if ($(this).is(':checked')) {
            InLocoCheck = parseInt($(this).val());
            //alert(InLocoCheck);
            var InLocoArr = $(this).val().split(';');
            for (var i = 0, len = InLocoCheck.length; i < len; i++) {
                var InLocoStatus = InLocoArr[0];
                var InLocoHandle = InLocoArr[1];
            }

            var InLocoStatus = InLocoArr[0];
            var InLocoHandle = InLocoArr[1];
            window.location.href = '../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' + InLocoHandle + '&referencia=DespesaAtendimentoInLoco';

        }

    })
}




//***Define Multiselect
function multiselection() {

    $('#situacao').multiselect({
        columns: 1,
        search: true
    });

    $('#despesa').multiselect({
        columns: 1,
        search: true
    });

    $('#InLoco').multiselect({
        columns: 1,
        search: true
    });

    $('#tipo').multiselect({
        columns: 1,
        search: true
    });

}

// alinha texto do input à esquerda ao focar
$(function () {
    $(".inputClass").focus(function () {
        $(this).removeClass("inputRight");
    });
    $(".inputClass").blur(function () {
        $(this).addClass("inputRight");
    });
});



//01...
// invoke blockUI as needed -->
$(document).on('click', '#sim', function () {


    $('.modal').modal('hide');
    $('#loader').removeAttr('style');

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

$(document).on('click', '#GravarAtendimentoInLoco', function () {

    $('.modal').modal('hide');
    $('#loader').removeAttr('style');

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

    document.getElementById('AtendimentoInLoco').submit();

});
$(document).on('click', '#GravarAtendimentoInLocoMobile', function () {

    $('.modal').modal('hide');
    $('#loader').removeAttr('style');

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

    document.getElementById('AtendimentoInLoco').submit();

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
    $('input[type=datetime-local]').valueAsDate = '0000-00-00 00:00';
    $('option').removeAttr('selected');
    $('button#btnMultiselect').text("   ").attr({
        title: "Limpou"
    });
}


$(document).ready(function () {
    $("#AtendimentoInLoco :text").add('#data').add('#obs').focus(function () {
        var valor = $(this).val();

        $("#AtendimentoInLoco :text").add('#data').add('#obs').blur(function () {

            var editou = $('#editou').val();
            var referencia = $('#referencia').val();

            if (editou === 'S') {

            }
            else {
                if ($(this).val() === valor) {
                    document.getElementById('toggle').innerHTML = "";
                    document.getElementById('toggle').innerHTML = "<a href='" + referencia + ".php'><button id='showLeftPushVoltarForm'><i class='glyphicon glyphicon-menu-left'></i></button></a>";
                    $('#editou').val("N");
                    $('#GravarAtendimentoInLoco').addClass('display');
                    $('button[name="GravarAtendimentoInLoco"]').addClass('display');
                    $('#Limpar').addClass('display');
                    $('#GravarAtendimentoInLocoMobile').addClass('display');
                    $('button[name="GravarAtendimentoInLocoMobile"]').addClass('display');
                    $('#LimparMobile').addClass('display');

                    $('#excluirInLoco').removeClass('display');
                    $('#liberarInLoco').removeClass('display');
                    $('#voltarInLoco').removeClass('display');
                    $('#cancelarInLoco').removeClass('display');
                }
                else {
                    document.getElementById('toggle').innerHTML = "";
                    document.getElementById('toggle').innerHTML = "<button id='showLeftPushVoltarForm' data-toggle='modal' data-target='#VoltarModal'><i class='glyphicon glyphicon-menu-left'></i></button>";
                    $('#editou').val("S");
                    $('#GravarAtendimentoInLoco').removeClass('display');
                    $('button[name="GravarAtendimentoInLoco"]').removeClass('display');
                    $('#Limpar').removeClass('display');
                    $('#GravarAtendimentoInLocoMobile').removeClass('display');
                    $('button[name="GravarAtendimentoInLocoMobile"]').removeClass('display');
                    $('#LimparMobile').removeClass('display');

                    $('#excluirInLoco').addClass('display');
                    $('#liberarInLoco').addClass('display');
                    $('#voltarInLoco').addClass('display');
                    $('#cancelarInLoco').addClass('display');

                    $('#excluirInLocoMobile').addClass('display');
                    $('#liberarInLocoMobile').addClass('display');
                    $('#voltarInLocoMobile').addClass('display');
                    $('#cancelarInLocoMobile').addClass('display');
                }

            }
        });
    });
});

/*
 $('#data').focus(function(){
 $(this).blur();
 });
 */