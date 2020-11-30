<?php
	include_once('../../controller/tecnologia/Sistema.php');
	include_once('../../controller/tecnologia/WS.php');
	
	date_default_timezone_set('America/Sao_Paulo');
	
	$connect = Sistema::getConexao();
	
	$EHcancelar = Sistema::getPost('cancelar');
	
	if (isset($EHcancelar))
	{
		$handle = Sistema::getPost('handle');
		
		WebService::setupCURL("tarefa/agenda/cancelar", [
			"HANDLE" => $handle
		]);
	}
	else 
	{
		$handle = Sistema::getPost('handle');
		$assunto = Sistema::getPost('assunto');
		$tipo = Sistema::getPost('tipo');
		$previsao = Sistema::getPost('previsao');
		$inicio = Sistema::getPost('inicio');
		$termino = Sistema::getPost('termino');
		$observacao = Sistema::getPost('observacao');
		$usuario = $_SESSION['handleUsuario'];
		
		WebService::setupCURL("tarefa/agenda/gravar", [
			"HANDLE" => $handle,
			"ASSUNTO" => $assunto,
			"TIPO" => $tipo,
			"PREVISAO" => $previsao,
			"INICIO" => $inicio,
			"TERMINO" => $termino,
			"OBSERVACAO" => $observacao,
			"USUARIO" => $usuario
		]);
	}
		
	WebService::execute();
	
	$body = WebService::getBody();
	
	$retorno = json_decode($body, true);
	
	if (isset($retorno["RETORNO"])) 
	{	
		echo $retorno["RETORNO"];
	} 
	else 
	{
		echo Sistema::retornoJson(500, $body);
	}