<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$data = date('Y-m-d', strtotime(Sistema::getPost('data')));
$hora = date('H:i:s', strtotime(Sistema::getPost('data')));
$quantidade = Sistema::getPost('quantidade');
$ValorUnitario = str_replace(',','.',preg_replace('#[^\d\,]#is','',Sistema::getPost('ValorUnitario')));
$ValorTotal = Sistema::getPost('ValorTotal');
$despesa = Sistema::getPost('despesa');
$despesaHandle = Sistema::getPost('despesaHandle');
$inLoco = Sistema::getPost('inLoco');
$inLocoHandle = Sistema::getPost('inLocoHandle');
$observacao = Sistema::getPost('observacao');
$complemento = Sistema::getPost('complemento');
$percentualReembolso =  str_replace(',','.',preg_replace('#[^\d\,]#is','',Sistema::getPost('percentualReembolso')));
$totalReembolso = Sistema::getPost('totalReembolso');

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

$despesaInLocoHandle = Sistema::getGet('handle');

$_SESSION['tipo'] = $tipo;
$_SESSION['tipoHandle'] = $tipoHandle;
$_SESSION['inLoco'] = $viagem;
$_SESSION['inLocoHandle'] = $viagemHandle;
$_SESSION['data'] = $data;
$_SESSION['hora'] = $hora;
$_SESSION['quantidade'] = $quantidade;
$_SESSION['ValorUnitario'] = $ValorUnitario;
$_SESSION['ValorTotal'] = $ValorTotal;
$_SESSION['despesa'] = $despesa;
$_SESSION['despesaHandle'] = $despesaHandle;
$_SESSION['observacao'] = $observacao;
$_SESSION['complemento'] = $complemento;
$_SESSION['percentualReembolso'] = $percentualReembolso;
$_SESSION['totalReembolso'] = $totalReembolso;


$ValorUnitario = number_format($ValorUnitario, '2', '.', '');
$ValorTotal = number_format($ValorTotal, '2', '.', '');
$quantidade = number_format($quantidade, '2', '.', '');

try {
    
    $params = array("inlocoDespesa" => $despesaInLocoHandle,
					"tipo" => $tipoHandle,
					"despesa" => $despesaHandle,
					"complemento" => $complemento,
					"data" => $data.'T'.$hora,
					"quantidade" => $quantidade,
					"valorUnitario" => $ValorUnitario,
					//"percentual" => $percentualReembolso,
					"observacao" => $observacao
    				);
	

	$webservice = 'ServiceDesk';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
		exit;
	}

    $result = $clientSoap->__soapCall("AlterarInlocoDespesa", array("AlterarInlocoDespesa" => array("inlocoDespesa" => $params)));
     
	$retorno = $result->AlterarInlocoDespesaResult;
	
	if(!empty($retorno->mensagem)){
		$mensagem = $retorno->mensagem; 
	}
	if(!empty($retorno->protocolo)){
		$protocolo = $retorno->protocolo;
	}
	if(!empty($retorno->sucesso)){
		$sucesso = $retorno->sucesso; 
	}
	
	if($mensagem == null and $protocolo == null and $sucesso == null){
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
	//header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
	}
		
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		
		header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
	}
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
}
?>