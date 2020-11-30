$(function () {
    $("#PRIORIDADE option:eq(2)").attr("selected", "selected");

    $('#FormOrdem').submit(function () {
        var data = $(this).serializeArray();

        $('#loader').removeAttr('style');

        $.ajax({
            url: "/model/ordemvenda/GravaOrdem.php",
            method: "POST",
            dataType: 'JSON',
            data: data,
            success: function (retorno) {
                $('#loader').hide();
                swal({
                    title: "Sucesso!",
                    text: "Sua ordem de venda foi criada com sucesso.",
                    icon: "success",
                    timer: 3000,
                    button: false
                }).then(function () {
                    window.location.href = '/view/ordemvenda/OrdemVendaListar.php?ordem=' + retorno;
                });
            },
            error: function (retorno) {
                bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                    beforeSend: function (report) {
                        report.updateMetaData('Dados enviados', {
                            "DADOS": data
                        })
                    }
                });

                $('#loader').hide();
                swal({
                    title: "Oopss!",
                    text: "Não foi possível criar a sua ordem de venda: " + retorno.responseJSON.message,
                    icon: "error",
                    timer: 3000,
                    button: false
                });
            }
        });
        return false;
    });

    $('#TIPO').on('change', function () {
        $condicaopagamento = $(this).find("option:selected").data('condicaopagamento');
        $formapagamento = $(this).find("option:selected").data('formapagamento');
        $contatesouraria = $(this).find("option:selected").data('contatesouraria');
        $tabelapreco = $(this).find("option:selected").data('tabelapadrao');
        $permitirsemtabela = $(this).find("option:selected").data('permitirsemtabela');

        if ($permitirsemtabela == 'S') {
            $("#VALORUNITARIO").removeAttr('disabled');
        } else {
            $("#VALORUNITARIO").attr('disabled', 'disabled');
        }

        if ($condicaopagamento) {
            $('#CONDICAOPAGAMENTO option[value="' + $condicaopagamento + '"]').attr('selected', 'selected')
        } else {
            $("#CONDICAOPAGAMENTO option:selected").prop("selected", false)
        }

        if ($formapagamento) {
            $('#FORMAPAGAMENTO option[value="' + $formapagamento + '"]').attr('selected', 'selected')
        } else {
            $("#FORMAPAGAMENTO option:selected").prop("selected", false)
        }

        if ($contatesouraria) {
            $('#CONTATESOURARIA option[value="' + $contatesouraria + '"]').attr('selected', 'selected')
        } else {
            $("#CONTATESOURARIA option:selected").prop("selected", false)
        }

        if ($tabelapreco) {
            $('#TABELAPRECO option[value="' + $tabelapreco + '"]').attr('selected', 'selected');

            $.ajax({
                url: "/model/ordemvenda/PegaItem.php",
                method: "POST",
                dataType: 'JSON',
                data: {
                    'tabela': $tabelapreco
                },
                success: function (retorno) {
                    $("#ITEM option:enabled").remove();
                    $.each(retorno, function (key, val) {
                        $('#ITEM').append(
                            $('<option>', {
                                value: val.HANDLE
                            }).text(val.NOME).attr('data-unidademedida', val.UNIDADEMEDIDA).attr('data-valor', val.VALOR).attr('data-marca', val.MARCA)
                        );
                    });

                    $("#ITEMVER option:enabled").remove();
                    $.each(retorno, function (key, val) {
                        $('#ITEMVER').append(
                            $('<option>', {
                                value: val.HANDLE
                            }).text(val.NOME).attr('data-unidademedida', val.UNIDADEMEDIDA).attr('data-valor', val.VALOR).attr('data-marca', val.MARCA)
                        );
                    });
                }
            });
        }
    });

    $('.datahora').mask('00/00/0000 00:00:00');
    $('.data').mask('00/00/0000');
    $('.horas').mask('00:00');
    $('.dinheiro').mask("#.##0,00", {
        reverse: true
    });

    $('form').keypress(function (e) {
        var code = e.keyCode || e.which;

        if (code === 13) {
            return false
        };
    });

    $(".btnFechar").click(function () {
        window.history.back();
    });
    
    $("#TIPOFRETE").on('change', function () {
        if ($(this).find("option:selected").val() == 4) {
            $("#TIPOTRANSPORTE").attr('disabled', 'disabled');
            $("#TRANSPORTADORA").attr('disabled', 'disabled');
        } else {
            $("#TIPOTRANSPORTE").removeAttr('disabled');
            $("#TRANSPORTADORA").removeAttr('disabled');
        }
    });
});