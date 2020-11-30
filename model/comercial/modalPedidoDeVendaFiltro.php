<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<?php
$situacao = null;
$situacaoHandle = null;
$filial = null;
$filialHandle = null;
$cliente = null;
$clienteHandle = null;
$transportador = null;
$transportadorHandle = null;

$dataInicioToTime =strtotime($_POST['dataInicio']);
$dataInicio= ($dataInicioToTime === false) ? '0000-00-00' : date('Y-m-d', $dataInicioToTime);
$horaInicio = ($dataInicioToTime === false) ? '00:00:00' : date('H:i:s', $dataInicioToTime);

$dataFinalToTime =strtotime($_POST['dataFinal']);
$dataFinal= ($dataFinalToTime === false) ? '0000-00-00' : date('Y-m-d', $dataFinalToTime);
$horaFinal = ($dataFinalToTime === false) ? '00:00:00' : date('H:i:s', $dataFinalToTime);
?>

    <form method="post" action="PedidoDeVendaFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar pedido de venda</h4>
      </div>
      <div class="modal-body">
      
        	<div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal"  class="form-control" name="dataFinal">
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
            <div class="col-xs-12 col-md-4 pullBottom">
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
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Transportador</span>
                <select name="transportador[]" multiple id="transportador">
                <?php
					if(isset($_POST['transportador'])){
						foreach($_POST['transportador'] as $transportador){
							$transportadorExplode = explode(';', $transportador);
							$transportadorHandle = $transportadorExplode[0];
							@$transportador = $transportadoroExplode[1];
					?>
                    <option value="<?php echo $transportadorHandle; ?>" selected><?php echo $transportador; ?></option>
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


<div class="modal fade" id="VoltarPedidoModal"  role="dialog" aria-spanledby="VoltarPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarPedidoModalspan">Deseja voltar as Pedidos de venda?</h4>
          </div>
              <div class="modal-body"> Os Pedidos de venda ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="VoltarPedidoDeVenda()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirPedidoModal"  role="dialog" aria-spanledby="ExcluirPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ExcluirPedidoModalspan">O registro será perdido</h4>
          </div>
              <div class="modal-body"> Deseja realmente excluir o Pedido?
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="ExcluirPedidoDeVenda()" id="sim" class="botaoBrancoLg">Sim</button
            ><!-- -->
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarPedidoModal"  role="dialog" aria-spanledby="LiberarPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="LiberarPedidoModalspan">Deseja liberar os Pedidos de venda?</h4>
          </div>
              <div class="modal-body"> Os Pedidos de venda serão liberados.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="LiberarPedidoDeVenda()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  
  <div class="modal fade" id="CancelarPedidoModal"  role="dialog" aria-spanledby="CancelarPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarPedidoModalspan">Deseja cancelar os Pedidos?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelarPedidoDeVenda()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->