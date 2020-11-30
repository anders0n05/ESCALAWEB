<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];
$ocorrenciaHandle = null;
$ocorrenciaHandle = Sistema::getGet('ocorrenciaHandle');
$motivo = Sistema::getGet('motivo');
$ref = Sistema::getGet('ref');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
	
    $params = array("ocorrencia" => $ocorrenciaHandle,
					"motivo" => $motivo
    );
	$webservice = 'Operacional';
	include_once('../tecnologia/WebService.php');
	
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/'.$ref.'.php?ocorrencia='.$ocorrenciaHandle.'');
		exit;
	}
	
    $result = $clientSoap->__soapCall("CancelarOcorrencia", array("CancelarOcorrencia" => array("ocorrencia" => $params)));
     
	$retorno = $result->CancelarOcorrenciaResult;
	
	
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