<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];
$motivo = Sistema::getGet('motivo');

$despesaInLocoHandle = Sistema::getGet('handle');
print_r($_GET);

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
	
    $params = array("inlocoDespesa" => $despesaInLocoHandle,
					"motivo" => $motivo
    );
	$webservice = 'ServiceDesk';
   include_once('../tecnologia/WebService.php');
   
   if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
		exit;
	}

    $result = $clientSoap->__soapCall("CancelarInlocoDespesa", array("CancelarInlocoDespesa" => array("inlocoDespesa" => $params)));
     
	$retorno = $result->CancelarInlocoDespesaResult;
	
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

		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
	}
	
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		
		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;

		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
	}
	
} 
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
}
?>