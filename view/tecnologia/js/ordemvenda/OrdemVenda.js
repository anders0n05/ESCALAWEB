$(function () {
    $.ajaxSetup({
        async: false
    });

    var table = $('#ordemvenda').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stateSave": true,
        "searching": false,
        dom: '<"col-md-12 mobileHide"l> t <"col-md-6 col-sm-12"i><"col-md-6 col-sm-12"p>',
        "ajax": {
            "url": "../../model/ordemvenda/ListaOrdens.php",
            "data": function (d) {
                return $.extend({}, d, {
                    "pesquisa": $("#pesquisarDesktop").val().length > 0 ? $("#pesquisarDesktop").val() : $("#pesquisarMobile").val(),
                    "pendente": $(".Pendente").attr('data-pendente'),
                    "cliente": $("#Cliente").val(),
                    "tipo": $("#Tipo").val(),
                    "formapagamento": $("#FormaPagamento").val(),
                });
            }
        },
        "drawCallback": function () {
            $(".dataTables_length").addClass('text-right');
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        },
        "order": [
            [1, "desc"]
        ],
        "columns": [{
                "data": "STATUS",
                "width": '1%',
                "responsivePriority": 1
            },
            {
                "data": "NUMERO",
                "width": '1%',
                "class": "text-right"
            },
            {
                "data": "DATA",
                "width": '10%',
                "responsivePriority": 2
            },
            {
                "data": "CLIENTE",
                "responsivePriority": 3
            },
            {
                "data": "TIPO",
                "responsivePriority": 4
            },
            {
                "data": "FORMAPAGAMENTO",
            },
            {
                "data": "VALORTOTAL",
                "class": "text-right",
            },
        ]
    });

    $(".pesquisar, #Cliente, #Tipo, #FormaPagamento").on('keypress', function () {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            table.draw();
        }
    });

    $('#ordemvenda tbody').on('click', 'tr', function () {
        if ($(".MultiSelecao").attr('data-multiselecao') === "true") {
            if (!$(this).find("td").hasClass('dataTables_empty')) {
                $(this).toggleClass('selected');
                var status = [];
                $.each(table.rows('.selected').data(), function (key, dados) {
                    status.push(parseInt(dados.STATUSHANDLE));
                });
                VerificaStatusOrdem(status);
            }
        } else {
            if (!$(this).find("td").hasClass('dataTables_empty')) {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    desativaBotao([
                        ".Editar",
                        ".Cancelar",
                        ".Voltar",
                        ".Liberar",
                    ]);
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    VerificaStatusOrdem(parseInt(table.rows('.selected').data()[0].STATUSHANDLE));
                }
            }
        }
    });

    $('#ordemvenda tbody').on('dblclick', 'tr', function () {
        window.location = "../../view/ordemvenda/OrdemVendaListar.php?ordem=" + table.row(this).data().CHAVE;
    });

    $(".Pendente").click(function () {
        $(this).attr('data-pendente', $(this).attr('data-pendente') == 'false' ? 'true' : 'false');
        $(this).find("i").toggleClass('hidden');
        table.draw();
    });

    $(".MultiSelecao").click(function () {
        $(this).attr('data-multiselecao', $(this).attr('data-multiselecao') == 'false' ? 'true' : 'false');
        $(this).find("i").toggleClass('hidden');
        desativaBotao([
            ".Editar",
            ".Cancelar",
            ".Voltar",
            ".Liberar",
        ]);
        $("#ordemvenda tr").removeClass('selected');
    });

    $(".Filtrar").on('click', function () {
        table.draw();
        $("#dropdownMenu1").dropdown('toggle');
    });

    $(".Cliente").bestComplete({
        source: "../../model/ordemvenda/autocomplete/ClienteAutoComplete.php"
    });

    $(".dropdown-menu").on('click', function (e) {
        e.stopPropagation();
    });

    $(".Adicionar").on('click', function () {
        window.location = "../../view/ordemvenda/CriarOrdemVenda.php";
    });

    $(".Voltar").on('click', function () {
        VoltarOrdem(table);
    });

    $(".Liberar").on('click', function () {
        LiberarOrdem(table);
    });

    $(".Editar").on('click', function () {
        window.location = "../../view/ordemvenda/OrdemVendaListar.php?ordem=" + table.rows('.selected').data()[0].CHAVE;
    });

    $(".Cancelar").on('click', function () {
        CancelarOrdem(table);
    });
});

