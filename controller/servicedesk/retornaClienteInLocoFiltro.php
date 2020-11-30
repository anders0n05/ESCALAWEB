<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "  SELECT TOP 1000 
				A.HANDLE, A.APELIDO
				FROM MS_PESSOA A 
				WHERE ( (A.STATUS = 4) )
				ORDER BY A.NOME ASC
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>