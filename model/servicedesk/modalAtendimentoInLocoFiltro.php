<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<?php
$situacao = null;
$situacaoHandle = null;
$tecnicoHandle = null;
$tecnico = null;
$clienteHandle = null;
$cliente = null;
$filialHandle = null;
$filial = null;

$dataInicioToTime =strtotime($_POST['dataInicio']);
$dataInicio= ($dataInicioToTime === false) ? '0000-00-00' : date('Y-m-d', $dataInicioToTime);
$horaInicio = ($dataInicioToTime === false) ? '00:00:00' : date('H:i:s', $dataInicioToTime);

$dataFinalToTime =strtotime($_POST['dataFinal']);
$dataFinal= ($dataFinalToTime === false) ? '0000-00-00' : date('Y-m-d', $dataFinalToTime);
$horaFinal = ($dataFinalToTime === false) ? '00:00:00' : date('H:i:s', $dataFinalToTime);
?>
    <form method="post" action="AtendimentoInLocoFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar in loco</h4>
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
            <div class="col-xs-12 col-md-8 pullBottom">
            	<span>Cliente</span>
    			<select name="cliente[]" multiple id="cliente">
                <?php
					if(isset($_POST['cliente'])){
						foreach($_POST['cliente'] as $cliente){
							$clienteExplode = explode(';', $cliente);
							$clienteHandle = $clienteExplode[0];
							@$cliente = $clienteExplode[1];
					?>
                    <option value="<?php echo $clienteHandle; ?>" selected><?php echo $cliente; ?></option>
                    <?php
						}
					}
					?>
				</select>
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
