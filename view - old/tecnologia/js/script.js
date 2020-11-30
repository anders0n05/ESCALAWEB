$(function(){
    //seleciona todo conteudo do campo ao clicar.
    $("input").on("click", function () {
        $(this).select();
    });

    $("input").on("keypress", function (e) {
        if (e.which !== 13) {
            if ($(this).parents('.inner-addon').length) {
                if ($(this).val() !== '') {
                    $('#' + $(this).attr("id") + 'Handle').val('');
                }
            }
        }
    });

    $("input").on("blur", function () {
        if ($(this).parents('.inner-addon').length) {
            if ($(this).val() === '') {
                $('#' + $(this).attr("id") + 'Handle').val('');
            } else if ($('#' + $(this).attr("id") + 'Handle').val() === '') {
                $(this).val('');
                $(this).focus();
            }
        }
    });

    //botão abrir menu
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

    showLeftPush.onclick = function () {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(body, 'bodyOverlay');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    $('.toUpper').keyup(function () {
        this.value = this.value.toUpperCase();
    });


    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }

    //botão fechar menu
    $('#showLeftPushClose').click(function () {

        $(this).removeClass('active');
        $(body).removeClass('cbp-spmenu-push-toright');
        $('.cbp-spmenu').removeClass('cbp-spmenu-open');
        disableOther('showLeftPush');

    });

    $("body").on("click", function (e) {
        if ($(e.target).closest("#cbp-spmenu-s1,#showLeftPush").length)
            return;

        $('#showLeftPushClose').removeClass('active');
        $(body).removeClass('cbp-spmenu-push-toright');
        $('.cbp-spmenu').removeClass('cbp-spmenu-open');
        disableOther('showLeftPush');
    });


    //pula campos usando enter
    $('.pulaCampoEnter').keypress(function (e) {

        var tecla = (e.keyCode ? e.keyCode : e.which);

        if (tecla == 13) {
            /* guarda o seletor do campo onde foi pressionado Enter */
            campo = $('.pulaCampoEnter');
            /* pega o indice do elemento*/
            indice = campo.index(this);
            /*soma mais um ao indice e verifica se não é null
             *se não for é porque existe outro elemento
             */
            if (campo[indice + 1] != null) {
                /* adiciona mais 1 no valor do indice */
                proximo = campo[indice + 1];
                /* passa o foco para o proximo elemento */
                proximo.focus();
            } else {
                return true;
            }
        }
        if (tecla == 13) {
            /* impede o submit caso esteja dentro de um form */
            e.preventDefault(e);
            return false;
        } else {
            /* se não for tecla enter deixa escrever */
            return true;
        }
    });

    //loader fade
    jQuery("#loader").delay(10).fadeOut("slow");
});//end document ready


function atualizarPagina(){
	window.location.reload();
}


//height 100% force
function SetHeight() {
    if ($(window).width() > '768') {
        var h = $(window).height();
        $(".larguraInteira").height(h - 115);
    } else {
        var h = $(window).height();
        $(".larguraInteira").height(h - 98);
    }
}
$(document).ready(function () {
    SetHeight();
});
$(window).resize(function () {
    SetHeight();
});
$(document).resize(function () {
    SetHeight();
});

function mostrarCarregando() {
    $('#loader').css('display', '');
}

function fecharCarregando() {
    $('#loader').css('display', 'none');
}

function mostrarErro(erro) {
    $('#retornoModal').modal('show');
    $('#retornoModal-body').html(erro);
}