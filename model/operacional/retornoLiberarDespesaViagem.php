<?php
			$mensagem = null;
			$protocolo = null;
			
			//$despesaHandle = $_GET['despesa'];
			
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
		
		
		
	
?>