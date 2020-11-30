<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="get" action="RastreioPedido.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="FiltroModalspan">Filtrar rastreio de pedido</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6 pullBottom">
                            <span>Nr pedido</span>
                            <input class="form-control" id="numeroPedido" name="numeroPedido">
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6 pullBottom">
                            <span>Rastreamento</span>
                            <input class="form-control" id="rastreamento" name="rastreamento">
                        </div>

                        <div class="col-xs-6 col-md-3 col-sm-6 pullBottom">
                            <span>Nr controle</span>
                            <input class="form-control" id="numeroControle" name="numeroControle">
                        </div>

                        <div class="col-xs-6 col-md-3 col-sm-6 pullBottom">
                            <span>Situação</span>
                            <select name="situacao[]" multiple id="situacao">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-3 col-sm-6 pullBottom">
                            <span>Filial</span>
                            <select name="filial[]" multiple id="filial">
                            </select>
                        </div>

                        <div class="col-xs-6 col-md-3 col-sm-6 pullBottom">
                            <span>Tipo de pedido</span>
                            <select name="tipo[]" multiple id="tipo">
                            </select>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 pullBottom">
                            <span>Data inicial</span>
                            <input type="date" id="dataInicio" class="form-control" name="dataInicio">
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 pullBottom">
                            <span>Data final</span>
                            <input type="date" id="dataFinal" class="form-control" name="dataFinal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-3 col-sm-6 pullBottom">
                            <span>Cliente</span>
                            <select name="cliente[]" multiple id="cliente" onchange="getUnidadeNegocio(this);">
                            </select>
                        </div>

                        <div class="col-xs-6 col-md-3 col-sm-6 pullBottom">
                            <span>Unidade de negócio do cliente</span>
                            <select name="unidadenegocio[]" multiple id="unidadenegocio">
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6 pullBottom">
                            <span>Documento originário</span>
                            <input class="form-control" id="documento" name="documento">
                        </div>

                        <div class="col-xs-6 col-md-3 col-sm-6">
                            <span>Observação originário</span>
                            <input type="text" id="observacao" class="form-control" name="observacao">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pullBottom">
                            <span>CT-e</span>
                            <input class="form-control" id="cte" name="cte">
                        </div>
                        <div class="col-md-4 pullBottom">
                            <span>Remetente</span>
                            <input class="form-control" id="remetente" name="remetente">
                        </div>

                        <div class="col-md-4 pullBottom">
                            <span>Destinatário</span>
                            <input class="form-control" id="destinatario" name="destinatario">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
                    <button type="reset" class="botaoBranco pullTop" onClick="limpaform()">Limpar</button>
                    <button type="submit" class="botaoBranco pullTop">Aplicar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- //End Modal Filtro -->

<script>
    $(document).ready(function() {

        $('#observacao').val("<?= Sistema::getGet("observacao") ?>");
        $('#numeroPedido').val("<?= Sistema::getGet("numeroPedido") ?>");
        $('#rastreamento').val("<?= Sistema::getGet("rastreamento") ?>");
        $('#dataInicio').val("<?= Sistema::getGet("dataInicio") ?>");
        $('#dataFinal').val("<?= Sistema::getGet("dataFinal") ?>");
        $('#remetente').val("<?= Sistema::getGet("remetente") ?>");
        $('#documento').val("<?= Sistema::getGet("documento") ?>");
        $('#numeroControle').val("<?= Sistema::getGet("numeroControle") ?>");

        <?php
        if (!empty(Sistema::getGetArray('filial'))) {
            foreach (Sistema::getGetArray('filial') as $filial) {
                $filialExplode = explode(';', $filial, 2);
                ?>
                $('#filial').append($('<option>', {
                    value: '<?= $filial ?>',
                    text: '<?= $filialExplode[1] ?>',
                    selected: true
                }));
            <?php
        }
    }

    if (!empty(Sistema::getGetArray('tipo'))) {
        foreach (Sistema::getGetArray('tipo') as $tipo) {
            $tipoExplode = explode(';', $tipo, 2);
            ?>
                $('#tipo').append($('<option>', {
                    value: '<?= $tipo ?>',
                    text: '<?= $tipoExplode[1] ?>',
                    selected: true
                }));
            <?php
        }
    }

    if (!empty(Sistema::getGetArray('unidadenegocio'))) {
        foreach (Sistema::getGetArray('unidadenegocio') as $unidadenegocio) {
            $unidadenegocioExplode = explode(';', $unidadenegocio, 2);
            ?>
                $('#unidadenegocio').append($('<option>', {
                    value: '<?= $unidadenegocio ?>',
                    text: '<?= $unidadenegocioExplode[1] ?>',
                    selected: true
                }));
            <?php
        }
    }

    if (!empty(Sistema::getGetArray('situacao'))) {
        foreach (Sistema::getGetArray('situacao') as $situacao) {
            $situacaoExplode = explode(';', $situacao, 2);
            ?>
                $('#situacao').append($('<option>', {
                    value: '<?= $situacao ?>',
                    text: '<?= $situacaoExplode[1] ?>',
                    selected: true
                }));
            <?php
        }
    }

    if (!empty(Sistema::getGetArray('cliente'))) {
        foreach (Sistema::getGetArray('cliente') as $cliente) {
            $clienteExplode = explode(';', $cliente, 2);
            ?>
                $('#cliente').append($('<option>', {
                    value: '<?= $cliente ?>',
                    text: '<?= $clienteExplode[1] ?>',
                    selected: true
                }));
            <?php
        }
    }
    ?>
    });
</script>