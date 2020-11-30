<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="CargaDescargaFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar carga e descarga</h4>
      </div>
      <div class="modal-body">
        	<div class="col-xs-6 col-md-3 pullBottom">
            	<span>Previsão Início</span>
                <input type="datetime-local" id="dataInicio" class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-3 pullBottom">
            	<span>Previsão Final</span>
                <input type="datetime-local" id="dataFinal" class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-6 col-md-3 pullBottom">
            	<span>Data Embarque</span>
                <input type="date" id="dataEmbarque" class="form-control" name="dataEmbarque">
            </div>
            <div class="col-xs-6 col-md-3 pullBottom">
            	<span>Data Embarque</span>
                <input type="date" id="dataColetar" class="form-control" name="dataColetar">
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

<!-- Start Modal verOBS -->
<div class="modal fade" id="verObsModal" role="dialog" aria-spanledby="verObsModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Observação</h4>
      </div>
      <div class="modal-body" id="verObsModalConteudo">
       		
      </div>
      <div class="modal-footer">
        <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Fechar</button>
      </div>
  </div>
</div>
</div>
<!-- //End Modal verOBS -->

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