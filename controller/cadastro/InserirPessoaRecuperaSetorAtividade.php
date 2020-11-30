<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	$ramoAtividadeHandle = Sistema::getGet('ramoAtividadeHandle');
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
								FROM MS_SETORATIVIDADE A 
								WHERE ( A.HANDLE IN (SELECT SETOR 
										FROM MS_RAMOATIVIDADESETORATIVIDADE 
										WHERE RAMO = '".$ramoAtividadeHandle."') )
								ORDER BY value ASC
								");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>