<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT TOP 1000 A.HANDLE id, A.NOME value
								FROM MS_MUNICIPIO A  
								LEFT JOIN MS_ESTADO B0 ON A.ESTADO = B0.HANDLE 
								LEFT JOIN MS_STATUSMUNICIPIO B1 ON A.STATUS = B1.HANDLE
								WHERE ( (A.EHESTADO <> 'S') 
									AND (A.EHMUNICIPIOPOLO <> 'S') 
									AND (A.EHRAIO <> 'S') 
									AND (A.STATUS = 4) )
								ORDER BY value ASC
								");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>