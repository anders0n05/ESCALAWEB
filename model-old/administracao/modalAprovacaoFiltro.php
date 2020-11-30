<?php
$origemFiltro = null;
$alcadaFiltro = null;
$empresaFiltro = null;
$filialFiltro = null;

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
    <form method="post" action="AprovacaoFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar aprovação</h4>
      </div>
      <div class="modal-body">
        	<div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio" value="<?php echo $dataInicio.'T'.$horaInicio; ?>"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal" value="<?php echo $dataFinal.'T'.$horaFinal; ?>"  class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Origem</span>
    			<select name="origem[]" multiple id="origem">
                <?php
					if(isset($_POST['origem'])){
						foreach($_POST['origem'] as $origemEach){
							$origemExplode = explode(';', $origemEach);
							$origemHandle = $origemExplode[0];
							@$origemFiltro = $origemExplode[1];
				?>
                    <option value="<?php echo $origemHandle; ?>" selected><?php echo $origemFiltro; ?></option>
                <?php
						}
					}
				?>
				</select>
            </div>
            <div class="col-xs-6 col-md-12 pullBottom">
            	<span>Alçada</span>
                <select name="alcada[]" multiple id="alcada">
                <?php
					if(isset($_POST['alcada'])){
						foreach($_POST['alcada'] as $alcadaEach){
							$alcadaExplode = explode(';', $alcadaEach);
							$alcadaHandle = $alcadaExplode[0];
							@$alcadaFiltro = $alcadaExplode[1];
					?>
                    <option value="<?php echo $alcadaHandle; ?>" selected><?php echo $alcadaFiltro; ?></option>
                    <?php
						}
					}
					?>
				</select>
           </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Empresa</span>
                	<select name="empresa[]" multiple id="empresa">
                    <?php
					if(isset($_POST['empresa'])){
						foreach($_POST['empresa'] as $empresaEach){
							$empresaExplode = explode(';', $empresaEach);
							$empresaHandle = $empresaExplode[0];
							@$empresaFiltro = $empresaExplode[1];
					?>
                    <option value="<?php echo $empresaHandle; ?>" selected><?php echo $empresaFiltro; ?></option>
                    <?php
						}
					}
					?>
					</select>
            </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Filial</span>
                <select name="filial[]" multiple id="filial">
                <?php
					if(isset($_POST['filial'])){
						foreach($_POST['filial'] as $filialEach){
							$filialExplode = explode(';', $filialEach);
							$filialHandle = $filialExplode[0];
							@$filialFiltro = $filialExplode[1];
					?>
                    <option value="<?php echo $filialHandle; ?>" selected><?php echo $filialFiltro; ?></option>
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
        <button type="reset" class="botaoBranco pullTop">Limpar</button>
        <button type="submit" class="botaoBranco pullTop">Aplicar</button>
      </div>
      </form>
  </div>
</div>
</div>
<!-- //End Modal Filtro -->

<div class="modal fade" id="AprovarModal"  role="dialog" aria-spanledby="AprovarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        	<form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="AprovarModal">Deseja aprovar os registros?</h4>
          </div>
              <div class="modal-body"> Os registros selecionados serão aprovados.
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="Aprovar()">Sim</button>
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
</div>

<div class="modal fade" id="RecusarModal" role="dialog" aria-spanledby="RecusarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        	<form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="RecusarModal">Deseja recusar os registros?</h4>
          </div>
              <div class="modal-body"> Os registros selecionados serão recusados, informe o motivo abaixo:
              <input class="form-control" type="text" name="motivo" id="motivo" placeholder="Motivo">
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="Recusar()">Sim</button>
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
</div>

<?php
if(isset($_SESSION['error']) and $_SESSION['error'] > NULL){
			
			
		
		
	for($err=0; $err < count($_SESSION['error']); $err++){
		echo "<script type='text/javascript'>
    				$(window).load(function(){
        			$('#MensagemModal".$err."').modal('show');
    				});
				</script>";
				
		
			echo '
			<div class="modal fade" id="MensagemModal'.$err.'" role="dialog" style="z-index:3040;" aria-spanledby="MensagemModalspan">
    			<div class="modal-dialog" role="document">
          			<div class="modal-content">
        				<form method="post" action="#">
             				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            						<h4 class="modal-title" id="MensagemModal'.$err.'">Erro!</h4>
          					</div>
              				<div class="modal-body"> 
								 '.$_SESSION['error'][$err].' 
            					<div class="clearfix"></div>
          					</div>
              				<div class="modal-footer">
            					<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
          					</div>
            			</form>
      				</div>
        		</div>
  			</div>';
	}
		
		unset($_SESSION['error']);
}
			
?>