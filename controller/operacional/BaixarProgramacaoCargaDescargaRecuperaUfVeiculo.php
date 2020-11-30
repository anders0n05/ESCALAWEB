<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();

	$dados = $connect->prepare(" SELECT HANDLE id, SIGLA value
								 FROM MS_ESTADO
								 WHERE PAIS = 1
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>