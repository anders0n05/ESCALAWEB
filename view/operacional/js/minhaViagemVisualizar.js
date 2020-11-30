$(function () {
    var dadosEnvioGlobal;

    $.ajaxSetup({
        async: false
    });

    $('.btnFechar').on('click', FecharOnClick);

    AtualizarPermissoes();

    let botaoIniciarViagem = $('#iniciarViagem');
    let botaoFinalizarViagem = $('#finalizarViagem');
    let botaoBaixarItem = $('#baixarItem');
    let botaoBaixarMdfe = $('#baixarMdfe');

    botaoIniciarViagem.on('click', BotaoIniciarViagemOnClick);
    botaoFinalizarViagem.on('click', BotaoFinalizarViagemOnClick);
    botaoBaixarItem.on('click', BaixarOnClick);
    botaoBaixarMdfe.on('click', BaixarMdfeOnClick);


    $('.local').click(function() {
        if($(this).is(':checked')) {
            $('input[local="'+$(this).attr('value')+'"]').each(function() {
                $(this).prop("checked", true);                
            });

            var situacao = $(this).attr('situacao');            
            $(".local:checked").each(function() {                
                if(situacao != $(this).attr('situacao')) {
                    $("#baixarItem").prop("disabled", true);
                    return false;
                } else {
                    $("#baixarItem").html($(this).attr('situacao'));
                    $("#baixarItem").prop("disabled", false);   
                }
            });
        } else {
            $('input[local="'+$(this).attr('value')+'"]').each(function() {
                $(this).prop("checked", false);
            }); 
                                    
            $(".local:checked").each(function() {                
                if($("#baixarItem").html() == $(this).attr('situacao')) {
                    $("#baixarItem").prop("disabled", false);                    
                } else {
                    $("#baixarItem").html($(this).attr('situacao'));
                    $("#baixarItem").prop("disabled", false);   
                }
            });
        }
        
        if ($(".local:checked").length == 0) {
            $("#baixarItem").html('Baixar');
            $("#baixarItem").prop("disabled", true);       
        }
    });

    $('.item').click(function() {
        if($(this).is(':checked')) {
           var nMarcado = $('input[local="'+$(this).attr('local')+'"]:checked').length;
           var total = $('input[local="'+$(this).attr('local')+'"]').length  
           if (nMarcado == total) {
                $('input[value="'+$(this).attr('local')+'"]').prop("checked", true);
                $('button[local="'+$(this).attr('local')+'"]').css("visibility", "visible");                
           } else {
                $('input[value="'+$(this).attr('local')+'"]').prop("checked", false); 
                $('button[local="'+$(this).attr('local')+'"]').css("visibility", "hidden");   
           }
           var botoes = $('button[local="'+$(this).attr('local')+'"]'); 
           $(this).parent().parent().find(botoes).css("visibility", "visible");
        } else {
            $('input[value="'+$(this).attr('local')+'"]').prop("checked", false);
            $('button[local="'+$(this).attr('local')+'"]').css("visibility", "hidden");  
        }    
    });

    $("#ItensTable").on('click', 'i', function(e) {
        var handle = $(e.target).attr('handle');             

        $.ajax({
            url: "../../controller/operacional/Viagem.php", 
            method: "POST",
            dataType: "html",            
            data: {
                "ACAO"      : "getDocumentoPdf",
                "HANDLE"    : handle
            },
            success: function (retorno, status, request) {                
                var link=document.createElement('a');
                link.href='data:application/octet-stream;base64,' + retorno;
                link.download=/filename=(.*)$/.exec(request.getResponseHeader('Content-Disposition'))[1];
                link.click();
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
});

$(document).on('change', 'select', function(event) {    

    if (event.target.id == "tipoOcorrencia") {        
        var arr = ['41', '3', '5', '7', '11', '13', '16', '18', '37', '38', '20'];
        var acao = $(event.target).find('option:selected').attr("acao");
  
        if (arr.indexOf(acao) >= 0) {
            
            $("#motivoOcorrencia").parent().css("display", "none");
            $("#motivoGenOcorrencia").parent().css("display", "block");
            $('#motivoGenOcorrencia').prop('selectedIndex',0);

        } else {
            $("#motivoOcorrencia").parent().css("display", "block");
            $("#motivoGenOcorrencia").parent().css("display", "none");
            $('#motivoOcorrencia').prop('selectedIndex',0);
        }
    }
});

function botaoBaixarItemGrid() {  
    var romaneioLocalHandle = []; 
    var data = new Date();
    var dataFormatada = data.getFullYear() + '-' +
                        ('00' + data.getMonth()).slice(-2) + '-'+ 
                        ('00' + data.getDate()).slice(-2) + 'T' + 
                        ('00' + data.getHours()).slice(-2) +':'+
                        ('00' + data.getMinutes()).slice(-2) +':'+
                        ('00' + data.getSeconds()).slice(-2);
    var dadosposicao = '';
    
    var handle = $('#HANDLE').val();   

    var romaneioLocal = $(".local:checkbox:checked");
    
    if (navigator.geolocation) {              
        navigator.geolocation.getCurrentPosition(function (posicao){
            dadosposicao = ",\"posicao\": { " +
                                        "\"latitude\":\"" + posicao.coords.latitude + "\"," +
                                        "\"longitude\":\"" + posicao.coords.longitude + "\"," +
                                        "\"data\":\"" + dataFormatada + "\"}";            
                                
        });

        var dados = "[";

        for (indiceItem in romaneioLocal){
            if (Number.isInteger(parseInt(romaneioLocal[indiceItem].value))){
                romaneioLocalHandle.push(parseInt(romaneioLocal[indiceItem].value));

                if (dados != "["){
                    dados = dados + ",";
                }

                dados = dados + "{ "+
                                    " \"localhandle\": \"" + parseInt(romaneioLocal[indiceItem].value) + "\"," +                                        
                                    " \"viagem\"      :\""  + handle +"\", " +
                                    " \"referenciaorigem\":\"" + $(romaneioLocal[indiceItem]).attr('situacao') + "\", " +
									" \"data\":\"" + dataFormatada + "\", " +
                                    " \"operacao\"    : \"" + parseInt($(romaneioLocal[indiceItem]).attr('operacao')) + "\"" + dadosposicao +"}";
            } else {
                break;
            }              
        }

        dados = dados + "]";

        dados = "{" +
                                "\"campovazio\": \"0\", "+
                                "\"local\":" +dados +
                                "}";    
        
        $.ajax({
            url: "../../controller/operacional/Viagem.php",
            method: "POST",
            dataType: "JSON",
            data: {
                "HANDLE": handle,
                "DADOS": dados,
                "ACAO": "baixarItensLocal"
            },
            success: function (retorno) {
                swal({
                    title: "Itens baixados!",
                    text: retorno.responseText,
                    icon: "success",
                    showCloseButton: true
                }).then(function (dismiss) {
                    location.href = "../../view/operacional/MinhaViagemVisualizar.php?viagem="+handle;
                });;               
            },
            error: function (retorno) {
                swal({
                    title: "Oopss!",
                    text: retorno.responseText,
                    icon: "error"
                });      
            }
        });
    } else {
        swal({
            title: "Oopss!",
            text: "Navegador não possui permissão de localização geográfica",
            icon: "error"
        });   
    }
}

function killPopup(){
    let divPopup = $('.meu_popup');
    divPopup.remove();
}

function AtualizarPermissoes(){
    let handle = $('#HANDLE').val();

    let iniciarViagem = $('#linhaIniciarViagem')[0];
    let finalizarViagem = $('#linhaFinalizarViagem')[0];

    $.ajax({
        url: "../../controller/operacional/Viagem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getPermissoesBotao"
        },
        success: function (retorno) {
            iniciarViagem.classList.remove("displayNone");
            iniciarViagem.classList.remove("displayListItem");

            finalizarViagem.classList.remove("displayNone");
            finalizarViagem.classList.remove("displayListItem");

            if (retorno.podeIniciarViagem == "true"){
                iniciarViagem.classList.add("displayListItem");
            }
            else{
                iniciarViagem.classList.add("displayNone");
            }

            if (retorno.podeFinalizarViagem == "true"){
                finalizarViagem.classList.add("displayListItem");
            }
            else{
                finalizarViagem.classList.add("displayNone");
            }      

            $("#stats").text(retorno.statusNome); 
            
        },
        error: function (retorno) {
            /*
            console.log("erro atualizar permissão");
            console.log(retorno);
            */
        }
    });
}

function BaixarOnClick() {
    var romaneioItem = $(".item:checkbox:checked"); 
    var operacoes = [];
    
    if (romaneioItem.length == 0){        
        swal({
            title: "Oopss!",
            text: "Nenhum item foi selecionado para ser baixado.",
            icon: "error"
        });
    } else {
        for (indiceItem in romaneioItem){
            if(Number.isInteger(parseInt(romaneioItem[indiceItem].value))) {
                operacoes.push($(romaneioItem[indiceItem]).attr('operacao'));
            } else {
                break;
            }

        }
        
        if(operacoes.indexOf('0') > -1){
            BotaoBaixarItemOnClick();
        } else {
            botaoBaixarItemGrid();    
        }
    }
}

function BotaoBaixarItemOnClick(){
    let romaneioItem = $(".item:checkbox:checked");
    
    if (romaneioItem.length == 0){        
        swal({
            title: "Oopss!",
            text: "Nenhum item foi selecionado para ser baixado.",
            icon: "error"
        });
    }
    else {
        let divMain = $('#FormViagem');

        let divForm = document.createElement("div");
        divForm.setAttribute("class", "meu_popup");

        let divContent = document.createElement("div");
        divContent.setAttribute("class", "meu_popup_inner");

        let botaoFechar = document.createElement("button");
        botaoFechar.setAttribute("id","popupFechar");
        botaoFechar.setAttribute("class","btn btn-outline-secondary floatRight");
        botaoFechar.innerHTML = "X";

        let hrTitulo = document.createElement("hr");

        let tituloH3 = document.createElement("h3");
        tituloH3.setAttribute("class","bold");
        tituloH3.append("Baixar itens da viagem");

        let divTitulo = document.createElement("div");
        divTitulo.setAttribute("class","form-row col-md-12 textcenter");
        
        divTitulo.append(botaoFechar);
        divTitulo.append(hrTitulo);
        divTitulo.append(tituloH3);

        //________________________________________

        let divFilial = document.createElement("div");
        divFilial.setAttribute("class","form-row col-md-12");

        let spanFilial = document.createElement("span");
        spanFilial.append("Filial");

        let campoFilial = document.createElement("select");
        campoFilial.setAttribute("class", "form-control");
        campoFilial.setAttribute("id", "filialOcorrencia");
        campoFilial.setAttribute("disabled", true);

        divFilial.append(spanFilial);
        divFilial.append(campoFilial);
        //________________________________________
        
        let divData = document.createElement("div");
        divData.setAttribute("class","form-row col-md-3");

        let spanData = document.createElement("span");
        spanData.append("Data");

        let campoData = document.createElement("input");
        campoData.setAttribute("type","datetime-local");
        campoData.setAttribute("class","form-control datahora");
        campoData.setAttribute("id","dataOcorrencia");
        campoData.setAttribute("readonly", true);
        
        divData.append(spanData);
        divData.append(campoData);

        //________________________________________
        let divTipoOcorrencia = document.createElement("div");
        divTipoOcorrencia.setAttribute("class","form-row col-md-9");

        let spanTipoOcorrencia = document.createElement("span");
        spanTipoOcorrencia.append("Tipo de ocorrência");

        let campoTipoOcorrencia = document.createElement("select");
        campoTipoOcorrencia.setAttribute("class", "form-control");
        campoTipoOcorrencia.setAttribute("id", "tipoOcorrencia");

        divTipoOcorrencia.append(spanTipoOcorrencia);
        divTipoOcorrencia.append(campoTipoOcorrencia);
        //________________________________________
        let divResponsavel = document.createElement("div");
        divResponsavel.setAttribute("class","form-row col-md-4");

        let spanResponsavel = document.createElement("span");
        spanResponsavel.append("Responsável");

        let campoResponsavel = document.createElement("select");
        campoResponsavel.setAttribute("class", "form-control");
        campoResponsavel.setAttribute("id", "responsavelOcorrencia");
        campoResponsavel.setAttribute("disabled", true);

        divResponsavel.append(spanResponsavel);
        divResponsavel.append(campoResponsavel);
        //________________________________________
        let divNome = document.createElement("div");
        divNome.setAttribute("class","form-row col-md-4");

        let spanNome = document.createElement("span");
        spanNome.append("Nome");

        let campoNome = document.createElement("input");
        campoNome.setAttribute("class", "form-control");
        campoNome.setAttribute("id", "nomeOcorrencia");         

        divNome.append(spanNome);
        divNome.append(campoNome);
        //________________________________________
        let divDocumento = document.createElement("div");
        divDocumento.setAttribute("class","form-row col-md-4");

        let spanDocumento = document.createElement("span");
        spanDocumento.append("Nr documento");

        let campoDocumento = document.createElement("input");
        campoDocumento.setAttribute("class", "form-control");
        campoDocumento.setAttribute("id", "documentoOcorrencia");         

        divDocumento.append(spanDocumento);
        divDocumento.append(campoDocumento);        
        //________________________________________
        let divMotivo = document.createElement("div");
        divMotivo.setAttribute("class","form-row col-md-12");

        let spanMotivo = document.createElement("span");
        spanMotivo.append("Motivo de atraso");

        let campoMotivo = document.createElement("select");
        campoMotivo.setAttribute("class", "form-control");
        campoMotivo.setAttribute("id", "motivoOcorrencia");

        divMotivo.append(spanMotivo);
        divMotivo.append(campoMotivo);
        //________________________________________
        let divMotivoGen = document.createElement("div");
        divMotivoGen.setAttribute("class","form-row col-md-12");
        divMotivoGen.setAttribute("style", "display: none;");

        let spanMotivoGen = document.createElement("span");
        spanMotivoGen.append("Motivo");

        let campoMotivoGen = document.createElement("select");
        campoMotivoGen.setAttribute("class", "form-control");
        campoMotivoGen.setAttribute("id", "motivoGenOcorrencia");        

        divMotivoGen.append(spanMotivoGen);
        divMotivoGen.append(campoMotivoGen);
        //________________________________________
        let divAnexo = document.createElement("div");
        divAnexo.setAttribute("class","form-row col-md-12");

        let spanAnexo = document.createElement("span");
        spanAnexo.append("Anexo");

        let divDropzone = document.createElement("div");
        divDropzone.setAttribute("class", "dropzone");
        
        let divDZMessage = document.createElement("div");
        divDZMessage.setAttribute("class", "dz-message");
        
        let spanDZMessage = document.createElement("span");
        spanDZMessage.append("Clique ou solte arquivos aqui para anexar.");
        
        let divFallBack = document.createElement("div");
        divFallBack.setAttribute("class", "fallback");

        let campoFile = document.createElement("input");
        campoFile.setAttribute("name", "file");
        campoFile.setAttribute("id", "file");
        campoFile.setAttribute("type", "file");
        campoFile.setAttribute("multiple", true);

        divFallBack.appendChild(campoFile);

        divDZMessage.appendChild(spanDZMessage);

        divDropzone.appendChild(divDZMessage);
        divDropzone.appendChild(divFallBack);

        divAnexo.appendChild(spanAnexo);
        divAnexo.appendChild(divDropzone);

        //________________________________________

        let divBotao = document.createElement("div");
        divBotao.setAttribute("class","form-row col-md-12");

        let hrBotao = document.createElement("hr");

        let botaoBaixar = document.createElement("button");
        botaoBaixar.append("Baixar");
        botaoBaixar.setAttribute("class", "btn btn-success btn-lg btn-block");    
        botaoBaixar.setAttribute("id","baixarOcorrencias");
        
        divBotao.append(hrBotao);
        divBotao.append(botaoBaixar);

        divContent.append(divTitulo);
        divContent.append(divFilial);
        divContent.append(divData);
        divContent.append(divTipoOcorrencia);
        divContent.append(divResponsavel);
        divContent.append(divNome);
        divContent.append(divDocumento);        
        divContent.append(divMotivo);
        divContent.append(divMotivoGen);                
        divContent.append(divAnexo);
        divContent.append(divBotao);
        divForm.append(divContent);
        divMain.append(divForm);

        PreencherData(campoData);

        PreencherFkFilial(campoFilial);

        PreencherFkTipoOcorrencia(campoTipoOcorrencia);

        PreencherFkResponsavel(campoResponsavel);

        PreencherFkMotivo(campoMotivo, campoMotivoGen);

        $(".modal-dialog").draggable();
        
        let handle = $('#HANDLE').val();

        $("div.dropzone").dropzone({ 
            url: "../../controller/operacional/Viagem.php",
            method: "POST",
            dataType: "JSON",
            autoProcessQueue: false,
            maxFilesize: 50, // MB
            timeout: 180000,
            uploadMultiple: true,
            addRemoveLinks: true,
            init: function () {
                dz = this;
                this.on('addedfile', function (file, xhr, formData) {
                }),
                this.on('sending', function (file, xhr, formData) {
                                        
                    $('.meu_popup_inner').find('input, select, textarea').attr('disabled', false);
                    $('#baixarOcorrencias, #popupFechar').attr('disabled', "disabled");
                    $('#baixarOcorrencias, #popupFechar').html('<i class="fas fa-sync fa-spin"></i>');

                    formData.append("ACAO", "baixarItensViagem");
                    formData.append("HANDLE", handle);
                    formData.append("DADOS", dadosEnvioGlobal);
                });
            },
            success: function (file, retorno) {
                //console.log(retorno);
                swal({
                    title: "Itens baixados!",
                    text: retorno.responseText,
                    icon: "success",
                    showCloseButton: true
                }).then(function (dismiss) {
                    location.href = "../../view/operacional/MinhaViagemVisualizar.php?viagem="+handle;
                });
            },
            error: function (file, retorno) {
                swal({
                    title: "Oopss!",
                    text: retorno.responseText,
                    icon: "error"
                });
                
                $('.meu_popup_inner').find('input, select, textarea').attr('disabled', false);
                $('#baixarOcorrencias, #popupFechar').attr('disabled', false);
                $('#baixarOcorrencias').html('Baixar'); 
                $('#popupFechar').html('X');               
                
            }
        });

        $('#popupFechar').on("click", killPopup);
        $('#baixarOcorrencias').on("click", criarOcorrencias);
    }
}

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

function criarOcorrencias(){     
    
    let handle = $('#HANDLE').val();

    let romaneioItem = $(".item:checkbox:checked");
    let romaneioItemHandle = [];
    
    let filial = $("#filialOcorrencia")[0].value;
    let data = $("#dataOcorrencia")[0].value;
    let tipo = $("#tipoOcorrencia")[0].value;
    let responsavel = $("#responsavelOcorrencia")[0].value;
    let motivoOcorrencia = $("#motivoOcorrencia")[0].value;
    let motivoGenOcorrencia = $("#motivoGenOcorrencia")[0].value;
    let nome = $("#nomeOcorrencia")[0].value;
    let documento = $("#documentoOcorrencia")[0].value;

    if (checarCampoVazio(filial, "filial") &&
        checarCampoVazio(data, "data") &&
        checarCampoVazio(tipo, "tipo de ocorrência") &&
        checarCampoVazio(responsavel, "responsável")) {

        dadosEnvioGlobal = "[";

        for (indiceItem in romaneioItem){
            if (Number.isInteger(parseInt(romaneioItem[indiceItem].value))){
                romaneioItemHandle.push(parseInt(romaneioItem[indiceItem].value));
    
                if (dadosEnvioGlobal != "["){
                    dadosEnvioGlobal = dadosEnvioGlobal + ",";
                }
    
                dadosEnvioGlobal = dadosEnvioGlobal + "{ "+
                                                    " \"romaneioItem\"     : \"" + parseInt(romaneioItem[indiceItem].value) + "\", "+
                                                    " \"filial\"           : \""+filial+"\", "+
                                                    " \"data\"             : \""+data+"\", "+
                                                    " \"tipo\"             : \""+tipo+"\", "+
                                                    " \"nome\"             : \""+nome+"\", "+
                                                    " \"documento\"             : \""+documento+"\", "+
                                                    " \"motivoOcorrencia\" : \""+motivoOcorrencia+"\", "+
                                                    " \"motivoGenOcorrencia\" : \""+motivoGenOcorrencia+"\", "+
                                                    " \"responsavel\"      : \""+responsavel+"\" }";
            }                
        }
    
        dadosEnvioGlobal = dadosEnvioGlobal + "]";
    
        dadosEnvioGlobal = "{" +
                            "\"campovazio\": \"0\", "+
                            "\"item\":" +dadosEnvioGlobal +
                            "}";
        
        if (dz.getQueuedFiles().length === 0) {
            var blob = new Blob();
            blob.upload = {
                'chunked': dz.defaultOptions.chunking
            };
            dz.uploadFile(blob);
        } else {
            dz.processQueue();
        }
    }

    return false;
}

function PreencherFkFilial(campoFilial){
    let handle = $('#HANDLE').val();

    $.ajax({
        url: "../../controller/operacional/Viagem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getFiliaisEmpresa"
        },
        success: function (retorno) {
            for (indiceFilial in retorno) {

                let opcaoFilial = document.createElement("option");
                opcaoFilial.setAttribute("value", retorno[indiceFilial].HANDLE);
                opcaoFilial.append(retorno[indiceFilial].NOME);

                if (retorno[indiceFilial].HANDLE == retorno[indiceFilial].FILIALATUAL){
                    opcaoFilial.setAttribute("selected", true);
                }

                campoFilial.append(opcaoFilial);
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

function PreencherData(campoData){
    let handle = $('#HANDLE').val();

    $.ajax({
        url: "../../controller/tecnologia/GenericCall.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getData"
        },
        success: function (retorno) {
            campoData.value = retorno.data.replace(" ", "T");
        },
        error: function(retorno){
            //campoData.value = moment().format('YYYY-MM-DDThh:mm');
            swal({
                title: "Oopss!",
                text: retorno.responseText,
                icon: "error"
            });
        }
    });
}

function PreencherFkTipoOcorrencia(campoTipoOcorrencia){
    let handle = $('#HANDLE').val();

    $.ajax({
        url: "../../controller/operacional/Viagem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getTiposOcorrencia"
        },
        success: function (retorno) {            
            for (indice in retorno) {

                let opcao = document.createElement("option");
                opcao.setAttribute("value", retorno[indice].HANDLE);
                opcao.setAttribute("acao", retorno[indice].ACAO);                
                opcao.append(retorno[indice].NOME);                

                campoTipoOcorrencia.append(opcao); 
                
                if (indice == 0) {                
                    $("#"+campoTipoOcorrencia.getAttribute('id')).change();
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

function PreencherFkResponsavel(campoResponsavel){
    let handle = $('#HANDLE').val();
    
    $.ajax({
        url: "../../controller/operacional/Viagem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getOcorrenciaResponsavel"
        },
        success: function (retorno) {
            for (indice in retorno) {

                let opcao = document.createElement("option");
                opcao.setAttribute("value", retorno[indice].HANDLE);
                opcao.append(retorno[indice].NOME);

                if (retorno[indice].HANDLE == 4){
                    opcao.setAttribute("selected", true);    
                }

                campoResponsavel.append(opcao);
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

function PreencherFkMotivo(campoMotivo, campoMotivoGen){
    let handle = $('#HANDLE').val();
    
    let opcao = document.createElement("option");
    opcao.setAttribute("value", "");
    opcao.append("Selecione..");

    campoMotivo.append(opcao);

    $.ajax({
        url: "../../controller/operacional/Viagem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getOcorrenciaMotivo"
        },
        success: function (retorno) {
            for (indice in retorno) {

                opcao = document.createElement("option");
                opcao.setAttribute("value", retorno[indice].HANDLE);                
                opcao.append(retorno[indice].NOME);

                campoMotivo.append(opcao);
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

    let opcaogen = document.createElement("option");
    opcaogen.setAttribute("value", "");
    opcaogen.append("Selecione..");

    campoMotivoGen.append(opcaogen);

    $.ajax({
        url: "../../controller/operacional/Viagem.php",
        method: "POST",
        dataType: "JSON",
        data: {
            "HANDLE": handle,
            "ACAO": "getMotivoGenericoOcorrencia"
        },
        success: function (retorno) {
            for (indice in retorno) {

                opcaogen = document.createElement("option");
                opcaogen.setAttribute("value", retorno[indice].HANDLE);
                opcaogen.append(retorno[indice].NOME);

                campoMotivoGen.append(opcaogen);
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

function BotaoIniciarViagemOnClick(){
    let handle = $('#HANDLE').val();

    swal({
        title: "Efetuar início da viagem?",
        text: "A viagem será iniciada.",
        icon: "warning",                
        buttons: true,
        dangerMode: true,
        content: {
            element: "input",
            attributes: {            
              placeholder: "Marcador atual",
              type: "text"
            }
        }        
    }).then(function (value) {        
        if(value === '') {
            swal({
                title: 'Marcador inválido!',
                text: 'Marcador não foi informado',
                icon: 'error'
            })
            return false;
        } else if (value === null) {
            return false;
        }

        $.ajax({
            url: "../../controller/operacional/Viagem.php",
            method: "POST",
            dataType: "JSON",
            data: {
                "HANDLE": handle,
                "ACAO": "efetuarsaida",
                "MARCADOR": value
            },
            success: function (retorno) {
                swal({
                    title: "Viagem iniciada!",
                    text: retorno.responseText,
                    icon: "success"
                }).then(
                    AtualizarPermissoes()
                );                
            },
            error: function (retorno) {
                bugsnagClient.notify(new Error(retorno.responseText), {
                    beforeSend: function (report) {
                        report.updateMetaData('Dados enviados', {
                            "DADOS": {
                                "handle": handle,
                                "acao": "efetuarsaida"
                            }
                        });
                    }
                });
    
                swal({
                    title: "Oopss!",
                    text: retorno.responseText,
                    icon: "error"
                });
            }
        });        
    });
}

function BotaoFinalizarViagemOnClick(){
    let handle = $('#HANDLE').val();

    swal({
        title: "Efetuar término da viagem?",
        text: "A viagem será finalizada.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        content: {
            element: "input",
            attributes: {            
              placeholder: "Marcador atual",
              type: "text"
            }
        }              
    }).then(function (value) {
        if(value === '') {
            swal({
                title: 'Marcador inválido!',
                text: 'Marcador não foi informado',
                icon: 'error'
            })
            return false;
        } else if (value === null) {
            return false;
        }       
        $.ajax({
            url: "../../controller/operacional/Viagem.php",
            method: "POST",
            dataType: "JSON",
            data: {
                "HANDLE": handle,
                "ACAO": "efetuarchegada",
                "MARCADOR": value
            },
            success: function (retorno) {
                swal({
                    title: "Viagem finalizada!",
                    text: retorno.responseText,
                    icon: "success"
                }).then(
                    AtualizarPermissoes()
                );
            },
            error: function (retorno) {
                bugsnagClient.notify(new Error(retorno.responseJSON.message), {
                    beforeSend: function (report) {
                        report.updateMetaData('Dados enviados', {
                            "DADOS": {
                                "HANDLE": handle,
                                "ACAO": "efetuarchegada"
                            }
                        });
                    }
                });

                swal({
                    title: "Oopss!",
                    text: retorno.responseJSON.message,
                    icon: "error"
                });
            }
        });
    });
}

function FecharOnClick(){
    window.location.href = "../../view/operacional/MinhaViagemConsulta.php";
}

function BaixarMdfeOnClick() {
    let handle = $('#HANDLE').val();  

    $.ajax({
        url: "../../controller/operacional/Viagem.php", 
        method: "POST",
        dataType: "html",            
        data: {
            "ACAO"      : "getPDFMDFe",
            "HANDLE"    : handle
        },
        success: function (retorno, status, request) {                
            var link=document.createElement('a');
            link.href='data:application/octet-stream;base64,' + retorno;
            link.download=/filename=(.*)$/.exec(request.getResponseHeader('Content-Disposition'))[1];
            link.click();
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