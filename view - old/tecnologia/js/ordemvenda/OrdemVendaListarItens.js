$(function () {
    var tableItens = $('#ItensTable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "paging": false,
        "ordering": false,
        "info": false,
        "searching": false,
        "ajax": {
            "url": "../../model/ordemvenda/ListaItensOrdem.php",
            "data": {
                "ordem": $("#ORDEM").val()
            }
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        },
        "drawCallback": function () {
            if (tableItens.row().count() == 0) {
                $("#AdicionarAjuste").attr("disabled", "disabled");
            } else {
                $("#AdicionarAjuste").removeAttr("disabled");
            }
        },
        "columns": [{
                "data": "STATUSIMAGE",
                "orderable": false,
                "responsivePriority": 1
            }, {
                "data": "SEQUENCIAL",
                "orderable": false
            },
            {
                "data": "ITEM",
                "orderable": false,
                "responsivePriority": 2
            },
            {
                "data": "UNIDADEMEDIDA",
                "orderable": false
            },
            {
                "data": "QUANTIDADE",
                "orderable": false
            },
            {
                "data": "VALORUNITARIO",
                "orderable": false,
                "class": "text-right"
            },
            {
                "data": "VALORTOTAL",
                "orderable": false,
                "class": "text-right",
                "responsivePriority": 3
            },
            {
                "data": "VALORAJUSTE",
                "orderable": false,
                "class": "text-right"
            },
            {
                "data": "TOTALGERAL",
                "orderable": false,
                "class": "text-right"
            }
        ]
    });

    $("#QUANTIDADE, #VALORUNITARIO").on('change', function () {
        calculaValoresItens();
    });

    $("#QUANTIDADEVER, #VALORUNITARIOVER").on('change', function () {
        calculaValoresItensVer();
    });

    $('#ItensTable tbody').on('click', 'tr', function () {
        if ($(this).find(".dataTables_empty").length > 0) {
            return false;
        }

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            resetaBotoes();
        } else {
            tableItens.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            VerificaStatusItem(parseInt(tableItens.row(this).data().STATUS));
        }
    });

    $('#ItensTable tbody').on('dblclick', 'tr', function () {
        if ($(this).find(".dataTables_empty").length > 0) {
            return false;
        }

        PegaDadosItem(tableItens.row(this).data().HANDLE);
    });

    $("#ITEM, #ITEMVER").on('change', function () {
        $unidademedida = $(this).find("option:selected").data('unidademedida');
        $marca = $(this).find("option:selected").data('marca');
        $valor = $(this).find("option:selected").data('valor');
        $item = $(this).find("option:selected").val();

        if ($marca) {
            $('#MARCA option[value="' + $marca + '"]').attr('selected', 'selected');
            $('#MARCAVER option[value="' + $marca + '"]').attr('selected', 'selected');
        } else {
            $("#MARCA option:selected").prop("selected", false)
            $("#MARCAVER option:selected").prop("selected", false)
        }

        $('#UNIDADEMEDIDA option[value="' + $unidademedida + '"]').attr('selected', 'selected');
        $('#UNIDADEMEDIDAVER option[value="' + $unidademedida + '"]').attr('selected', 'selected');
        $('#VALORUNITARIO').val($valor).trigger("change");
        $('#VALORUNITARIOVER').val($valor).trigger("change");

        $.ajax({
            url: "../../model/ordemvenda/PegaVariacao.php",
            method: "POST",
            dataType: 'JSON',
            data: {
                'item': $item
            },
            success: function (retorno) {
                $("#VARIACAO option:enabled").remove();
                $.each(retorno, function (key, val) {
                    $('#VARIACAO').append(
                        $('<option>', {
                            value: val.HANDLE
                        }).text(val.NOME)
                    );
                });

                $("#VARIACAOVER option:enabled").remove();
                $.each(retorno, function (key, val) {
                    $('#VARIACAOVER').append(
                        $('<option>', {
                            value: val.HANDLE
                        }).text(val.NOME)
                    );
                });

                if (retorno.length == 0) {
                    $('#VARIACAO').removeAttr('required');
                    $('#VARIACAOVER').removeAttr('required');
                } else {
                    $('#VARIACAO').attr('required', 'required');
                    $('#VARIACAOVER').attr('required', 'required');
                }

                if ($('#VARIACAO > option:enabled').length == 1) {
                    $('#VARIACAO option:eq(1)').attr('selected', 'selected');
                    $('#VARIACAO').attr('disabled', 'disabled');
                    $('#VARIACAOVER option:eq(1)').attr('selected', 'selected');
                    $('#VARIACAOVER').attr('disabled', 'disabled');
                } else {
                    $('#VARIACAO').removeAttr('disabled');
                    $('#VARIACAOVER').removeAttr('disabled');
                }

                $("#VARIACAOVER option:enabled").remove();
                $.each(retorno, function (key, val) {
                    $('#VARIACAOVER').append(
                        $('<option>', {
                            value: val.HANDLE
                        }).text(val.NOME)
                    );
                });
            }
        });
    });

    $("#FormItem").submit(function () {
        var data = $(this).serializeArray(),
            form = $(this);

        $('#loader').removeAttr('style');

        $.ajax({
            url: "../../model/ordemvenda/GravaOrdemItem.php",
            method: "POST",
            dataType: "JSON",
            data: data,
            success: function (retorno) {
                $('#loader').hide();
                $("#ModalAdicionarItem").modal('toggle');
                form.trigger('reset');
                tableItens.draw();

                PegaDadosItem(retorno.HANDLE);
            },
            error: function (retorno) {
                bugsnagClient.notify(new Error(retorno.responseText), {
                    beforeSend: function (report) {
                        report.updateMetaData('Dados enviados', {
                            "DADOS": data
                        })
                    }
                });

                $('#loader').hide();

                swal({
                    title: "Oopss!",
                    text: "Não foi possível criar seu item: " + retorno.responseText,
                    icon: "error",
                    timer: 3000,
                    button: false
                });
            }
        });
        return false;
    });

    $("#AdicionarAjusteItem").on('click', function () {
        $("#ModalAdicionarAjusteItem").modal('toggle');
    });

    $("#AdicionarAjusteItemEditando").on('click', function () {
        $("#ModalAdicionarAjusteItemEditando #ITEM").val($("#FormItemVer #POS").val());
        $("#ModalAdicionarAjusteItemEditando").modal('toggle');
    });

    $('#ModalVerItem').on('hidden.bs.modal', function () {
        $(this).find("form")[0].reset();

        $("#AjusteItemTableVer tbody").remove();
        $("#AjusteItemTableVer").DataTable().clear();
        $("#AjusteItemTableVer").DataTable().destroy();
    });

    // Operações
    $(".EditarItem").on('click', function () {
        PegaDadosItem(tableItens.rows('.selected').data()[0].HANDLE);
    });

    $(".VoltarItem").on('click', function () {
        VoltarItem(tableItens.rows('.selected').data()[0].HANDLE, tableItens);
    });

    $(".CancelarItem").on('click', function () {
        CancelarItem(tableItens.rows('.selected').data()[0].HANDLE, tableItens);
    });

    $(".ExcluirItem").on('click', function () {
        excluirItem(tableItens.rows('.selected').data()[0].HANDLE, tableItens);
    });

    $(".LiberarItem").on('click', function () {
        LiberarItem(tableItens.rows('.selected').data()[0].HANDLE, tableItens);
    });

    $(".GravarItem").on('click', function () {
        AlterarItem(tableItens);
    });

    $(".VerItem").on('click', function () {
        PegaDadosItem(tableItens.rows('.selected').data()[0].HANDLE);
    });

    $("#AdicionarItem").on('click', function () {
        $("#ModalAdicionarItem").modal('toggle');
    });

    resizeTable($(window).width(), tableItens, [1, 3, 4, 5, 6, 7]);
    $(window).resize(function () {
        resizeTable($(window).width(), tableItens, [1, 3, 4, 5, 6, 7]);
    });
});

