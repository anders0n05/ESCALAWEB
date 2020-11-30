<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
								  FROM MT_ITEM A 
								 WHERE A.EMPRESA = '".$empresa."'
								   AND A.STATUS = 4
								   ORDER BY value ASC
							   ");
	
	$dados->execute();
	header('Content-Type: application/json', true);
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
	
?>