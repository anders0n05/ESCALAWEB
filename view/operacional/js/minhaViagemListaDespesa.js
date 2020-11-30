$(function () {
    $.ajaxSetup({
        async: false
    });

    let viagem = $('#VIAGEM').val();
    let botaoNova = $("#BOTAONOVA");
    let botaoFechar = $("#BOTAOFECHAR");

    botaoNova.on('click', NovaDespesaOnClick);
    botaoFechar.on('click', FecharOnClick);

    $.ajax({
        url: "../../controller/operacional/ViagemDespesa.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "ACAO": "getDespesas",
            "VIAGEM": viagem
        },
        success: function (retorno) {
            for (indice in retorno) {
                let tBodyListaDespesa = $("#listaDespesa")[0];

                let linhaRegistro = retornarLinha(retorno[indice]);

                tBodyListaDespesa.append(linhaRegistro);
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
});

function NovaDespesaOnClick(){
    let viagem = $('#VIAGEM').val();
    window.location.href = "../../view/operacional/MinhaViagemAdicionarDespesa.php?viagem="+viagem;
}

function FecharOnClick(){
    let viagem = $('#VIAGEM').val();
    window.location.href = "../../view/operacional/MinhaViagemVisualizar.php?viagem="+viagem;
}

function retornarLinha(dataSetDespesa){
    let linhaRegistro = document.createElement("tr");

    let tdNumero = document.createElement("td");
    tdNumero.append(dataSetDespesa.NUMERO);
    
    let tdData = document.createElement("td");
    tdData.append(dataSetDespesa.DATA);
    
    let tdFilial = document.createElement("td");
    tdFilial.append(dataSetDespesa.FILIAL);
    
    let tdTipo = document.createElement("td");
    tdTipo.append(dataSetDespesa.TIPO);
    
    let tdDespesa = document.createElement("td");
    tdDespesa.append(dataSetDespesa.DESPESA);
    
    let tdValor = document.createElement("td");
    tdValor.append(dataSetDespesa.VALOR);


    linhaRegistro.append(tdNumero);
    linhaRegistro.append(tdData);
    linhaRegistro.append(tdFilial);
    linhaRegistro.append(tdTipo);
    linhaRegistro.append(tdDespesa);
    linhaRegistro.append(tdValor);

    return linhaRegistro;
}