<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "  SELECT A.HANDLE HANDLE, A.NOME NOME
				FROM MS_FILIAL A  
				LEFT JOIN MS_PESSOA B0 ON A.PESSOA = B0.HANDLE
				WHERE A.EMPRESA = '".$empresa."' 
				AND ( (A.STATUS = 4))
				ORDER BY NOME ASC
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>