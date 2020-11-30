<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();


	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
								FROM MS_FILIAL A  
								LEFT JOIN MS_PESSOA B0 ON A.PESSOA = B0.HANDLE
								WHERE A.EMPRESA = '".$empresa."' 
								AND ( (A.STATUS = 4))
								ORDER BY value ASC
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>