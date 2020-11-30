<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	$pessoa = $_SESSION['pessoa'];
	
	$dados = $connect->prepare("SELECT A.HANDLE, A.NUMERO
								  FROM OP_VIAGEM A 
								 WHERE A.EMPRESA = '".$empresa."'
								   AND A.MOTORISTA = '".$pessoa."'
								   AND A.STATUS <> 6
								   AND A.STATUS <> 7
							  ORDER BY A.NUMERO ASC
							   ");
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>