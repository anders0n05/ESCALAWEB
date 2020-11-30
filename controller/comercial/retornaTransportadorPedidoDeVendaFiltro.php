<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	  $dados = "SELECT A.HANDLE, A.APELIDO
				FROM MS_PESSOA A 
				WHERE (A.RAMOATIVIDADE = 3 
				AND A.SETORATIVIDADE = 1 )
				AND ( (A.STATUS = 4) )
				ORDER BY APELIDO ASC
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>