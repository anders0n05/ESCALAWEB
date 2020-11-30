<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, B0.NOME value, b0.HANDLE HANDLEACAO
								FROM
								OP_TIPOOCORRENCIA A  
								LEFT JOIN OP_ACAOOCORRENCIA B0 ON A.ACAO = B0.HANDLE
								WHERE ((((A.ACAO IN (0,6,11,7,18,13,33,10,22,24,25,19,26,23,21,8,1,31)) OR (A.ACAO IS NULL)) 
										AND (EHPERMITEMANUAL = 'S')))
								AND ( (A.STATUS = 3))
								ORDER BY value
								 ASC 
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>