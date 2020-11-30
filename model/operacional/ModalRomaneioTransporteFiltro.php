<?php
$filial = null;
$filialHandle = null;
$tipoHandle = null;
$destinatario = null;
$destinatarioHandle = null;
$romaneio = null;
$romaneioHandle = null;
$viagemHandle  = null;
$viagem = null;

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
    <form method="post" action="RomaneioTransporteFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar romaneio de transporte</h4>
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
            	<span>Destinatário</span>
                <select name="destinatario[]" multiple id="destinatario">
                <?php
				if(isset($_POST['destinatario'])){
					foreach($_POST['destinatario'] as $destinatario){
						$destinatarioExplode = explode(';', $destinatario);
						$destinatarioHandle = $destinatarioExplode[0];
						@$destinatario = $destinatarioExplode[1];
				?>
                <option value="<?php echo $destinatarioHandle; ?>" selected><?php echo $destinatario; ?></option>
                <?php
					}
				}
				?>
				</select>
            </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Romaneio</span>
    			<select name="romaneio[]" multiple id="romaneio">
                <?php
				if(isset($_POST['romaneio'])){
					foreach($_POST['romaneio'] as $romaneio){
						$romaneioExplode = explode(';', $romaneio);
						$romaneioHandle = $romaneioExplode[0];
						@$romaneio = $romaneioExplode[1];
				?>
                <option value="<?php echo $romaneioHandle; ?>" selected><?php echo $romaneio; ?></option>
                <?php
					}
				}
				?>
				</select>
            </div>
            <div class="col-xs-6 col-md-6 pullBottom">
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