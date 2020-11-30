<?php

include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];
$ref = Sistema::getGet('ref');
$motivo = Sistema::getPost('motivo');
$check = NULL;
$mensagem = array();
$protocolo = null;
$sucesso = null;

try {

 	$webservice = 'Administracao';
    include('../tecnologia/WebService.php');

    if ($WebServiceOffline) {
        $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
        header('Location: ../../view/administracao/' . $ref . '.php');
        exit;
    }
	
	for($i=0; $i < count($_POST['check']); $i++){
	$check = $_POST['check'];
    $params = array("aprovacao" => $check[$i], "motivo" => $_POST['motivo']);
    
    $result = $clientSoap->__soapCall("RecusarAprovacao", array("RecusarAprovacao" => array("aprovacao" => $params)));

    $retorno = $result->RecusarAprovacaoResult;

    if (!empty($retorno->mensagem)) {
        $mensagem = $retorno->mensagem;
    }
    if (!empty($retorno->protocolo)) {
        $protocolo = $retorno->protocolo;
    }
    if (!empty($retorno->sucesso)) {
        $sucesso = $retorno->sucesso;
    }


   if ($mensagem == null and $protocolo == null and $sucesso == null) {
        $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/administracao/' . $ref . '.php');
    }

    if ($sucesso == 'True') {
        $_SESSION['protocolo'] = $protocolo;

    } else if ($sucesso == 'False') {
		
		if(empty($_SESSION["error"])){
			$_SESSION["error"] = array(); 	
		}
		
		array_push($_SESSION['error'], $mensagem.'<br> Aprovação: '.$_POST['check'][$i]);	
    }

}//end for
$check = NULL;
$_SESSION['voltou'] = true;
echo"<script language='javascript' type='text/javascript'>window.location.href='../../view/administracao/Aprovacao.php';</script>";
//header('Location: ../../view/administracao/' . $ref . '.php');

} catch (SoapFault $e) {
    var_dump($e->getMessage());

    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/administracao/' . $ref . '.php');
}
?>