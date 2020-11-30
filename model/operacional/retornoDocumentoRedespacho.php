<?php
$tipoOcorrencia = NULL;
$tipoOcorrenciaHandle = NULL;
$motivoAtraso = NULL;
$motivoAtrasoHandle = NULL;
$responsavel = NULL;
$responsavelHandle = NULL;
$nome = NULL;
$numeroDocumento = NULL;
$obs = NULL;
$mensagem = NULL;
$acaoHandle = NULL;

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

	$tipoOcorrencia = $_SESSION['tipoOcorrencia'];
	$tipoOcorrenciaHandle = $_SESSION['tipoOcorrenciaHandle'];
	$acaoHandle = $_SESSION['acaoHandle'];
	$motivoAtraso = $_SESSION['motivoAtraso'];
	$motivoAtrasoHandle = $_SESSION['motivoAtrasoHandle'];
	$responsavel = $_SESSION['responsavel'];
	$responsavelHandle = $_SESSION['responsavelHandle'];
	$nome = $_SESSION['nome'];
	$numeroDocumento = $_SESSION['numeroDocumento'];
	$obs = $_SESSION['obs'];
	$mensagem = $_SESSION['mensagem'];

	unset($_SESSION['tipoOcorrencia']);
	unset($_SESSION['tipoOcorrenciaHandle']);
	unset($_SESSION['acaoHandle']);
	unset($_SESSION['motivoAtraso']);
	unset($_SESSION['motivoAtrasoHandle']);
	unset($_SESSION['responsavel']);
	unset($_SESSION['responsavelHandle']);
	unset($_SESSION['nome']);
	unset($_SESSION['numeroDocumento']);
	unset($_SESSION['obs']);
	unset($_SESSION['mensagem']);
}

else if(isset($_SESSION['protocolo'])){
	$protocolo = $_SESSION['protocolo'];	
	unset($_SESSION['protocolo']);
}
?>