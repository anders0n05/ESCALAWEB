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
            <a href="../../controller/operacional/VoltarOcorrenciaTransporteController.php?ref=VisualizarOcorrenciaTransporte&ocorrenciaHandle=<?php echo $ocorrenciaHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
            </a>
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
            <a href="../../controller/operacional/ExcluirOcorrenciaTransporteController.php?ref=VisualizarOcorrenciaTransporte&ocorrenciaHandle=<?php echo $ocorrenciaHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
            </a>
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
            <a href="../../controller/operacional/LiberarOcorrenciaTransporteController.php?ref=VisualizarOcorrenciaTransporte&ocorrenciaHandle=<?php echo $ocorrenciaHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
            </a>
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
            <a href="../../controller/operacional/CancelarOcorrenciaTransporteController.php?ref=VisualizarOcorrenciaTransporte&ocorrenciaHandle=<?php echo $ocorrenciaHandle; ?>">
            <button type="button" id="sim" class="botaoBrancoLg">Sim</button>
            </a>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->

<?php
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


	if(isset($_SESSION['mensagem'])){
			$mensagem = $_SESSION['mensagem'];
			
			echo "<script type='text/javascript'>
    				$(window).load(function(){
        			$('#MensagemModal').modal('show');
    				});
				</script>";
		
			echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="MensagemModal">Erro ao inserir despesa</h4>
          </div>
              <div class="modal-body"> '.$mensagem.'
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
          </div>
            </form>
      </div>
        </div>
  </div>';
		
			unset($_SESSION['mensagem']);
			
		}
			
		else if(isset($_SESSION['protocolo'])){
			$protocolo = $_SESSION['protocolo'];	
			unset($_SESSION['protocolo']);
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