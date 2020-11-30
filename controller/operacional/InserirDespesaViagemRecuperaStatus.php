<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
								FROM OP_STATUSVIAGEMDESPESA A
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
	
?>