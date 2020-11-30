        <!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
<?php
$situacao = null;
$situacaoHandle = null;
$tipoHandle = null;
$tipo = null;
$despesaHandle = null;
$despesa = null;
$viagemHandle = null;
$viagem = null;

$dataInicioToTime =strtotime($_POST['dataInicio']);
$dataInicio= ($dataInicioToTime === false) ? '0000-00-00' : date('Y-m-d', $dataInicioToTime);
$horaInicio = ($dataInicioToTime === false) ? '00:00:00' : date('H:i:s', $dataInicioToTime);

$dataFinalToTime =strtotime($_POST['dataFinal']);
$dataFinal= ($dataFinalToTime === false) ? '0000-00-00' : date('Y-m-d', $dataFinalToTime);
$horaFinal = ($dataFinalToTime === false) ? '00:00:00' : date('H:i:s', $dataFinalToTime);


?>

    <form method="post" action="DespesaViagemFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar despesa de viagem</h4>
      </div>
      <div class="modal-body">
      
        	<div class="col-xs-6 col-md-4 pullBottom">
            	   	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio" value="<?php echo $dataInicio.'T'.$horaInicio; ?>" class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal" value="<?php echo $dataFinal.'T'.$horaFinal; ?>" class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Situação</span>
                	<select name="situacao[]" multiple id="situacao">
                    <?php
					if(isset($_POST['situacao'])){
						foreach($_POST['situacao'] as $situacao){
							$situacaoExplode = explode(';', $situacao);
							$situacaoHandle = $situacaoExplode[0];
							@$situacao = $situacaoExplode[1];
					?>
                    <option value="<?php echo $situacaoHandle; ?>" selected><?php echo $situacao; ?></option>
                    <?php
						}
					}
					?>
					</select>
            </div>
            <div class="col-xs-12 pullBottom">
            	<span>Tipo de Despesa</span>
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
            	<span>Despesa</span>
    			<select name="despesa[]" multiple id="despesa">
                <?php
				if(isset($_POST['despesa'])){
					foreach($_POST['despesa'] as $despesa){
						$despesaExplode = explode(';', $despesa);
						$despesaHandle = $despesaExplode[0];
						@$despesa = $despesaExplode[1];
				?>
                <option value="<?php echo $despesaHandle; ?>" selected><?php echo $despesa; ?></option>
                <?php
					}
				}
				?>
				</select>
            </div>
            <div class="col-xs-4 col-md-3 pullBottom">
            	<span>Viagem</span>
                <select name="viagem[]" multiple id="viagem">
                <?php
				if(isset($_POST['viagem'])){
					foreach($_POST['viagem'] as $viagem){
						$viagemExplode = explode(';', $viagem);
						$viagemHandle = $viagemExplode[0];
						@$viagem = $viagemExplode[1];
				?>
                <option value="<?php echo $viagemHandle; ?>" selected><?php echo $viagem; ?></option>
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
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitDespesaViagemForm()">Sim</button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='DespesaViagem.php'">Não</button>
            <button type="button" class="botaoBranco"  data-dismiss="modal">Cancelar</button>
          </div>
            </form>
      </div>
        </div>
  </div>
      
      <div class="modal fade" id="VoltarDespesaModal"  role="dialog" aria-spanledby="VoltarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja voltar as despesas da viagem?</h4>
          </div>
              <div class="modal-body"> As despesas da viagem ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="VoltarDespesaViagem()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirDespesaModal"  role="dialog" aria-spanledby="ExcluirDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">O registro será perdido</h4>
          </div>
              <div class="modal-body"> Deseja realmente excluir o registro?
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="ExcluirDespesaViagem()" id="sim" class="botaoBrancoLg">Sim</button
            ><!-- -->
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarDespesaModal"  role="dialog" aria-spanledby="LiberarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja liberar as despesas da viagem?</h4>
          </div>
              <div class="modal-body"> As despesas da viagem serão liberadas e encerradas.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="LiberarDespesaViagem()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="CancelarDespesaModal"  role="dialog" aria-spanledby="CancelarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarDespesaModalspan">Deseja cancelar as despesas da viagem?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelarDespesaViagem()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->

