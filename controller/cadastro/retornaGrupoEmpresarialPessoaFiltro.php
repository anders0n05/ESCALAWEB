<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "SELECT A.HANDLE, A.APELIDO NOME
				FROM MS_PESSOA A 
				WHERE ( A.HANDLE <> 0 
				AND  A.EHGRUPOEMPRESARIAL = 'S' 
				AND  A.TIPO IN (2, 4) )
				AND ( (A.STATUS = 4) )
				ORDER BY NOME  ASC 
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>