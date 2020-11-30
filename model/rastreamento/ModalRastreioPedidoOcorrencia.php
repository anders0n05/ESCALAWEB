<!-- Start Modal Filtro -->
<div class="modal fade" id="ocorrenciaModal" role="dialog" aria-spanledby="OcorrenciaModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="OcorrenciaModalspan">Ocorrência de transporte</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-5 pullBottom">
                        <span>Filial</span>
                        <input class="form-control" id="filialocorrencia" name="filialocorrencia" readonly>
                    </div>

                    <div class="col-xs-5 col-md-5 col-sm-5 pullBottom">
                        <span>Tipo</span>
                        <input class="form-control" id="tipoocorrencia" name="tipoocorrencia" readonly>
                    </div>         

                    <div class="col-xs-2 col-md-2 col-sm-2 pullBottom">
                        <span>Número</span>
                        <input class="form-control" id="numeroocorrencia" name="numeroocorrencia" readonly> 
                    </div>              
                </div>                                
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3 pullBottom">
                        <span>Data</span>
                        <input class="form-control" type="text" id="dataocorrencia" name="dataocorrencia" readonly>
                    </div>

                    <div class="col-xs-2 col-md-2 col-sm-2 pullBottom">
                        <span>Documento</span>
                        <input class="form-control" id="documentoocorrencia" name="documentoocorrencia" readonly>
                    </div> 
                    <div class="col-xs-3 col-md-3 col-sm-3 pullBottom">
                        <span>Responsável</span>
                        <input class="form-control" id="responsavelocorrencia" name="responsavelocorrencia" readonly>
                    </div> 
                    <div class="col-xs-4 col-md-4 col-sm-4 pullBottom">
                        <span>Motivo de atraso</span>
                        <input class="form-control" id="motivoatrasoocorrencia" name="motivoatrasoocorrencia" readonly>
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 pullBottom">
                            <span>Observação</span>
                            <textarea class="form-control" style="resize:none;" rows="3" id="observacaoocorrencia" name="observacaoocorrencia" readonly></textarea>
                    </div> 
                </div>
                <div class="row">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#AnexoOcorrencia" id="Anexo-tab" role="tab" data-toggle="tab" aria-controls="ocorrenciatransporte" aria-expanded="true">Anexo</a></li>
                    </ul>
                    <div class="col-xs-12 bottonPull" style="padding: 0px">                            
                        <table class="table table-responsive table-striped bottomPull" id="reqtableDocumento" border="0">
                            <thead>                            
                            <th style="border-left: 1px solid #2b9bcb;" width="5%">Data</th>
                            <th>Descrição</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody id="tbodyAnexo">
                                <?php
                                include_once('../../model/rastreamento/VisualizarRastreioPedidoDocumentoTabelaModel.php');
                                ?>
                            </tbody>
                        </table>

                        <div class="clearfix"></div>
                        </p>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="botaoBranco pullTop" id="fecharModalOcorrencia" data-dismiss="modal">Fechar</button>  
            </div>              
        </div>
    </div>                
</div>
<!-- //End Modal Ocorrencia -->
<script>
    $("#tbodyAnexo").on('click', 'i', function(e) {
        var handle = $(e.target).attr('handle');     
        var ocorrencia = $(e.target).attr('ocorrencia'); 

        $.ajax({
            url: "../../controller/rastreamento/Ocorrencia.php", 
            method: "POST",
            dataType: "html",            
            data: {
                "ACAO"      : "baixarOcorrenciaTransporteAnexo",
                "ANEXO"     : handle,
                "OCORRENCIA": ocorrencia
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

    $(document).keydown(function(event) { 
        if (event.keyCode == 27) { 
            $('#fecharModalOcorrencia').click();
        }
    });

    $('#ocorrenciaModal').on('shown.bs.modal', function(e) {
        var handle = $(e.relatedTarget).attr('handle');
        
        $.ajax({
            url: "../../controller/rastreamento/Ocorrencia.php", 
            method: "POST",
            dataType: "JSON",
            data: {
                "ACAO"          : "getOcorrenciaTransporte",
                "OCORRENCIA"    : handle
            },
            success: function (retorno) {     
                
                if (typeof retorno[0] !== 'undefined') {
                    $("#filialocorrencia").val(retorno[0].FILIAL);    
                    $("#tipoocorrencia").val(retorno[0].TIPO);
                    $("#numeroocorrencia").val(retorno[0].NUMERO);                
                    $("#dataocorrencia").val(moment(retorno[0].DATA).format('DD/MM/YYYY HH:mm'));
                    $("#documentoocorrencia").val(retorno[0].DOCUMENTO);
                    $("#responsavelocorrencia").val(retorno[0].RESPONSAVEL);
                    $("#motivoatrasoocorrencia").val(retorno[0].MOTIVOATRASO);
                    $("#observacaoocorrencia").val(retorno[0].OBSERVACAO);
                } else {
                    swal({
                        title: "Oopss!",
                        text: "Ocorrência inválida para visualização",
                        icon: "error"
                    });

                    $("#ocorrenciaModal").modal("hide");
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

        $.ajax({
            url: "../../controller/rastreamento/Ocorrencia.php", 
            method: "POST",
            dataType: "JSON",
            data: {
                "ACAO"          : "getOcorrenciaTransporteAnexo",
                "OCORRENCIA"    : handle
            },
            success: function (retorno) {     
                $("#tbodyAnexo").empty();

                if (typeof retorno[0] !== 'undefined') {
                    
                    for(var i in retorno){
                        var tr = $(document.createElement('tr'));
                        $('<td/>', {
                            'html':'<span>'+moment(retorno[i].DATA).format('DD/MM/YYYY HH:mm')+'</span>'
                        }).appendTo(tr);

                        $('<td/>', {
                            'html':'<span>'+retorno[i].DESCRICAO+'</span>'
                        }).appendTo(tr);

                        var td = $(document.createElement('td'));
                        td.css('text-align','center');

                        $('<i/>', {
                            'class':'glyphicon glyphicon-download',
                            'handle': retorno[i].HANDLE, 
                            'ocorrencia': handle,                           
                            'style':'cursor:pointer'
                        }).appendTo(td);

                        td.appendTo(tr);
                        tr.appendTo('#tbodyAnexo');
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
    });
</script>