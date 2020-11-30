<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="ProgramacaoCargaDescarga.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="FiltroModalspan">Filtrar carga e descarga</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-6 col-md-3 pullBottom">
                        <span>Previsão início</span>
                        <input type="datetime-local" id="dataInicio" class="form-control" name="dataInicio">
                    </div>
                    <div class="col-xs-6 col-md-3 pullBottom">
                        <span>Previsão final</span>
                        <input type="datetime-local" id="dataFinal" class="form-control" name="dataFinal">
                    </div>
                    <div class="col-xs-6 col-md-3 pullBottom">
                        <span>Data embarque</span>
                        <input type="date" id="dataEmbarque" class="form-control" name="dataEmbarque">
                    </div>
                    <div class="col-xs-6 col-md-3 pullBottom">
                        <span>Data coleta</span>
                        <input type="date" id="dataColeta" class="form-control" name="dataColeta">
                    </div>
                    <div class="col-xs-12 col-md-6 pullBottom">
                        <span>Transportadora</span>
                        <div class="inner-addon right-addon"><font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="transportadora" id="transportadora" onClick="clickdownTransportadora();" class="editou form-control">
                        </div>
                        <input type="text" name="transportadoraHandle" id="transportadoraHandle" hidden="true">
                    </div>
                    <div class="col-xs-12 col-md-6 pullBottom">
                        <span>Pedido</span>
                        <input type="literal" id="pedido" class="form-control" name="pedido">
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

<!-- Start Modal Ocorrencia -->
<div class="modal fade" id="modalOcorrencia" role="dialog" aria-spanledby="BaixarModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="BaixarModalspan">Ocorrência de carga e descarga</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-3 pullBottom">
                        <span>Tipo</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="tipoOcorrencia" id="tipoOcorrencia" onfocus="tipoOnPesquisar()" onClick="clickdownTipoOcorrencia();" class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="tipoOcorrenciaHandle" id="tipoOcorrenciaHandle" hidden="true">
                        <input type="text" name="carregamento" id="carregamento" hidden="true">
                        <input type="text" name="acaoHandle" id="acaoHandle" hidden="true">
                    </div>
                    <div class="col-sm-3 pullBottom">
                        <span>Programação doca</span>           
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="progDoca" id="progDoca" onfocus="programacaoDocaOnPesquisar()" onClick="clickdownProgDoca();" class="editou form-control pulaCampoEnter" disabled>
                        </div>
                        <input type="text" name="progDocaHandle" id="progDocaHandle" hidden="true">
                        <input type="text" name="docaHandle" id="docaHandle" hidden="true">
                    </div>
                    <div class="col-sm-3 pullBottom">
                        <span>Previsão Entrega</span>
                        <input type="datetime-local" name="previsao" id="previsao" class="editou form-control" disabled>
                    </div>
                    <div class="col-sm-3 pullBottom">
                        <span>Número</span>
                        <input type="text" id="numero" class="form-control toUpper" name="numero" disabled>
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Tipo Veículo</span>           
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="tipoVeiculo" id="tipoVeiculo" onClick="clickdownTipoVeiculo();" class="editou form-control pulaCampoEnter" disabled>
                        </div>
                        <input type="text" name="tipoVeiculoHandle" id="tipoVeiculoHandle" hidden="true">
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Veículo</span>
                        <input type="text" id="veiculo" class="form-control toUpper pulaCampoEnter" name="veiculo" disabled>
                    </div>
                    <div class="col-sm-1 pullBottom">
                        <span>UF</span>           
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="ufVeiculo" id="ufVeiculo" onClick="clickdownUfVeiculo();" class="editou form-control pulaCampoEnter" disabled>
                        </div>
                        <input type="text" name="ufVeiculoHandle" id="ufVeiculoHandle" hidden="true">
                    </div>
                    <div class="col-sm-3 pullBottom">
                        <span>Propriedade</span>           
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="propriedadeVeiculo" id="propriedadeVeiculo" onClick="clickdownPropriedadeVeiculo();" class="editou form-control pulaCampoEnter" disabled>
                        </div>
                        <input type="text" name="propriedadeVeiculoHandle" id="propriedadeVeiculoHandle" hidden="true">
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Acoplado</span>
                        <input type="text" id="acoplado" class="form-control toUpper pulaCampoEnter" name="acoplado" disabled>
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Conteiner <font color="#FF0004">*</font></span>
                        <div class="inner-addon right-addon "> <font size="-2"><e class="glyphicon glyphicon-triangle-bottom add" id="spandown"></e></font>
                            <div class="input-group">   
                                <input type="text" id="conteiner" class="editou form-control pulaCampoEnter toUpper" onClick="clickdownConteiner();" name="conteiner">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="inserirConteiner"><i class="fa fa-plus text-success"></i></button>
                                </span>
                            </div>
                        </div>
                        <input type="text" id="conteinerHandle" hidden="true" name="conteinerHandle">
                    </div>
                    <div class="col-sm-5 pullBottom">
                        <span>Motorista</span>
                        <input type="text" id="motorista" class="form-control toUpper pulaCampoEnter" name="motorista" disabled>
                    </div>
                    <div class="col-sm-7 pullBottom">
                        <span>Documento</span>
                        <input type="text" id="documentoMotorista" class="form-control toUpper pulaCampoEnter" name="documentoMotorista" disabled>
                    </div>
                    <div class="col-sm-12 pullBottom">
                        <span>Observação</span>
                        <textarea id="obs"  class="form-control pulaCampoEnter" name="obs"></textarea>
                    </div>
                    <div class="col-sm-12 pullBottom">
                        <span>Anexo</span>
                        <input id="anexo" type="file" style="display: block;" name="image_src" class="form-control pulaCampoEnter">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
                    <button id="gravar" type="button" class="botaoBranco pullTop" onclick="manterOcorrencia()">Gravar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //End Modal Ocorrencia -->

