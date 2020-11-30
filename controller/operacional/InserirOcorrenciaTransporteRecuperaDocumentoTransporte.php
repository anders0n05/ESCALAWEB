<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE ROMANEIOITEM, 
									   B.DOCUMENTO value, 
									   B.HANDLE id
			FROM OP_VIAGEMROMANEIOITEM A
	 INNER JOIN GD_DOCUMENTOTRANSPORTE B ON A.DOCUMENTOTRANSPORTE = B.HANDLE
								 WHERE B.MOTORISTA = '".$pessoa."'
							  ORDER BY value
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>