$(function () {    
    DefinirHandle();
});

function DefinirHandle(){

    let rastreamento = $("#RASTREAMENTO")[0].value;
    let handlePedido;

    $.ajax({
        url: "../../controller/rastreamento/Pedido.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "ACAO"          : "getHandlePorRastreamento",
            "RASTREAMENTO"  : rastreamento
        },
        success: function (retorno) {    
            handlePedido = retorno.HANDLE;
            PopularEtapas(handlePedido);            
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

function PopularEtapas(prHandlePedido){
    $.ajax({
        url: "../../controller/rastreamento/Pedido.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "ACAO"     : "getEtapaEvento",
            "HANDLE"  : prHandlePedido
        },
        success: function (retorno) {            
            //console.log(retorno)  
            let GridEtapaEvento = $("#GRIDETAPAEVENTO")[0];
            let lastEtapa = 0;
            let linhaCont = 1;

            for(indice = 0; indice < retorno.length;indice++){

                if (lastEtapa != retorno[indice].HANDLE){
                    lastEtapa = retorno[indice].HANDLE
                    linhaCont = 1;

                    CriarLinhaEtapaEvento(linhaCont, GridEtapaEvento, false, retorno[indice].ETAPAIMAGEMSTATUS, retorno[indice].SEQUENCIAL, retorno[indice].DATA, retorno[indice].ETAPA, retorno[indice].OBSERVACAO);
                }

                if (retorno[indice].EVENTOHANDLE != 0){
                    CriarLinhaEtapaEvento(linhaCont, GridEtapaEvento, true, retorno[indice].EVENTOIMAGEMSTATUS, retorno[indice].SEQUENCIAL, retorno[indice].EVENTODATA, retorno[indice].TIPOEVENTO, retorno[indice].EVENTOOBSERVACAO);
                    linhaCont += 1;
                }

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

function CriarLinhaEtapaEvento(prLinhaCont, prGrid, prEhEvento, prStatus, prSequencial, prData, prEtapa, prObservacao){
    let tr = document.createElement("tr");

    if (((prLinhaCont % 2) == 0) && (prEhEvento)){
        tr.setAttribute("style","background-color: #F8F8FF;")
        tr.onmouseover = function(){
            tr.setAttribute("style","background-color: #DCDCDC;")
        }
        tr.onmouseleave = function(){
            tr.setAttribute("style","background-color: #F8F8FF;")
        }
    }

    let tdEmBranco = document.createElement("td");
    tdEmBranco.setAttribute("class","col-md-1");

    let tdStatus = document.createElement("td");
    tdStatus.setAttribute("class","col-md-1");
    tdStatus.setAttribute("align","center");

    let imgStatus = document.createElement("img");
    imgStatus.setAttribute("src", "../tecnologia/img/status/" + prStatus +".png");
    imgStatus.setAttribute("widtd","15px");
    imgStatus.setAttribute("height","15px");

    tdStatus.appendChild(imgStatus);

    tdSequencial = document.createElement("td");
    tdSequencial.setAttribute("class","col-md-1");
    tdSequencial.setAttribute("align","center");
    tdSequencial.append(prSequencial);
    
    let tdData = document.createElement("td");
    tdData.setAttribute("class","col-md-2");
    tdData.append(moment(prData).format("DD/MM/YYYY hh:mm:ss"));

    let tdEtapa = document.createElement("td");
    tdEtapa.setAttribute("class","col-md-3")
    tdEtapa.append(prEtapa);

    let tdObservacao = document.createElement("td");
    tdObservacao.setAttribute("class","col-md-5")
    tdObservacao.append(prObservacao);

    if (prEhEvento)
        tr.appendChild(tdEmBranco);

    tr.appendChild(tdStatus);

    if (!prEhEvento)
    tr.appendChild(tdSequencial);

    tr.appendChild(tdData);
    tr.appendChild(tdEtapa);
    tr.appendChild(tdObservacao);

    prGrid.appendChild(tr);
}