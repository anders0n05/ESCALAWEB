<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$tabelaselecionada = Sistema::getGet('tabelaselecionada');

	$dados = $connect->prepare("SELECT A.HANDLE id,A.NOME value
								FROM CM_LISTA A  
								LEFT JOIN CM_TABELA B0 ON A.TABELA = B0.HANDLE
								WHERE  A.EMPRESA = '".$empresa."'
								AND ( '".$datetime."' BETWEEN A.DATAINICIO 
									AND A.DATATERMINO)
								AND ( A.TABELA = '".$tabelaselecionada."')
								ORDER BY value ASC
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>