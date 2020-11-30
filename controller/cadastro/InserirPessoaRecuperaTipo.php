<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();


	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
								FROM MS_TIPOPESSOA A 
								ORDER BY A.ORDEM ASC 
								");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>