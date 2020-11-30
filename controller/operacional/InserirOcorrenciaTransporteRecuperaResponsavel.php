<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, 
									   A.NOME value
		 FROM OP_RESPONSAVELOCORRENCIA A
							  ORDER BY value
								");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>