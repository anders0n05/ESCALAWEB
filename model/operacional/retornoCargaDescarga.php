<?php
$carregamento = null;
$tipoOcorrencia = null;
$tipoOcorrenciaHandle = null;
$progDoca = null;
$progDocaHandle = null;
$dataPrevisao = null;
$horaPrevisao = null;
$numero = null;
$veiculo = null;
$acoplado = null;
$conteiner = null;
$conteinerHandle = null;
$motorista = null;
$ufVeiculoHandle = null;
$ufVeiculo = null;
$obs = null;
$tipoVeiculo = null;
$tipoVeiculoHandle = null;
$docaHandle = null;
$documentoMotorista = null;
$propriedadeVeiculo = null;
$propriedadeVeiculoHandle = null;



//INSERIR CONTEINER
$codigoConteiner = null;
$tipoEquipamento = null;
$tipoEquipamentoHandle = null;
$codigoISO = null;
$codigoISOHandle = null;
$alturaConteiner = null;
$larguraConteiner = null;
$comprimentoConteiner = null;
$capacidadeConteiner = null;
$taraConteiner = null;
$mgwConteiner = null;
$fabricacaoConteiner = null;
$obsInserirConteiner = null;

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
	<h4 class="modal-title" id="MensagemModal">Erro ao inserir ocorrência</h4>
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

	$carregamento = $_SESSION['carregamento'];
	$tipoOcorrencia = $_SESSION['tipoOcorrencia'];
	$tipoOcorrenciaHandle = $_SESSION['tipoOcorrenciaHandle'];
	$progDoca = $_SESSION['progDoca'];
	$progDocaHandle = $_SESSION['progDocaHandle'];
	$dataPrevisao = $_SESSION['dataPrevisao'];
	$horaPrevisao = $_SESSION['horaPrevisao'];
	$numero = $_SESSION['numero'];
	$veiculo = $_SESSION['veiculo'];
	$acoplado = $_SESSION['acoplado'];
	$conteiner = $_SESSION['container'];
	$motorista = $_SESSION['motorista'];
	$obs = $_SESSION['obs'];
	$ufVeiculoHandle = $_SESSION['ufVeiculoHandle'];
	$ufVeiculo = $_SESSION['ufVeiculo'];
	$conteinerHandle = $_SESSION['conteinerHandle'];
	$tipoVeiculo = $_SESSION['tipoVeiculo'];
	$tipoVeiculoHandle = $_SESSION['tipoVeiculoHandle'];
	$docaHandle = $_SESSION['docaHandle'];
	$documentoMotorista = $_SESSION['documentoMotorista'];
	$propriedadeVeiculo = $_SESSION['propriedadeVeiculo'];
	$propriedadeVeiculoHandle = $_SESSION['propriedadeVeiculoHandle'];
	
	
	//inserir conteiner
	$codigoConteiner = $_SESSION['codigoConteiner'];
	$tipoEquipamento = $_SESSION['tipoEquipamento'];
	$tipoEquipamentoHandle = $_SESSION['tipoEquipamentoHandle'];
	$codigoISO = $_SESSION['codigoISO'];
	$codigoISOHandle = $_SESSION['codigoISOHandle'];
	$alturaConteiner = $_SESSION['alturaConteiner'];
	$larguraConteiner = $_SESSION['larguraConteiner'];
	$comprimentoConteiner = $_SESSION['comprimentoConteiner'];
	$capacidadeConteiner = $_SESSION['capacidadeConteiner'];
	$taraConteiner = $_SESSION['taraConteiner'];
	$mgwConteiner = $_SESSION['mgwConteiner'];
	$fabricacaoConteiner = $_SESSION['fabricacaoConteiner'];
	$obsInserirConteiner = $_SESSION['obsInserirConteiner'];
	
	unset($_SESSION['carregamento']);
	unset($_SESSION['tipoOcorrencia']);
	unset($_SESSION['tipoOcorrenciaHandle']);
	unset($_SESSION['progDoca']);
	unset($_SESSION['progDocaHandle']);
	unset($_SESSION['dataPrevisao']);
	unset($_SESSION['horaPrevisao']);
	unset($_SESSION['numero']);
	unset($_SESSION['veiculo']);
	unset($_SESSION['acoplado']);
	unset($_SESSION['container']);
	unset($_SESSION['motorista']);
	unset($_SESSION['obs']);
	unset($_SESSION['mensagem']);
	unset($_SESSION['ufVeiculoHandle']);
	unset($_SESSION['ufVeiculo']);
	unset($_SESSION['conteinerHandle']);
	
	
	//inserir conteiner
	unset($_SESSION['codigoConteiner']);
	unset($_SESSION['tipoEquipamento']);
	unset($_SESSION['tipoEquipamentoHandle']);
	unset($_SESSION['codigoISO']);
	unset($_SESSION['codigoISOHandle']);
	unset($_SESSION['alturaConteiner']);
	unset($_SESSION['larguraConteiner']);
	unset($_SESSION['comprimentoConteiner']);
	unset($_SESSION['capacidadeConteiner']);
	unset($_SESSION['taraConteiner']);
	unset($_SESSION['mgwConteiner']);
	unset($_SESSION['fabricacaoConteiner']);
	unset($_SESSION['obsInserirConteiner']);
}

else if(isset($_SESSION['protocolo'])){
	$protocolo = $_SESSION['protocolo'];	
	unset($_SESSION['protocolo']);
}
?>