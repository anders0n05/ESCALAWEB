<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "  SELECT A.HANDLE, A.ASSUNTOATENDIMENTO 
				FROM SD_INLOCO A
				WHERE A.EMPRESA = '".$empresa."'
				  AND A.TECNICO = '".$handleUsuario."'
				AND ( A.STATUS NOT IN (4, 5) ) 
				ORDER BY A.ASSUNTOATENDIMENTO ASC
				";

	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));	
	
?>