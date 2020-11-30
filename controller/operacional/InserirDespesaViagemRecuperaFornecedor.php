<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
		
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
						FROM MS_PESSOA A 
								 WHERE A.EHFORNECEDOR = 'S' OR (A.EHPRESTADORSERVICO = 'S')
								   AND A.STATUS = 4
							  ORDER BY value ASC 
							   ");
	
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
	
?>