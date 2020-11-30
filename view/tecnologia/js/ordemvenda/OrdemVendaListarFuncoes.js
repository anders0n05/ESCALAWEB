$(function () {
    $('.datahora').mask('00/00/0000 00:00:00');
    $('.data').mask('00/00/0000');
    $('.horas').mask('00:00');
    $('.dinheiro').mask("#.##0,00", {
        reverse: true
    });

    $(".btnFechar").click(function () {
        window.history.back();
        '../../view/ordemvenda/OrdemVenda.php';
    });

    $('form input').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
});

function resizeTable(width, table, columns) {
    if (width < 767) {
        table.columns(columns).visible(false);
    } else {
        table.columns(columns).visible(true);
    }
}

// Coloca o atributo que bloqueia o campo
function bloqueiaCampo(campos) {
    if ($.isArray(campos)) {
        $.each(campos, function (key, value) {
            $(value).attr('disabled', 'disabled');
        });
    } else {
        $(campos).attr('disabled', 'disabled');
    }
}

// Tira o atributo que bloqueia o campo
function desbloqueiaCampo(campos) {
    if ($.isArray(campos)) {
        $.each(campos, function (key, value) {
            $(value).removeAttr('disabled');
        });
    } else {
        $(campos).removeAttr('disabled');
    }
}

function ativaBotao(botao, tiraHidden = false) {
    if ($.isArray(botao)) {
        $.each(botao, function (key, value) {
            $(value).removeAttr('disabled');
            if (tiraHidden) {
                $(value).removeClass("hidden");
            }
        });
    } else {
        $(botao).removeAttr('disabled');
        if (tiraHidden) {
            $(botao).removeClass("hidden");
        }
    }
}

function desativaBotao(botao, botaHidden = false) {
    if ($.isArray(botao)) {
        $.each(botao, function (key, value) {
            $(value).attr('disabled', 'disabled');
            if (botaHidden) {
                $(value).addClass("hidden");
            }
        });
    } else {
        $(botao).attr('disabled', 'disabled');
        if (botaHidden) {
            $(botao).addClass("hidden");
        }
    }
}

function VerificaStatusOrdem(status) {
    switch (status) {
        case 7: //Cadastrado
            ativaBotao([
                ".EditarOrdem",
                ".LiberarOrdem",
                ".CancelarOrdem",
            ], true);
            break;
        case 2: //Ag Modificação
            ativaBotao([
                ".EditarOrdem",
                ".CancelarOrdem",
                ".LiberarOrdem",
            ], true);
            break;
        case 10: //Cancelada
            desativaBotao([
                ".EditarOrdem",
                ".CancelarOrdem",
                ".LiberarOrdem",
                ".VoltarOrdem",
                "#AdicionarItem",
                "#AdicionarAjuste",
            ], true);
            break;
        default: //O resto
            ativaBotao('.VoltarOrdem', true);
            desativaBotao([
                ".EditarOrdem",
                ".CancelarOrdem",
                ".LiberarOrdem",
                "#AdicionarItem",
                "#AdicionarAjuste",
            ], true);
            break;
    }
}