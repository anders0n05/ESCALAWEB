<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();

	$dados = $connect->prepare("SELECT TOP 100 A.HANDLE id, A.CODIGO value
								FROM PA_CONTEINER A  
								WHERE ( (A.STATUS IN (4, 5, 6, 7, 8, 9, 10)) )
								ORDER BY value ASC 
							    ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>