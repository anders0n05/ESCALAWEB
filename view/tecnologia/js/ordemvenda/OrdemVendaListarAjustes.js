$(function () {
    var tableAjustesItem = null,
        tableAjustes = $('#AjusteTable').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,
            "ajax": {
                "url": "../../model/ordemvenda/ListaAjustesOrdem.php",
                "data": {
                    "ordem": $("#ORDEM").val()
                }
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
            },
            "columns": [{
                    "data": "STATUSIMAGE",
                    "orderable": false
                }, {
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

    $("#ModalAjusteItemVer").submit(function () {
        if ($("#ModalAjusteItemVer #HANDLE").val().length > 0) {
            swal({
                text: 'Motivo do cancelamento',
                content: "input",
                dangerMode: true,
                buttons: ["Fechar", "Cancelar"],
            }).then(motivo => {
                if (!motivo) {
                    swal({
                        title: "Motivo inválido!",
                        text: "Você precisa informar um motivo para cancelar o ajuste.",
                        icon: "info",
                        timer: 3000,
                        button: false
                    });
                } else {
                    $('#loader').removeAttr('style');
                    $.ajax({
                        url: "../../model/ordemvenda/cancelar/CancelaAjusteItem.php",
                        method: "POST",
                        data: {
                            'ajuste': $("#ModalAjusteItemVer #HANDLE").val(),
                            'motivo': motivo,
                            'ordem': $("#ORDEM").val(),
                            'item': $("#POS").val(),
                        },
                        success: function (retorno) {
                            $('#loader').hide();
                            swal({
                                title: "Sucesso!",
                                text: "Ajuste cancelado com sucesso.",
                                icon: "success",
                                timer: 3000,
                                button: false
                            }).then(function () {
                                location.reload();
                            });
                        },
                        error: function (retorno) {
                            bugsnagClient.notify(new Error(retorno.responseText), {
                                beforeSend: function (report) {
                                    report.updateMetaData('Dados enviados', {
                                        "DADOS": {
                                            'AJUSTE': $("#ModalAjusteItemVer #HANDLE").val(),
                                            'MOTIVO': motivo,
                                            'ORDEM': $("#ORDEM").val(),
                                            'ITEM': $("#POS").val(),
                                        }
                                    })
                                }
                            });

                            $('#loader').hide();

                            swal({
                                title: "Oopss!",
                                text: "Não foi possível cancelar seu ajuste: " + retorno.responseText,
                                icon: "error",
                                timer: 3000,
                                button: false
                            });
                        }
                    });
                }
            });

        }

        $("#ModalAjusteItemVer").modal('toggle');

        return false;
    });

    $("#AdicionarAjuste").click(function () {
        $("#ModalAdicionarAjuste").modal('toggle');
    });

    $("#AJUSTEFINANCEIROITEM, #AJUSTEFINANCEIRO, #AJUSTEFINANCEIROVER").on('change', function () {
        $modal = $(this).closest('.modal');
        $valor = $(this).find("option:selected").data('tiponome');

        $modal.find("#TIPONOME").val($valor);
    });

    $('#FormAjusteItem').submit(function () {
        var ajuste = {
            'POS': ajusteItens.length,
            'AJUSTENOME': $("#FormAjusteItem #AJUSTEFINANCEIROITEM option:selected").text(),
            'AJUSTE': $("#FormAjusteItem #AJUSTEFINANCEIROITEM").val(),
            'TIPONOME': $("#FormAjusteItem #AJUSTEFINANCEIROITEM option:selected").data('tiponome'),
            'TIPO': $("#FormAjusteItem #AJUSTEFINANCEIROITEM option:selected").data('tipo'),
            'VALOR': $("#FormAjusteItem #VALORAJUSTEITEM").val(),
            'VALORCLEAN': $("#FormAjusteItem #VALORAJUSTEITEM").cleanVal(),
        };

        ajusteItens.push(ajuste);

        tableAjusteItem.rows.add([ajuste]).draw();

        calculaValoresItens(tableAjusteItem);

        $('#FormAjusteItem')[0].reset();
        return false;
    });

    $('#FormAjuste').submit(function () {
        var data = $(this).serializeArray();

        $('#loader').removeAttr('style');
        $.ajax({
            url: "../../model/ordemvenda/GravaOrdemAjuste.php",
            method: "POST",
            data: data,
            success: function (retorno) {
                $('#loader').hide();
                swal({
                    title: "Sucesso!",
                    text: "Seu ajuste foi salvo com sucesso.",
                    icon: "success",
                    timer: 3000,
                    button: false
                }).then(function () {
                    location.reload();
                });
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
                    text: "Não foi possível criar seu ajuste: " + retorno.responseText,
                    icon: "error",
                    timer: 3000,
                    button: false
                });
            }
        });
        return false;
    });

    $('#FormAjusteItemEditando').submit(function () {
        var data = $(this).serializeArray();

        data.push({
            "name": "ORDEM",
            "value": $("#ORDEM").val()
        });

        $('#loader').removeAttr('style');

        $.ajax({
            url: "../../model/ordemvenda/GravaOrdemAjusteItem.php",
            method: "POST",
            data: data,
            success: function (retorno) {
                $('#loader').hide();
                swal({
                    title: "Sucesso!",
                    text: "Seu ajuste foi salvo com sucesso.",
                    icon: "success",
                    timer: 3000,
                    button: false
                }).then(function () {
                    location.reload();
                });
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
                    text: "Não foi possível criar seu ajuste: " + retorno.responseText,
                    icon: "error",
                    timer: 3000,
                    button: false
                });
            }
        });
        return false;
    });

    $('#AjusteTable tbody').on('click', 'tr', function () {
        if ($(this).find(".dataTables_empty").length > 0) {
            return false;
        }

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            desativaBotao([
                ".EditarAjuste",
                ".CancelarAjuste",
                ".VoltarAjuste",
                ".ExcluirAjuste",
                ".LiberarAjuste",
                ".VerAjuste",
                ".GravarAjuste",
            ], true);
        } else {
            tableAjustes.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            VerificaStatusAjuste(parseInt(tableAjustes.row(this).data().STATUS));
        }
    });

    $('#AjusteTable tbody').on('dblclick', 'tr', function () {
        if ($(this).find(".dataTables_empty").length > 0) {
            return false;
        }

        $dados = tableAjustes.row(this).data();

        PegaAjusteEdit($dados);
        VerificaStatusAjuste(parseInt($dados.STATUS));

        resetaBotoesAjuste();
    });

    // Operações
    $(".LiberarAjuste").on('click', function () {
        LiberarAjuste(tableAjustes.rows('.selected').data()[0].HANDLE, tableAjustes);
    });

    $(".VoltarAjuste").on('click', function () {
        VoltarAjuste(tableAjustes.rows('.selected').data()[0].HANDLE, tableAjustes);
    });

    $(".VerAjuste").on('click', function () {
        PegaAjusteEdit(tableAjustes.rows('.selected').data()[0]);
    });

    $(".EditarAjuste").on('click', function () {
        PegaAjusteEdit(tableAjustes.rows('.selected').data()[0]);
    });

    $(".ExcluirAjuste").on('click', function () {
        ExcluirAjuste(tableAjustes.rows('.selected').data()[0].HANDLE, tableAjustes);
    });

    $(".CancelarAjuste").on('click', function () {
        CancelarAjuste(tableAjustes.rows('.selected').data()[0].HANDLE, tableAjustes);
    });

    $(".GravarAjuste").on('click', function () {
        AlterarAjuste(tableAjustes);
    });
});

