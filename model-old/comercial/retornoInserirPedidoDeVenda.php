<?php
$PedidoHandle = NULL;
if($PedidoHandle > ''){
$queryPedido = $connect->prepare("SELECT A.ASSUNTOATENDIMENTO, A.NUMERO FROM SD_Pedido A WHERE A.HANDLE = '".$PedidoHandle."'");			   
$queryPedido->execute();
$row = $queryPedido->fetch(PDO::FETCH_ASSOC);
$assunto = $row['ASSUNTOATENDIMENTO']; 
$numeroPedido = $row['NUMERO'];

$disabled = 'disabled';
$PedidoView = $numeroPedido;
}
else{
$PedidoView = NULL; 
$disabled = '';
}

$ContaTesouraria = NULL;
$ContaTesourariaHandle = NULL;
$filialPedidoDeVenda = NULL;
$filialPedidoDeVendaHandle = NULL;
$tipo = NULL;
$tipoHandle = NULL;
$cliente = NULL;
$clienteHandle = NULL;
$data = NULL;
$hora = NULL;
$vendedor = NULL;
$vendedorHandle = NULL;
$FormaPagamento = NULL;
$FormaPagamentoHandle = NULL;
$CondicaoPagamento = NULL;
$CondicaoPagamentoHandle = NULL;
$frete = NULL;
$freteHandle = NULL;
$transportador = NULL;
$transportadorHandle = NULL;
$tabela = NULL;
$tabelaHandle = NULL;
$lista = NULL;
$listaHandle = NULL;
$observacao = NULL;
$naturezaOperacaoHandle = NULL;
$naturezaOperacao = NULL;
$mensagem = NULL;
$protocolo = NULL;
$gravou = NULL;
$entregarAte = NULL;
$observacaoUsoInterno = NULL;

if(isset($_SESSION['mensagem'])){
		$display = '';
}
else{
	$display = 'display';	
}
	
if(isset($_SESSION['mensagem']) and isset($_SESSION['retornoItemPedido'])){
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
	$observacaoUsoInterno = $_SESSION['observacaoUsoInterno'];
	$naturezaOperacaoHandle = $_SESSION['naturezaOperacaoHandle'];
	$naturezaOperacao = $_SESSION['naturezaOperaca'];
	$ContaTesouraria = $_SESSION['ContaTesouraria'];
	$ContaTesourariaHandle = $_SESSION['ContaTesourariaHandle']; 
	$filialPedidoDeVenda = $_SESSION['filialPedidoDeVenda']; 
	$filialPedidoDeVendaHandle = $_SESSION['filialPedidoDeVendaHandle']; 
	$tipo = $_SESSION['tipo']; 
	$tipoHandle = $_SESSION['tipoHandle']; 
	$cliente = $_SESSION['cliente']; 
	$clienteHandle = $_SESSION['clienteHandle']; 
	$data = $_SESSION['data']; 
	$hora = $_SESSION['hora']; 
	$vendedor = $_SESSION['vendedor']; 
	$vendedorHandle = $_SESSION['vendedorHandle']; 
	$FormaPagamento = $_SESSION['FormaPagamento']; 
	$FormaPagamentoHandle = $_SESSION['FormaPagamentoHandle']; 
	$CondicaoPagamento = $_SESSION['CondicaoPagamento']; 
	$CondicaoPagamentoHandle = $_SESSION['CondicaoPagamentoHandle']; 
	$frete = $_SESSION['frete']; 
	$freteHandle = $_SESSION['freteHandle']; 
	$transportador = $_SESSION['transportador']; 
	$transportadorHandle = $_SESSION['transportadorHandle']; 
	$tabela = $_SESSION['tabela']; 
	$tabelaHandle = $_SESSION['tabelaHandle']; 
	$lista = $_SESSION['lista']; 
	$listaHandle = $_SESSION['listaHandle']; 
	$observacao = $_SESSION['observacao']; 
	$entregarAte = $_SESSION['entregarAte']; 

	unset($_SESSION['observacaoUsoInterno']);
	unset($_SESSION['entregarAte']);
	unset($_SESSION['naturezaOperacaoHandle']);
	unset($_SESSION['naturezaOperaca']);
	unset($_SESSION['mensagem']);
	unset($_SESSION['protocolo']);
	unset($_SESSION['sucesso']);
	unset($_SESSION['ContaTesouraria']);
	unset($_SESSION['ContaTesourariaHandle']);
	unset($_SESSION['filialPedidoDeVenda']);
	unset($_SESSION['filialPedidoDeVendaHandle']);
	unset($_SESSION['tipo']);
	unset($_SESSION['tipoHandle']);
	unset($_SESSION['cliente']);
	unset($_SESSION['clienteHandle']);
	unset($_SESSION['data']);
	unset($_SESSION['hora']);
	unset($_SESSION['vendedor']);
	unset($_SESSION['vendedorHandle']);
	unset($_SESSION['FormaPagamento']);
	unset($_SESSION['FormaPagamentoHandle']);
	unset($_SESSION['CondicaoPagamento']);
	unset($_SESSION['CondicaoPagamentoHandle']);
	unset($_SESSION['frete']);
	unset($_SESSION['freteHandle']);
	unset($_SESSION['transportador']);
	unset($_SESSION['transportadorHandle']);
	unset($_SESSION['tabela']);
	unset($_SESSION['tabelaHandle']);
	unset($_SESSION['lista']);
	unset($_SESSION['listaHandle']);
	unset($_SESSION['observacao']);
	
}
else if(isset($_SESSION['mensagem']) and !isset($_SESSION['retornoItemPedido'])){
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

unset($_SESSION['retornoItemPedido']);
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


}
?>
