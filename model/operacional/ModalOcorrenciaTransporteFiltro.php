<?php
$filial = null;
$filialHandle = null;
$tipoHandle = null;
$tipo = null;
$acaoHandle = null;
$acao = null;
$documentoHandle  = null;
$documento = null;
$ufVeiculo = null;
$ufVeiculoHandle = null;

$dataInicioToTime =strtotime($_POST['dataInicio']);
$dataInicio= ($dataInicioToTime === false) ? '0000-00-00' : date('Y-m-d', $dataInicioToTime);
$horaInicio = ($dataInicioToTime === false) ? '00:00:00' : date('H:i:s', $dataInicioToTime);

$dataFinalToTime =strtotime($_POST['dataFinal']);
$dataFinal= ($dataFinalToTime === false) ? '0000-00-00' : date('Y-m-d', $dataFinalToTime);
$horaFinal = ($dataFinalToTime === false) ? '00:00:00' : date('H:i:s', $dataFinalToTime);
?>
<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="OcorrenciaTransporteFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar ocorrência de transporte</h4>
      </div>
      <div class="modal-body">
        	<div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio" value="<?php echo $dataInicio.'T'.$horaInicio; ?>"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal" value="<?php echo $dataFinal.'T'.$horaFinal; ?>" class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Filial</span>
                	<select name="filial[]" multiple id="filial">
                    <?php
				if(isset($_POST['filial'])){
					foreach($_POST['filial'] as $filial){
						$filialExplode = explode(';', $filial);
						$filialHandle = $filialExplode[0];
						@$filial = $filialExplode[1];
				?>
                <option value="<?php echo $filialHandle; ?>" selected><?php echo $filial; ?></option>
                <?php
					}
				}
				?>
					</select>
            </div>
            <div class="col-xs-12 pullBottom">
            	<span>Tipo</span>
                <select name="tipo[]" multiple id="tipo">
                <?php
				if(isset($_POST['tipo'])){
					foreach($_POST['tipo'] as $tipo){
						$tipoExplode = explode(';', $tipo);
						$tipoHandle = $tipoExplode[0];
						@$tipo = $tipoExplode[1];
				?>
                <option value="<?php echo $tipoHandle; ?>" selected><?php echo $tipo; ?></option>
                <?php
					}
				}
				?>
				</select>
            </div>
            <div class="col-xs-8 col-md-9 pullBottom">
            	<span>Ação</span>
    			<select name="acao[]" multiple id="acao">
                <?php
				if(isset($_POST['acao'])){
					foreach($_POST['acao'] as $acao){
						$acaoExplode = explode(';', $acao);
						$acaoHandle = $acaoExplode[0];
						@$acao = $acaoExplode[1];
				?>
                <option value="<?php echo $acaoHandle; ?>" selected><?php echo $acao; ?></option>
                <?php
					}
				}
				?>
				</select>
            </div>
            <div class="col-xs-4 col-md-3 pullBottom">
            	<span>Documento</span>
                <select name="documento[]" multiple id="documento">
                <?php
				if(isset($_POST['documento'])){
					foreach($_POST['documento'] as $documento){
						$documentoExplode = explode(';', $documento);
						$documentoHandle = $documentoExplode[0];
						@$documento = $documentoExplode[1];
				?>
                <option value="<?php echo $documentoHandle; ?>" selected><?php echo $documento; ?></option>
                <?php
					}
				}
				?>
				</select>
            <div class="clearfix"></div>
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

 <!-- Start modal -->
      <div class="modal fade" id="VoltarModal"  role="dialog" aria-spanledby="VoltarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarModalspan">O registro não foi salvo</h4>
          </div>
              <div class="modal-body"> Deseja salvar as alterações realizadas neste formulário?
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitOcorrenciaTransporteForm()">Sim</button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='OcorrenciaTransporte.php'">Não</button>
            <button type="button" class="botaoBranco"  data-dismiss="modal">Cancelar</button>
          </div>
            </form>
      </div>
        </div>
  </div>
      
      <div class="modal fade" id="VoltarOcorrenciaModal"  role="dialog" aria-spanledby="VoltarOcorrenciaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarOcorrenciaModalspan">Deseja voltar as ocorrências?</h4>
          </div>
              <div class="modal-body"> As ocorrências de transporte ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="VoltarOcorrenciaTransporte()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirOcorrenciaModal"  role="dialog" aria-spanledby="ExcluirOcorrenciaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarOcorrenciaModalspan">Confirma exclusão do(s) registro(s)?</h4>
          </div>
              <div class="modal-body"> Os registros selecionados serão excluídos permanentemente da base de dados.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="ExcluirOcorrenciaTransporte()" id="sim" class="botaoBrancoLg">Sim</button
            ><!-- -->
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarOcorrenciaModal"  role="dialog" aria-spanledby="LiberarOcorrenciaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarOcorrenciaModalspan">Deseja liberar as ocorrências?</h4>
          </div>
              <div class="modal-body"> As ocorrências de transporte serão liberadas.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="LiberarOcorrenciaTransporte()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="CancelarOcorrenciaModal"  role="dialog" aria-spanledby="CancelarOcorrenciaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarOcorrenciaModalspan">Deseja cancelar as ocorrências?</h4>
          </div>
              <div class="modal-body">As ocorrências de transporte serão canceladas.
              <input class="form-control" placeholder="Motivo" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelarOcorrenciaTransporte()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->