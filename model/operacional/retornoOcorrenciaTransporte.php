<?php
		$mensagem = null;
			$protocolo = null;
			$gravou = null;
			$ocorrencia = null;
			$ocorrenciaHandle = null;	
			
			$disabled = null;
			
			
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
		
		if(isset($_POST['check'])){
			
			$check =  $_POST['check'];
			
		foreach($check as $chk){
			$checkValue = $chk;
		}
		
		$ocorrenciaTransporte = explode(';', $checkValue);
		$ocorrencia = $ocorrenciaTransporte[0];
		$ocorrenciaHandle = $ocorrenciaTransporte[1];
		}
		
		
		if($ocorrencia == null){
			@$ocorrencia = $_GET['ocorrencia'];
		}
		if($ocorrenciaHandle == null){
			@$ocorrenciaHandle = $_GET['handle'];
			$disabled = 'disabled';
		}
		if($ocorrencia > null){
			$disabled = 'disabled';
		}
		else{
			$disabled = '';
		}
?>