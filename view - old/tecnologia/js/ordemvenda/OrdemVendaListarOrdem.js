$(function () {
    pegaDadosOrdem();

    $(".EditarOrdem").on('click', function () {
        desbloqueiaCampo([
            "#PRIORIDADE",
            "#FORMAPAGAMENTO",
            "#CONDICAOPAGAMENTO",
            "#OBSERVACAO",
            "#TIPOFRETE",
            "#TIPOTRANSPORTE",
            "#TRANSPORTADORA",
        ]);

        desativaBotao([
            ".EditarOrdem",
            ".CancelarOrdem",
            ".LiberarOrdem",
        ], true);

        ativaBotao([
            ".GravarOrdem",
            ".LimparOrdem",
        ], true);

        $(".itemArea").addClass('hidden');
        $(".ajusteArea").addClass('hidden');
    });

    //----------- Operações ----------//
    $(".LiberarOrdem").on('click', function () {
        LiberarOrdem();
    });

    $(".VoltarOrdem").on('click', function () {
        voltarOrdem();
    });

    $(".GravarOrdem").on('click', function () {
        gravarAlteracoesOrdem();

        bloqueiaCampo([
            "#PRIORIDADE",
            "#FORMAPAGAMENTO",
            "#CONDICAOPAGAMENTO",
            "#OBSERVACAO",
            "#TIPOFRETE",
            "#TIPOTRANSPORTE",
            "#TRANSPORTADORA",
        ]);

        ativaBotao([
            ".EditarOrdem",
            ".LiberarOrdem",
            ".CancelarOrdem",
        ], true);

        desativaBotao([
            ".GravarOrdem",
            ".LimparOrdem",
        ], true);

        $(".itemArea").removeClass('hidden');
        $(".ajusteArea").removeClass('hidden');
    });

    $(".LimparOrdem").on('click', function () {
        pegaDadosOrdem();

        bloqueiaCampo([
            "#PRIORIDADE",
            "#FORMAPAGAMENTO",
            "#CONDICAOPAGAMENTO",
            "#OBSERVACAO",
            "#TIPOFRETE",
            "#TIPOTRANSPORTE",
            "#TRANSPORTADORA",
        ]);

        ativaBotao([
            ".EditarOrdem",
            ".LiberarOrdem",
            ".CancelarOrdem"
        ], true);

        desativaBotao([
            ".GravarOrdem",
            ".LimparOrdem",
        ], true);

        $(".itemArea").removeClass('hidden');
        $(".ajusteArea").removeClass('hidden');
    });

    $('.CancelarOrdem').click(function () {
        CancelarOrdem();
    });
});

function LiberarOrdem() {
    swal({
        title: "Deseja liberar as ordens de venda?",
        text: "As ordens de venda serão liberadas.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiLiberar) {
        if (vaiLiberar) {
            $('#loader').removeAttr('style');

            var ordens = [];

            ordens.push($("#ORDEM").val());

            $.ajax({
                url: "../../model/ordemvenda/liberar/LiberarOrdem.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    "ordens": ordens
                },
                success: function (retorno) {
                    $('#loader').hide();
                    location.reload();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    "ORDENS": ordens
                                }
                            });
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: retorno.responseJSON.message,
                        icon: "error"
                    });
                }
            });
        }
    });
}

function CancelarOrdem() {
    swal({
        text: 'Motivo do cancelamento',
        content: "input",
        dangerMode: true,
        buttons: ["Fechar", "Cancelar"],
    }).then(motivo => {
        if (!motivo) {
            swal({
                title: "Motivo inválido!",
                text: "Você precisa informar um motivo para cancelar a ordem de venda.",
                icon: "info",
                timer: 3000,
                button: false
            });
        } else {
            $('#loader').removeAttr('style');

            var ordens = [];

            ordens.push($("#ORDEM").val());

            $.ajax({
                url: "../../model/ordemvenda/cancelar/CancelaOrdem.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    'ordens': ordens,
                    'motivo': motivo
                },
                success: function (retorno) {
                    $('#loader').hide();
                    location.reload();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'ORDEM': $("#ORDEM").val(),
                                    'MOTIVO': motivo,
                                }
                            });
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível cancelar a ordem de venda: " + retorno.responseText,
                        icon: "error",
                        timer: 3000,
                        button: false
                    });
                }
            });
        }
    });
}

function voltarOrdem() {
    swal({
        title: "Deseja voltar as ordens de venda?",
        text: "A ordem de venda ficará disponível para edição.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiVoltar) {
        if (vaiVoltar) {
            $('#loader').removeAttr('style');

            var ordens = [];

            ordens.push($("#ORDEM").val());

            $.ajax({
                url: "../../model/ordemvenda/voltar/VoltarOrdem.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    "ordens": ordens
                },
                success: function (retorno) {
                    $('#loader').hide();
                    location.reload();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'ORDEM': $("#ORDEM").val(),
                                }
                            });
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: retorno.responseJSON.message,
                        icon: "error",
                        timer: 3000,
                        button: false
                    });
                }
            });
        }
    });
}

function pegaDadosOrdem() {
    $.ajax({
        url: "../../model/ordemvenda/PegaDadosOrdem.php",
        method: "POST",
        dataType: 'JSON',
        data: {
            'ordem': $("#CHAVE").val()
        },
        success: function (retorno) {
            $.each(retorno, function (key, val) {
                $(".container #" + key).val(val);
            });

            VerificaStatusOrdem(parseInt(retorno.STATUS));

            pegaItens($("#TABELAPRECO").val());

            if ($("#TIPO option:selected").data('permitirsemtabela') == 'S') {
                $("#VALORUNITARIO").removeAttr("disabled")
                $("#VALORUNITARIOVER").removeAttr("disabled")
            }
        }
    });
}

function gravarAlteracoesOrdem(tabela) {
    $('#loader').removeAttr('style');

    var dados = $("#FormOrdem").serializeArray();

    $.ajax({
        url: "../../model/ordemvenda/alterar/AlterarOrdem.php",
        method: "POST",
        data: dados,
        success: function (retorno) {
            $('#loader').hide();
        },
        error: function (retorno) {
            bugsnagClient.notify(new Error(retorno.responseText), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": dados
                    });
                }
            });

            $('#loader').hide();

            swal({
                title: "Oopss!",
                text: "Não foi possível alterar a ordem: " + retorno.responseText,
                icon: "error",
                timer: 3000,
                button: false
            });
        }
    });
}