function PegaAjusteEdit(dados) {
    if (dados.HANDLE) {
        $("#ModalAjusteVer #HANDLE").val(dados.HANDLE);
    }

    $("#ModalAjusteVer #POS").val(dados.POS);
    $("#ModalAjusteVer #AJUSTEFINANCEIROVER").val(dados.AJUSTEFINANCEIRO);
    $("#ModalAjusteVer #TIPONOME").val(dados.TIPONOME);
    $("#ModalAjusteVer #VALORAJUSTEITEMVER").val(dados.VALOR);

    $("#ModalAjusteVer").modal('toggle');
}

function LiberarAjuste(ajuste, tabela) {
    swal({
        title: "Deseja liberar o ajuste?",
        text: "O ajuste da ordem de venda será liberado.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiLiberar) {
        if (vaiLiberar) {
            $('#loader').removeAttr('style');
            $.ajax({
                url: "../../model/ordemvenda/liberar/LiberarAjuste.php",
                method: "POST",
                data: {
                    "AJUSTE": ajuste,
                    "ORDEM": $("#ORDEM").val()
                },
                success: function (retorno) {
                    tabela.draw();
                    resetaBotoesAjuste()
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'AJUSTE': ajuste,
                                    'ORDEM': $("#ORDEM").val(),
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível liberar o ajuste da ordem de venda : " + retorno.responseText,
                        icon: "error"
                    });
                }
            });
        }
    });
}

function ExcluirAjuste(ajuste, tabela) {
    swal({
        title: "Deseja excluir o ajuste?",
        text: "Deseja realmente excluir o registro?",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiLiberar) {
        if (vaiLiberar) {
            $('#loader').removeAttr('style');
            $.ajax({
                url: "../../model/ordemvenda/excluir/ExcluirAjuste.php",
                method: "POST",
                data: {
                    "AJUSTE": ajuste,
                    "ORDEM": $("#ORDEM").val()
                },
                success: function (retorno) {
                    tabela.draw();
                    resetaBotoesAjuste()
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'AJUSTE': ajuste,
                                    'ORDEM': $("#ORDEM").val(),
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível excluir o ajuste da ordem de venda : " + retorno.responseText,
                        icon: "error"
                    });
                }
            });
        }
    });
}