function VoltarItem(item, tabela) {
    swal({
        title: "Deseja voltar o item?",
        text: "O item ficará disponível para edição.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiVoltar) {
        if (vaiVoltar) {
            $('#loader').removeAttr('style');

            $.ajax({
                url: "../../model/ordemvenda/voltar/VoltarItem.php",
                method: "POST",
                data: {
                    "ITEM": item,
                    "ORDEM": $("#ORDEM").val()
                },
                success: function (retorno) {
                    resetaBotoes();
                    tabela.draw();
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    "ITEM": item,
                                    "ORDEM": $("#ORDEM").val()
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível voltar o item: " + retorno.responseText,
                        icon: "error",
                        timer: 3000,
                        button: false
                    });
                }
            });
        }
    });
}

function LiberarItem(item, tabela) {
    swal({
        title: "Deseja liberar o item?",
        text: "O item da ordem de venda será liberado.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiLiberar) {
        if (vaiLiberar) {
            $('#loader').removeAttr('style');

            $.ajax({
                url: "../../model/ordemvenda/liberar/LiberarItem.php",
                method: "POST",
                data: {
                    "ITEM": item,
                    "ORDEM": $("#ORDEM").val()
                },
                success: function (retorno) {
                    resetaBotoes();
                    tabela.draw();
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    "ITEM": item,
                                    "ORDEM": $('#ORDEM').val()
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível liberar o item da ordem de venda : " + retorno.responseText,
                        icon: "error"
                    });
                }
            });
        }
    });
}

