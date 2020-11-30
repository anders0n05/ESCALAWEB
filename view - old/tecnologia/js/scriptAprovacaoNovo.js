$(function () {
    var tableAprovacoes = $('#tableAprovacoes').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "responsive": {
            details: false
        },
        "ajax": {
            "url": "../../model/administracao/aprovacao/ListaAprovacoes.php",
            "data": {
                "pendente": $("#Pendente").attr('data-pendente')
            }
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
        },
        "columns": [{
            "data": "STATUS",
            "responsivePriority": 0,
            "orderable": false
        }, {
            "data": "HISTORICO",
            "responsivePriority": 1,
            "orderable": false
        },
            {
                "data": "SOLICITANTE",
                "responsivePriority": 2,
                "orderable": false
            },
            {
                "data": "NIVEL",
                "responsivePriority": 3,
                "orderable": false
            },
            {
                "data": "EMPRESA",
                "responsivePriority": 4,
                "orderable": false
            },
            {
                "data": "FILIAL",
                "responsivePriority": 5,
                "orderable": false
            },
            {
                "data": "VALORORIGEM",
                "responsivePriority": 6,
                "orderable": false,
                "class": "text-right"
            }
        ]
    });

    resizeTable($(window).width(), tableAprovacoes);
    $(window).resize(function () {
        resizeTable($(window).width(), tableAprovacoes);
    });

    $('#tableAprovacoes tbody').on('click', 'tr', function () {
        if ($(".btnMultiSelecao").hasClass('active')) {
            if (!$(this).find("td").hasClass('dataTables_empty')) {
                $(this).toggleClass('selected');
                $(".btnAprovar").removeAttr('disabled');
                $(".btnRecusar").removeAttr('disabled');
                $(".btnAprovarResponsivo").removeAttr('disabled');
                $(".btnRecusarResponsivo").removeAttr('disabled');
            }
        } else {
            if (!$(this).find("td").hasClass('dataTables_empty')) {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $(".btnAprovar").attr('disabled', 'disabled');
                    $(".btnRecusar").attr('disabled', 'disabled');
                    $(".btnAprovarResponsivo").attr('disabled', 'disabled');
                    $(".btnRecusarResponsivo").attr('disabled', 'disabled');
                } else {
                    tableAprovacoes.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $(".btnAprovar").removeAttr('disabled');
                    $(".btnRecusar").removeAttr('disabled');
                    $(".btnAprovarResponsivo").removeAttr('disabled');
                    $(".btnRecusarResponsivo").removeAttr('disabled');
                }
            } else {
                $(".btnAprovar").attr('disabled', 'disabled');
                $(".btnRecusar").attr('disabled', 'disabled');
                $(".btnAprovarResponsivo").attr('disabled', 'disabled');
                $(".btnRecusarResponsivo").attr('disabled', 'disabled');
            }
        }
    });

    $(".btnMultiSelecao").on('click', function () {
        $(this).toggleClass('active');
        $(this).find('span').toggleClass('hidden');
        $("#tableAprovacoes tr").removeClass('selected');
    });

    function aprovar() {
        var aprovacao = tableAprovacoes.rows('.selected').data(),
            aprovacoes = [];

        $.each(aprovacao, function (key, value) {
            aprovacoes.push(value.APROVACAO);
        });

        $('#loader').removeAttr('style');

        $.ajax({
            url: "../../model/administracao/aprovacao/Aprovar.php",
            method: "POST",
            dataType: 'JSON',
            data: {
                'APROVACAO': aprovacoes
            },
            success: function (retorno) {
                $('#loader').hide();

                swal({
                    title: "Sucesso!",
                    text: "A aprovação foi aprovada.",
                    icon: "success",
                    timer: 3000,
                    button: false
                }).then(function () {
                    tableAprovacoes.draw();
                });
            },
            error: function (retorno) {
                bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                    beforeSend: function (report) {
                        report.updateMetaData('Dados enviados', {
                            'APROVACAO': aprovacoes
                        });
                    }
                });

                $('#loader').hide();

                swal({
                    title: "Oopss!",
                    text: "Não foi possível aprovar a aprovação:" + retorno.responseJSON.message,
                    icon: "error"
                }).then(function () {
                    tableAprovacoes.draw();
                });
            }
        });
    }

    function recusar() {
        $aprovacao = tableAprovacoes.rows('.selected').data();
        swal({
            text: 'Motivo da recusa',
            content: {
                element: 'textarea',
                attributes: {
                    id: 'motivoRecusa',
                    rows: "4"
                }
            },
            dangerMode: true,
            buttons: ["Cancelar", "Recusar"]
        }).then(function () {
            if ($("#motivoRecusa").val().length == 0) {
                swal({
                    title: "Motivo inválido",
                    text: "Você precisa informar um motivo para recusar essa aprovação",
                    icon: "warning"
                });
                throw null;
            }

            var aprovacao = tableAprovacoes.rows('.selected').data(),
                aprovacoes = [];

            $.each(aprovacao, function (key, value) {
                aprovacoes.push(value.APROVACAO);
            });


            $('#loader').removeAttr('style');

            $.ajax({
                url: "../../model/administracao/aprovacao/Recusar.php",
                method: "POST",
                dataType: 'JSON',
                data: {
                    'APROVACAO': aprovacoes,
                    'MOTIVO': $("#motivoRecusa").val()
                },
                success: function (retorno) {
                    $('#loader').hide();

                    swal({
                        title: "Sucesso!",
                        text: "A aprovação foi reprovada.",
                        icon: "success",
                        timer: 3000,
                        button: false
                    }).then(function () {
                        tableAprovacoes.draw();
                    });
                },
                error: function (retorno) {
                    bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                        beforeSend: function (report) {
                            report.updateMetaData('Dados enviados', {
                                'APROVACAO': aprovacoes,
                                'MOTIVO': $("#motivoRecusa").val()
                            });
                        }
                    });

                    $('#loader').hide();

                    swal({
                        title: "Oopss!",
                        text: "Não foi possível reprovar a aprovação:" + retorno.responseJSON.message,
                        icon: "error"
                    }).then(function () {
                        tableAprovacoes.draw();
                    });
                }
            });
        });
    }

    $(".btnAprovar").on('click', function () {
        aprovar();
    });

    $(".btnRecusar").on('click', function () {
        recusar()
    });
    $(".btnAprovarResponsivo").on('click', function () {
        aprovar();
    });

    $(".btnRecusarResponsivo").on('click', function () {
        recusar()
    });
});

function resizeTable(width, table) {
    if (width < 767) {
        table.columns([2, 3, 4, 5, 6]).visible(false);
    } else {
        table.columns([2, 3, 4, 5, 6]).visible(true);
    }
}