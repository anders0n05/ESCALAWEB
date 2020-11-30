<?php
			$mensagem = null;
			$protocolo = null;
			
if(isset($_SESSION['error']) and $_SESSION['error'] > NULL){
$countErr = count($_SESSION['error']);
	for($err=0; $err < count($_SESSION['error']); $err++){
		
		if($err == 0){
		
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
            					<button type="button" class="botaoBrancoLg" onClick="atualizarPagina()"  data-dismiss="modal">Ok</button>
          					</div>
            			</form>
      				</div>
        		</div>
  			</div>';
		}
		else{
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
		
	}
		
		
}
			
		if(isset($_SESSION['mensagem'])){
			$mensagem = $_SESSION['mensagem'];
			unset($_SESSION['mensagem']);
			
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
            <h4 class="modal-title" id="MensagemModal">Erro</h4>
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
  
		}

		else if(isset($_SESSION['protocolo'])){
			$protocolo = $_SESSION['protocolo'];	
			unset($_SESSION['protocolo']);
		}
		
if(isset($_SESSION['voltou']) and isset($_SESSION['error'])){
?>

<script>
function atualizarPagina(){
	self.location.reload();
}
</script>
<?php
	unset($_SESSION['voltou']);	
}

else if(isset($_SESSION['voltou']) and !isset($_SESSION['error'])){
?>

<script>
	self.location.reload();
</script>
<?php	
}
unset($_SESSION['voltou']);	
unset($_SESSION['error']);
?>