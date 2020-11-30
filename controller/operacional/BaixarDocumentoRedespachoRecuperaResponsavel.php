<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value, A.ORDEM C2
								FROM OP_RESPONSAVELOCORRENCIA A
								ORDER BY C2 ASC 
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>