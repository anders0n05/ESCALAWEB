<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	    
	$dados = "SELECT A.HANDLE ,
									   A.NOME 
				FROM OP_TIPOOCORRENCIA A 
							 WHERE ((((A.ACAO IN (0,2,15,4,27,29,11,13,16,28,30)) 
							 	   OR (A.ACAO IS NULL)) 
								  AND (A.EHPERMITEMANUAL = 'S')))
 								   AND A.STATUS = 3
							  ORDER BY A.NOME
				";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>

