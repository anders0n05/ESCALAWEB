<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
				  FROM OP_TIPOOPERACAO A 
							    WHERE  A.HANDLE IN (3, 2) 
							  ORDER BY value ASC 
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>