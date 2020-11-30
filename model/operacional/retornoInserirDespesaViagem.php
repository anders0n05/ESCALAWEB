<?php
			$tipo = null;
			$tipoHandle = null;
			$numero = null;
			$viagemHandle = null;
			$data = null;
			$hora = null;
			$quantidade = '1,0000';
			$ValorUnitario = '0,0000';
			$ValorTotal = null;
			$despesa = null;
			$despesaHandle = null;
			$fornecedor = null;
			$fornecedorHandle = null;
			$FormaPagamento = null;
			$FormaPagamentoHandle = null;
			$CondicaoPagamento = null;
			$CondicaoPagamentoHandle = null;
			$observacao = null;
			$mensagem = null;
			$protocolo = null;
			$gravou = null;
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
		
			$tipo = $_SESSION['tipo'];
			$tipoHandle = $_SESSION['tipoHandle'];
			$numero = $_SESSION['viagem'];
			$viagemHandle = $_SESSION['viagemHandle'];
			$data = $_SESSION['data'];
			$hora = $_SESSION['hora'];
			$datahora = $data.$hora;
			$quantidade = $_SESSION['quantidade'];
			$ValorUnitario = $_SESSION['ValorUnitario'];
			$ValorTotal = $_SESSION['mensaValorTotalgem'];
			$despesa = $_SESSION['despesa'];
			$despesaHandle = $_SESSION['despesaHandle'];
			$fornecedor = $_SESSION['fornecedor'];
			$fornecedorHandle = $_SESSION['fornecedorHandle'];
			$FormaPagamento = $_SESSION['FormaPagamento'];
			$FormaPagamentoHandle = $_SESSION['FormaPagamentoHandle'];
			$CondicaoPagamento = $_SESSION['CondicaoPagamento'];
			$CondicaoPagamentoHandle = $_SESSION['CondicaoPagamentoHandle'];
			$observacao = $_SESSION['observacao'];
		
			unset($_SESSION['mensagem']);
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
			
		else if(isset($_SESSION['protocolo'])){
			$protocolo = $_SESSION['protocolo'];	
			unset($_SESSION['protocolo']);
			
			/*
			$tipo = $_SESSION['tipo'];
			$tipoHandle = $_SESSION['tipoHandle'];
			$numero = $_SESSION['viagem'];
			$viagemHandle = $_SESSION['viagemHandle'];
			$data = $_SESSION['data'];
			$hora = $_SESSION['hora'];
			$datahora = $data.$hora;
			$quantidade = $_SESSION['quantidade'];
			$ValorUnitario = $_SESSION['ValorUnitario'];
			$ValorTotal = $_SESSION['mensaValorTotalgem'];
			$despesa = $_SESSION['despesa'];
			$despesaHandle = $_SESSION['despesaHandle'];
			$fornecedor = $_SESSION['fornecedor'];
			$fornecedorHandle = $_SESSION['fornecedorHandle'];
			$FormaPagamento = $_SESSION['FormaPagamento'];
			$FormaPagamentoHandle = $_SESSION['FormaPagamentoHandle'];
			$CondicaoPagamento = $_SESSION['CondicaoPagamento'];
			$CondicaoPagamentoHandle = $_SESSION['CondicaoPagamentoHandle'];
			$observacao = $_SESSION['observacao'];
			$gravou = $_SESSION['gravou'];
			
			unset($_SESSION['gravou']);
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
			*/
		}
		
		if(isset($_POST['check'])){
			
			$check =  $_POST['check'];
			
		foreach($check as $chk){
			$checkValue = $chk;
		}
		
		$numeroViagem = explode(';', $checkValue);
		$numero = $numeroViagem[0];
		$viagemHandle = $numeroViagem[1];
		}
		
		
		if($numero == null){
			@$numero = $_GET['numero'];
		}
		if($viagemHandle == null){
			@$viagemHandle = $_GET['handle'];
			$disabled = 'disabled';
		}
		if($numero > null){
			$disabled = 'disabled';
		}
		else{
			$disabled = '';
		}
?>