function excluirItem(item, tabela) {
    swal({
        title: "Deseja excluir o item?",
        text: "Deseja realmente excluir o registro?.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiVoltar) {
        if (vaiVoltar) {
            $('#loader').removeAttr('style');

            $.ajax({
                url: "../../model/ordemvenda/excluir/ExcluirItem.php",
                method: "POST",
                data: {
                    "ITEM": item,
                    "ORDEM": $("#ORDEM").val()
                },
                success: function (retorno) {
                    resetaBotoes();
                    tabela.draw();
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    "ITEM": item,
                                    "ORDEM": $("#ORDEM").val()
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível excluir o seu item: " + retorno.responseText,
                        icon: "error",
                        timer: 3000,
                        button: false
                    });
                }
            });
        }
    });
}

function CancelarItem(item, tabela) {
    swal({
        text: 'Motivo do cancelamento',
        content: "input",
        dangerMode: true,
        buttons: ["Fechar", "Cancelar"],
    }).then(motivo => {
        if (!motivo) {
            swal({
                title: "Motivo inválido!",
                text: "Você precisa informar um motivo para cancelar o item.",
                icon: "info",
                timer: 3000,
                button: false
            });
        } else {
            $('#loader').removeAttr('style');
            $.ajax({
                url: "../../model/ordemvenda/cancelar/CancelaItem.php",
                method: "POST",
                data: {
                    'item': item,
                    'motivo': motivo,
                    'ordem': $("#ORDEM").val()
                },
                success: function (retorno) {
                    resetaBotoes();
                    tabela.draw();
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    "ITEM": item,
                                    "MOTIVO": motivo,
                                    "ORDEM": $("#ORDEM").val()
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível cancelar o item: " + retorno.responseText,
                        icon: "error",
                        timer: 3000,
                        button: false
                    });
                }
            });
        }
    });
}

