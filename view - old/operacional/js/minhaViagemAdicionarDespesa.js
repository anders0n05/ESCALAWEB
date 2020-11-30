$(function () {
    $.ajaxSetup({
        async: false
    });

    var regExp = /[0-9\.\,]/;

    let bloquearLetras = function(e) {
        var value = String.fromCharCode(e.which) || e.key;
        
        // Only numbers, dots and commas
        if (e.which <= 105  // right numbers
            && e.which >= 96){
                return true
            }
        else if (!regExp.test(value)
        && e.which != 188 // ,
        && e.which != 9 // tab
        && e.which != 190 // .
        && e.which != 194 // . da direita
        && e.which != 110 // , da direita
        && e.which != 8   // backspace
        && e.which != 46  // delete
        && e.which != 16  // shift
        && e.which != 36  // home
        && e.which != 35  // end
        && (e.which < 37  // arrow keys
            || e.which > 40)) {
            e.preventDefault();
            return false;
        }
    };

    let recalcularTotal = function(e) {
        let quantidade = $('#QUANTIDADE');
        let valorUnitario = $('#VALORUNITARIO');
        let valorTotal = $('#VALORTOTAL');

        valorTotal.val(parseFloat(quantidade.val()) * parseFloat(valorUnitario.val()));
    };
    
    let FecharOnClick = function(){
        let viagem = $('#VIAGEM').val();

        window.location.href = "../../view/operacional/MinhaViagemListaDespesa.php?viagem="+viagem;
    }

    let vQuantidade = $('#QUANTIDADE');
    let vValorUnitario = $('#VALORUNITARIO');

    let campoTipoDespesa = $("#TIPODESPESA");
    
    let campoData = $("#DATA");
    campoData.val(moment().format('YYYY-MM-DDTHH:mm'));

    PreencherTipoDespesa(campoTipoDespesa);
    campoTipoDespesa.change(PopularDespesas);

    vQuantidade.on('keydown keyup', bloquearLetras);
    vQuantidade.on('keydown keyup', recalcularTotal);

    vValorUnitario.on('keydown keyup', bloquearLetras);
    vValorUnitario.on('keydown keyup', recalcularTotal);
    
    $('.btnFechar').on('click', FecharOnClick);
    $('#GRAVAR').on('click', GravarDespesa);
});

function checarCampoVazio(valor, label){
    if (!valor){
        swal({
            title: "Oopss!",
            text: "O campo "+label+" é obrigatório, para continuar ele deve ser preenchido.",
            icon: "error"
        });
        return false;
    }
    return true;
}

function GravarDespesa(){    
    let viagem = $('#VIAGEM').val();
    
    let tipoDespesa = $("#TIPODESPESA")[0].value;
    let despesa = $("#DESPESA")[0].value;
    let data = $("#DATA")[0].value;
    let quantidade = $("#QUANTIDADE")[0].value;
    let valorUnitario = $("#VALORUNITARIO")[0].value;
    let valorTotal = $("#VALORTOTAL")[0].value;
    let observacao = $("#OBSERVACAO")[0].value;

    if (checarCampoVazio(tipoDespesa  , "tipo de despesa") &&
        checarCampoVazio(despesa      , "despesa") &&
        checarCampoVazio(data         , "data") &&
        checarCampoVazio(quantidade   , "quantidade") &&
        checarCampoVazio(valorUnitario, "valor unitário") &&
        checarCampoVazio(valorTotal   , "valor total") &&
        checarCampoVazio(observacao   , "observação")){
            let dadosEnvio = "{ "+
                             " \"tipoDespesa\"   : \""+tipoDespesa+"\", "+
                             " \"despesa\"       : \""+despesa+"\", "+
                             " \"data\"          : \""+data+"\", "+
                             " \"quantidade\"    : \""+quantidade+"\", "+
                             " \"valorUnitario\" : \""+valorUnitario+"\", "+
                             " \"valorTotal\"    : \""+valorTotal+"\", "+
                             " \"observacao\"    : \""+observacao+"\", "+
                             " \"viagem\"        : \""+viagem+"\" "+
                             "}";                              

            $.ajax({
                url: "../../controller/operacional/ViagemDespesa.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    "ACAO": "cadastrar",
                    "DADOS": JSON.parse(dadosEnvio)
                },
                success: function (retorno) {
                    swal({
                        title: "Despesa cadastrada!",
                        text: retorno.responseText,
                        icon: "success",
                        showCloseButton: true
                    }).then(function (dismiss) {
                        location.href = "../../view/operacional/MinhaViagemListaDespesa.php?viagem="+viagem;
                    });
                },
                error: function(retorno){
                    swal({
                        title: "Oopss!",
                        text: retorno.responseText,
                        icon: "error"
                    });
                }
            });
      }
}

function PreencherTipoDespesa(campoTipoDespesa){
    $.ajax({
        url: "../../controller/operacional/ViagemDespesa.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "ACAO": "getListaTipoDespesa"
        },
        success: function (retorno) {
            for (indice in retorno) {
                retorno[indice].HANDLE
                retorno[indice].NOME

                let opcao = document.createElement("option");
                opcao.setAttribute("value", retorno[indice].HANDLE);
                opcao.append(retorno[indice].NOME);

                campoTipoDespesa.append(opcao);
            }
        },
        error: function(retorno){
            swal({
                title: "Oopss!",
                text: retorno.responseText,
                icon: "error"
            });
        }
    });
}

function PopularDespesas(){
    let tipo = $("#TIPODESPESA")[0].value;
    let campoDespesa = $("#DESPESA");

    $("#DESPESA option").remove();

    let opcao = document.createElement("option");
    opcao.setAttribute("value", 0);
    opcao.append("Selecione");

    campoDespesa.append(opcao);

    $.ajax({
        url: "../../controller/operacional/ViagemDespesa.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "ACAO": "getListaDespesa",
            "TIPO": tipo
        },
        success: function (retorno) {
            for (indice in retorno) {
                retorno[indice].HANDLE
                retorno[indice].NOME

                opcao = document.createElement("option");
                opcao.setAttribute("value", retorno[indice].HANDLE);
                opcao.append(retorno[indice].NOME);

                campoDespesa.append(opcao);
            }
        },
        error: function(retorno){
            swal({
                title: "Oopss!",
                text: retorno.responseText,
                icon: "error"
            });
        }
    });
    
}