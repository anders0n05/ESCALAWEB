<!-- Start Modal Executar -->
<div class="modal fade" id="modalExecutar" role="dialog" aria-spanledby="BaixarModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="BaixarModalspan">Executar etapa do pedido</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 pullBottom">
                        <span>Observação</span>
                        <textarea id="observacao"  class="form-control pulaCampoEnter" name="obs"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
                    <button id="executar" type="button" class="botaoBranco pullTop" onclick="executarOnClick()">Executar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //End Modal Executar -->

<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEtapaPedidoFiltro" method="post" action="EtapaPedido.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="FiltroModalspan">Filtrar etapa do pedido</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-3 pullBottom">
                        <span>Nr pedido</span>
                        <input class="form-control" id="numeroPedido" name="numeroPedido">
                    </div>
                    <div class="col-md-3 pullBottom">
                        <span>Rastreamento</span>
                        <input class="form-control" id="rastreamento" name="rastreamento">
                    </div>
                    <div class="col-md-3 pullBottom">
                        <span>De</span>
                        <input type="datetime-local" class="form-control" id="dataDe" name="dataDe">
                    </div>
                    <div class="col-md-3 pullBottom">
                        <span>Até</span>
                        <input type="datetime-local" class="form-control" id="dataAte" name="dataAte">
                    </div>
                    <div class="col-md-4 pullBottom">
                        <span>Cliente</span>
                        <input class="form-control" id="cliente" name="cliente">
                    </div>
                    <div class="col-md-4 pullBottom">
                        <span>Origem</span>
                        <input class="form-control" id="origem" name="origem">
                    </div>
                    <div class="col-md-4 pullBottom">
                        <span>Destino</span>
                        <input class="form-control" id="destino" name="destino">
                    </div>
                    <div class="col-md-6 pullBottom">
                        <span>Remetente</span>
                        <input class="form-control" id="remetente" name="remetente">
                    </div>
                    <div class="col-md-6 pullBottom">
                        <span>Destinatário</span>
                        <input class="form-control" id="destinatario" name="destinatario">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
                    <button type="reset" class="botaoBranco pullTop">Limpar</button>
                    <button type="submit" class="botaoBranco pullTop">Aplicar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- //End Modal Filtro -->

<!-- //start Modal retorno -->
<div aria-hidden="true" aria-labelledby="retornoModalLabel" role="dialog" tabindex="-1" id="retornoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Mensagem do sistema</h4>
            </div>
            <div class="modal-body">
                <div id="retornoModal-body">
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" id="retornoModalOk" type="button">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //end Modal retorno -->

<script>
    $(document).ready(function () {
        $('#numeroPedido').val("<?= Sistema::getPost("numeroPedido") ?>");
        $('#rastreamento').val("<?= Sistema::getPost("rastreamento") ?>");
        $('#dataDe').val("<?= Sistema::getPost("dataDe") ?>");
        $('#dataAte').val("<?= Sistema::getPost("dataAte") ?>");
        $('#cliente').val("<?= Sistema::getPost("cliente") ?>");
        $('#origem').val("<?= Sistema::getPost("origem") ?>");
        $('#destino').val("<?= Sistema::getPost("destino") ?>");
        $('#remetente').val("<?= Sistema::getPost("remetente") ?>");
        $('#destinatario').val("<?= Sistema::getPost("destinatario") ?>");
    });
</script>