function AlterarItem(tabela) {
    var dados = $("#FormItemVer").serializeArray();

    dados.push({
        'name': "HANDLE",
        'value': $("#FormItemVer #POS").val()
    });

    dados.push({
        'name': "ORDEM",
        'value': $("#FormOrdem #ORDEM").val()
    });

    dados.push({
        'name': "VALORUNITARIO",
        'value': $("#FormItemVer #VALORUNITARIOVER").val()
    });

    dados.push({
        'name': "VALORTOTAL",
        'value': $("#FormItemVer #VALORTOTALVER").val()
    });

    dados.push({
        'name': "UNIDADEMEDIDA",
        'value': $("#FormItemVer #UNIDADEMEDIDAVER").val()
    });

    dados.push({
        'name': "VARIACAO",
        'value': $("#FormItemVer #VARIACAOVER").val()
    });

    $('#loader').removeAttr('style');

    $.ajax({
        url: "../../model/ordemvenda/alterar/AlteraItem.php",
        method: "POST",
        data: dados,
        success: function (retorno) {
            resetaBotoes();
            tabela.draw();
            $('#loader').hide();
        },
        error: function (retorno) {
            bugsnagClient.notify(new Error(retorno.responseText), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": dados
                    })
                }
            });

            $('#loader').hide();

            swal({
                title: "Oopss!",
                text: "Não foi possível alterar seu item: " + retorno.responseText,
                icon: "error",
                timer: 3000,
                button: false
            });
        }
    });
}

function calculaValoresItensVer(tabelaAjustes = null) {
    var formItem = $("#FormItemVer"),
        valorGeralItem = formItem.find("#TOTALGERALVER"),
        valorTotalItem = formItem.find("#VALORTOTALVER"),
        valorUnitarioItem = formItem.find("#VALORUNITARIOVER"),
        quantidadeItem = formItem.find("#QUANTIDADEVER"),
        ajustes = null;

    if (tabelaAjustes) {
        ajustes = tabelaAjustes.rows().data();
    }

    valorItem = valorUnitarioItem.cleanVal() * quantidadeItem.val();

    valorTotalItem.val(valorItem).trigger('input');

    $.each(ajustes, function (key, dado) {
        switch (dado.TIPO) {
            case 1:
                valorItem = valorItem + dado.VALORCLEAN
                break;
            case 2:
                valorItem = valorItem - dado.VALORCLEAN
                break;
        }
    });

    valorGeralItem.val(valorItem).trigger('input');
}

function calculaValoresItens(tabelaAjustes = null) {
    var formItem = $("#FormItem"),
        valorGeralItem = formItem.find("#VALORGERAL"),
        valorTotalItem = formItem.find("#VALORTOTAL"),
        valorUnitarioItem = formItem.find("#VALORUNITARIO"),
        quantidadeItem = formItem.find("#QUANTIDADE"),
        ajustes = null;

    if (tabelaAjustes) {
        ajustes = tabelaAjustes.rows().data();
    }

    valorItem = valorUnitarioItem.cleanVal() * quantidadeItem.val();

    valorTotalItem.val(valorItem).trigger('input');

    $.each(ajustes, function (key, dado) {
        switch (dado.TIPO) {
            case 1:
                valorItem = valorItem + dado.VALORCLEAN
                break;
            case 2:
                valorItem = valorItem - dado.VALORCLEAN
                break;
        }
    });

    valorGeralItem.val(valorItem).trigger('input');
}

function pegaItens(tabela) {
    $.ajax({
        url: "../../model/ordemvenda/PegaItem.php",
        method: "POST",
        dataType: 'JSON',
        data: {
            'tabela': tabela
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

function VerificaStatusItem(status) {
    desativaBotao([
        ".EditarItem",
        ".CancelarItem",
        ".VoltarItem",
        ".ExcluirItem",
        ".LiberarItem",
        ".VerItem",
        ".GravarItem",
    ], true);

    bloqueiaCampo([
        "#ITEMVER",
        "#VARIACAOVER",
        "#QUANTIDADEVER",
        "#OBSERVACAOVER",
    ]);

    switch (status) {
        case 1: //Cadastrado
            ativaBotao([
                '.LiberarItem',
                '.EditarItem',
                '.ExcluirItem',
                '.GravarItem',
            ], true);

            desbloqueiaCampo([
                "#ITEMVER",
                "#VARIACAOVER",
                "#QUANTIDADEVER",
                "#OBSERVACAOVER",
            ]);
            break;
        case 2: //Ag. Modificações
            ativaBotao([
                '.LiberarItem',
                '.EditarItem',
                '.CancelarItem',
                '.GravarItem',
            ], true);

            desbloqueiaCampo([
                "#ITEMVER",
                "#VARIACAOVER",
                "#QUANTIDADEVER",
                "#OBSERVACAOVER",
            ]);
            break;
        default:
            desativaBotao([
                ".LiberarItem",
                ".CancelarItem",
                ".EditarItem",
                ".GravarItem",
                "#AdicionarAjusteItemEditando",
            ], true);

            ativaBotao([
                '.VoltarItem',
                '.VerItem',
            ], true);
            break;
    }
}

function PegaDadosItem(item) {
    $('#loader').removeAttr('style');
    $.ajax({
        url: "../../model/ordemvenda/PegaDadosItem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "ITEM": item
        },
        success: function (retorno) {
            $('#loader').hide();
            setaDadosItemEdit(retorno);
        },
        error: function (retorno) {
            bugsnagClient.notify(new Error(retorno.responseText), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": {
                            "ITEM": item
                        }
                    })
                }
            });

            $('#loader').hide();

            swal({
                title: "Oopss!",
                text: "Não foi possível alterar seu item: " + retorno.responseText,
                icon: "error",
                timer: 3000,
                button: false
            });
        }
    });
}

