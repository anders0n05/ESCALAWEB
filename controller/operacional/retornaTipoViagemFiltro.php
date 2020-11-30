<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = $connect->prepare("SELECT A.HANDLE, A.NOME
								  FROM OP_TIPOVIAGEMDESPESA A 
	 							 WHERE A.STATUS = 3
								   AND A.EHPERMITEUTILIZACAOWEB = 'S' 
							  ORDER BY A.NOME ASC 
							   ");
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>

