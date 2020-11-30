<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NUMERO value
								  FROM OP_VIAGEM A 
								 WHERE A.EHLIBERADOALTERARVALOR = 'S'
								   AND A.EMPRESA = '".$empresa."'
								   AND A.MOTORISTA = '".$pessoa."'
								   AND A.STATUS <> 6
								   AND A.STATUS <> 7
								   AND A.EHDESPESA = 'S'
							  ORDER BY A.value ASC
							   ");
	
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
	
?>