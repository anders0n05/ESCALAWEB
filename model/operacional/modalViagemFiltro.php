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

    <form method="post" action="ViagemFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar viagem</h4>
      </div>
      <div class="modal-body">
      
        	<div class="col-xs-6 col-md-4">
            	   	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio" value="<?php echo $dataInicio.'T'.$horaInicio; ?>" class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal" value="<?php echo $dataFinal.'T'.$horaFinal; ?>" class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-12 col-md-4">
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
            <div class="col-xs-12">
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
            <div class="col-xs-8 col-md-9">
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
            <div class="col-xs-4 col-md-3">
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
        <button type="reset" class="botaoBranco pullTop" onClick="limpaform();">Limpar</button>
        <button type="submit" class="botaoBranco pullTop">Aplicar</button>
      </div>
      </form>
  </div>
</div>
</div>
<!-- //End Modal Filtro -->