function VerificaStatusOrdem(status) {

    if ($.isArray(status)) {
        var mudaBotoes = true;

        $.each(status, function (key, value) {
            if ($.inArray(value, [7, 2]) !== -1) {
                if (mudaBotoes) {
                    if (status.length == 1) {
                        ativaBotao([
                            ".Editar",
                            ".Cancelar",
                            ".Liberar",
                        ]);
                    } else {
                        desativaBotao([
                            ".Editar",
                        ]);
                        ativaBotao([
                            ".Cancelar",
                            ".Liberar",
                        ]);
                    }
                }
            } else if (value === 10) {
                mudaBotoes = false;
                desativaBotao([
                    ".Editar",
                    ".Cancelar",
                    ".Liberar",
                    ".Voltar",
                ]);
            } else {
                mudaBotoes = false;

                ativaBotao('.Voltar');
                desativaBotao([
                    ".Editar",
                    ".Cancelar",
                    ".Liberar",
                ]);
            }
        });

    } else {
        switch (status) {
            case 7: //Cadastrado
                ativaBotao([
                    ".Editar",
                    ".Liberar",
                    ".Cancelar",
                ]);
                break;
            case 2: //Ag Modificação
                ativaBotao([
                    ".Editar",
                    ".Cancelar",
                    ".Liberar",
                ]);
                break;
            case 10: //Cancelada
                desativaBotao([
                    ".Editar",
                    ".Cancelar",
                    ".Liberar",
                    ".Voltar",
                ]);
                break;
            default: //O resto
                ativaBotao('.Voltar');
                desativaBotao([
                    ".Editar",
                    ".Cancelar",
                    ".Liberar",
                ]);
                break;
        }
    }
}

function LiberarOrdem(tabela) {
    swal({
        title: "Deseja liberar a(s) ordem(ns) de venda?",
        text: "As ordens de venda serão liberadas.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiLiberar) {
        if (vaiLiberar) {
            $('#loader').removeAttr('style');

            var selecionados = tabela.rows('.selected').data(),
                ordens = [];

            $.each(selecionados, function (key, value) {
                ordens.push(value.HANDLE);
            });

            $.ajax({
                url: "../../model/ordemvenda/liberar/LiberarOrdem.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    "ordens": ordens
                },
                success: function (retorno) {
                    resetaBotoes();
                    tabela.draw();
                    $('#loader').hide();
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

function VoltarOrdem(tabela) {
    swal({
        title: "Deseja voltar as ordens de venda?",
        text: "A ordem de venda ficará disponível para edição.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        buttons: ["Não", "Sim"]
    }).then(function (vaiVoltar) {
        if (vaiVoltar) {
            var selecionados = tabela.rows('.selected').data(),
                ordens = [];

            $.each(selecionados, function (key, value) {
                ordens.push(value.HANDLE);
            });

            $('#loader').removeAttr('style');

            $.ajax({
                url: "../../model/ordemvenda/voltar/VoltarOrdem.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    "ordens": ordens
                },
                success: function (retorno) {
                    resetaBotoes();
                    tabela.draw();
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    'ORDENS': ordens,
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

function CancelarOrdem(tabela) {
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

            var selecionados = tabela.rows('.selected').data(),
                ordens = [];

            $.each(selecionados, function (key, value) {
                ordens.push(value.HANDLE);
            });

            $.ajax({
                url: "../../model/ordemvenda/cancelar/CancelaOrdem.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    "ordens": ordens,
                    'motivo': motivo
                },
                success: function (retorno) {
                    tabela.draw();
                    resetaBotoes();
                    $('#loader').hide();
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                "DADOS": {
                                    "ORDENS": ordens,
                                    'MOTIVO': motivo
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

function resetaBotoes() {
    desativaBotao([
        ".Liberar",
        ".Voltar",
        ".Cancelar",
        ".Editar",
    ]);
}