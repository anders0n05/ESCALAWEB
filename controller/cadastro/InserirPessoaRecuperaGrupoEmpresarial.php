<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.APELIDO value
								FROM MS_PESSOA A 
								WHERE ( A.HANDLE <> 0 
								AND  A.EHGRUPOEMPRESARIAL = 'S' 
								AND  A.TIPO IN (2, 4) )
								AND ( (A.STATUS = 4) )
								ORDER BY value  ASC 
								");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>