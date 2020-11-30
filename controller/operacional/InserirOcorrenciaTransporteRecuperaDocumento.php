<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, 
									   A.DOCUMENTO value
		   FROM GD_DOCUMENTOTRANSPORTE A
								 WHERE A.MOTORISTA = '".$pessoa."'
								");
	
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>