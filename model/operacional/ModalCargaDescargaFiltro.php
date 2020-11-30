<?php
$transportadora = null;
$pedido = $_POST['pedido'];

$dataInicioToTime =strtotime($_POST['dataInicio']);
$dataInicio= ($dataInicioToTime === false) ? '0000-00-00' : date('Y-m-d', $dataInicioToTime);
$horaInicio = ($dataInicioToTime === false) ? '00:00:00' : date('H:i:s', $dataInicioToTime);

$dataFinalToTime =strtotime($_POST['dataFinal']);
$dataFinal= ($dataFinalToTime === false) ? '0000-00-00' : date('Y-m-d', $dataFinalToTime);
$horaFinal = ($dataFinalToTime === false) ? '00:00:00' : date('H:i:s', $dataFinalToTime);

$dataEmbarqueToTime =strtotime($_POST['dataEmbarque']);
$dataEmbarque= ($dataEmbarqueToTime === false) ? '0000-00-00' : date('Y-m-d', $dataEmbarqueToTime);

$dataColetarToTime =strtotime($_POST['dataColetar']);
$dataColetar= ($dataColetarToTime === false) ? '0000-00-00' : date('Y-m-d', $dataColetarToTime);

?>
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
                <input type="datetime-local" id="dataInicio" value="<?php echo $dataInicio.'T'.$horaInicio; ?>"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-3 pullBottom">
            	<span>Previsão Final</span>
                <input type="datetime-local" id="dataFinal" value="<?php echo $dataFinal.'T'.$horaFinal; ?>" class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-6 col-md-3 pullBottom">
            	<span>Data Embarque</span>
                <input type="date" id="dataEmbarque" value="<?php echo $dataEmbarque; ?>" class="form-control" name="dataEmbarque">
            </div>
            <div class="col-xs-6 col-md-3 pullBottom">
            	<span>Data Coletar</span>
                <input type="date" id="dataColetar" value="<?php echo $dataColetar; ?>" class="form-control" name="dataColetar">
            </div>
            <div class="col-xs-12 col-md-6 pullBottom">
                <span>Transportadora</span>
                <div class="inner-addon right-addon"><font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                    <input type="text" name="transportadora" id="transportadora" value="<?= Sistema::getPost('transportadora') ?>" onClick="clickdownTransportadora();" class="editou form-control">
                </div>
                <input type="text" name="transportadoraHandle" id="transportadoraHandle" value="<?= Sistema::getPost('transportadoraHandle') ?>" hidden="true">
            </div>
            <div class="col-xs-12 col-md-6 pullBottom">
            	<span>Pedido</span>
                <input type="literal" id="pedido" value="<?= $pedido ?>" class="form-control" name="pedido">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
        <button type="button" class="botaoBranco pullTop" onClick="limpaform()">Limpar</button>
        <button type="submit" class="botaoBranco pullTop">Aplicar</button>
      </div>
      </form>
  </div>
</div>
</div>
<!-- //End Modal Filtro -->

