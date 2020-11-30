<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();


	$dados = $connect->prepare("SELECT A.HANDLE id, A.APELIDO value
							  FROM MS_PESSOA A
							 WHERE ( A.EHCLIENTE = 'S' )
							   AND ( (A.STATUS = 4) )
							   AND (    EXISTS(SELECT B.PESSOA 
												 FROM MS_TRANSFERENCIAAGENTE B 
												WHERE B.PESSOA = A.HANDLE 
												  AND B.AGENTEVENDAS = '".$pessoa."')
									OR
									NOT EXISTS(SELECT B.PESSOA 
												 FROM MS_TRANSFERENCIAAGENTE B 
												WHERE B.PESSOA = A.HANDLE) )
							 ORDER BY value ASC
							 
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>