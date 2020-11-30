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
			unset($_SESSION['inLoco']);
			unset($_SESSION['inLocoHandle']);
			unset($_SESSION['data']);
			unset($_SESSION['hora']);
			unset($_SESSION['quantidade']);
			unset($_SESSION['ValorUnitario']);
			unset($_SESSION['ValorTotal']);
			unset($_SESSION['despesa']);
			unset($_SESSION['despesaHandle']);
			unset($_SESSION['complemento']);
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
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarModalspan">O registro não foi salvo</h4>
          </div>
              <div class="modal-body"> Deseja salvar as alterações realizadas neste formulário?
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitDespesaInLocoForm()">Sim</button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='DespesaAtendimentoInLoco.php'">Não</button>
            <button type="button" class="botaoBranco"  data-dismiss="modal">Cancelar</button>
          </div>
      </div>
        </div>
  </div>
      
      <div class="modal fade" id="VoltarDespesaModal"  role="dialog" aria-spanledby="VoltarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja voltar as despesas da InLoco?</h4>
          </div>
              <div class="modal-body"> As despesas da InLoco ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
         <a href="../../controller/servicedesk/VoltarDespesaInLocoController.php?referencia=<?php echo $referencia; ?>&handle=<?php echo $inLocoHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
         </a>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirDespesaModal"  role="dialog" aria-spanledby="ExcluirDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">O registro será perdido</h4>
          </div>
              <div class="modal-body"> Deseja realmente excluir a despesa?
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
          <a href="../../controller/servicedesk/ExcluirDespesaInLocoController.php?referencia=<?php echo $referencia; ?>&handle=<?php echo $inLocoHandle; ?>">
            <button type="button" onClick="ExcluirDespesaInLoco()" id="sim" class="botaoBrancoLg">Sim</button><!-- -->
          </a>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarDespesaModal"  role="dialog" aria-spanledby="LiberarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja liberar as despesas da InLoco?</h4>
          </div>
              <div class="modal-body"> As despesas da InLoco serão liberadas e encerradas.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
          <a href="../../controller/servicedesk/LiberarDespesaInLocoController.php?referencia=<?php echo $referencia; ?>&handle=<?php echo $inLocoHandle; ?>">
            <button type="button" onClick="LiberarDespesaInLoco()" id="sim" class="botaoBrancoLg">Sim</button>
          </a>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="CancelarDespesaModal"  role="dialog" aria-spanledby="CancelarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
          
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarDespesaModalspan">Deseja cancelar as despesas?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
         <script>
		 function motivof(){
		 	var motivo = document.getElementById('motivo').value;
			window.location.href='../../controller/servicedesk/CancelarDespesaInLocoController.php?referencia=<?php echo $referencia; ?>&handle=<?php echo $inLocoHandle; ?>&motivo='+motivo;
		 }
         </script>
         <a onClick="motivof()">
            <button type="button" class="botaoBrancoLg" id="sim" >Sim</button>
         </a>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
  </div>
  
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
<!-- //End modal -->