<!-- Start Modal Conteiner -->
<div class="modal fade" id="inserirConteinerModal" role="dialog" aria-spanledby="inserirConteinerModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- id="formModalInserirConteiner" -->
            <form method="post" id="formModalInserirConteiner" action=""  enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="inserirConteinerModal">Inserir Conteiner</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-3 pullBottom">
                        <span>Contêiner</span>
                        <input type="text" id="codigoConteiner" value="<?php echo $codigoConteiner; ?>" class="form-control toUpper pulaCampoEnter" name="codigoConteiner">
                    </div>
                    <div class="col-sm-4 pullBottom">
                        <span>Tipo</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="tipoEquipamento" value="<?php echo $tipoEquipamento; ?>" id="tipoEquipamento"  onClick="clickdownTipoEquipamento();" class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="tipoEquipamentoHandle" value="<?php echo $tipoEquipamentoHandle; ?>" id="tipoEquipamentoHandle" hidden="true">
                    </div>
                    <div class="col-sm-5 pullBottom">
                        <span>Classificação ISO</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                            <input type="text" name="codigoISO" value="<?php echo $codigoISO; ?>" id="codigoISO"  onClick="clickdownCodigoISO();" class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="codigoISOHandle" value="<?php echo $codigoISOHandle; ?>" id="codigoISOHandle" hidden="true">
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Altura (m)</span>
                        <input type="text" id="alturaConteiner" value="<?php echo $alturaConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="alturaConteiner" >
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Largura (m)</span>
                        <input type="text" id="larguraConteiner" value="<?php echo $larguraConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="larguraConteiner" >
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Comprimento (m)</span>
                        <input type="text" id="comprimentoConteiner" value="<?php echo $comprimentoConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="comprimentoConteiner" >
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Capacidade (m³)</span>
                        <input type="text" id="capacidadeConteiner" value="<?php echo $capacidadeConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="capacidadeConteiner" >
                    </div>
                    <div class="col-sm-2 pullBottom">
                        <span>Tara (kg)</span>
                        <input type="text" id="taraConteiner" value="<?php echo $taraConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="taraConteiner" >
                    </div>
                    <div class="col-sm-1 pullBottom">
                        <span>Mgw (kg)</span>
                        <input type="text" id="mgwConteiner" value="<?php echo $mgwConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="mgwConteiner" >
                    </div>
                    <div class="col-sm-1 pullBottom">
                        <span>Fabricação</span>
                        <input type="text" id="fabricacaoConteiner" value="<?php echo $fabricacaoConteiner; ?>" class="form-control pulaCampoEnter inputRight" name="fabricacaoConteiner" >
                    </div>
                    <div class="col-sm-12 pullBottom">
                        <span>Observação</span>
                        <textarea id="obsInserirConteiner"  class="form-control" name="obsInserirConteiner"><?php echo $obsInserirConteiner; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="botaoBranco pullTop">Gravar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- //End Modal Conteiner -->

<!-- Start Modal Observacao -->
<div class="modal fade" id="modalObservacao" role="dialog" aria-spanledby="verObsModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Observação</h4>
            </div>
            <div class="modal-body" id="modalObservacaoConteudo">

            </div>
            <div class="modal-footer">
                <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- //End Modal Observacao -->

<script>
    $(document).ready(function () {
        $('#dataInicio').val("<?= Sistema::getPost("dataInicio") ?>");
        $('#dataFinal').val("<?= Sistema::getPost("dataFinal") ?>");
        $('#dataEmbarque').val("<?= Sistema::getPost("dataEmbarque") ?>");
        $('#dataColeta').val("<?= Sistema::getPost("dataColeta") ?>");
        $('#pedido').val("<?= Sistema::getPost("pedido") ?>");
        $('#transportadora').val("<?= Sistema::getPost("transportadora") ?>");
        $('#transportadoraHandle').val("<?= Sistema::getPost("transportadoraHandle") ?>");
    });
</script>