function setaDadosItemEdit(dados) {
    $("#ModalVerItem #POS").val(dados.HANDLE);
    $("#ModalVerItem #ITEMVER").val(dados.ITEM).trigger('change');
    $("#ModalVerItem #MARCAVER").val(dados.MARCA);
    $("#ModalVerItem #OBSERVACAOVER").val(dados.OBSERVACAO);
    $("#ModalVerItem #QUANTIDADEVER").val(dados.QUANTIDADE);
    $("#ModalVerItem #UNIDADEMEDIDAVER").val(dados.UNIDADEMEDIDA);
    $("#ModalVerItem #VALORTOTALVER").val(dados.TOTALGERAL);
    $("#ModalVerItem #VALORUNITARIOVER").val(dados.VALORUNITARIO);
    $("#ModalVerItem #TOTALGERALVER").val(dados.TOTALGERAL);
    $("#ModalVerItem #VARIACAOVER").val(dados.VARIACAO);
    $("#ModalVerItem #AJUSTEVER").val(dados.VALORAJUSTE);


    VerificaStatusItem(parseInt(dados.STATUS));

    tableAjustesItem = $('#AjusteItemTableVer').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "paging": false,
        "ordering": false,
        "info": false,
        "searching": false,
        "ajax": {
            "url": "../../model/ordemvenda/ListaAjustesItemOrdem.php",
            "data": {
                "item": $("#ModalVerItem #POS").val()
            }
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        },
        "columns": [{
                "data": "AJUSTENOME",
                "orderable": false
            },
            {
                "data": "TIPONOME",
                "orderable": false
            },
            {
                "data": "VALOR",
                "orderable": false,
                "class": "text-right"
            }
        ]
    });

    $('#AjusteItemTableVer tbody').on('dblclick', 'tr', function () {
        $dados = tableAjustesItem.row(this).data();

        if ($dados.EHMANUAL == 'N') {
            $("#ModalAjusteItemVer .CancelarAjuste").attr('disabled', 'disabled');
        } else {
            $("#ModalAjusteItemVer .CancelarAjuste").removeAttr('disabled');

        }

        if ($dados.HANDLE) {
            $("#ModalAjusteItemVer #HANDLE").val($dados.HANDLE);
        }

        $("#ModalAjusteItemVer #POS").val($dados.POS);
        $("#ModalAjusteItemVer #AJUSTENOME").val($dados.AJUSTENOME);
        $("#ModalAjusteItemVer #TIPONOME").val($dados.TIPONOME);
        $("#ModalAjusteItemVer #VALORAJUSTEITEM").val($dados.VALOR);

        $("#ModalAjusteItemVer").modal('toggle');
    });

    $("#ModalVerItem").modal('toggle');
}

function resetaBotoes() {
    desativaBotao([
        ".EditarItem",
        ".CancelarItem",
        ".VoltarItem",
        ".ExcluirItem",
        ".LiberarItem",
        ".VerItem",
        ".GravarItem",
    ], true);
}