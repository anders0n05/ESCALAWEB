<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT HANDLE id, NOME value FROM MF_PROPRIEDADEVEICULO");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>