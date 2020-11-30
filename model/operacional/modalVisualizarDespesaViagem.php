<?php
	if(isset($_SESSION['mensagem'])){
			$mensagem = $_SESSION['mensagem'];
			unset($_SESSION['mensagem']);
			
			echo "<script type='text/javascript'>
    				$(window).load(function(){
        			$('#MensagemModal').modal('show');
    				});
				</script>";
		
			echo '
			<div class="modal fade" id="MensagemModal" role="dialog" style="z-index:3040;" aria-spanledby="MensagemModalspan">
    			<div class="modal-dialog" role="document">
          			<div class="modal-content">
        				<form method="post" action="#">
             				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            						<h4 class="modal-title" id="MensagemModal">Erro</h4>
          					</div>
              				<div class="modal-body"> 
								'.$mensagem.'
            					<div class="clearfix"></div>
          					</div>
              				<div class="modal-footer">
            					<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
          					</div>
            			</form>
      				</div>
        		</div>
  			</div>';
  		
			unset($_SESSION['tipo']);
			unset($_SESSION['tipoHandle']);
			unset($_SESSION['viagem']);
			unset($_SESSION['viagemHandle']);
			unset($_SESSION['data']);
			unset($_SESSION['hora']);
			unset($_SESSION['quantidade']);
			unset($_SESSION['ValorUnitario']);
			unset($_SESSION['mensaValorTotalgem']);
			unset($_SESSION['despesa']);
			unset($_SESSION['despesaHandle']);
			unset($_SESSION['fornecedor']);
			unset($_SESSION['fornecedorHandle']);
			unset($_SESSION['FormaPagamento']);
			unset($_SESSION['FormaPagamentoHandle']);
			unset($_SESSION['CondicaoPagamento']);
			unset($_SESSION['CondicaoPagamentoHandle']);
			unset($_SESSION['observacao']);
		}
		
		if(isset($_SESSION['error']) and $_SESSION['error'] > null){
			
			//var_dump($_SESSION);
			
			echo "<script type='text/javascript'>
    				$(window).load(function(){
        			$('#MensagemModal').modal('show');
    				});
				</script>";
		
		foreach(@$_SESSION['error'] as $error){
			echo '
			<div class="modal fade" id="MensagemModal" role="dialog" style="z-index:3040;" aria-spanledby="MensagemModalspan">
    			<div class="modal-dialog" role="document">
          			<div class="modal-content">
        				<form method="post" action="#">
             				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            						<h4 class="modal-title" id="MensagemModal">Erro ao enviar anexo</h4>
          					</div>
              				<div class="modal-body"> 
								 '.$error.' 
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
		
					if(isset($_SESSION['arquivo']) and $_SESSION['arquivo'] > null){
					$nomeAnexoExplode = explode('.', $_SESSION['nomeAnexo']);
					$nomeAnexo = $nomeAnexoExplode[0];
					$extAnexo = $nomeAnexoExplode[1];
										
?>
            <script type='text/javascript'>
    				$(window).load(function(){
        			$('#AnexoModal').modal('show');
    				});
					
			$.blockUI({ css: { 
            border: 'none', 
            padding: '10px',
            backgroundColor: 'transparent', 
            '-webkit-border-radius': '0px', 
            '-moz-border-radius': '0px',
            opacity: 1,
            color: '#fff'
			} 
			});
 
          setTimeout($.unblockUI, 4000);
			</script>
            
            
			<div class="modal fade" id="AnexoModal" role="dialog" style="z-index:3040;" aria-spanledby="AnexoModalspan">
    			<div class="modal-dialog" role="document">
          			<div class="modal-content">
                    		<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            						<h4 class="modal-title" id="AnexoModal"><?php echo $nomeAnexo; ?></h4>
          					</div>
              				<div class="modal-body"> 
								<img src="../../controller/estrutura/VisualizarAnexo.php" width="100%" class="image-responsive" alt="<?php echo $nomeAnexo; ?>" title="<?php echo $nomeAnexo; ?>" />
            					<div class="clearfix"></div>
          					</div>
      				</div>
        		</div>
  			</div>
            
<?php
				}
			
?>
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
            <a href="../../controller/operacional/VoltarDespesaViagemController.php?ref=VisualizarDespesaViagem&despesaHandle=<?php echo $despesaHandle; ?>">
            <button type="button"  id="sim" class="botaoBrancoLg">Sim</button>
            </a>
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
            <a href="../../controller/operacional/ExcluirDespesaViagemController.php?ref=VisualizarDespesaViagem&despesaHandle=<?php echo $despesaHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
            </a>
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
            <a href="../../controller/operacional/LiberarDespesaViagemController.php?ref=VisualizarDespesaViagem&despesaHandle=<?php echo $despesaHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
            </a>
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
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja cancelar as despesas da viagem?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelaDespesa()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->

<!-- Start modal -->
<div class="modal fade" id="LimparModal"  role="dialog" aria-spanledby="LimparModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="LimparModalspan">Deseja realmente limpar os campos?</h4>
          </div>
              <div class="modal-body"> Ao limpar os campos, os dados editados não serão salvos!
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="reset" class="botaoBrancoLg" data-dismiss="modal" onClick="limparcampos()">Sim</button>
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
</div>
