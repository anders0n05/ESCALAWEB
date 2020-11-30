<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();

	$item = Sistema::getGet('item');
	$tabela = Sistema::getGet('tabela');
	$lista = Sistema::getGet('lista');
	
	$dados = $connect->prepare("SELECT HANDLE id, VALOR value
								FROM CM_LISTAITEM  
								WHERE ITEM = '".$item."'   
								AND LISTA = '".$lista."' 
								AND TABELA = '".$tabela."' 
								AND STATUS = 4
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>