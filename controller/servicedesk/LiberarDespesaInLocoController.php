<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];
$despesaHandle = null;

$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$data = date('Y-m-d', strtotime(Sistema::getPost('data')));
$hora = date('H:i:s', strtotime(Sistema::getPost('data')));
$quantidade = Sistema::getPost('quantidade');
$ValorUnitario = Sistema::getPost('ValorUnitario');
$ValorTotal = Sistema::getPost('ValorTotal');
$despesa = Sistema::getPost('despesa');
$despesaHandle = Sistema::getPost('despesaHandle');
$inLoco = Sistema::getPost('inLoco');
$inLocoHandle = Sistema::getPost('inLocoHandle');
$observacao = Sistema::getPost('observacao');
$complemento = Sistema::getPost('complemento');

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

$despesaInLocoHandle = Sistema::getGet('handle');


$SESSION['tipo'] = $tipo;
$SESSION['tipoHandle'] = $tipoHandle;
$SESSION['data'] = $data;
$SESSION['hora'] = $data;
$SESSION['quantidade'] = $quantidade;
$SESSION['ValorUnitario'] = $ValorUnitario;
$SESSION['ValorTotal'] = $ValorTotal;
$SESSION['despesa'] = $despesa;
$SESSION['despesaHandle'] = $despesaHandle;
$SESSION['inLoco'] = $inLoco;
$SESSION['inLocoHandle'] = $inLocoHandle;
$SESSION['observacao'] = $observacao;
$SESSION['complemento'] = $complemento;



try {
	
    $params = array("inlocoDespesa" => $despesaInLocoHandle
    );
	
	//print_r($params);
	
	$webservice = 'ServiceDesk';
   include_once('../tecnologia/WebService.php');
   
   if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
		exit;
	}

    $result = $clientSoap->__soapCall("LiberarInlocoDespesa", array("LiberarInlocoDespesa" => array("inlocoDespesa" => $params)));
     
	$retorno = $result->LiberarInlocoDespesaResult;
	
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
	

	header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaHandle.'&referencia='.$referencia);	
	}
	
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		
		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaHandle.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;

		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaHandle.'&referencia='.$referencia);
	}
	
} 
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaHandle.'&referencia='.$referencia);
}
?>