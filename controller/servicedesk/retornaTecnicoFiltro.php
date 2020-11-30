<?php
	
		include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = " SELECT A.HANDLE, 
				 A.LOGIN 
		   FROM MS_USUARIO A
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
?>