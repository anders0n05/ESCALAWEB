<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "SELECT A.HANDLE HANDLE, A.APELIDO APELIDO
			  FROM MS_PESSOA A
			 WHERE ( A.EHCLIENTE = 'S' )
			   AND ( (A.STATUS = 4) )
			   AND (    EXISTS(SELECT B.PESSOA 
								 FROM MS_TRANSFERENCIAAGENTE B 
								WHERE B.PESSOA = A.HANDLE 
								  AND B.AGENTEVENDAS = '".$pessoa."')
					OR
					NOT EXISTS(SELECT B.PESSOA 
								 FROM MS_TRANSFERENCIAAGENTE B 
								WHERE B.PESSOA = A.HANDLE) )
			 ORDER BY APELIDO ASC
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>