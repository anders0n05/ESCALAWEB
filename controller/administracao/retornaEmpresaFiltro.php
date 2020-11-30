<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = "SELECT A.HANDLE, 
					 A.NOME 
	 FROM MS_EMPRESA A 
			   WHERE A.STATUS = 4
			ORDER BY A.NOME
			 ";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>

