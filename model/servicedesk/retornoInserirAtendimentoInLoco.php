<?php
if($inLocoHandle > ''){
$queryInLoco = $connect->prepare("SELECT A.ASSUNTOATENDIMENTO, A.NUMERO FROM SD_INLOCO A WHERE A.HANDLE = '".$inLocoHandle."'");			   
$queryInLoco->execute();
$row = $queryInLoco->fetch(PDO::FETCH_ASSOC);
$assunto = $row['ASSUNTOATENDIMENTO']; 
$numeroInLoco = $row['NUMERO'];

$disabled = 'disabled';
$inLocoView = $numeroInLoco;
}
else{
$inLocoView = NULL; 
$disabled = '';
}

$tipo = null;
$tipoHandle = null;
$inLoco = null;
$data = null;
$hora = null;
$quantidade = '1,00';
$ValorUnitario = '0,00';
$ValorTotal = null;
$despesa = null;
$despesaHandle = null;
$observacao = null;
$mensagem = null;
$protocolo = null;
$gravou = null;
$complemento  = null;
$percentualReembolso = null;
$totalReembolso = null;

	
if(isset($_SESSION['mensagem'])){
		$display = '';
}
else{
	$display = 'display';	
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

	$tipo = $_SESSION['tipo'];
	$tipoHandle = $_SESSION['tipoHandle'];
	$data = $_SESSION['data'];
	$hora = $_SESSION['hora'];
	$datahora = $data.$hora;
	$quantidade = $_SESSION['quantidade'];
	$ValorUnitario = $_SESSION['ValorUnitario'];
	$ValorTotal = $_SESSION['ValorTotal'];
	$despesa = $_SESSION['despesa'];
	$despesaHandle = $_SESSION['despesaHandle'];
	$observacao = $_SESSION['observacao'];
	$complemento = $_SESSION['complemento'];
	$percentualReembolso = $_SESSION['percentualReembolso'];
	$totalReembolso = $_SESSION['totalReembolso'];
	
	unset($_SESSION['mensagem']);
	unset($_SESSION['tipo']);
	unset($_SESSION['tipoHandle']);
	unset($_SESSION['data']);
	unset($_SESSION['hora']);
	unset($_SESSION['quantidade']);
	unset($_SESSION['ValorUnitario']);
	unset($_SESSION['ValorTotal']);
	unset($_SESSION['despesa']);
	unset($_SESSION['despesaHandle']);
	unset($_SESSION['observacao']);
	unset($_SESSION['complemento']);
	unset($_SESSION['percentualReembolso']);
	unset($_SESSION['totalReembolso']);
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