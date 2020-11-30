<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, 
									   A.NOME value,
									   B.HANDLE ACAOHANDLE,
									   B.NOME ACAO
				FROM OP_TIPOOCORRENCIA A 
		  INNER JOIN OP_ACAOOCORRENCIA B ON A.ACAO = B.HANDLE
							 WHERE A.EHPERMITEMANUAL = 'S'
 								   AND A.STATUS = 3
							  ORDER BY value
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>