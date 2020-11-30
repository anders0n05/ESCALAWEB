$(function () {
    var atualCima = new CountUp("atualcima", 0, 0, 0, 2.5, { separator: '.' }),
        inicialCima = new CountUp("inicialcima", 0, 0, 0, 2.5, { separator: '.' }),
        novosCima = new CountUp("novoscima", 0, 0, 0, 2.5, { separator: '.' }),
        devolucaoCima = new CountUp("devolucaocima", 0, 0, 0, 2.5, { separator: '.' }),
        liberadoCima = new CountUp("liberadocima", 0, 0, 0, 2.5, { separator: '.' }),
        slavencidoCima = new CountUp("slavencidocima", 0, 0, 0, 2.5, { separator: '.' }),
        criticoCima = new CountUp("criticocima", 0, 0, 0, 2.5, { separator: '.' }),
        porcentoretrabalhoCima = new CountUp("porcentoretrabalhocima", 0, 0, 1, 2.5, { suffix: ' %' }),

        atualBaixo = new CountUp("atualbaixo", 0, 0, 0, 2.5, { separator: '.' }),
        inicialBaixo = new CountUp("inicialbaixo", 0, 0, 0, 2.5, { separator: '.' }),
        novosBaixo = new CountUp("novosbaixo", 0, 0, 0, 2.5, { separator: '.' }),
        liberadoBaixo = new CountUp("liberadobaixo", 0, 0, 0, 2.5, { separator: '.' }),
        slavencidoBaixo = new CountUp("slavencidobaixo", 0, 0, 0, 2.5, { separator: '.' }),
        correcaoBaixo = new CountUp("correcaobaixo", 0, 0, 0, 2.5, { separator: '.' }),
        criticoBaixo = new CountUp("criticobaixo", 0, 2, 0, 2.5, { separator: '.' }),
        porcentoretrabalhoBaixo = new CountUp("porcentoretrabalhobaixo", 0, 0, 1, 2.5, { suffix: ' %' });

    var datatable = $("#recursos").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/model/servicedesk/painel/UsuariosPainel.php",
        columns: [
            { data: 'ATIVIDADE', orderable: false, width: '1%' },
            { data: 'RECURSO', orderable: false },
            { data: 'OK', className: "text-right", orderable: false },
            { data: 'DEV', className: "text-right", orderable: false },
            { data: 'TOTALAPONTA', className: "text-right", orderable: false },
            { data: 'RETRA', className: "text-right", orderable: false },
            { data: 'CLIENTE', className: "text-left", orderable: false, width: "500px" },
            { data: 'SD', className: "text-right", orderable: false },
            { data: 'HRS', className: "text-right", orderable: false },
            { data: 'SLA', className: "text-right", orderable: false, width: "150px" },
            { data: 'TOTAL', className: "text-right", orderable: false, width: "50px" }
        ],
        "order": [[9, "asc"]],
        searching: false,
        paging: false,
        info: false,
        fixedHeader: {
            header: true,
            footer: true
        },
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (!aData["RECURSO"]) {
                $('td', nRow).css('background-color', '#ff0066');
                $('td', nRow).css('border', 'none');
            }
            if (moment(aData["SLA"], 'DD/MM/YYYY HH:mm:ss').isBefore()) { //-- SLA Vencido
                $('td:eq(9)', nRow).css('background-color', 'red');
                $('td:eq(9)', nRow).css('color', '#fff');
            }
            if (aData["SEVERIDADE"] == 0) { //-- Críticos
                $('td:eq(6)', nRow).css('background-color', 'red');
                $('td:eq(6)', nRow).css('color', '#fff');
            }
            if (aData["DATAABERTURA"]) {
                var agora = moment(),
                    abertura = moment(aData["DATAABERTURA"]),
                    ms = moment(agora).diff(moment(abertura)),
                    d = moment.duration(ms),
                    s = d.format('h:mm').split(',').join(".").split(':').join(",");

                if (s.length == 2) {
                    $('td:eq(10)', nRow).html('0,' + s);
                } else if (s.length > 2) {
                    $('td:eq(10)', nRow).html(s);
                }
            }

            // Total de horas que o HD teve um encaminhamento.
            if (aData["DATAULTIMOENCAMINHAMENTO"]) {
                var agora = moment(),
                    abertura = moment(aData["DATAULTIMOENCAMINHAMENTO"]),
                    ms = moment(agora).diff(moment(abertura)),
                    d = moment.duration(ms),
                    s = d.format('h:mm').split(',').join("").split(':').join(",");

                if (s.length == 2) {
                    $('td:eq(8)', nRow).html('0,' + s);
                } else if (s.length > 2) {
                    $('td:eq(8)', nRow).html(s);
                }
            }

            // Coloca na tela o total de apontamento do recurso;
            if (aData["TOTALAPONTA"] > 0) {
                // Converte segundos para horas:minutos
                var duration = moment.duration(aData["TOTALAPONTA"], 'seconds'),
                    formatted = duration.format("h,mm");

                if (formatted.length == 1) {
                    $('td:eq(4)', nRow).html("0,0" + formatted);
                } else if (formatted.length == 2) {
                    $('td:eq(4)', nRow).html("0," + formatted);
                } else {
                    $('td:eq(4)', nRow).html(formatted);
                }
            } else {
                $('td:eq(4)', nRow).html('');
            }

            // Caso o recurso esteja no telefone;
            if (aData["CANAL"] == 3) {
                $('td:eq(6)', nRow).css('background-color', '#9400d3');
                $('td:eq(6)', nRow).css('color', 'white');
            }

            // Caso o usuário esteja sem SD, irá mostrar o tempo que o mesmo está sem apontamento em um SD;
            if (!aData["DATAULTIMOENCAMINHAMENTO"] && (aData["RECURSO"] && !aData["SD"])) {
                // Converte segundos para horas:minutos
                var duration = moment.duration(aData["HORASSEMHD"], 'seconds'),
                    formatted = duration.format("h,mm");

                if (formatted.length == 1) {
                    $('td:eq(8)', nRow).html("0,0" + formatted);
                } else if (formatted.length == 2) {
                    $('td:eq(8)', nRow).html("0," + formatted);
                } else {
                    $('td:eq(8)', nRow).html(formatted);
                }
            }

            if (aData["TOTALRETRABALHO"]) {
                if (aData["TOTALRETRABALHO"] > 0) {
                    $('td:eq(5)', nRow).html(aData["TOTALRETRABALHO"]);
                }
            }
        }
    });

    doDataLista();
    doDataContador();
    setInterval(function () {
        doDataLista();
        doDataContador();
    }, 10000);

    function doDataContador() {
        $.ajax({
            url: "/model/servicedesk/painel/ContadoresPainel.php",
            success: function (retorno) {
                retorno = JSON.parse(retorno);

                atualCima.update(retorno.atualAtendimento);
                inicialCima.update(retorno.inicialAtendimento);
                novosCima.update(retorno.novosAtendimento);
                devolucaoCima.update(retorno.devolucaoAtendimento);
                liberadoCima.update(retorno.liberadoAtendimento);
                slavencidoCima.update(retorno.slavencidoAtendimento);
                criticoCima.update(retorno.criticoAtendimento);
                porcentoretrabalhoCima.update(retorno.porcentoretrabalhoAtendimento);

                atualBaixo.update(retorno.atualDesenvolvimento);
                inicialBaixo.update(retorno.inicialDesenvolvimento);
                novosBaixo.update(retorno.novosDesenvolvimento);
                liberadoBaixo.update(retorno.liberadoDesenvolvimento);
                slavencidoBaixo.update(retorno.slavencidoDesenvolvimento);
                correcaoBaixo.update(retorno.correcaoDesenvolvimento);
                criticoBaixo.update(retorno.criticoDesenvolvimento);
                porcentoretrabalhoBaixo.update(retorno.porcentoretrabalhoDesenvolvimento);

                // Painel Atendimento
                if (retorno.atualAtendimento == 0) {
                    $("#atualcima").addClass('textoBranco').closest(".panel-body").removeClass("verde").addClass('branco');
                } else {
                    $("#atualcima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('verde');
                }

                if (retorno.inicialAtendimento == 0) {
                    $("#inicialcima").addClass('textoBranco').closest('.panel-body').removeClass("preto").addClass('branco');
                } else {
                    $("#inicialcima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('preto');
                }

                if (retorno.novosAtendimento == 0) {
                    $("#novoscima").addClass('textoBranco').closest('.panel-body').removeClass("azul").addClass('branco');
                } else {
                    $("#novoscima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('azul');
                }

                if (retorno.devolucaoAtendimento == 0) {
                    $("#devolucaocima").addClass('textoBranco').closest('.panel-body').removeClass("amarelo").addClass('branco');
                } else {
                    $("#devolucaocima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('amarelo');
                }

                if (retorno.liberadoAtendimento == 0) {
                    $("#liberadocima").addClass('textoBranco').closest('.panel-body').removeClass("verde").addClass('branco');
                } else {
                    $("#liberadocima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('verde');
                }

                if (retorno.slavencidoAtendimento == 0) {
                    $("#slavencidocima").addClass('textoBranco').closest('.panel-body').removeClass("laranja").addClass('branco');
                } else {
                    $("#slavencidocima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('laranja');
                }

                if (retorno.criticoAtendimento == 0) {
                    $("#criticocima").addClass('textoBranco').closest('.panel-body').removeClass("vermelho").addClass('branco');
                } else {
                    $("#criticocima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('vermelho');
                }

                if (retorno.porcentoretrabalhoAtendimento == 0) {
                    $("#porcentoretrabalhocima").addClass('textoBranco').closest('.panel-body').removeClass("preto").addClass('branco');
                } else {
                    $("#porcentoretrabalhocima").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('preto');
                }

                // Desenvolvimento
                if (retorno.atualDesenvolvimento == 0) {
                    $("#atualbaixo").addClass('textoBranco').closest(".panel-body").addClass('branco');
                } else {
                    $("#atualbaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('verde');
                }

                if (retorno.inicialDesenvolvimento == 0) {
                    $("#inicialbaixo").addClass('textoBranco').closest('.panel-body').removeClass("preto").addClass('branco');
                } else {
                    $("#inicialbaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('preto');
                }

                if (retorno.novosDesenvolvimento == 0) {
                    $("#novosbaixo").addClass('textoBranco').closest('.panel-body').removeClass("azul").addClass('branco');
                } else {
                    $("#novosbaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('azul');
                }

                if (retorno.correcaoDesenvolvimento == 0) {
                    $("#correcaobaixo").addClass('textoBranco').closest('.panel-body').removeClass("amarelo").addClass('branco');
                } else {
                    $("#correcaobaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('amarelo');
                }

                if (retorno.liberadoDesenvolvimento == 0) {
                    $("#liberadobaixo").addClass('textoBranco').closest('.panel-body').removeClass("verde").addClass('branco');
                } else {
                    $("#liberadobaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('verde');
                }

                if (retorno.slavencidoDesenvolvimento == 0) {
                    $("#slavencidobaixo").addClass('textoBranco').closest('.panel-body').removeClass("laranja").addClass('branco');
                } else {
                    $("#slavencidobaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('laranja');
                }

                if (retorno.criticoDesenvolvimento == 0) {
                    $("#criticobaixo").addClass('textoBranco').closest('.panel-body').removeClass("vermelho").addClass('branco');
                } else {
                    $("#criticobaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('vermelho');
                }

                if (retorno.criticoDesenvolvimento == 0) {
                    $("#criticobaixo").addClass('textoBranco').closest('.panel-body').removeClass("vermelho").addClass('branco');
                } else {
                    $("#criticobaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('vermelho');
                }

                if (retorno.porcentoretrabalhoDesenvolvimento == 0) {
                    $("#porcentoretrabalhobaixo").addClass('textoBranco').closest('.panel-body').removeClass("preto").addClass('branco');
                } else {
                    $("#porcentoretrabalhobaixo").removeClass('textoBranco').closest('.panel-body').removeClass("branco").addClass('preto');
                }

                var atualCriticoAtendimento = parseInt($("#criticocima").html()),
                    valorCriticoAtendimento = parseInt(retorno.criticoAtendimento);

                if (valorCriticoAtendimento > 0 && valorCriticoAtendimento > atualCriticoAtendimento) {
                    $("#criticocima").closest('.panel').delay(5000).fadeOut().delay(50).fadeIn().delay(50).fadeOut().delay(50).fadeIn().delay(50).fadeOut().delay(50).fadeIn().delay(50).fadeOut().delay(50).fadeIn();
                }

                var atualCriticoDesenvolvimento = parseInt($("#criticobaixo").html()),
                    valorCriticoDesenvolvimento = parseInt(retorno.criticoDesenvolvimento);

                if (valorCriticoDesenvolvimento > 0 && valorCriticoDesenvolvimento > atualCriticoDesenvolvimento) {
                    $("#criticobaixo").closest('.panel').delay(5000).fadeOut().delay(50).fadeIn().delay(50).fadeOut().delay(50).fadeIn().delay(50).fadeOut().delay(50).fadeIn().delay(50).fadeOut().delay(50).fadeIn();
                }
                if ((valorCriticoAtendimento > 0 && valorCriticoAtendimento > atualCriticoAtendimento)) {
                    swal({
                        title: "Crítico(s) na(s) fila(s)!!",
                        text: "Existem novos críticos na(s) fila(s)!",
                        icon: "error",
                        buttons: false,
                        timer: 5000
                    });
                    $("#bling").get(0).play();
                }


            }
        });
    }
    function doDataLista() {
        datatable.draw();
    }
});