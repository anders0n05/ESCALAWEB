<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT TOP 1000 A.HANDLE id, 
								A.CEP value
								FROM MS_CEP A  
								ORDER BY value ASC
								");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>