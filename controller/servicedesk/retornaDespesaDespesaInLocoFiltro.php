<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "  SELECT TOP 1000 A.HANDLE, A.NOME 
				FROM MT_ITEM A
				WHERE A.EMPRESA = '".$empresa."'
				AND ( (A.STATUS = 4 ) )
				AND ( A.TIPO = 2 )
				ORDER BY A.NOME ASC
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>