function CancelarAjuste(ajuste, tabela) {
    swal({
        text: 'Motivo do cancelamento',
        content: "input",
        dangerMode: true,
        buttons: ["Fechar", "Cancelar"],
    }).then(motivo => {
        if (!motivo) {
            swal({
                title: "Motivo inválido!",
                text: "Você precisa informar um motivo para cancelar o ajuste.",
                icon: "info",
                timer: 3000,
                button: false
            });
        } else {
            $('#loader').removeAttr('style');
            $.ajax({
                url: "../../model/ordemvenda/cancelar/CancelarAjuste.php",
                method: "POST",
                data: {
                    'AJUSTE': ajuste,
                    'MOTIVO': motivo,
                    'ORDEM': $("#ORDEM").val()
                },
                success: function (retorno) {
                    tabela.draw();
                    resetaBotoesAjuste()
                    $('#loader').hide();
                },
                error: function (retorno) {

                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'AJUSTE': ajuste,
                                    'MOTIVO': motivo,
                                    'ORDEM': $("#ORDEM").val(),
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível cancelar o ajuste: " + retorno.responseText,
                        icon: "error",
                        timer: 3000,
                        button: false
                    });
                }
            });
        }
    });
}

function VoltarAjuste(ajuste, tabela) {
    swal({
        title: "Deseja voltar o ajuste?",
        text: "O ajuste ficará disponível para edição.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiLiberar) {
        if (vaiLiberar) {
            $('#loader').removeAttr('style');
            $.ajax({
                url: "../../model/ordemvenda/voltar/VoltarAjuste.php",
                method: "POST",
                data: {
                    "AJUSTE": ajuste,
                    "ORDEM": $("#ORDEM").val()
                },
                success: function (retorno) {
                    tabela.draw();
                    resetaBotoesAjuste()
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseText), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'AJUSTE': ajuste,
                                    'ORDEM': $("#ORDEM").val(),
                                }
                            })
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível voltar o ajuste da ordem de venda : " + retorno.responseText,
                        icon: "error"
                    });
                }
            });
        }
    });
}

function AlterarAjuste(tabela) {
    var dados = $("#FormAjusteItemVer").serializeArray();

    dados.push({
        'name': "HANDLE",
        'value': $("#FormAjusteItemVer #HANDLE").val()
    });

    dados.push({
        'name': "ORDEM",
        'value': $("#FormOrdem #ORDEM").val()
    });

    $('#loader').removeAttr('style');

    $.ajax({
        url: "../../model/ordemvenda/alterar/AlterarAjuste.php",
        method: "POST",
        data: dados,
        success: function (retorno) {
            tabela.draw();
            resetaBotoesAjuste()
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
                text: "Não foi possível alterar seu ajuste: " + retorno.responseText,
                icon: "error",
                timer: 3000,
                button: false
            });
        }
    });
}

function VerificaStatusAjuste(status) {
    desativaBotao([
        ".EditarAjuste",
        ".CancelarAjuste",
        ".VoltarAjuste",
        ".ExcluirAjuste",
        ".LiberarAjuste",
        ".VerAjuste",
        ".GravarAjuste",
    ], true);

    bloqueiaCampo([
        "#AJUSTEFINANCEIROVER",
        "#VALORAJUSTEITEMVER",
    ]);

    switch (status) {
        case 1: //Cadastrado
            ativaBotao([
                '.LiberarAjuste',
                '.EditarAjuste',
                '.ExcluirAjuste',
                '.GravarAjuste',
            ], true);

            desbloqueiaCampo([
                "#AJUSTEFINANCEIROVER",
                "#VALORAJUSTEITEMVER",
            ]);
            break;
        case 2: //Ag. Modificações
            ativaBotao([
                '.LiberarAjuste',
                '.EditarAjuste',
                '.CancelarAjuste',
                '.GravarAjuste',
            ], true);

            desbloqueiaCampo([
                "#AJUSTEFINANCEIROVER",
                "#VALORAJUSTEITEMVER",
            ]);
            break;
        default:
            desativaBotao([
                ".LiberarAjuste",
                ".CancelarAjuste",
                ".EditarAjuste"
            ], true);

            ativaBotao([
                '.VoltarAjuste',
                '.VerAjuste',
            ], true);

            break;
    }
}

function resetaBotoesAjuste() {
    desativaBotao([
        ".EditarAjuste",
        ".CancelarAjuste",
        ".VoltarAjuste",
        ".ExcluirAjuste",
        ".LiberarAjuste",
    ], true);
}