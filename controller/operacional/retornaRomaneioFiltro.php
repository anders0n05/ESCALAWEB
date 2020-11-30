<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	$pessoa = $_SESSION['pessoa'];
	
	$dados = $connect->prepare("SELECT A.HANDLE, 
									   A.NUMERO NOME
				FROM OP_VIAGEMROMANEIO A 
							 	 WHERE A.EMPRESA = 1
							  ORDER BY A.NOME
							   ");
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>