<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];
$ocorrenciaHandle = Sistema::getGet('ocorrenciaHandle');
$ref = Sistema::getGet('ref');
$_SESSION['ocorrenciaHandle'] = $ocorrenciaHandle;

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
	
    $params = array("ocorrencia" => $ocorrenciaHandle
    );
	
	$webservice = 'Operacional';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/'.$ref.'.php?ocorrencia='.$ocorrenciaHandle.'');
		exit;
	}

    $result = $clientSoap->__soapCall("VoltarOcorrencia", array("VoltarOcorrencia" => array("ocorrencia" => $params)));
     
	$retorno = $result->VoltarOcorrenciaResult;
		
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
		
	header('Location: ../../view/operacional/'.$ref.'.php?ocorrencia='.$ocorrenciaHandle);	
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		
		header('Location: ../../view/operacional/'.$ref.'.php?ocorrencia='.$ocorrenciaHandle.'');
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
	
		header('Location: ../../view/operacional/'.$ref.'.php?ocorrencia='.$ocorrenciaHandle.'');
	}
	
} 
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	header('Location: ../../view/operacional/'.$ref.'.php?ocorrencia='.$ocorrenciaHandle.'');
}
?>