<!-- Start Modal Baixa -->
<div class="modal fade" id="BaixarModal" role="dialog" aria-spanledby="BaixarModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="../../controller/operacional/InserirOcorrenciaCargaDescarcaController.php" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="BaixarModalspan">Ocorrência de carga e descarga</h4>
      </div>
      <div class="modal-body">
        	<div class="col-sm-3 pullBottom">
            	<span>Tipo</span>
           		<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="tipoOcorrencia" value="<?php echo $tipoOcorrencia; ?>" id="tipoOcorrencia"  onClick="clickdownTipoOcorrencia();" class="editou form-control pulaCampoEnter">
				</div>
				<input type="text" name="tipoOcorrenciaHandle" value="<?php echo $tipoOcorrenciaHandle; ?>" id="tipoOcorrenciaHandle" hidden="true">
                <input type="text" name="carregamento" id="carregamento" hidden="true">
                <input type="text" name="acaoHandle" id="acaoHandle" hidden="true">
            </div>
            <div class="col-sm-3 pullBottom">
            	<span>Prg Doca</span>           
				<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="progDoca" id="progDoca" value="<?php echo $progDoca; ?>" onClick="clickdownProgDoca();" class="editou form-control pulaCampoEnter" disabled>
				</div>
				<input type="text" name="progDocaHandle" value="<?php echo $progDocaHandle; ?>" id="progDocaHandle" hidden="true">
           		<input type="text" name="docaHandle" value="<?php echo $docaHandle; ?>" id="docaHandle" hidden="true">
            </div>
            <div class="col-sm-3 pullBottom">
            	<span>Previsão Entrega</span>
				 <input type="datetime-local" name="previsao" id="previsao" value="<?php echo $date.'T'.$time; ?>" class="editou form-control pulaCampoEnter" disabled>
            </div>
            <div class="col-sm-3 pullBottom">
            	<span>Número</span>
                <input type="text" id="numero" value="<?php echo $numero; ?>" class="form-control toUpper" name="numero" disabled>
            </div>
            <div class="col-sm-2 pullBottom">
            	<span>Tipo Veículo</span>           
				<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="tipoVeiculo" id="tipoVeiculo" value="<?php echo $tipoVeiculo; ?>" onClick="clickdownTipoVeiculo();" class="editou form-control pulaCampoEnter" disabled>
				</div>
				<input type="text" name="tipoVeiculoHandle" value="<?php echo $tipoVeiculoHandle; ?>" id="tipoVeiculoHandle" hidden="true">
            </div>
            <div class="col-sm-2 pullBottom">
            	<span>Veículo</span>
                <input type="text" id="veiculo" value="<?php echo $veiculo; ?>" class="form-control toUpper" name="veiculo" disabled>
            </div>
            <div class="col-sm-1 pullBottom">
            	<span>UF</span>           
				<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="ufVeiculo" id="ufVeiculo" value="<?php echo $ufVeiculo; ?>" onClick="clickdownUfVeiculo();" class="editou form-control pulaCampoEnter" disabled>
				</div>
				<input type="text" name="ufVeiculoHandle" value="<?php echo $ufVeiculoHandle; ?>" id="ufVeiculoHandle" hidden="true">
            </div>
            <div class="col-sm-3 pullBottom">
            	<span>Propriedade</span>           
				<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="propriedadeVeiculo" id="propriedadeVeiculo" value="<?php echo $propriedadeVeiculo; ?>" onClick="clickdownPropriedadeVeiculo();" class="editou form-control pulaCampoEnter" disabled>
				</div>
				<input type="text" name="propriedadeVeiculoHandle" value="<?php echo $propriedadeVeiculoHandle; ?>" id="propriedadeVeiculoHandle" hidden="true">
            </div>
            <div class="col-sm-2 pullBottom">
            	<span>Acoplado</span>
                <input type="text" id="acoplado" value="<?php echo $acoplado; ?>" class="form-control toUpper" name="acoplado" disabled>
            </div>
            <div class="col-sm-2 pullBottom">
					<span>Conteiner <font color="#FF0004">*</font></span>
					<div class="inner-addon right-addon "> <font size="-2"><e class="glyphicon glyphicon-triangle-bottom add" id="spandown"></e></font>
					<div class="input-group">   
						<input type="text" id="conteiner" value="<?php echo $conteiner; ?>" class="editou form-control pulaCampoEnter toUpper" onClick="clickdownConteiner();" name="conteiner">
						<span class="input-group-btn">
						<button class="btn btn-default" type="button" id="inserirConteiner"><i class="fa fa-plus text-success"></i></button>
					</span>
				</div>
					</div>
					
					<input type="text" id="conteinerHandle" hidden="true" value="<?php echo $conteinerHandle; ?>" name="conteinerHandle">
				 
					
            </div>
            <div class="col-sm-5 pullBottom">
            	<span>Motorista</span>
                <input type="text" id="motorista" value="<?php echo $motorista; ?>" class="form-control toUpper" name="motorista" disabled>
            </div>
            <div class="col-sm-7 pullBottom">
            	<span>Documento</span>
                <input type="text" id="documentoMotorista" value="<?php echo $documentoMotorista; ?>" class="form-control toUpper" name="documentoMotorista" disabled>
            </div>
            <div class="col-sm-12 pullBottom">
            	<label for="image_src" class="btn btn-default" ><i class="fa fa-paperclip"> </i> Anexo</label>
                <input accept="image/*" onchange="preview_image()" type="file" name="image_src[]" id="image_src"  multiple/>
            </div>
            <div class="col-sm-12 pullBottom">
            	<span>Observação</span>
                <textarea id="obs"  class="form-control" name="obs"><?php echo $obs; ?></textarea>
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
<!-- //End Modal Baixa -->



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