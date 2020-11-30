<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();

	$dados = $connect->prepare("SELECT A.HANDLE id, A.NUMERO value
								FROM SD_INLOCO A
								WHERE A.EMPRESA = '".$empresa."'
								AND A.TECNICO = '".$handleUsuario."'
								AND ( A.STATUS NOT IN (4, 5) ) 
							    ORDER BY value ASC
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>